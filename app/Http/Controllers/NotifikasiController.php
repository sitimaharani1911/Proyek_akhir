<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function notifRead(Request $request)
    {

        Notifikasi::where('status', 1)->update(['status' => 2]);
        $unreadNotificationsCount = Notifikasi::where('status', 1)->count();
        return response()->json([
            'status' => 'success',
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);

    }

}
