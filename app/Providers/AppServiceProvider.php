<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::macro('appImages', fn($asset) => $this->asset("resources/images/app/{$asset}"));
        Vite::macro('qrcodeImages', fn($asset) => $this->asset("resources/images/qrcode/{$asset}"));
        Vite::macro('partnersImages', fn($asset) => $this->asset("resources/images/partners/{$asset}"));
        Vite::macro('galleryImages', fn($asset) => $this->asset("resources/images/photo-galery/{$asset}"));
        Vite::macro('slidersImages', fn($asset) => $this->asset("resources/images/sliders/{$asset}"));
        Vite::macro('galleryAlbunsImages', fn($asset) => $this->asset("resources/images/photo-galery/albuns/{$asset}"));
        Vite::macro('libs', fn($asset) => $this->asset("resources/libs/{$asset}"));
    }
}