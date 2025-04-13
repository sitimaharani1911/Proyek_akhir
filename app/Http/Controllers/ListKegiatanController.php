<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('content.list_kegiatan.vw_table_hibah');
    }
    public function listKegiatan()
    {
        return view ('content.list_kegiatan.vw_table_list_kegiatan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('content.list_kegiatan.vw_tambah_list_kegiatan');
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
