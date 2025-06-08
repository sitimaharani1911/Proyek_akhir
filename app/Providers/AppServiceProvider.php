<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        // Bagikan jumlah notifikasi yang belum dibaca ke semua view
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                if (Auth::user()->role == 'Adhoc') {
                    $notifications = DB::table('notifikasi')
                        ->leftJoin('proposal', 'notifikasi.id_ref', '=', 'proposal.id')
                        ->leftJoin('informasi_hibah', 'notifikasi.id_ref', '=', 'informasi_hibah.id')
                        ->where(function ($query) use ($userId) {
                            $query->where(function ($q) use ($userId) {
                                $q->where('notifikasi.jenis', 'update proposal')
                                    ->where('proposal.created_by', $userId);
                            })->orWhere(function ($q) {
                                $q->where('notifikasi.jenis', 'tambah informasi hibah');
                            });
                        })
                        ->orderBy('notifikasi.created_at', 'desc')
                        ->select('notifikasi.*')
                        ->get();


                    $unreadNotificationsCount = DB::table('notifikasi')
                        ->leftJoin('proposal', function ($join) {
                            $join->on('notifikasi.id_ref', '=', 'proposal.id');
                        })
                        ->leftJoin('informasi_hibah', function ($join) {
                            $join->on('notifikasi.id_ref', '=', 'informasi_hibah.id');
                        })
                        ->where(function ($query) use ($userId) {
                            $query->where(function ($q) use ($userId) {
                                $q->where('notifikasi.jenis', 'update proposal')
                                    ->where('proposal.created_by', $userId);
                            })
                                ->orWhere(function ($q) {
                                    $q->where('notifikasi.jenis', 'tambah informasi hibah');
                                });
                        })
                        ->whereNotIn('notifikasi.id', function ($query) use ($userId) {
                            $query->select('notifikasi_id')
                                ->from('notifikasi_read')
                                ->where('user_id', $userId);
                        })
                        ->count();
                } elseif (Auth::user()->role == 'Sentra') {

                    $notifications = Notifikasi::where('jenis', 'tambah proposal')
                        ->orderBy('created_at', 'desc')
                        ->get();

                    $unreadNotificationsCount = Notifikasi::where('status', 1)
                        ->where('jenis', 'tambah proposal')
                        ->whereNotIn('id', function ($query) use ($userId) {
                            $query->select('notifikasi_id')
                                ->from('notifikasi_read')
                                ->where('user_id', $userId);
                        })
                        ->count();
                } else {

                    $notifications = Notifikasi::where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->get();

                    $unreadNotificationsCount = Notifikasi::where('user_id', $userId)
                        ->where('status', 1)
                        ->count();
                }

                $view->with(compact('notifications', 'unreadNotificationsCount'));
            }
        });
    }
}
