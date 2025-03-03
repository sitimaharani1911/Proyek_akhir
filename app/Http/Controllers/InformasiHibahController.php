<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiHibahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('content.informasi_hibah.vw_table_informasi_hibah');
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
        return view('content.informasi_hibah.vw_detail_informasi_hibah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = 'model';
        return response()->json(['data' => $data], 200);
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
