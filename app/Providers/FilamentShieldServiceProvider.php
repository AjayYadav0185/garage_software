<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\PluginServiceProvider;

class FilamentShieldServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-shield';

    public function register(): void
    {
        $this->plugins([
            FilamentShieldPlugin::make(),
        ]);
    }
}
