<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('content.pengajuan_dana.vw_table_pengajuan_dana');
    }
    public function dataKegiatan()
    {
        return view ('content.pengajuan_dana.vw_table_pengajuan_dana_kegiatan');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('content.pengajuan_dana.vw_tambah_pengajuan_dana');
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
    public function show()
    {
        return view ('content.pengajuan_dana.vw_detail_pengajuan_dana');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view ('content.pengajuan_dana.vw_edit_pengajuan_dana');
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
