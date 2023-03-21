<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Basket;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
  
        public function boot() {
        View::composer('layouts.parts.roots', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('layouts.parts.brands', function($view) {
            $view->with(['items' => Brand::popular()]);
        });
        
       View::composer('layouts.site', function($view) {
            $view->with(['positions' => Basket::getCount()]);
        });
        
//        View::composer('layouts.site', function($view) {
//            $view->with(['positions' => 3]);
//        });
    
    }
}
