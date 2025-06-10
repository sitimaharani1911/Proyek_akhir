<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\InformasiHibah;
use App\Models\Proposal;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = 'no-apply';
        $id = '0';
        $hibah = InformasiHibah::all();
        return view('content.proposal.vw_table_proposal', compact('status', 'id', 'hibah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'informasi_hibah_id' => 'required',
            'judul_proposal' => 'required',
            'ketua_hibah' => 'required',
            'abstrak' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        if ($request->hasFile('file_proposal')) {
            $filePath = $request->file('file_proposal')->store('pengajuan_proposal/file_proposal', 'public');
            $file_proposal = $filePath;
        } else {
            $file_proposal = null;
        }

        $data = Proposal::create([
            'informasi_hibah_id' => $request->informasi_hibah_id,
            'judul_proposal' => $request->judul_proposal,
            'ketua_hibah' => $request->ketua_hibah,
            'abstrak' => $request->abstrak,
            'file_proposal' => $file_proposal,
            'persetujuan_piu' => 1,
            'persetujuan_direktur' => 1,
            'status_internal' => 1,
            'status_eksternal' => 1,
            'status_progres' => 1,
            'created_by' => Auth::id()
        ]);

        $data = Notifikasi::create([
            'id_ref' => $data->id,
            'jenis' => 'tambah proposal',
            'pesan' => 'Proposal Baru: ' . $request->judul_proposal,
            'status' => 1,
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
        $proposal_id = decrypt($id);
        $data = Proposal::with('informasi_hibah')->findOrFail($proposal_id);
        return view('content.proposal.vw_detail_proposal', compact('data'));
    }

    public function apply($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $hibah = InformasiHibah::all();
        $status = 'apply';
        return view('content.proposal.vw_table_proposal', compact('status', 'id', 'hibah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Proposal::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = Proposal::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Pengajuan Proposal tidak ditemukan',
            ]);
        }

        $data->update([
            'informasi_hibah_id' => $request->informasi_hibah_id,
            'judul_proposal' => $request->judul_proposal,
            'ketua_hibah' => $request->ketua_hibah,
            'abstrak' => $request->abstrak
        ]);

        if ($request->hasFile('file_proposal')) {
            // Hapus file lama jika ada
            if ($data->file_proposal && Storage::disk('public')->exists($data->file_proposal)) {
                Storage::disk('public')->delete($data->file_proposal);
            }

            // Upload file baru
            $filePath = $request->file('file_proposal')->store('pengajuan_proposal/file_proposal', 'public');
            $data->update([
                'file_proposal' => $filePath
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

    public function update_nilai(Request $request)
    {
        $id = $request->id;
        $data = Proposal::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Pengajuan Proposal tidak ditemukan',
            ]);
        }

        $data->update([
            'catatan' => $request->catatan,
            'nilai' => $request->nilai
        ]);

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
        $data = Proposal::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Ditemukan'
            ], 404);
        }

        // Hapus file pendukung dari storage jika ada
        if ($data->file_proposal && Storage::disk('public')->exists($data->file_proposal)) {
            Storage::disk('public')->delete($data->file_proposal);
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
            $data = Proposal::orderBy('id', 'DESC');
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('judul_proposal', 'like', "%{$search}%")
                                ->orWhere('ketua_hibah', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('skema_hibah', function ($value) {
                    return $value->informasi_hibah->skema_hibah;
                })
                ->addColumn('nama_hibah', function ($value) {
                    return $value->informasi_hibah->nama_hibah;
                })
                ->addColumn('status_internal', function ($value) {
                    return convertStatus($value->status_internal)['badge'];
                })
                ->addColumn('action', function ($value) {
                    $encryptedId = encrypt($value->id);
                    $detail  = '<a href="' . url("proposal/show/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-information fs-2 text-primary"></i></a>';
                    $edit = '<a href="javascript:void(0)" onclick="edit(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-pencil fs-2 text-info"></i>
                            </a>';
                    $hapus = '<a href="javascript:void(0)" onclick="hapus(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                               <i class="ki-outline ki-trash fs-2 text-danger"></i>
                            </a>';

                    if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin') {
                        if ($value->created_by == Auth::id()) {
                            $aksi = $value->status_internal == 3 ? $detail : $detail . $edit . $hapus;
                        } else {
                            $aksi = $detail;
                        }
                    } else {
                        $aksi = $detail;
                    }
                    return $aksi;
                })
                ->rawColumns(['action', 'skema_hibah', 'status_internal', 'nama_hibah'])
                ->make(true);
        }
    }
}
