<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class PengesahanBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('content.pengesahan_berkas.vw_table_pengesahan_berkas');
    }

    public function show(string $id)
    {
        $proposal_id = decrypt($id);
        $data = Proposal::with('informasi_hibah')->findOrFail($proposal_id);
        return view('content.pengesahan_berkas.vw_detail_pengesahan_berkas', compact('data'));
    }

    public function upload_berkas(Request $request)
    {
        $id = $request->id;
        $data = Proposal::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Proposal tidak ditemukan',
            ]);
        }


        if ($request->hasFile('file_sk')) {
            // Hapus file lama jika ada
            if ($data->file_sk && Storage::disk('public')->exists($data->file_sk)) {
                Storage::disk('public')->delete($data->file_sk);
            }

            // Upload file baru
            $filePath = $request->file('file_sk')->store('file_sk', 'public');
            $data->update([
                'file_sk' => $filePath
            ]);
        }

        if ($request->hasFile('file_st')) {
            // Hapus file lama jika ada
            if ($data->file_st && Storage::disk('public')->exists($data->file_st)) {
                Storage::disk('public')->delete($data->file_st);
            }

            // Upload file baru
            $filePath = $request->file('file_st')->store('file_st', 'public');
            $data->update([
                'file_st' => $filePath
            ]);
        }

        if ($request->hasFile('file_kontrak')) {
            // Hapus file lama jika ada
            if ($data->file_kontrak && Storage::disk('public')->exists($data->file_kontrak)) {
                Storage::disk('public')->delete($data->file_kontrak);
            }

            // Upload file baru
            $filePath = $request->file('file_kontrak')->store('file_kontrak', 'public');
            $data->update([
                'file_kontrak' => $filePath
            ]);
        }
        if ($request->hasFile('file_berita_acara')) {
            // Hapus file lama jika ada
            if ($data->file_berita_acara && Storage::disk('public')->exists($data->file_berita_acara)) {
                Storage::disk('public')->delete($data->file_berita_acara);
            }

            // Upload file baru
            $filePath = $request->file('file_berita_acara')->store('file_berita_acara', 'public');
            $data->update([
                'file_berita_acara' => $filePath
            ]);
        }

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
                'message' => 'Berhasil Upload Berkas',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Upload Berkas',
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Proposal::where('status_eksternal', 3)->orderBy('id', 'DESC');
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
                ->addColumn('status_eksternal', function ($value) {
                    return convertStatus($value->status_eksternal)['badge'];
                })
                ->addColumn('action', function ($value) {
                    $encryptedId = encrypt($value->id);
                    if (Auth::user()->role == 'Kesekretariatan' || Auth::user()->role == 'superadmin') {
                        $aksi = '<a href="' . url("pengesahan_berkas/show/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-information fs-2 text-primary"></i></a>
                                <a href="javascript:void(0)" onclick="upload_berkas(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                               <i class="ki-outline ki-file-up fs-2 text-danger"></i>
                            </a>';
                    } else {
                        $aksi = '-';
                    }
                    return $aksi;
                })
                ->rawColumns(['action', 'skema_hibah', 'status_eksternal', 'nama_hibah'])
                ->make(true);
        }
    }
}
