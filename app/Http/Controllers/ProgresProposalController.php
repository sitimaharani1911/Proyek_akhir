<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProgresProposalController extends Controller
{
    public function index()
    {
        return view('content.progres_proposal.vw_table_progres_proposal');
    }
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Proposal::orderBy('id', 'DESC');
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
                ->addColumn('status', function ($value) {
                    return convertStatus($value->status)['badge'];
                })
                ->addColumn('action', function ($value) {
                    if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'superadmin') {
                        $aksi = '<div class="dropdown" style="position: static;">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Progres </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="position: absolute; min-width: 10rem; transform: none !important;" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn-statusProgres" href="javascript:void(0);" data-id="' . $value->id . '" data-status="2" data-model="Proposal">Pengajuan</a>
                                        <a class="dropdown-item btn-statusProgres" href="javascript:void(0);" data-id="' . $value->id . '" data-status="3" data-model="Proposal">Diterima</a>
                                        <a class="dropdown-item btn-statusProgres" href="javascript:void(0);" data-id="' . $value->id . '" data-status="0" data-model="Proposal">Ditolak</a>
                                    </div>
                                </div>';
                    } else {
                        $aksi = '';
                    }
                    return $aksi;
                })
                ->rawColumns(['action', 'skema_hibah', 'status', 'nama_hibah'])
                ->make(true);
        }
    }
}
