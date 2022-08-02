<?php

namespace ZunFuyuzora\UkyoTable;

use Illuminate\Support\ServiceProvider;

class UkyoTableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('ZunFuyuzora\UkyoTable\UkyoTableController');
        $this->app->make('ZunFuyuzora\UkyoTable\Datatable');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'./routes.php';
    }
}
