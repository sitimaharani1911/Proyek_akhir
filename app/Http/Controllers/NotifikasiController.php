<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\NotifikasiRead;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function notifRead(Request $request)
    {
        $userId = Auth::id();; // ambil ID user yang sedang login

        if (Auth::user()->role == 'Adhoc') {

            $notifikasi = Notifikasi::where('status', 1)
                ->whereIn('jenis', ['update proposal', 'tambah informasi hibah'])
                ->get();
            foreach ($notifikasi as $notif) {
                $exists = NotifikasiRead::where('notifikasi_id', $notif->id)
                    ->where('user_id', $userId)
                    ->exists();

                if (!$exists) {
                    NotifikasiRead::create([
                        'notifikasi_id' => $notif->id,
                        'user_id' => $userId,
                    ]);
                }
            }

            $unreadNotificationsCount = Notifikasi::whereIn('jenis', ['update proposal', 'tambah informasi hibah'])
                ->whereNotIn('id', function ($query) use ($userId) {
                    $query->select('notifikasi_id')
                        ->from('notifikasi_read')
                        ->where('user_id', $userId);
                })
                ->count();
        } elseif (Auth::user()->role == 'Sentra') {
            $notifikasi = Notifikasi::where('status', 1)
                ->whereIn('jenis', ['tambah proposal'])
                ->get();
            foreach ($notifikasi as $notif) {
                $exists = NotifikasiRead::where('notifikasi_id', $notif->id)
                    ->where('user_id', $userId)
                    ->exists();

                if (!$exists) {
                    NotifikasiRead::create([
                        'notifikasi_id' => $notif->id,
                        'user_id' => $userId,
                    ]);
                }
            }

            $unreadNotificationsCount = Notifikasi::where('jenis', 'tambah porposal')
                ->whereNotIn('id', function ($query) use ($userId) {
                    $query->select('notifikasi_id')
                        ->from('notifikasi_read')
                        ->where('user_id', $userId);
                })
                ->count();
        } else {
            Notifikasi::where('user_id', $userId)
                ->where('status', 1)
                ->update(['status' => 2]);

            $unreadNotificationsCount = Notifikasi::where('user_id', $userId)
                ->where('status', 1)
                ->count();
        }

        return response()->json([
            'status' => 'success',
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }
}
