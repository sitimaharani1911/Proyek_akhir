<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Notifikasi;
use App\Models\Pelaporan;
use App\Models\RoleUser;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $proposal_id)
    {
        // decypt proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $listKegiatan = ListKegiatan::with(['proposal.informasi_hibah'])
            ->where('proposal_id', $proposal_id)
            ->get();
        return view('content.pelaporan.kegiatan.vw_table_kegiatan', compact('listKegiatan', 'proposal_id', 'encryptedId', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $list_kegiatan_id)
    {
        $kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $pelaporan = Pelaporan::where('list_kegiatan_id', $list_kegiatan_id)->first();
        $proposal_id = $kegiatan->proposal_id;
        return view('content.pelaporan.kegiatan.vw_tambah_kegiatan', compact('kegiatan', 'list_kegiatan_id', 'pelaporan', 'proposal_id'));
    }
    public function hasilMonev(string $list_kegiatan_id)
    {
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        return view('content.pelaporan.kegiatan.vw_hasil_monev', compact('pelaporans', 'list_kegiatan_id'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $list_kegiatan_id)
    {
        // ambil data list_kegiatan
        $listKegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $proposalId = $listKegiatan->proposal_id;
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_peserta' => 'required|string|max:255',
            'absensi_peserta' => 'required|file|mimes:pdf|max:5120',
            'pengajuan_dana' => 'required|numeric',
            'penggunaan_dana' => 'required|numeric',
            'sisa_dana' => 'required|numeric',
            'jumlah_luaran' => 'required|integer',
            'satuan_luaran' => 'required|string|max:255',
            'luaran_kegiatan' => 'required|string|max:255',
            'link_luaran' => 'nullable|url|max:255',
            'status_pelaksanaan' => 'required|string|max:255',
            'surat_keputusan' => 'required|file|mimes:pdf|max:5120',
            'surat_tugas' => 'required|file|mimes:pdf|max:5120',
            'laporan_kegiatan' => 'required|file|mimes:pdf|max:5120',
            'laporan_keuangan' => 'required|file|mimes:pdf|max:5120',
            'dampak' => 'required|string|max:255',
            'dokumentasi' => 'required|string|max:255',
            'lainnya' => 'nullable|url|max:255',
            'bukti_pembayaran' => 'required|string|max:255',
        ]);

        //simpan file 
        $absensi_peserta_path = $request->file('absensi_peserta')->store('absensi_peserta', 'public');
        $surat_keputusan_path = $request->file('surat_keputusan')->store('surat_keputusan', 'public');
        $surat_tugas_path = $request->file('surat_tugas')->store('surat_tugas', 'public');
        $laporan_kegiatan_path = $request->file('laporan_kegiatan')->store('laporan_kegiatan', 'public');
        $laporan_keuangan_path = $request->file('laporan_keuangan')->store('laporan_keuangan', 'public');

        $validated['absensi_peserta'] = $absensi_peserta_path;
        $validated['surat_keputusan'] = $surat_keputusan_path;
        $validated['surat_tugas'] = $surat_tugas_path;
        $validated['laporan_kegiatan'] = $laporan_kegiatan_path;
        $validated['laporan_keuangan'] = $laporan_keuangan_path;
        $validated['list_kegiatan_id'] = $list_kegiatan_id;

        Pelaporan::create($validated);
        $userIds = RoleUser::whereIn('role', ['Monev', 'Keuangan'])->pluck('user_id');

        foreach ($userIds as $userId) {
            Notifikasi::create([
                'pesan' => 'Laporan kegiatan baru telah dibuat untuk kegiatan "' . $listKegiatan->nama_kegiatan . '".',
                'status' => 1,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('kegiatan.index', ['proposal_id' => encrypt($proposalId)])
            ->with('success', 'Pelaporan berhasil ditambahkan!');
    }

    public function reviewLaporan(string $list_kegiatan_id)
    {
        $list_kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $proposal_id = $list_kegiatan->proposal_id;
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        foreach ($pelaporans as $pelaporan) {
            $pelaporan["serapan_dana"] = (($pelaporan['pengajuan_dana'] - $pelaporan["sisa_dana"]) / $pelaporan["pengajuan_dana"]) * 100;
            // dd($pelaporan->toArray());
        }
        // dd($pelaporans->toArray());
        return view('content.pelaporan.kegiatan.vw_hasil_review_keuangan', compact('pelaporans', 'list_kegiatan_id', 'proposal_id'));
    }
    public function reviewLaporanPiu(string $list_kegiatan_id)
    {
        $list_kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $proposal_id = $list_kegiatan->proposal_id;
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        foreach ($pelaporans as $pelaporan) {
            $pelaporan["serapan_dana"] = (($pelaporan['pengajuan_dana'] - $pelaporan["sisa_dana"]) / $pelaporan["pengajuan_dana"]) * 100;
            // dd($pelaporan->toArray());
        }
        // dd($pelaporans->toArray());
        return view('content.pelaporan.kegiatan.vw_hasil_review_piu', compact('pelaporans', 'list_kegiatan_id', 'proposal_id'));
    }
    public function reviewLaporanPimpinan(string $list_kegiatan_id)
    {
        $list_kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $proposal_id = $list_kegiatan->proposal_id;
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        foreach ($pelaporans as $pelaporan) {
            $pelaporan["serapan_dana"] = (($pelaporan['pengajuan_dana'] - $pelaporan["sisa_dana"]) / $pelaporan["pengajuan_dana"]) * 100;
            // dd($pelaporan->toArray());
        }
        // dd($pelaporans->toArray());
        return view('content.pelaporan.kegiatan.vw_hasil_review_pimpinan', compact('pelaporans', 'list_kegiatan_id', 'proposal_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $list_kegiatan_id)
    {
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        return view('content.pelaporan.kegiatan.vw_detail_kegiatan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('content.pelaporan.kegiatan.vw_edit_kegiatan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dataKegiatan(Request $request)
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
                // hasil review keuangan
                ->addColumn('hasil_review_keuangan', function ($value) {
                    return '<a href="' . url("kegiatan/review-keuangan/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-file fs-2 text-primary"></i></a>';
                })
                // hasil review piu
                ->addColumn('hasil_review_piu', function ($value) {
                    return '<a href="' . url("kegiatan/review-piu/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-file fs-2 text-primary"></i></a>';
                })
                // hasil review pimpinan
                ->addColumn('hasil_review_pimpinan', function ($value) {
                    return '<a href="' . url("kegiatan/review-pimpinan/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-file fs-2 text-primary"></i></a>';
                })
                // hasil monev
                ->addColumn('hasil_monev', function ($value) {
                    return '<a href="' . url("pelaporan/show/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-file fs-2 text-primary"></i></a>';
                })
                // buat laporan
                ->addColumn('buat_laporan', function ($value) {
                    return '<a href="' . url("kegiatan/buat-laporan/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-file-earmark-plus fs-2 text-primary"></i></a>';
                })
                ->rawColumns(['hasil_review_keuangan', 'hasil_review_piu', 'hasil_review_pimpinan', 'hasil_monev', 'buat_laporan', 'ketua_hibah', 'nama_kegiatan'])
                ->make(true);
        }
    }
}
