<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.template',function($view){
             $view->with(
                 [
                     'categories' => DB::table('categories')->where('status','=',1)->get()
                 ]
            );
        });
        view()->composer('admin.layouts.index',function($view){
            $data = DB::select(
                'SELECT DATE_FORMAT(o.created_at,"%d/%m/%Y") order_day,SUM(o.price) total_price FROM orders o WHERE o.status = 2 GROUP BY order_day'
            );
            $view->with('data',$data);
        });
    }
}
