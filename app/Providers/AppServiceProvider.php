<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Countries;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Session;
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
        // $countries = Countries::where('is_active',1)->get();
        $countries = Countries::all();
        $country   = Countries::first();
        $setting=Setting::first();
        // Session::put('country', $country->id);
        View::share([
            'countries' =>  $countries,
            'setting'=>$setting
        ]);
        // \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
