<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\View;

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
        // Bagikan jumlah notifikasi yang belum dibaca ke semua view
        View::composer('*', function ($view) {
            $unreadNotificationsCount = Notifikasi::where('status', 1)->count();
            $notifications = Notifikasi::where('status', 1)->orderBy('id','DESC')->get();

            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
            $view->with('notifications', $notifications);
        });
    }
}
