<?php

namespace App\Providers;

use App\Services\Currency;
use App\Services\CurrencyGenerator;
use App\Services\CurrencyRepository;
use App\Services\CurrencyRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CurrencyRepositoryInterface::class, function ($app) {
            return new CurrencyRepository(CurrencyGenerator::generate());
        });

        $this->app->bind(Currency::class, function ($app, array $parameters) {
            return new Currency($parameters['id'], $parameters['name'], $parameters['short_name'],
                $parameters['actual_course'], $parameters['actual_course_date'],
                $parameters['active']);
        });
    }
}
