<?php

namespace App\Providers;

use Acme\Point\Core\UseCases\AddPoint\AddPointUseCase;
use App\Adapters\AddPointAdapter;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AddPointUseCase::class, function () {
            $adapter = $this->app->make(AddPointAdapter::class);
            return new AddPointUseCase($adapter);
        });
    }
}
