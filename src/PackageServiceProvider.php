<?php
namespace Yeeraf\DocumentNumberer;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    public function register()
    {
        $this->app->make(DocumentNumberer::class);
    }
}
