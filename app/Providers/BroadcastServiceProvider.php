<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
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
        // Broadcast::routes([
        //     'middleware' => ['web', 'auth:admin'],
        // ]);
        Broadcast::routes(['middleware' => ['web', 'auth:web,admin']]);

        require base_path('routes/channels.php');
    }
}
