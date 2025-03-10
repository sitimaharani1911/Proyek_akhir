<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('content.monev.vw_table_monev');
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
}
