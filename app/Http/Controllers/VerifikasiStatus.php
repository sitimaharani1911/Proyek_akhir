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
        $verifikasi_oleh = $request->verifikasi;

        if ($verifikasi_oleh == 'PIU') {
            $data['persetujuan_piu'] = $request->status;
        } elseif ($verifikasi_oleh == 'direktur') {
            $data['persetujuan_direktur'] = $request->status;
        } else {
            $data['status'] = $request->status;
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
