<?php

namespace App\Http\Controllers;

use App\Models\DokumenHibah;
use App\Models\Pelaporan;
use App\Models\Proposal;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        //dd($proposals->toArray()); untuk ngecek apakah back end sudah terpanggil atau belom
        return view('content.pelaporan.vw_table_pelaporan',  compact('proposals'));
    }

    public function inputDocument(string $informasi_hibah_id)
    {
        $dokumenHibah = DokumenHibah::where('informasi_hibah_id', $informasi_hibah_id)->first();
        return view('content.pelaporan.vw_input_dokumen', [
            'informasi_hibah_id' => $informasi_hibah_id,
            'dokumenHibah' => $dokumenHibah
        ]);
    }

    public function inputDocumentStore(Request $request, $informasi_hibah_id)
    {
        $validated = $request->validate([
            'kontrak' => 'required|file|mimes:pdf|max:5120',
            'berita_acara' => 'required|file|mimes:pdf|max:5120',
            'verifikasi_kelayakan' => 'required|file|mimes:pdf|max:5120',
            'kerangka_acuan_kerja' => 'required|file|mimes:pdf|max:5120',
            'sk_tim_hibah' => 'required|file|mimes:pdf|max:5120',
        ]);

        $kontrak_path = $request->file('kontrak')->store('kontrak', 'public');
        $berita_acara_path = $request->file('berita_acara')->store('berita_acara', 'public');
        $verifikasi_kelayakan_path = $request->file('verifikasi_kelayakan')->store('verifikasi_kelayakan', 'public');
        $kerangka_acuan_kerja_path = $request->file('kerangka_acuan_kerja')->store('kerangka_acuan_kerja', 'public');
        $sk_tim_hibah_path = $request->file('sk_tim_hibah')->store('sk_tim_hibah', 'public');

        $validated['informasi_hibah_id'] = $informasi_hibah_id;
        $validated['kontrak'] = $kontrak_path;
        $validated['berita_acara'] = $berita_acara_path;
        $validated['verifikasi_kelayakan'] = $verifikasi_kelayakan_path;
        $validated['kerangka_acuan_kerja'] = $kerangka_acuan_kerja_path;
        $validated['sk_tim_hibah'] = $sk_tim_hibah_path;

        DokumenHibah::create($validated);

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan!');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $list_kegiatan_id)
    {
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        // dd($pelaporan->toArray());
        return view('content.pelaporan.kegiatan.vw_detail_kegiatan', compact('pelaporans'));
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
