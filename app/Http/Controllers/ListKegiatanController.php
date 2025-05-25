<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Proposal;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ListKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $proposal = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        return view('content.list_kegiatan.vw_table_proposal', compact('proposal', 'years'));
    }

    public function listKegiatan(string $proposal_id)
    {

        // Decrypt the proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $listKegiatan = ListKegiatan::where('proposal_id', $proposal_id)->get();
        // dd($listKegiatan->toArray());
        return view('content.list_kegiatan.vw_table_list_kegiatan', compact(['listKegiatan', 'proposal_id', 'years', 'encryptedId']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        return view('content.list_kegiatan.vw_tambah_list_kegiatan', compact('proposal_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $proposal_id)
    {
        $validated = $request->validate([
            'jenis_aktivitas' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'jumlah_luaran' => 'required|integer',
            'satuan_luaran' => 'required|string|max:255',
            'luaran_kegiatan' => 'required|string|max:255',
            'status_pelaksanaan_kegiatan' => 'required|string|max:255',
            'total_pengajuan_anggaran' => 'required|numeric',
            'total_penggunaan_anggaran' => 'required|numeric',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'rentang_pengerjaan' => 'required|string|max:255',
            'panitia_pengerjaan' => 'required|string|max:255',
            'rincian_jumlah_peserta' => 'required|string|max:255',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'surat_kerja' => 'required|file|mimes:pdf|max:5120',
            'surat_tugas' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Simpan file jika ada
        $surat_kerja_path = $request->file('surat_kerja')->store('surat_kerja', 'public');
        $surat_tugas_path = $request->file('surat_tugas')->store('surat_tugas', 'public');


        $validated['surat_kerja'] = $surat_kerja_path;
        $validated['surat_tugas'] = $surat_tugas_path;
        $validated['proposal_id'] = $proposal_id;

        // Simpan data ke tabel list_kegiatan
        ListKegiatan::create($validated);

        return redirect()->route('list-kegiatan.data', ['proposal_id' =>  encrypt($proposal_id)])
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $kegiatan = ListKegiatan::with('proposal')->findOrFail($id);
        // dd($kegiatan->toArray());
        return view('content.list_kegiatan.vw_detail_list_kegiatan', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Decrypt the ID
        $id = decrypt($id);
        $kegiatan = ListKegiatan::findOrFail($id);
        return view('content.list_kegiatan.vw_edit_list_kegiatan', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_aktivitas' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'jumlah_luaran' => 'required|numeric',
            'satuan_luaran' => 'required|string|max:255',
            'luaran_kegiatan' => 'required|string|max:255',
            'status_pelaksanaan_kegiatan' => 'required|string|max:255',
            'total_pengajuan_anggaran' => 'required|numeric',
            'total_penggunaan_anggaran' => 'required|numeric',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'rentang_pengerjaan' => 'required|string|max:255',
            'panitia_pengerjaan' => 'required|string|max:255',
            'rincian_jumlah_peserta' => 'required|string|max:255',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'surat_kerja' => 'nullable|file|mimes:pdf|max:512',
            'surat_tugas' => 'nullable|file|mimes:pdf|max:512',
        ]);

        $kegiatan = ListKegiatan::findOrFail($id);

        // Simpan file jika ada upload baru
        if ($request->hasFile('surat_kerja')) {
            $suratKerja = $request->file('surat_kerja')->store('surat_kerja', 'public');
            $kegiatan->surat_kerja = $suratKerja;
        }

        if ($request->hasFile('surat_tugas')) {
            $suratTugas = $request->file('surat_tugas')->store('surat_tugas', 'public');
            $kegiatan->surat_tugas = $suratTugas;
        }

        // Update field lainnya
        $kegiatan->jenis_aktivitas = $request->jenis_aktivitas;
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->jumlah_luaran = $request->jumlah_luaran;
        $kegiatan->satuan_luaran = $request->satuan_luaran;
        $kegiatan->luaran_kegiatan = $request->luaran_kegiatan;
        $kegiatan->status_pelaksanaan_kegiatan = $request->status_pelaksanaan_kegiatan;
        $kegiatan->total_pengajuan_anggaran = $request->total_pengajuan_anggaran;
        $kegiatan->total_penggunaan_anggaran = $request->total_penggunaan_anggaran;
        $kegiatan->tanggal_awal = $request->tanggal_awal;
        $kegiatan->tanggal_akhir = $request->tanggal_akhir;
        $kegiatan->rentang_pengerjaan = $request->rentang_pengerjaan;
        $kegiatan->panitia_pengerjaan = $request->panitia_pengerjaan;
        $kegiatan->rincian_jumlah_peserta = $request->rincian_jumlah_peserta;
        $kegiatan->tempat_pelaksanaan = $request->tempat_pelaksanaan;

        $kegiatan->save();

        return redirect()->route('list-kegiatan.data', ['proposal_id' => encrypt($kegiatan->proposal_id)])
            ->with('success', 'Data berhasil diperbarui');
    }



    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $kegiatan = ListKegiatan::findOrFail($id);

        // Hapus data kegiatan
        $kegiatan->delete();

        // Redirect dengan pesan sukses
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil dihapus',
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->orderBy('id', 'DESC');
            if ($request->tahun) {
                $data->where('created_at', 'like', $request->tahun . '%');
            }
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
                ->addColumn('kegiatan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("list-kegiatan/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-information fs-2 text-primary"></i></a>';

                    return $detail;
                })
                ->rawColumns(['kegiatan', 'skema_hibah', 'nama_hibah'])
                ->make(true);
        }
    }

    public function dataKegiatan(Request $request)
    {
        if ($request->ajax()) {
            $proposal_id = decrypt($request->proposal_id);
            // dd($proposal_id);
            $data = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->orderBy('id', 'DESC');
            if ($request->tahun) {
                $data->where('created_at', 'like', $request->tahun . '%');
            }
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('nama_kegiatan', 'like', "%{$search}%")
                                ->orWhere('jenis_aktivitas', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('jenis_hibah', function ($value) {
                    return $value->proposal->informasi_hibah->skema_hibah;
                })
                // kolom program studi
                ->addColumn('program_studi', function ($value) {
                    return $value->proposal->informasi_hibah->prodi_terlibat;
                })
                ->addColumn('aksi', function ($value) {
                    $encryptedId = encrypt($value->id);
                    $detail  = '<a href="' . url("list-kegiatan/show/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-information fs-2 text-primary"></i></a>';
                    $edit = '<a href="' . url("list-kegiatan/{$encryptedId}/edit") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-pencil fs-2 text-info"></i>
                            </a>';
                    $hapus = '<a href="javascript:void(0)" onclick="hapus(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                               <i class="ki-outline ki-trash fs-2 text-danger"></i>
                            </a>';

                    $aksi = $detail . $edit . $hapus;
                    return $aksi;
                })
                ->addColumn('surat_kerja', function ($value) {
                    return '<a href="' . asset('storage/' . $value->surat_kerja) . '" target="_blank">Lihat</a>';
                })
                ->addColumn('surat_tugas', function ($value) {
                    return '<a href="' . asset('storage/' . $value->surat_tugas) . '" target="_blank">Lihat</a>';
                })
                ->addColumn('template_laporan', function ($value) {
                    return '<a href="' . url("template_laporan/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-file fs-2 text-primary"></i></a>';
                })
                ->rawColumns(['aksi', 'surat_kerja', 'surat_tugas', 'template_laporan', 'jenis_hibah', 'program_studi'])
                ->make(true);
        }
    }
}
