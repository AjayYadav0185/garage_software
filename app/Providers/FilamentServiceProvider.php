<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Filament;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerPlugin(FilamentShieldPlugin::make());
        });
    }
}
