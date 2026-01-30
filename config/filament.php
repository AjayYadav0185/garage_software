<?php

return [

    /*
    |----------------------------------------------------------------------
    | Auth
    |----------------------------------------------------------------------
    |
    | Filament needs to know which guard and provider to use for the panel.
    |
    */

    'auth' => [
        'guard' => 'admin',
        'user_model' => App\Models\UserAdmin::class,
    ],


    /*
    |----------------------------------------------------------------------
    | Broadcasting
    |----------------------------------------------------------------------
    */
    'broadcasting' => [
        // 'echo' => [ ... ]
    ],

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    'assets_path' => null,
    'cache_path' => base_path('bootstrap/cache/filament'),
    'livewire_loading_delay' => 'default',
    'system_route_prefix' => 'filament',
];
