<?php

namespace App\Http\Controllers;

use App\Models\DokumenHibah;
use App\Models\ListKegiatan;
use App\Models\Pelaporan;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage; // Untuk menghapus file lama
use Illuminate\Support\Facades\Validator; // Untuk validasi

class PelaporanController extends Controller
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
        //dd($proposals->toArray()); untuk ngecek apakah back end sudah terpanggil atau belom
        return view('content.pelaporan.vw_table_pelaporan',  compact('proposals', 'years'));
    }

    public function inputDocument(string $informasi_hibah_id)
    {
        // decrypt informasi_hibah_id
        $informasi_hibah_id = decrypt($informasi_hibah_id);
        $dokumenHibah = DokumenHibah::where('informasi_hibah_id', $informasi_hibah_id)->first();
        return view('content.pelaporan.vw_input_dokumen', [
            'informasi_hibah_id' => $informasi_hibah_id,
            'dokumenHibah' => $dokumenHibah
        ]);
    }

    public function inputDocumentStore(Request $request, $informasi_hibah_id)
    {
        $validated = $request->validate([
            'kontrak' => 'required|file|mimes:pdf|max:5120',
            'berita_acara' => 'required|file|mimes:pdf|max:5120',
            'verifikasi_kelayakan' => 'required|file|mimes:pdf|max:5120',
            'kerangka_acuan_kerja' => 'required|file|mimes:pdf|max:5120',
            'sk_tim_hibah' => 'required|file|mimes:pdf|max:5120',
        ]);

        $kontrak_path = $request->file('kontrak')->store('kontrak', 'public');
        $berita_acara_path = $request->file('berita_acara')->store('berita_acara', 'public');
        $verifikasi_kelayakan_path = $request->file('verifikasi_kelayakan')->store('verifikasi_kelayakan', 'public');
        $kerangka_acuan_kerja_path = $request->file('kerangka_acuan_kerja')->store('kerangka_acuan_kerja', 'public');
        $sk_tim_hibah_path = $request->file('sk_tim_hibah')->store('sk_tim_hibah', 'public');

        $validated['informasi_hibah_id'] = $informasi_hibah_id;
        $validated['kontrak'] = $kontrak_path;
        $validated['berita_acara'] = $berita_acara_path;
        $validated['verifikasi_kelayakan'] = $verifikasi_kelayakan_path;
        $validated['kerangka_acuan_kerja'] = $kerangka_acuan_kerja_path;
        $validated['sk_tim_hibah'] = $sk_tim_hibah_path;

        DokumenHibah::create($validated);

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan!');
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
    public function show(string $list_kegiatan_id)
    {
        $list_kegiatan = ListKegiatan::findOrFail($list_kegiatan_id);
        $proposal_id = $list_kegiatan->proposal_id;

        $pelaporans = Pelaporan::with(['list_kegiatan.proposal', 'monev'])
            ->where('list_kegiatan_id', $list_kegiatan_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $latestPelaporan = $pelaporans->first(); // Dapatkan laporan terakhir
        $latestMonev = $latestPelaporan ? $latestPelaporan->monev : null;

        return view('content.pelaporan.kegiatan.vw_detail_kegiatan', compact('pelaporans', 'list_kegiatan_id', 'proposal_id', 'latestMonev', 'latestPelaporan'));
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
    public function updateRevisi(Request $request, Pelaporan $pelaporan)
    {
        $monev = $pelaporan->monev;

        // Jika tidak ada monev atau statusnya bukan 'open', tolak request.
        if (!$monev || $monev->status !== 'open') {
            return redirect()->back()->withErrors('Tidak ada revisi yang bisa dikirim saat ini.');
        }

        // Definisikan semua field yang bisa direvisi dan validasinya
        $revisableFields = [
            'pengajuan_dana' => 'sometimes|required|numeric',
            'penggunaan_dana' => 'sometimes|required|numeric',
            'sisa_dana' => 'sometimes|required|numeric',
            'jumlah_peserta' => 'sometimes|required|numeric',
            'absensi_peserta' => 'sometimes|required|file|mimes:pdf|max:5120',
            'surat_keputusan' => 'sometimes|required|file|mimes:pdf|max:5120',
            'surat_tugas' => 'sometimes|required|file|mimes:pdf|max:5120',
            'laporan_kegiatan' => 'sometimes|required|file|mimes:pdf|max:5120',
            'laporan_keuangan' => 'sometimes|required|file|mimes:pdf|max:5120',
            'jumlah_luaran' => 'sometimes|required|numeric',
            'satuan_luaran' => 'sometimes|required|string|max:255',
            'luaran_kegiatan' => 'sometimes|required|string|max:255',
            'link_luaran' => 'sometimes|required|url',
            'dampak' => 'sometimes|required|string|max:255',
            'dokumentasi' => 'sometimes|required|url',
            'lainnya' => 'sometimes|required|url',
            'bukti_pembayaran' => 'sometimes|required|url',
        ];

        // Filter validasi hanya untuk field yang ditolak
        $rules = [];
        foreach ($revisableFields as $field => $rule) {
            // Cek jika status monev untuk field ini adalah 'Ditolak'
            $statusField = 'status_' . $field;
            if (isset($monev->$statusField) && $monev->$statusField === 'Ditolak') {
                $rules[$field] = $rule;
            }
        }

        // Validasi data yang masuk
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataToUpdate = [];
        $monevDataToUpdate = [];

        // Proses update untuk setiap field yang divalidasi
        foreach (array_keys($rules) as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($pelaporan->$field) {
                    Storage::disk('public')->delete($pelaporan->$field);
                }
                // Simpan file baru
                $dataToUpdate[$field] = $request->file($field)->store('pelaporan-files', 'public');
            } elseif ($request->filled($field)) {
                $dataToUpdate[$field] = $request->$field;
            }

            // Setelah diupdate, reset status monev untuk item tersebut
            $monevDataToUpdate['status_' . $field] = 'Direvisi';
            $monevDataToUpdate['catatan_' . $field] = 'Menunggu monev ulang';
        }

        // Update data di tabel pelaporan
        if (!empty($dataToUpdate)) {
            $pelaporan->update($dataToUpdate);
        }

        // Update status monev menjadi 'Revisi Dikirim' agar tidak bisa direvisi lagi sebelum dicek ulang
        $monevDataToUpdate['status'] = 'Revisi Dikirim';
        $monev->update($monevDataToUpdate);

        return redirect()->route('pelaporan.show', ['list_kegiatan_id' => $pelaporan->list_kegiatan_id])
            ->with('success', 'Revisi pelaporan berhasil dikirim dan sedang menunggu pengecekan ulang.');
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
                ->addColumn('skema_hibah', function ($value) {
                    return $value->informasi_hibah->skema_hibah;
                })
                ->addColumn('nama_hibah', function ($value) {
                    return $value->informasi_hibah->nama_hibah;
                })
                ->addColumn('kegiatan', function ($value) {
                    $encryptedId = encrypt($value->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("kegiatan/{$encryptedId}") . '"
                                class="btn btn-sm btn-primary me-1">
                                Detail</a>';

                    return $detail;
                })
                ->addColumn('dokumen', function ($value) {
                    $encryptedId = encrypt($value->informasi_hibah->id);
                    // $id = $value->id;
                    $detail  = '<a href="' . url("pelaporan/input-dokumen/{$encryptedId}") . '"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="bi bi-file-earmark-plus fs-2 text-primary"></i></a>';

                    return $detail;
                })
                ->rawColumns(['kegiatan', 'skema_hibah', 'nama_hibah', 'dokumen'])
                ->make(true);
        }
    }
}
