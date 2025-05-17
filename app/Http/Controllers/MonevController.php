<?php

namespace App\Http\Controllers;

use App\Models\DokumenHibah;
use App\Models\ListKegiatan;
use App\Models\Monev;
use App\Models\Pelaporan;
use App\Models\Proposal;
use App\Models\ReviewKeuangan;
use App\Models\ReviewPimpinan;
use App\Models\ReviewPIU;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class MonevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        // dd($proposals->toArray());
        return view('content.monev.vw_table_monev', compact('proposals'));
    }
    public function dataKegiatan(string $proposal_id)
    {
        $kegiatans = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.monev.vw_table_monev_kegiatan', compact('kegiatans', 'proposal_id'));
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
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        
        // dd($pelaporans->toArray());
        return view('content.monev.vw_review_laporan', compact('pelaporans', 'list_kegiatan_id'));
    }
    public function detailDokumen($informasi_hibah_id)
    {
        $documents = DokumenHibah::with('informasi_hibah')->where('informasi_hibah_id', $informasi_hibah_id)->get();
        // dd($documents->toArray());
        return view('content.monev.vw_detail_dokumen', compact('documents'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $pelaporan_id)
    {
        $validated = $request->validate([
            'status_pengajuan_dana' => 'required|string|max:255',
            'catatan_pengajuan_dana' => 'nullable|string|max:2550',
            'status_sisa_dana' => 'required|string|max:255',
            'catatan_sisa_dana' => 'nullable|string|max:2550',
            'status_surat_kerja' => 'required|string|max:255',
            'catatan_surat_kerja' => 'nullable|string|max:2550',
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
            'nilai' => 'required|numeric',
            'persentase_capaian' => 'required|numeric',
            'status' => 'required|string|max:255',
            'tim_monev' => 'required|string|max:255',
            'laporan_monev' => 'required|file|mimes:pdf|max:5120',
        ]);

        $laporan_monev_path = $request->file('laporan_monev')->store('laporan_monev', 'public');
        $validated['pelaporan_id'] = $pelaporan_id;
        $validated['laporan_monev'] = $laporan_monev_path;
        Monev::create($validated);
        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');

    }
    public function storePIU(Request $request, $pelaporan_id)
    {
        $validated = $request->validate([
            'catatan' => 'required|string|max:2550',
        ]);

        $validated['pelaporan_id'] = $pelaporan_id;

        ReviewPIU::create($validated);
        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');

    }
    public function storePimpinan(Request $request, $pelaporan_id)
    {
        $validated = $request->validate([
            'catatan' => 'required|string|max:2550',
        ]);

        $validated['pelaporan_id'] = $pelaporan_id;

        ReviewPimpinan::create($validated);
        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');

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
    // KETUA PIU
    public function monevPiu()
    {
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        // dd($proposals->toArray());
        return view('content.monev_piu.vw_table_monev', compact('proposals'));
    }
    public function monevPiuKegiatan(string $proposal_id)
    {
        $kegiatans = ListKegiatan::where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.monev_piu.vw_table_monev_kegiatan', compact('kegiatans', 'proposal_id'));
    }
    public function monevPiuReview(string $list_kegiatan_id)
    {
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        $monevs = Monev::with('pelaporan')->where('pelaporan_id', $pelaporans[0]['id'])->first();
        // dd($monevs);
        return view('content.monev_piu.vw_monev_ketua_piu', compact('pelaporans', 'list_kegiatan_id', 'monevs'));
    }
    // PIMPINAN
    public function monevPimpinan()
    {
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        //dd($proposals->toArray());
        return view('content.monev_pimpinan.vw_table_monev' , compact('proposals'));
    }
    public function monevPimpinanKegiatan(string $proposal_id)
    {
        $kegiatans = ListKegiatan::where('proposal_id', $proposal_id)->get();
        //dd($kegiatans->toArray());
        return view('content.monev_pimpinan.vw_table_monev_kegiatan', compact('kegiatans', 'proposal_id'));
    }
       
    public function monevPimpinanReview(string $list_kegiatan_id)
    {
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        $monevs = Monev::with('pelaporan')->where('pelaporan_id', $pelaporans[0]['id'])->first();
        return view('content.monev_pimpinan.vw_monev_pimpinan', compact('pelaporans', 'list_kegiatan_id', 'monevs'));
    }
}
