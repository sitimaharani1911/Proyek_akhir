<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
