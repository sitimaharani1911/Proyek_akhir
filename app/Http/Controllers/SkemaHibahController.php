<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkemaHibah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SkemaHibahController extends Controller
{
    public function index()
    {
        return view('content.skema_hibah.vw_table_skema_hibah');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'skema' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        $data = SkemaHibah::create([
            'skema' => $request->skema
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Disimpan',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menyimpan Data',
            ]);
        }
    }
    public function edit(string $id)
    {
        $data = SkemaHibah::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = SkemaHibah::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Skema Hibah tidak ditemukan',
            ]);
        }

        $data->update([
            'skema' => $request->skema
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Mengubah Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah data',
            ]);
        }
    }
    public function destroy(string $id)
    {
        $data = SkemaHibah::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan Delete Data',
        ]);
    }
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = SkemaHibah::query();
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('skema', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function ($value) {
                    $aksi = '<a href="javascript:void(0)" onclick="edit(\'' . $value->id . '\')">
                                <i class="fa fa-edit text-success fs-5" style="margin-right: 10px;"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="hapus(\'' . $value->id . '\')" style="color: red;" title="Hapus">
                                <i class="fas fa-trash text-danger fs-5"></i>
                            </a>';
                    return $aksi;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
