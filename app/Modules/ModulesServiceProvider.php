<?php

namespace App\Modules;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

     private $module_path;

    public function boot()
    {

            $modules = config('module.modules');
            foreach ($modules as $key => $module) {
                // Load the routes for each of the modules
                 if (file_exists(__DIR__.'/'.$module.'/routes.php')) {
                     include __DIR__.'/'.$module.'/routes.php';
                 } else {
                     echo "{$module} Module Not found1"; die;
                 }

                // Load the views
                if(is_dir(__DIR__.'/'.$module.'/Views')) {
                    $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
                } else {
                    echo  "{$module} Module View Not found"; die;
                }
            }

    }
    

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

