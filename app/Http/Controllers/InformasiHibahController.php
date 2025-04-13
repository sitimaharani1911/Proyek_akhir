<?php

namespace App\Http\Controllers;

use App\Models\InformasiHibah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InformasiHibahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        return view('content.informasi_hibah.vw_table_informasi_hibah', compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_hibah' => 'required',
            'prodi_terlibat' => 'required',
            'kriteria' => 'required',
            'mitra' => 'required',
            'skema_hibah' => 'required',
            'periode_pengajuan_awal' => 'required',
            'periode_pengajuan_akhir' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        if ($request->hasFile('file_pendukung')) {
            $filePath = $request->file('file_pendukung')->store('file_pendukung', 'public');
            $file_pendukung = $filePath;
        } else {
            $file_pendukung = null;
        }

        $data = InformasiHibah::create([
            'nama_hibah' => $request->nama_hibah,
            'prodi_terlibat' => $request->prodi_terlibat,
            'kriteria' => $request->kriteria,
            'mitra' => $request->mitra,
            'skema_hibah' => $request->skema_hibah,
            'periode_pengajuan_awal' => $request->periode_pengajuan_awal,
            'periode_pengajuan_akhir' => $request->periode_pengajuan_akhir,
            'file_pendukung' => $file_pendukung,
            'status' => 1
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
        $hibah_id = decrypt($id);
        $data = InformasiHibah::find($hibah_id);
        return view('content.informasi_hibah.vw_detail_informasi_hibah', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = InformasiHibah::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = InformasiHibah::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Informasi Hibah tidak ditemukan',
            ]);
        }

        $data->update([
            'nama_hibah' => $request->nama_hibah,
            'prodi_terlibat' => $request->prodi_terlibat,
            'kriteria' => $request->kriteria,
            'mitra' => $request->mitra,
            'skema_hibah' => $request->skema_hibah,
            'periode_pengajuan_awal' => $request->periode_pengajuan_awal,
            'periode_pengajuan_akhir' => $request->periode_pengajuan_akhir
        ]);

        if ($request->hasFile('file_pendukung')) {
            // Hapus file lama jika ada
            if ($data->file_pendukung && Storage::disk('public')->exists($data->file_pendukung)) {
                Storage::disk('public')->delete($data->file_pendukung);
            }

            // Upload file baru
            $filePath = $request->file('file_pendukung')->store('file_pendukung', 'public');
            $data->update([
                'file_pendukung' => $filePath
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
        $data = InformasiHibah::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Ditemukan'
            ], 404);
        }

        // Hapus file pendukung dari storage jika ada
        if ($data->file_pendukung && Storage::disk('public')->exists($data->file_pendukung)) {
            Storage::disk('public')->delete($data->file_pendukung);
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
            $data = InformasiHibah::query();
            if ($request->tahun) {
                $data->where('periode_pengajuan_awal', 'like', $request->tahun . '%');
            }
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('nama_hibah', 'like', "%{$search}%")
                                ->orWhere('prodi_terlibat', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('periode_pengajuan', function ($value) {
                    $periode_pengajuan = $value->periode_pengajuan_awal . ' s/d ' . $value->periode_pengajuan_akhir;
                    return $periode_pengajuan;
                })
                ->addColumn('action', function ($value) {
                    $encryptedId = encrypt($value->id);
                    $detail  = '<a href="' . url("informasi_hibah/show/{$encryptedId}") . '"
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

                    if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'superadmin') {
                        $aksi = $detail . $edit . $hapus;
                    } else {
                        $aksi = $detail;
                    }
                    return $aksi;
                })
                ->rawColumns(['action', 'periode_pengajuan'])
                ->make(true);
        }
    }
}
