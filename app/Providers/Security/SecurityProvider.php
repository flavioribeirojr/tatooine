<?php

namespace App\Providers\Security;

use Illuminate\Support\ServiceProvider;
use App\Models\Security\Resource;

class SecurityProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Security::class, function () {
            return new Security(new Resource());
        });
    }
}
