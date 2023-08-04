<?php
namespace LavaBee\Power;

use Illuminate\Support\ServiceProvider;
use LavaBee\Power\Models\Permission;
use Illuminate\Contracts\Foundation\Application;

class LavaBeePowerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //$this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->mergeConfigFrom(__DIR__ . '/../configs/power.php','power');
    }

    public function register()
    {

    }
}
