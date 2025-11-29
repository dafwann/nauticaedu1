<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Jika ada service container binding khusus bisa ditambahkan di sini
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paksa Laravel generate URL HTTPS saat di production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Tambahan optional: jika ingin generate asset pakai secure URL
        // URL::forceRootUrl(config('app.url'));
    }
}
