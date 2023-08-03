<?php
namespace LavaBee\LaravelAuth\Providers;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //$this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../../configs/lava-auth.php','lavaAuth');
    }

    public function register()
    {

    }
}
