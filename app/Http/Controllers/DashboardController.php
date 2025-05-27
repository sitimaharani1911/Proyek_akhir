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
        ])
            ->where('periode_pengajuan_awal', '>=', now()->subYear())
            ->get();


        $categories = [];
        $belumAdaPelaporan = [];
        $belumDimonev = [];
        $monevOpen = [];
        $monevClose = [];

        foreach ($hibahs as $hibah) {
            $categories[] = $hibah->nama_hibah;

            $countBelumAdaPelaporan = 0;
            $countBelumDimonev = 0;
            $countMonevOpen = 0;
            $countMonevClose = 0;

            foreach ($hibah->proposal as $proposal) {
                foreach ($proposal->listKegiatan as $kegiatan) {
                    $pelaporans = $kegiatan->pelaporan;

                    if ($pelaporans->isEmpty()) {
                        $countBelumAdaPelaporan++;
                    } else {
                        $sudahDimonev = false;
                        foreach ($pelaporans as $pelaporan) {
                            $monev = $pelaporan->monev;
                            if ($monev) {
                                $sudahDimonev = true;
                                if ($monev->status === 'open') {
                                    $countMonevOpen++;
                                } elseif ($monev->status === 'close') {
                                    $countMonevClose++;
                                }
                            }
                        }

                        if (!$sudahDimonev) {
                            $countBelumDimonev++;
                        }
                    }
                }
            }

            $belumAdaPelaporan[] = $countBelumAdaPelaporan;
            $belumDimonev[] = $countBelumDimonev;
            $monevOpen[] = $countMonevOpen;
            $monevClose[] = $countMonevClose;
        }

        return [
            'categories' => $categories,
            'series' => [
                ['name' => 'Belum Ada Dilaporkan', 'data' => $belumAdaPelaporan],
                ['name' => 'Sudah Dilaporkan, Belum Dimonev', 'data' => $belumDimonev],
                ['name' => 'Monev Open', 'data' => $monevOpen],
                ['name' => 'Monev Close', 'data' => $monevClose],
            ]
        ];
    }
}
