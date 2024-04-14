<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
 
        View::composer('*', function($view)
        {
            $menu = Menu::with(['sub_menu'])->where('is_active', 1)->where('par_id', 0)->orderBy('ordering')->get();
            $view->with('menu', $menu);
        });
    }
}
