<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ListKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposal = Proposal::with('informasi_hibah')->where('status_progres', '3')->get();
        return view('content.list_kegiatan.vw_table_proposal', compact('proposal'));
    }

    public function listKegiatan(string $proposal_id)
    {
        $listKegiatan = ListKegiatan::where('proposal_id', $proposal_id)->get();
        // dd($listKegiatan->toArray());
        return view('content.list_kegiatan.vw_table_list_kegiatan', compact(['listKegiatan', 'proposal_id']));
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
        // Debug data request
        // dd($request->all());
        // Validasi input
        $validated = $request->validate([
            'jenis_hibah' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
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
            'surat_kerja' => 'required|file|mimes:pdf|max:512',
            'surat_tugas' => 'required|file|mimes:pdf|max:512',
        ]);

        // Simpan file jika ada
        $surat_kerja_path = $request->file('surat_kerja')->store('surat_kerja');
        $surat_tugas_path = $request->file('surat_tugas')->store('surat_tugas');

        // Simpan data ke tabel list_kegiatan
        $kegiatan = new ListKegiatan();
        $kegiatan->proposal_id = $proposal_id;
        $kegiatan->jenis_hibah = $validated['jenis_hibah'];
        $kegiatan->program_studi = $validated['program_studi'];
        $kegiatan->jenis_aktivitas = $validated['jenis_aktivitas'];
        $kegiatan->nama_kegiatan = $validated['nama_kegiatan'];
        $kegiatan->jumlah_luaran = $validated['jumlah_luaran'];
        $kegiatan->satuan_luaran = $validated['satuan_luaran'];
        $kegiatan->luaran_kegiatan = $validated['luaran_kegiatan'];
        $kegiatan->status_pelaksanaan_kegiatan = $validated['status_pelaksanaan_kegiatan'];
        $kegiatan->total_pengajuan_anggaran = $validated['total_pengajuan_anggaran'];
        $kegiatan->total_penggunaan_anggaran = $validated['total_penggunaan_anggaran'];
        $kegiatan->tanggal_awal = $validated['tanggal_awal'];
        $kegiatan->tanggal_akhir = $validated['tanggal_akhir'];
        $kegiatan->rentang_pengerjaan = $validated['rentang_pengerjaan'];
        $kegiatan->panitia_pengerjaan = $validated['panitia_pengerjaan'];
        $kegiatan->rincian_jumlah_peserta = $validated['rincian_jumlah_peserta'];
        $kegiatan->tempat_pelaksanaan = $validated['tempat_pelaksanaan'];
        $kegiatan->surat_kerja = $surat_kerja_path;
        $kegiatan->surat_tugas = $surat_tugas_path;

        $kegiatan->save();

        return redirect()->route('list-kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
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
}
