<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Proposal;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

class ListKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposal = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
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
            'surat_kerja' => 'required|file|mimes:pdf|max:5120',
            'surat_tugas' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Simpan file jika ada
        $surat_kerja_path = $request->file('surat_kerja')->store('surat_kerja', 'public');
        $surat_tugas_path = $request->file('surat_tugas')->store('surat_tugas', 'public');


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

        if ($kegiatan->save()) {
            return redirect()->route('list-kegiatan.data', ['proposal_id' => $proposal_id])
                ->with('success', 'Kegiatan berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data!');
        }
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
    public function edit($id)
    {
        $kegiatan = ListKegiatan::findOrFail($id);
        return view('content.list_kegiatan.vw_edit_list_kegiatan', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_hibah' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'jenis_aktivitas' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'jumlah_luaran' => 'required|numeric',
            'satuan_luaran' => 'required|string|max:255',
            'luaran_kegiatan' => 'required|string|max:255',
            'status_pelaksanaan_kegiatan' => 'required|string|max:255',
            'total_pengajuan_anggaran' => 'required|numeric',
            'total_penggunaan_anggaran' => 'required|numeric',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
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
        $kegiatan->jenis_hibah = $request->jenis_hibah;
        $kegiatan->program_studi = $request->program_studi;
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

        return redirect()->route('list-kegiatan.data', ['proposal_id' => $kegiatan->proposal_id])
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
        return redirect()->route('list-kegiatan.data', ['proposal_id' => $kegiatan->proposal_id])
            ->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
