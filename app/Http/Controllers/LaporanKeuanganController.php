<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('content.laporan_keuangan.vw_table_laporan_keuangan');
    }
    public function dataKegiatan()
    {
        return view ('content.laporan_keuangan.vw_table_laporan_keuangan_kegiatan');
    }
    public function reviewLaporan()
    {
        return view ('content.laporan_keuangan.vw_review_laporan_keuangan');
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
