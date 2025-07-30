<?php

namespace App\Http\Controllers;

use App\Models\DokumenHibah;
use App\Models\ListKegiatan;
use App\Models\Monev;
use App\Models\Notifikasi;
use App\Models\Pelaporan;
use App\Models\Proposal;
use App\Models\ReviewKeuangan;
use App\Models\ReviewPimpinan;
use App\Models\ReviewPIU;
use App\Models\RoleUser;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MonevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        // dd($proposals->toArray());
        return view('content.monev.vw_table_monev', compact('proposals', 'years'));
    }
    public function dataKegiatan(string $proposal_id)
    {
        // decrypt proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $kegiatans = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.monev.vw_table_monev_kegiatan', compact('kegiatans', 'proposal_id', 'encryptedId', 'years'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function reviewLaporan(string $list_kegiatan_id)
    {
        try {
            // decrypt list_kegiatan_id
            $list_kegiatan_id = Crypt::decrypt($list_kegiatan_id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle invalid encrypted value
            return redirect()->route('monev.index')->with('error', 'ID Kegiatan tidak valid.');
        }

        $list_kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $proposal_id = $list_kegiatan->proposal_id;

        // --- INI BAGIAN YANG DIPERBAIKI ---
        // Mengambil HANYA SATU laporan (yang paling baru) untuk kegiatan ini.
        // Bukan lagi mengambil semua laporan.
        $pelaporan = Pelaporan::with(['list_kegiatan.proposal', 'monev'])
            ->where('list_kegiatan_id', $list_kegiatan_id)
            ->orderBy('created_at', 'desc') // Urutkan dari laporan terbaru
            ->first(); // <--- Mengubah .get() menjadi .first()

        // Jangan lupa ganti nama view sesuai dengan yang Anda gunakan
        return view('content.monev.vw_review_laporan', compact('pelaporan', 'list_kegiatan_id', 'proposal_id'));
    }
    public function detailDokumen($informasi_hibah_id)
    {
        // decrypt informasi_hibah_id
        $informasi_hibah_id = decrypt($informasi_hibah_id);
        $documents = DokumenHibah::with('informasi_hibah')->where('informasi_hibah_id', $informasi_hibah_id)->get();
        // dd($documents->toArray());
        return view('content.monev.vw_detail_dokumen', compact('documents'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // 1. Hapus $pelaporan_id dari sini
    {
        $validated = $request->validate([
            'pelaporan_id' => 'required|exists:pelaporan,id', // 2. Tambahkan validasi untuk pelaporan_id
            'status_pengajuan_dana' => 'required|string|max:255',
            'catatan_pengajuan_dana' => 'nullable|string|max:2550',
            'status_penggunaan_dana' => 'required|string|max:255',
            'catatan_penggunaan_dana' => 'nullable|string|max:2550',
            'status_sisa_dana' => 'required|string|max:255',
            'catatan_sisa_dana' => 'nullable|string|max:2550',
            'status_surat_keputusan' => 'required|string|max:255',
            'catatan_surat_keputusan' => 'nullable|string|max:2550',
            'status_surat_tugas' => 'required|string|max:255',
            'catatan_surat_tugas' => 'nullable|string|max:2550',
            'status_laporan_kegiatan' => 'required|string|max:255',
            'catatan_laporan_kegiatan' => 'nullable|string|max:2550',
            'status_laporan_keuangan' => 'required|string|max:255',
            'catatan_laporan_keuangan' => 'nullable|string|max:2550',
            'status_luaran' => 'required|string|max:255',
            'catatan_luaran' => 'nullable|string|max:2550',
            'status_dampak' => 'required|string|max:255',
            'catatan_dampak' => 'nullable|string|max:2550',
            'status_dokumentasi' => 'required|string|max:255',
            'catatan_dokumentasi' => 'nullable|string|max:2550',
            'status_lainnya' => 'required|string|max:255',
            'catatan_lainnya' => 'nullable|string|max:2550',
            'persentase_capaian' => 'required|numeric',
            'status' => 'required|string|max:255',
            'tim_monev' => 'required|string|max:255',
            'laporan_monev' => 'required|file|mimes:pdf|max:5120',
        ]);

        $laporan_monev_path = $request->file('laporan_monev')->store('laporan_monev', 'public');

        // Data yang sudah divalidasi sekarang sudah mencakup pelaporan_id
        $dataToCreate = $validated;
        $dataToCreate['laporan_monev'] = $laporan_monev_path;

        Monev::create($dataToCreate);

        // 3. Ambil pelaporan_id dari data yang sudah divalidasi
        $pelaporan_id = $validated['pelaporan_id'];

        $pelaporan = Pelaporan::findOrFail($pelaporan_id);
        $listKegiatan = ListKegiatan::findOrFail($pelaporan->list_kegiatan_id);
        $namaKegiatan = $listKegiatan->nama_kegiatan;
        $proposalId = $listKegiatan->proposal_id;

        $pelaksanaUsers = RoleUser::where('role', 'Pelaksana')->pluck('user_id');

        foreach ($pelaksanaUsers as $userId) {
            Notifikasi::create([
                'pesan' => 'Monev telah ditambahkan oleh Tim Monev untuk kegiatan "' . $namaKegiatan . '".',
                'status' => 1, // 1: unread
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('monev.kegiatan', ['proposal_id' => encrypt($proposalId)])
            ->with('success', 'Review berhasil ditambahkan!');
    }
    public function storePIU(Request $request, $pelaporan_id)
    {
        $validated = $request->validate([
            'catatan' => 'required|string|max:2550',
        ]);

        $validated['pelaporan_id'] = $pelaporan_id;

        ReviewPIU::create($validated);
        $pelaporan = Pelaporan::findOrFail($pelaporan_id);
        $listKegiatan = ListKegiatan::findOrFail($pelaporan->list_kegiatan_id);
        $namaKegiatan = $listKegiatan->nama_kegiatan;
        $proposalId = $listKegiatan->proposal_id;
        $pelaksanaUsers = RoleUser::where('role', 'Pelaksana')->pluck('user_id');

        foreach ($pelaksanaUsers as $userId) {
            Notifikasi::create([
                'pesan' => 'Review laporan baru dari PIU untuk kegiatan"' . $namaKegiatan . '". telah ditambahkan.',
                'status' => 1, // 1: unread
                'user_id' => $userId,
            ]);
        }
        return redirect()->route('piu.kegiatan', ['proposal_id' => encrypt($proposalId)])
            ->with('success', 'Review berhasil ditambahkan!');
    }
    public function storePimpinan(Request $request, $pelaporan_id)
    {
        $validated = $request->validate([
            'catatan' => 'required|string|max:2550',
        ]);

        $validated['pelaporan_id'] = $pelaporan_id;

        ReviewPimpinan::create($validated);
        $pelaporan = Pelaporan::findOrFail($pelaporan_id);
        $listKegiatan = ListKegiatan::findOrFail($pelaporan->list_kegiatan_id);
        $namaKegiatan = $listKegiatan->nama_kegiatan;
        $proposalId = $listKegiatan->proposal_id;

        $pelaksanaUsers = RoleUser::where('role', 'Pelaksana')->pluck('user_id');

        foreach ($pelaksanaUsers as $userId) {
            Notifikasi::create([
                'pesan' => 'Review laporan baru dari Pimpinan untuk kegiatan"' . $namaKegiatan . '". telah ditambahkan.',
                'status' => 1, // 1: unread
                'user_id' => $userId,
            ]);
        }
        return redirect()->route('pimpinan.kegiatan', ['proposal_id' => encrypt($proposalId)])
            ->with('success', 'Review berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monev $monev)
    {
        $this->validateMonev($request, $isUpdate = true)->validate();

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('laporan_monev')) {
            // Hapus file lama jika ada
            if ($monev->laporan_monev && Storage::disk('public')->exists($monev->laporan_monev)) {
                Storage::disk('public')->delete($monev->laporan_monev);
            }
            // Simpan file baru
            $data['laporan_monev'] = $request->file('laporan_monev')->store('laporan-monev', 'public');
        }

        $monev->update($data);

        return redirect()->back()->with('success', 'Review Laporan berhasil diperbarui!');
    }

    /**
     * Helper untuk validasi data monev.
     */
    private function validateMonev(Request $request, $isUpdate = false)
    {
        $rules = [
            'pelaporan_id' => 'required|exists:pelaporan,id',
            'status_luaran' => 'required|in:Diterima,Ditolak',
            'catatan_luaran' => 'nullable|string|max:255',
            'status_pengajuan_dana' => 'required|in:Diterima,Ditolak',
            'catatan_pengajuan_dana' => 'nullable|string|max:255',
            'status_penggunaan_dana' => 'required|in:Diterima,Ditolak',
            'catatan_penggunaan_dana' => 'nullable|string|max:255',
            'status_sisa_dana' => 'required|in:Diterima,Ditolak',
            'catatan_sisa_dana' => 'nullable|string|max:255',
            'status_surat_keputusan' => 'required|in:Diterima,Ditolak',
            'catatan_surat_keputusan' => 'nullable|string|max:255',
            'status_surat_tugas' => 'required|in:Diterima,Ditolak',
            'catatan_surat_tugas' => 'nullable|string|max:255',
            'status_laporan_kegiatan' => 'required|in:Diterima,Ditolak',
            'catatan_laporan_kegiatan' => 'nullable|string|max:255',
            'status_laporan_keuangan' => 'required|in:Diterima,Ditolak',
            'catatan_laporan_keuangan' => 'nullable|string|max:255',
            'status_dampak' => 'required|in:Diterima,Ditolak',
            'catatan_dampak' => 'nullable|string|max:255',
            'status_dokumentasi' => 'required|in:Diterima,Ditolak',
            'catatan_dokumentasi' => 'nullable|string|max:255',
            'status_lainnya' => 'required|in:Diterima,Ditolak',
            'catatan_lainnya' => 'nullable|string|max:255',
            'persentase_capaian' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:open,close',
            'laporan_monev' => ($isUpdate ? 'nullable' : 'required') . '|file|mimes:pdf|max:2048',
            'tim_monev' => 'required|string|max:255',
        ];

        return Validator::make($request->all(), $rules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // KETUA PIU
    public function monevPiu()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        // dd($proposals->toArray());
        return view('content.monev_piu.vw_table_monev', compact('proposals', 'years'));
    }
    public function monevPiuKegiatan(string $proposal_id)
    {
        // decrypt proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $kegiatans = ListKegiatan::where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.monev_piu.vw_table_monev_kegiatan', compact('kegiatans', 'proposal_id', 'encryptedId', 'years'));
    }
    public function monevPiuReview(string $list_kegiatan_id)
    {
        // decrypt list_kegiatan_id
        $list_kegiatan_id = decrypt($list_kegiatan_id);
        $pelaporans = Pelaporan::with('list_kegiatan', 'monev')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        $monevs = Monev::with('pelaporan')
            ->where('pelaporan_id', $pelaporans[0]['id'] ?? null)
            ->first();

        // dd($monevs);
        return view('content.monev_piu.vw_monev_ketua_piu', compact('pelaporans', 'list_kegiatan_id', 'monevs'));
    }
    // PIMPINAN
    public function monevPimpinan()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        //dd($proposals->toArray());
        return view('content.monev_pimpinan.vw_table_monev', compact('proposals', 'years'));
    }
    public function monevPimpinanKegiatan(string $proposal_id)
    {
        // decrypt proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $kegiatans = ListKegiatan::where('proposal_id', $proposal_id)->get();
        //dd($kegiatans->toArray());
        return view('content.monev_pimpinan.vw_table_monev_kegiatan', compact('kegiatans', 'proposal_id', 'encryptedId', 'years'));
    }

    public function monevPimpinanReview(string $list_kegiatan_id)
    {
        // decrypt list_kegiatan_id
        $list_kegiatan_id = decrypt($list_kegiatan_id);
        $pelaporans = Pelaporan::with('list_kegiatan', 'monev')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        $monevs = Monev::with('pelaporan')
            ->where('pelaporan_id', $pelaporans[0]['id'] ?? null)
            ->first();
        return view('content.monev_pimpinan.vw_monev_pimpinan', compact('pelaporans', 'list_kegiatan_id', 'monevs'));
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
                ->addColumn('nama_hibah', function ($value) {
                    return $value->informasi_hibah->nama_hibah;
                })
                ->addColumn('skema_hibah', function ($value) {
                    return $value->informasi_hibah->skema_hibah;
                })


                ->addColumn('kegiatan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("monev/monev-kegiatan/{$encryptedId}") . '"
                                class="btn btn-sm btn-primary me-1">
                                Detail</a>';

                    return $detail;
                })
                ->addColumn('kegiatanPIU', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("piu/kegiatan/{$encryptedId}") . '"
                                class="btn btn-sm btn-primary me-1">
                                Detail</a>';

                    return $detail;
                })
                ->addColumn('kegiatanPimpinan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("pimpinan/kegiatan/{$encryptedId}") . '"
                                class="btn btn-sm btn-primary me-1">
                                Detail</a>';

                    return $detail;
                })

                // dokumen
                ->addColumn('dokumen', function ($value) {
                    $encryptedId = encrypt($value->informasi_hibah->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("monev/detail-dokumen/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-file-earmark-pdf fs-2 text-primary"></i></a>';
                    return $detail;
                })
                ->rawColumns(['kegiatan', 'skema_hibah', 'nama_hibah', 'dokumen', 'kegiatanPIU', 'kegiatanPimpinan'])
                ->make(true);
        }
    }

    public function dataListKegiatan(Request $request)
    {
        if ($request->ajax()) {
            $proposal_id = decrypt($request->proposal_id);
            // dd($proposal_id);
            $data = ListKegiatan::with(['proposal.informasi_hibah'])->where('proposal_id', $proposal_id)->orderBy('id', 'DESC');
            if ($request->tahun) {
                $data->where('created_at', 'like', $request->tahun . '%');
            }
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('nama_kegiatan', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                // add kolom ketua hibah
                ->addColumn('ketua_hibah', function ($value) {
                    return $value->proposal->ketua_hibah;
                })
                // kolom aksi
                ->addColumn('aksi', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("monev/review-laporan/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-pencil-square fs-2 text-primary"></i></a>';
                    return $detail;
                })

                ->addColumn('aksiPIU', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("piu/verifikasi/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-pencil-square fs-2 text-primary"></i></a>';
                    return $detail;
                })
                ->addColumn('aksiPimpinan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("pimpinan/verifikasi/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-pencil-square fs-2 text-primary"></i></a>';
                    return $detail;
                })

                ->rawColumns(['ketua_hibah', 'nama_kegiatan', 'aksi', 'aksiPIU', 'aksiPimpinan'])
                ->make(true);
        }
    }
}
