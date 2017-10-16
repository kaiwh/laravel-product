<?php

namespace Kaiwh\Product\Providers;

class ProductServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $commands = [
        'Kaiwh\Product\Commands\ProductInstallCommand',
    ];
    // public function boot()
    // {
    // }

    public function register()
    {
        $this->commands($this->commands);
    }
}
