<?php

namespace App\Providers;

use App\Support\CsvFactory;
use App\Support\LeagueCsvFactory;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CsvServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            CsvFactory::class,
        ];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CsvFactory::class, LeagueCsvFactory::class);
    }
}
