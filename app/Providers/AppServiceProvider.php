<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebSetting;
use App\Http\Controllers\MainController;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        $settings = WebSetting::first(); 
        $menuData = MainController::Menu();

        View::share('settings', $settings);
        View::share('menuData', $menuData);
    }
}
