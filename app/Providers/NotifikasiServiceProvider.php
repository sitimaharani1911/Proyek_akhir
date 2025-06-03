<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class NotifikasiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Bagikan jumlah notifikasi yang belum dibaca ke semua view
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $notifications = Notifikasi::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $unreadNotificationsCount = Notifikasi::where('user_id', $userId)
                    ->where('status', 1)
                    ->count();

                $view->with(compact('notifications', 'unreadNotificationsCount'));
            }
        });
    }
}
