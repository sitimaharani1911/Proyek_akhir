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


        $proposal_pengajuan = Proposal::where('status_internal',2)->count();
        $proposal_pending = Proposal::where('status_internal',1)->count();
        $proposal_diterima_internal = Proposal::where('status_internal',3)->count();
        $proposal_ditolak_internal = Proposal::where('status_internal',0)->count();
        $proposal_diterima_eksternal = Proposal::where('status_eksternal',3)->count();
        $proposal_ditolak_eksternal = Proposal::where('status_eksternal',0)->count();

        return view('content.dashboard.vw_dashboard',compact('proposal_pengajuan','hibah_aktif','proposal_diterima_internal','proposal_ditolak_internal','proposal_diterima_eksternal','proposal_ditolak_eksternal','proposal_pending','mitra','pelaksana'));
    }
}
