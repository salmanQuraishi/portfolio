<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Menu;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Skills;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\WebSetting;

class MainController extends Controller
{
    public static function settings()
    {
        return WebSetting::first();
    }
    public static function profile()
    {
        return Profile::first();
    }
    public static function Menu()
    {
        $headerMenu = Menu::where('menu_status', 'show')
                  ->where('menu_link', 'NOT LIKE', '%contact%')
                  ->get();
        $footerMenu = Menu::where('menu_status', 'show')->get();
        return [
            'headerMenu' => $headerMenu,
            'footerMenu' => $footerMenu
        ];
    }
}