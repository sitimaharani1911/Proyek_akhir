<?php

namespace App\Http\Controllers;

use App\Models\ListKegiatan;
use App\Models\Notifikasi;
use App\Models\Pelaporan;
use App\Models\Proposal;
use App\Models\ReviewKeuangan;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanKeuanganController extends Controller
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
        return view('content.laporan_keuangan.vw_table_laporan_keuangan', compact('proposals', 'years'));
    }
    public function dataKegiatan(string $proposal_id)
    {
        // decrypt proposal_id
        $proposal_id = decrypt($proposal_id);
        $encryptedId    = encrypt($proposal_id);
        $currentYear = date('Y');
        $startYear = 2019;
        $years = range($currentYear, $startYear);
        $kegiatans = ListKegiatan::with('proposal')->where('proposal_id', $proposal_id)->get();
        // dd($kegiatans->toArray());
        return view('content.laporan_keuangan.vw_table_laporan_keuangan_kegiatan', compact('kegiatans', 'proposal_id', 'encryptedId', 'years'));
    }
    public function reviewLaporan(string $list_kegiatan_id)
    {
        // decrypt list_kegiatan_id
        $list_kegiatan_id = decrypt($list_kegiatan_id);
        $pelaporans = Pelaporan::with('list_kegiatan')->where('list_kegiatan_id', $list_kegiatan_id)->get();
        foreach ($pelaporans as $pelaporan) {
            $pelaporan["serapan_dana"] = (($pelaporan['pengajuan_dana'] - $pelaporan["sisa_dana"]) / $pelaporan["pengajuan_dana"]) * 100;
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

        $validated['pelaporan_id'] = $pelaporan_id;
        ReviewKeuangan::create($validated);

        $pelaporan = Pelaporan::findOrFail($pelaporan_id);
        $listKegiatan = ListKegiatan::findOrFail($pelaporan->list_kegiatan_id);
        $namaKegiatan = $listKegiatan->nama_kegiatan;
        $proposalId = $listKegiatan->proposal_id;

        $pelaksanaUsers = RoleUser::where('role', 'Pelaksana')->pluck('user_id');

        foreach ($pelaksanaUsers as $userId) {
            Notifikasi::create([
                'pesan' => 'Review laporan keuangan baru dari Tim Keuangan untuk kegiatan"' . $namaKegiatan . '". telah ditambahkan.',
                'status' => 1, // 1: unread
                'user_id' => $userId,
            ]);
        }


        return redirect()->route('laporan-keuangan.kegiatan', ['proposal_id' => encrypt($proposalId)])
            ->with('success', 'Review berhasil ditambahkan!');
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
                ->addColumn('nama_hibah', function ($value) {
                    return $value->informasi_hibah->nama_hibah;
                })
                ->addColumn('skema_hibah', function ($value) {
                    return $value->informasi_hibah->skema_hibah;
                })


                ->addColumn('kegiatan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("laporan-keuangan/kegiatan/{$encryptedId}") . '"
                                class="btn btn-sm btn-primary me-1">
                                Detail</a>';

                    return $detail;
                })
                ->rawColumns(['kegiatan', 'skema_hibah', 'nama_hibah'])
                ->make(true);
        }
    }
    public function dataListKegiatan(Request $request)
    {
        if ($request->ajax()) {
            $proposal_id = decrypt($request->proposal_id);
            // dd($proposal_id);
            $data = ListKegiatan::with(['proposal.informasi_hibah'])->where('proposal_id', $proposal_id)->orderBy('id', 'DESC');
            if ($request->tahun) {
                $data->where('created_at', 'like', $request->tahun . '%');
            }
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('nama_kegiatan', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                // add kolom ketua hibah
                ->addColumn('ketua_hibah', function ($value) {
                    return $value->proposal->ketua_hibah;
                })
                // kolom aksi
                ->addColumn('aksi', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("laporan-keuangan/review/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-pencil-square fs-2 text-primary"></i></a>';
                    return $detail;
                })

                ->rawColumns(['ketua_hibah', 'nama_kegiatan', 'aksi'])
                ->make(true);
        }
    }
}
