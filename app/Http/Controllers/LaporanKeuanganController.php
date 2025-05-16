<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Pelaporan;
use App\Models\Proposal;
use App\Models\ReviewKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        return view('content.laporan_keuangan.vw_table_laporan_keuangan', compact('proposals'));
    }
    public function dataKegiatan(string $proposal_id)
    {
        $kegiatans = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.laporan_keuangan.vw_table_laporan_keuangan_kegiatan', compact('kegiatans', 'proposal_id'));
    }
    public function reviewLaporan(string $list_kegiatan_id)
    {
        
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get(); 
        foreach($pelaporans as $pelaporan){
            $pelaporan["serapan_dana"] = (($pelaporan['pengajuan_dana'] - $pelaporan["sisa_dana"]) / $pelaporan["pengajuan_dana"] ) * 100 ;
        }
        // dd($pelaporans->toArray());
        return view('content.laporan_keuangan.vw_review_laporan_keuangan', compact('pelaporans', 'list_kegiatan_id'));
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
    public function store(Request $request, $pelaporan_id)
    {
        $validated = $request->validate([
            'catatan' => 'required|string|max:2550',
            'status' => 'required|string|max:255',
            'auditor' => 'required|string|max:255',
        ]);

        $reviewKeuangan = new ReviewKeuangan();
        $reviewKeuangan->pelaporan_id = $pelaporan_id;
        $reviewKeuangan->catatan = $validated['catatan'];
        $reviewKeuangan->status = $validated['status'];
        $reviewKeuangan->auditor = $validated['auditor'];

        $reviewKeuangan->save();
        // dd($validated, $reviewKeuangan);


        if ($reviewKeuangan->save()) {
            return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
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
