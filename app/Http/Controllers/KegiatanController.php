<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
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
        return view ('content.pelaporan.kegiatan.vw_table_kegiatan', compact('listKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('content.pelaporan.kegiatan.vw_tambah_kegiatan');
    }
    public function hasilMonev()
    {
        return view ('content.pelaporan.kegiatan.vw_hasil_monev');
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
        return view ('content.pelaporan.kegiatan.vw_detail_kegiatan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view ('content.pelaporan.kegiatan.vw_edit_kegiatan');
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
