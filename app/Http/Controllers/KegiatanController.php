<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Pelaporan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $proposal_id)
    {
        $listKegiatan = ListKegiatan::with(['proposal.informasi_hibah'])
            ->where('proposal_id', $proposal_id)
            ->get();
        return view('content.pelaporan.kegiatan.vw_table_kegiatan', compact('listKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $list_kegiatan_id)
    {
        $kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        return view('content.pelaporan.kegiatan.vw_tambah_kegiatan', compact('kegiatan', 'list_kegiatan_id'));
    }
    public function hasilMonev()
    {
        return view('content.pelaporan.kegiatan.vw_hasil_monev');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $list_kegiatan_id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'ketua_pelaksana' => 'required|string|max:255',
            'anggota_pelaksana' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'jumlah_peserta' => 'required|numeric',
            'absensi_peserta' => 'required|file|mimes:pdf|max:5120',
            'pengajuan_dana' => 'required|numeric',
            'sisa_dana' => 'required|numeric',
            'surat_kerja' => 'required|file|mimes:pdf|max:5120',
            'surat_tugas' => 'required|file|mimes:pdf|max:5120',
            'laporan_kegiatan' => 'required|file|mimes:pdf|max:5120',
            'laporan_keuangan' => 'required|file|mimes:pdf|max:5120',
            'luaran' => 'required|string|max:255',
            'dampak' => 'required|string|max:255',
            'dokumentasi' => 'required|string|max:255',
            'lainnya' => 'required|file|mimes:pdf|max:5120',
            'bukti_pembayaran' => 'required|string|max:255',
        ]);

        //simpan file 
        $absensi_peserta_path = $request->file('absensi_peserta')->store('absensi_peserta', 'public');
        $surat_kerja_path = $request->file('surat_kerja')->store('surat_kerja', 'public');
        $surat_tugas_path = $request->file('surat_tugas')->store('surat_tugas', 'public');
        $laporan_kegiatan_path = $request->file('laporan_kegiatan')->store('laporan_kegiatan', 'public');
        $laporan_keuangan_path = $request->file('laporan_keuangan')->store('laporan_keuangan', 'public');
        $lainnya_path = $request->file('lainnya')->store('lainnya', 'public');

        $pelaporan = new Pelaporan();
        $pelaporan->list_kegiatan_id = $list_kegiatan_id;
        $pelaporan->nama_kegiatan = $validated['nama_kegiatan'];
        $pelaporan->ketua_pelaksana = $validated['ketua_pelaksana'];
        $pelaporan->anggota_pelaksana = $validated['anggota_pelaksana'];
        $pelaporan->tanggal = $validated['tanggal'];
        $pelaporan->tempat = $validated['tempat'];
        $pelaporan->jumlah_peserta = $validated['jumlah_peserta'];
        $pelaporan->absensi_peserta = $absensi_peserta_path;
        $pelaporan->pengajuan_dana = $validated['pengajuan_dana'];
        $pelaporan->sisa_dana = $validated['sisa_dana'];
        $pelaporan->surat_kerja = $surat_kerja_path;
        $pelaporan->surat_tugas = $surat_tugas_path;
        $pelaporan->laporan_kegiatan = $laporan_kegiatan_path;
        $pelaporan->laporan_keuangan = $laporan_keuangan_path;
        $pelaporan->luaran = $validated['luaran'];
        $pelaporan->dampak = $validated['dampak'];
        $pelaporan->dokumentasi = $validated['dokumentasi'];
        $pelaporan->lainnya = $lainnya_path;
        $pelaporan->bukti_pembayaran = $validated['bukti_pembayaran'];

        $pelaporan->save();

        if ($pelaporan->save()) {
            return redirect()->back()->with('success', 'Kegiatan berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data!');
        }
    }

    public function reviewLaporan(string $list_kegiatan_id)
    {
        
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get(); 
        foreach($pelaporans as $pelaporan){
            $pelaporan["serapan_dana"] = (($pelaporan['pengajuan_dana'] - $pelaporan["sisa_dana"]) / $pelaporan["pengajuan_dana"] ) * 100 ;
            // dd($pelaporan->toArray());
        }
        // dd($pelaporans->toArray());
        return view('content.pelaporan.kegiatan.vw_hasil_review_keuangan', compact('pelaporans', 'list_kegiatan_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
}
