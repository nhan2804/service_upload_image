<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\CateCourse;
use App\Notification;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
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
        $cate_course=CateCourse::all(); 
        View::share('cate_course',$cate_course);
        view()->composer('*', function ($view) 
        {
            $id_user= Session::get("id");
            $notify= DB::table('notify')->join('accounts','notify.id_send','=','accounts.id')->where('notify.id_rec',$id_user)->get();
            $view->with('notify', $notify);    
        });  
        Carbon::setLocale('vi');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
}
