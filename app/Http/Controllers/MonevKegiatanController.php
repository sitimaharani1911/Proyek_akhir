<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MonevKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $proposals = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        // dd($proposals->toArray());
        return view('content.monev_kegiatan.vw_table_hibah', compact('proposals', 'years'));
    }
    public function listKegiatan(string $proposal_id)
    {
        // decrypt proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $kegiatans = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.monev_kegiatan.vw_table_list_kegiatan', compact('kegiatans', 'proposal_id', 'encryptedId', 'years'));
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
            'template_laporan' => 'required|mimes:pdf,doc,docx|max:5120', // 5MB
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

    public function dataProposal(Request $request)
    {
        if ($request->ajax()) {
            $data = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->orderBy('id', 'DESC');
            if ($request->tahun) {
                $data->where('created_at', 'like', $request->tahun . '%');
            }
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('judul_proposal', 'like', "%{$search}%")
                                ->orWhere('ketua_hibah', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('nama_hibah', function ($value) {
                    return $value->informasi_hibah->nama_hibah;
                })
                ->addColumn('skema_hibah', function ($value) {
                    return $value->informasi_hibah->skema_hibah;
                })
                ->addColumn('kegiatan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("monev-kegiatan/data/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-information fs-2 text-primary"></i></a>';

                    return $detail;
                })
                ->rawColumns(['kegiatan', 'skema_hibah', 'nama_hibah'])
                ->make(true);
        }
    }

    public function dataKegiatan(Request $request)
    {
        if ($request->ajax()) {
            $proposal_id = decrypt($request->proposal_id);
            // dd($proposal_id);
            $data = ListKegiatan::where('proposal_id', $proposal_id)->orderBy('id', 'DESC');
            if ($request->tahun) {
                $data->where('created_at', 'like', $request->tahun . '%');
            }
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('nama_kegiatan', 'like', "%{$search}%")
                                ->orWhere('jenis_aktivitas', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('template_laporan', function ($row) {
                    return '<button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#unggahModal' . $row->id . '">Input</button>';
                })
                ->addColumn('jenis_hibah', function ($value) {
                    return $value->proposal->informasi_hibah->skema_hibah;
                })
                ->addColumn('program_studi', function ($value) {
                    return $value->proposal->informasi_hibah->prodi_terlibat;
                })
                ->rawColumns(['aksi', 'surat_kerja', 'surat_tugas', 'template_laporan', 'jenis_hibah'])
                ->make(true);
        }
    }
}
