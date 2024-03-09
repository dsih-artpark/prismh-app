<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class GuzzleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new Client([
                'base_uri' => 'https://four.iissms.co.in/',
                'timeout' => 10,
            ]);
        });
    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
