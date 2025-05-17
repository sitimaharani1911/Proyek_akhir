<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonevKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        // dd($proposals->toArray());
        return view('content.monev_kegiatan.vw_table_hibah', compact('proposals'));
    }
    public function listKegiatan(string $proposal_id)
    {
        $kegiatans = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.monev_kegiatan.vw_table_list_kegiatan', compact('kegiatans', 'proposal_id'));
    }
    /**
     * Show the form for creating a new resource.
     */


    public function unggahTemplate($id)
    {
        $kegiatan = ListKegiatan::findOrFail($id);
        return view('kegiatan.unggah_template', compact('kegiatan'));
    }

    public function simpanTemplate(Request $request, $id)
    {
        $request->validate([
            'template_laporan' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $kegiatan = ListKegiatan::findOrFail($id);

        // Simpan file ke storage
        if ($request->hasFile('template_laporan')) {
            // Hapus file lama jika ada
            if ($kegiatan->template_laporan) {
                Storage::disk('public')->delete($kegiatan->template_laporan); // path lengkap, langsung hapus
            }

            // Simpan file baru
            $file = $request->file('template_laporan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('template_laporan', $fileName, 'public');

            // Simpan path ke database (cth: template_laporan/NAMA_FILE.pdf)
            $kegiatan->template_laporan = $filePath;
        }

        // Simpan perubahan ke DB
        $kegiatan->save();

        return redirect()->back()->with('success', 'Template laporan berhasil diunggah.');
    }


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
