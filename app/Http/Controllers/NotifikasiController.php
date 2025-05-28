<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function notifRead(Request $request)
    {
        $userId = Auth::id();; // ambil ID user yang sedang login

        Notifikasi::where('user_id', $userId)
            ->where('status', 1)
            ->update(['status' => 2]);

        $unreadNotificationsCount = Notifikasi::where('user_id', $userId)
            ->where('status', 1)
            ->count();

        return response()->json([
            'status' => 'success',
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }
}
