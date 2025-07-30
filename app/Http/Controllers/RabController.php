<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $proposal = Proposal::where('created_by', $id)->get();
        return view('content.rab.vw_table_rab', compact('proposal'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proposal_id' => 'required',
            'tujuan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        if ($request->hasFile('file_rab')) {

            $rules = [
                'file_rab' => 'mimes:xls,xlsx|max:10240'
            ];

            $messages = [
                'file_rab.mimes' => 'Format file tidak didukung. Format yang diperbolehkan: xls, xlsx.',
                'file_rab.max' => 'Ukuran file terlalu besar. Maksimal 10 MB.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                $errorMessage = $validator->errors()->first('file_rab');

                return response()->json([
                    'status' => false,
                    'message' => $errorMessage
                ]);
            }

            $filePath = $request->file('file_rab')->store('file_rab', 'public');
            $file_rab = $filePath;
        } else {
            $file_rab = null;
        }

        $data = Rab::create([
            'proposal_id' => $request->proposal_id,
            'tujuan' => $request->tujuan,
            'file_rab' => $file_rab,
            'created_by' => Auth::user()->id
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Disimpan',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menyimpan Data',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rab_id = decrypt($id);
        $data = Rab::find($rab_id);
        return view('content.rab.vw_detail_rab', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Rab::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = Rab::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Rab tidak ditemukan',
            ]);
        }

        $data->update([
            'proposal_id' => $request->proposal_id,
            'tujuan' => $request->tujuan
        ]);

        if ($request->hasFile('file_rab')) {
            // Hapus file lama jika ada
            if ($data->file_rab && Storage::disk('public')->exists($data->file_rab)) {
                Storage::disk('public')->delete($data->file_rab);
            }

            // Upload file baru
            $filePath = $request->file('file_rab')->store('file_rab', 'public');
            $data->update([
                'file_rab' => $filePath
            ]);
        }

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Mengubah Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah data',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Rab::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Ditemukan'
            ], 404);
        }

        // Hapus file rab dari storage jika ada
        if ($data->file_rab && Storage::disk('public')->exists($data->file_rab)) {
            Storage::disk('public')->delete($data->file_rab);
        }
        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil dihapus',
        ]);
    }
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Rab::with('proposal.informasi_hibah')
                ->orderBy('id', 'DESC');
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('tujuan', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('skema_hibah', function ($value) {
                    return $value->proposal->informasi_hibah->skema_hibah;
                })
                ->addColumn('nama_hibah', function ($value) {
                    return $value->proposal->informasi_hibah->nama_hibah;
                })
                ->addColumn('judul_proposal', function ($value) {
                    return $value->proposal->judul_proposal;
                })
                ->addColumn('status_internal', function ($value) {
                    return convertStatus($value->proposal->status_internal)['badge'];
                })
                ->addColumn('action', function ($value) {
                    $id = Auth::user()->id;
                    $encryptedId = encrypt($value->id);
                    $detail  = '<a href="' . url("rab/show/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-eye fs-2 text-primary"></i></a>';
                    $edit = '<a href="javascript:void(0)" onclick="edit(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-pencil fs-2 text-info"></i>
                            </a>';
                    $hapus = '<a href="javascript:void(0)" onclick="hapus(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                               <i class="ki-outline ki-trash fs-2 text-danger"></i>
                            </a>';

                    if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin') {
                        $aksi = ($id == $value->created_by) ? $detail . $edit . $hapus : $detail;
                    } else {
                        $aksi = $detail;
                    }
                    return $aksi;
                })
                ->rawColumns(['action', 'skema_hibah', 'nama_hibah', 'judul_proposal', 'status_internal'])
                ->make(true);
        }
    }
}
