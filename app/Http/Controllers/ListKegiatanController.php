<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Notifikasi;
use App\Models\Proposal;
use App\Models\RoleUser;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ListKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $proposal = Proposal::with('informasi_hibah')->where('status_eksternal', '3')->get();
        return view('content.list_kegiatan.vw_table_proposal', compact('proposal', 'years'));
    }

    public function listKegiatan(string $proposal_id)
    {

        // Decrypt the proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $listKegiatan = ListKegiatan::where('proposal_id', $proposal_id)->get();
        // dd($listKegiatan->toArray());
        return view('content.list_kegiatan.vw_table_list_kegiatan', compact(['listKegiatan', 'proposal_id', 'years', 'encryptedId']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        return view('content.list_kegiatan.vw_tambah_list_kegiatan', compact('proposal_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $proposal_id)
    {
        $validated = $request->validate([
            'jenis_aktivitas' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'rentang_pengerjaan' => 'required|string|max:255',
            'panitia_pengerjaan' => 'required|string|max:255',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'surat_keputusan' => 'required|file|mimes:pdf|max:5120',
            'surat_tugas' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Simpan file jika ada
        $surat_keputusan_path = $request->file('surat_keputusan')->store('surat_keputusan', 'public');
        $surat_tugas_path = $request->file('surat_tugas')->store('surat_tugas', 'public');


        $validated['surat_keputusan'] = $surat_keputusan_path;
        $validated['surat_tugas'] = $surat_tugas_path;
        $validated['proposal_id'] = $proposal_id;

        // Simpan data ke tabel list_kegiatan
        ListKegiatan::create($validated);

        $monevUsers = RoleUser::where('role', 'Monev')->pluck('user_id');

        foreach ($monevUsers as $userId) {
            Notifikasi::create([
                'pesan' => 'Kegiatan "' . $validated['nama_kegiatan'] . '" telah ditambahkan.',
                'status' => 1, // 1: unread
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('list-kegiatan.data', ['proposal_id' =>  encrypt($proposal_id)])
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $kegiatan = ListKegiatan::with('proposal')->findOrFail($id);
        // dd($kegiatan->toArray());
        return view('content.list_kegiatan.vw_detail_list_kegiatan', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Decrypt the ID
        $id = decrypt($id);
        $kegiatan = ListKegiatan::findOrFail($id);
        return view('content.list_kegiatan.vw_edit_list_kegiatan', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_aktivitas' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'rentang_pengerjaan' => 'required|string|max:255',
            'panitia_pengerjaan' => 'required|string|max:255',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'surat_keputusan' => 'nullable|file|mimes:pdf|max:512',
            'surat_tugas' => 'nullable|file|mimes:pdf|max:512',
        ]);

        $kegiatan = ListKegiatan::findOrFail($id);

        // Simpan file jika ada upload baru
        if ($request->hasFile('surat_keputusan')) {
            $suratKerja = $request->file('surat_keputusan')->store('surat_keputusan', 'public');
            $kegiatan->surat_keputusan = $suratKerja;
        }

        if ($request->hasFile('surat_tugas')) {
            $suratTugas = $request->file('surat_tugas')->store('surat_tugas', 'public');
            $kegiatan->surat_tugas = $suratTugas;
        }

        // Update field lainnya
        $kegiatan->jenis_aktivitas = $request->jenis_aktivitas;
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tanggal_awal = $request->tanggal_awal;
        $kegiatan->tanggal_akhir = $request->tanggal_akhir;
        $kegiatan->rentang_pengerjaan = $request->rentang_pengerjaan;
        $kegiatan->panitia_pengerjaan = $request->panitia_pengerjaan;
        $kegiatan->tempat_pelaksanaan = $request->tempat_pelaksanaan;

        $kegiatan->save();

        return redirect()->route('list-kegiatan.data', ['proposal_id' => encrypt($kegiatan->proposal_id)])
            ->with('success', 'Data berhasil diperbarui');
    }



    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $kegiatan = ListKegiatan::findOrFail($id);

        // Hapus data kegiatan
        $kegiatan->delete();

        // Redirect dengan pesan sukses
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil dihapus',
        ]);
    }

    public function data(Request $request)
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
                ->addColumn('skema_hibah', function ($value) {
                    return $value->informasi_hibah->skema_hibah;
                })
                ->addColumn('nama_hibah', function ($value) {
                    return $value->informasi_hibah->nama_hibah;
                })
                ->addColumn('kegiatan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("list-kegiatan/{$encryptedId}") . '"
                                class="btn btn-sm btn-primary me-1">
                                Detail</a>';

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
            $data = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->orderBy('id', 'DESC');
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
                ->addColumn('jenis_hibah', function ($value) {
                    return $value->proposal->informasi_hibah->skema_hibah;
                })
                // kolom program studi
                ->addColumn('program_studi', function ($value) {
                    return $value->proposal->informasi_hibah->prodi_terlibat;
                })
                ->addColumn('aksi', function ($value) {
                    $encryptedId = encrypt($value->id);
                    $detail  = '<a href="' . url("list-kegiatan/show/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-eye fs-2 text-primary"></i></a>';
                    $edit = '<a href="' . url("list-kegiatan/{$encryptedId}/edit") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-pencil fs-2 text-info"></i>
                            </a>';
                    $hapus = '<a href="javascript:void(0)" onclick="hapus(\'' . $value->id . '\')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                               <i class="ki-outline ki-trash fs-2 text-danger"></i>
                            </a>';

                    $aksi = $detail . $edit;
                    return $aksi;
                })
                ->addColumn('surat_keputusan', function ($value) {
                    return '<a href="' . asset('storage/' . $value->surat_keputusan) . '" target="_blank">Lihat</a>';
                })
                ->addColumn('surat_tugas', function ($value) {
                    return '<a href="' . asset('storage/' . $value->surat_tugas) . '" target="_blank">Lihat</a>';
                })
                ->addColumn('template_laporan', function ($value) {
                    return '<a href="' . url("template_laporan/{$value->id}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-outline ki-file fs-2 text-primary"></i></a>';
                })
                ->rawColumns(['aksi', 'surat_keputusan', 'surat_tugas', 'template_laporan', 'jenis_hibah', 'program_studi'])
                ->make(true);
        }
    }
}
