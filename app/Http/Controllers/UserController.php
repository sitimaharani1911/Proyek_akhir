<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('content.user.vw_table_user');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        $data = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->input('password')),
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

    public function store_role(Request $request)
    {
        $roles = $request->role ?? [];

        $existingRoles = RoleUser::where('user_id', $request->user_id)
            ->pluck('role')
            ->toArray();

        $rolesToDelete = array_diff($existingRoles, $roles);
        if (!empty($rolesToDelete)) {
            RoleUser::where('user_id', $request->user_id)
                ->whereIn('role', $rolesToDelete)
                ->delete();
        }
        $rolesToAdd = array_diff($roles, $existingRoles);
        if (!empty($rolesToAdd)) {
            foreach ($rolesToAdd as $role) {
                $data = RoleUser::create([
                    'user_id' => $request->user_id,
                    'role' => $role
                ]);
            }
        }

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Role Berhasil Disimpan',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menyimpan Role',
            ]);
        }
    }

    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    public function get_role(string $id)
    {

        $roles = RoleUser::where('user_id', $id)
            ->pluck('role')
            ->toArray();

        return response()->json([
            'status' => true,
            'roles' => $roles
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data User tidak ditemukan',
            ]);
        }

        $data->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);
        if ($request->password) {
            $data->update([
                'password' => $request->password
            ]);
        }

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
        $data = User::find($id);

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
            $data = User::query();
            return DataTables::of($data)
                ->filter(function ($query) {
                    if (request()->has('search.value')) {
                        $search = request('search.value');
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                        });
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function ($value) {
                    $aksi = '<a href="javascript:void(0)" onclick="add_role(\'' . $value->id . '\')">
                                <i class="fa fa-user-shield text-primary fs-5" style="margin-right: 10px;"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="edit(\'' . $value->id . '\')">
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
