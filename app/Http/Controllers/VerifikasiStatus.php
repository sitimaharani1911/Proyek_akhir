<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Proposal;

class VerifikasiStatus extends Controller
{
    public function __invoke(Request $request)
    {

        // config dinamis model
        $model =  '\\App\\Models\\' . $request->model;
        $model = new $model;

        $idData   = $request->id;
        $verifikasi = $request->verifikasi;

        if ($verifikasi == 'PIU') {
            $data['persetujuan_piu'] = $request->status;
        } elseif ($verifikasi == 'direktur') {
            $data['persetujuan_direktur'] = $request->status;
        } elseif ($verifikasi == 'status_eksternal') {
            $data['status_eksternal'] = $request->status;
        } else {
            $data['status_internal'] = $request->status;
        }

        $save = $model::find($idData);

        $save->update($data);

        $pengajuan = ($verifikasi == 'status_eksternal') ? 'Eksternal ' : 'Internal ';
        $proposal = Proposal::find($idData);
        $pesan = ($request->status == 2) ? 'Proposal '. $proposal->judul_proposal.' Sedang Dalam Tahap Pengajuan '.$pengajuan : (($request->status == 3) ? 'Pengajuan '.$pengajuan.'Proposal '.$proposal->judul_proposal.' Diterima' : (($request->status == 0) ? 'Pengajuan '.$pengajuan.'Proposal '.$proposal->judul_proposal.' Ditolak' : 'Status tidak dikenal'));

        $data = Notifikasi::create([
            'id_ref' => $idData,
            'jenis' => 'update proposal',
            'pesan' => $pesan,
            'status' => 1,
        ]);

        return response()->json([
            'status'      => true,
            'status_code' => 200,
            'message'     => 'Data berhasil di simpan.',
            'data'        => [
                'id' => $idData
            ]
        ], 200);
    }
}
