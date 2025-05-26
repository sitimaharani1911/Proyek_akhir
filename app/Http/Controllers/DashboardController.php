<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\InformasiHibah;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hibah_aktif = InformasiHibah::where('periode_pengajuan_awal', '<=', now())
            ->where('periode_pengajuan_akhir', '>=', now())
            ->count();

        $mitra = InformasiHibah::select('mitra', DB::raw('count(mitra) as jml'))
            ->groupBy('mitra')
            ->get();

        $pelaksana = Proposal::select('ketua_hibah', DB::raw('count(ketua_hibah) as jml'))
            ->groupBy('ketua_hibah')
            ->get();


        $proposal_pengajuan = Proposal::where('status_internal', 2)->count();
        $proposal_pending = Proposal::where('status_internal', 1)->count();
        $proposal_diterima_internal = Proposal::where('status_internal', 3)->count();
        $proposal_ditolak_internal = Proposal::where('status_internal', 0)->count();
        $proposal_diterima_eksternal = Proposal::where('status_eksternal', 3)->count();
        $proposal_ditolak_eksternal = Proposal::where('status_eksternal', 0)->count();

        // Get progress of each hibah
        $chartData = $this->getProgresHibah();
        // dd($chartData);

        return view('content.dashboard.vw_dashboard', compact('proposal_pengajuan', 'hibah_aktif', 'proposal_diterima_internal', 'proposal_ditolak_internal', 'proposal_diterima_eksternal', 'proposal_ditolak_eksternal', 'proposal_pending', 'mitra', 'pelaksana', 'chartData'));
    }

    public function getProgresHibah()
    {
        $hibahs = InformasiHibah::with([
            'proposal.listKegiatan.pelaporan.monev'
        ])->get();

        $labels = []; // Nama-nama hibah
        $kegiatanLabels = []; // Nama-nama kegiatan unik
        $dataPerHibah = []; // Menyimpan progres per hibah per kegiatan

        // Loop semua hibah
        foreach ($hibahs as $hibah) {
            $labels[] = $hibah->nama_hibah;
            $hibahData = [];

            // Loop semua proposal dalam hibah
            foreach ($hibah->proposal as $proposal) {
                // Loop semua kegiatan dalam proposal
                foreach ($proposal->listKegiatan as $kegiatan) {
                    $namaKegiatan = $kegiatan->nama_kegiatan;

                    // Kumpulkan semua nama kegiatan unik
                    if (!in_array($namaKegiatan, $kegiatanLabels)) {
                        $kegiatanLabels[] = $namaKegiatan;
                    }

                    // Hitung progress kegiatan
                    $progress = 0;
                    if ($kegiatan->pelaporan->isNotEmpty()) {
                        $latestPelaporan = $kegiatan->pelaporan->sortByDesc('created_at')->first();
                        if ($latestPelaporan && $latestPelaporan->monev) {
                            $status = $latestPelaporan->monev->status;
                            $progress = ($status === 'close') ? 100 : 50;
                        }
                    }

                    // Ambil progres tertinggi jika kegiatan sama muncul lebih dari sekali
                    if (!isset($hibahData[$namaKegiatan]) || $progress > $hibahData[$namaKegiatan]) {
                        $hibahData[$namaKegiatan] = $progress;
                    }
                }
            }

            // Pastikan semua kegiatan muncul, default 0
            foreach ($kegiatanLabels as $namaKegiatan) {
                if (!isset($hibahData[$namaKegiatan])) {
                    $hibahData[$namaKegiatan] = 0;
                }
            }

            $dataPerHibah[] = $hibahData;
        }

        // Bangun struktur datasets untuk ApexCharts
        $datasets = [];
        foreach ($kegiatanLabels as $namaKegiatan) {
            $data = [];

            foreach ($dataPerHibah as $hibahData) {
                $value = $hibahData[$namaKegiatan] ?? 0;

                // Ubah 0 jadi 0.001 agar bar kecil tetap tampil
                $data[] = ($value === 0) ? 0.001 : $value;
            }

            $datasets[] = [
                'label' => $namaKegiatan,
                'data' => $data,
                'backgroundColor' => '#' . substr(md5($namaKegiatan), 0, 6),
            ];
        }

        return [
            'labels' => $labels,       // Nama hibah
            'datasets' => $datasets,   // Progress per kegiatan
        ];
    }
}
