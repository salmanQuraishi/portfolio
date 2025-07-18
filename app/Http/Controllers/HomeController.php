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

class HomeController extends Controller
{
    public function dashboard()
    {
        $educationCount = Education::count();
        $experienceCount = Experience::count();
        $menuCount = Menu::count();
        $portfolioCount = Portfolio::count();
        $serviceCount = Service::count();
        $skillsCount = Skills::count();
        $testimonialCount = Testimonial::count();
        $contactCount = Contact::count();
        return view('admin.index', compact(
            'educationCount', 
            'experienceCount', 
            'menuCount', 
            'portfolioCount', 
            'serviceCount', 
            'skillsCount', 
            'testimonialCount',
            'contactCount'
        ));
    }

}