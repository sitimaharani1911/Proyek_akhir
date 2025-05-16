<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
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
        return view ('content.monev.vw_table_monev', compact('proposals'));
    }
    public function dataKegiatan()
    {
        return view ('content.monev.vw_table_monev_kegiatan');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function reviewLaporan()
    {
        return view ('content.monev.vw_review_laporan');
    }
    public function detailDokumen()
    {
        return view ('content.monev.vw_detail_dokumen');
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
        return view ('content.monev_piu.vw_table_monev');
    }
    public function monevPiuKegiatan()
    {
        return view ('content.monev_piu.vw_table_monev_kegiatan');
    }
    public function monevPiuReview()
    {
        return view ('content.monev_piu.vw_monev_ketua_piu');
    }
    // PIMPINAN
    public function monevPimpinan()
    {
        return view ('content.monev_pimpinan.vw_table_monev');
    }
    public function monevPimpinanKegiatan()
    {
        return view ('content.monev_pimpinan.vw_table_monev_kegiatan');
    }
    public function monevPimpinanReview()
    {
        return view ('content.monev_pimpinan.vw_monev_pimpinan');
    }
}
