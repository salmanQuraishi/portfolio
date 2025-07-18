<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WebSettingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ContactEnquiryController;
use App\Models\Portfolio;

Route::group([], function () {

    Route::get('/', function(){
        return view('home.home');
    })->name('home');

    Route::get('/about', function(){
        return view('about.about');
    })->name('about');
    
    Route::get('/services', function(){
        return view('service.index');
    })->name('services');
    
    Route::get('/portfolio', function(){
        return view('portfolio.index');
    })->name('portfolio');

    Route::get('/portfolio/{id}', [CommonController::class, 'portfolioShow'])->name('portfolio.show');
    Route::get('/modal/portfolio/{id}', [PortfolioController::class, 'show']);
    
    Route::get('/contact', function(){
        return view('contact.contact');
    })->name('contact');
    
    Route::post('/contact/enquiry',[CommonController::class,'contactEnquiry'])->name('contact.enquiry');

});


Route::fallback(function () {
    return view('admin.error');
});

Route::group(['middleware'=>'guest'],function(){
    Route::get('/admin/login',[AuthController::class,'index'])->name('login');
    Route::post('/admin/login',[AuthController::class,'login'])->name('login');
});

Route::group(['middleware'=>'auth'],function(){

    Route::get('/admin',[HomeController::class,'dashboard'])->name('index');
    Route::get('/admin/index',[HomeController::class,'dashboard'])->name('index');
    Route::get('/admin/logout',[AuthController::class,'logout'])->name('logout');

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/setting', [WebSettingController::class,'setting'])->name('setting');
        Route::post('/setting', [WebSettingController::class,'update_setting'])->name('updatesetting');
    });
    
    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/profile', [WebSettingController::class,'profile'])->name('profile');
        Route::post('/profile/update', [WebSettingController::class, 'updateprofile'])->name('updateprofile');
    });
    
    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/add/menu', [MenuController::class,'add_menu'])->name('addmenu');
        Route::post('/add/menu', [MenuController::class,'insert_menu'])->name('insertmenu');
        Route::get('/menu', [MenuController::class,'select_menu'])->name('viewmenu');
        Route::get('/delete/menu/{id}', [MenuController::class,'delete_menu'])->name('deletemenu');
        Route::get('/edit/menu/{id}', [MenuController::class,'edit_menu'])->name('editmenu');
        Route::post('/update/menu/{id}', [MenuController::class,'update_menu'])->name('updatemenu');
    });
    
    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/add/service', [ServiceController::class,'index'])->name('addservice');
        Route::get('/service', [ServiceController::class,'service'])->name('viewservice');
        Route::post('/insert/service', [ServiceController::class, 'store'])->name('insertservice');
        Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('editservices');
        Route::put('/service/update/{id}', [ServiceController::class, 'update'])->name('updateservice');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/add/portfolio', [PortfolioController::class,'index'])->name('addportfolio');
        Route::get('/portfolio', [PortfolioController::class,'portfolio'])->name('viewportfolio');
        Route::post('/insert/portfolio', [PortfolioController::class, 'store'])->name('insertportfolio');
        Route::get('/portfolio/edit/{id}', [PortfolioController::class, 'edit'])->name('editportfolio');
        Route::put('/portfolio/update/{id}', [PortfolioController::class, 'update'])->name('updateportfolio');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/portfolio/category', [PortfolioController::class,'viewportfoliocategory'])->name('viewportfoliocategory');
        Route::post('/insert/portfolio/category', [PortfolioController::class, 'insertportfoliocategory'])->name('insertportfoliocategory');
        Route::get('/portfolio/category/edit/{id}', [PortfolioController::class, 'editportfoliocategory'])->name('editportfoliocategory');
        Route::put('/portfolio/category/update/{id}', [PortfolioController::class, 'updateportfoliocategory'])->name('updateportfoliocategory');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/portfolio/gallery/{id}', [PortfolioController::class,'gallery'])->name('viewportfoliogallery');
        Route::post('/portfolio/gallery/insert/{id}', [PortfolioController::class, 'insertportfoliogallery'])->name('insertportfoliogallery');
        Route::get('/portfolio/gallery/delete/{id}', [PortfolioController::class, 'deleteGallery'])->name('deleteportfoliogallery');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/experience', [ExperienceController::class,'index'])->name('addexperience');
        Route::post('/insert/experience', [ExperienceController::class, 'store'])->name('insertexperience');
        Route::get('/experience/view', [ExperienceController::class,'view'])->name('viewexperience');
        Route::get('/experience/edit/{id}', [ExperienceController::class, 'edit'])->name('editexperience');
        Route::put('/experience/update/{id}', [ExperienceController::class, 'update'])->name('updateexperience');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/education', [EducationController::class,'index'])->name('addeducation');
        Route::post('/insert/education', [EducationController::class, 'store'])->name('inserteducation');
        Route::get('/education/view', [EducationController::class,'view'])->name('vieweducation');
        Route::get('/education/edit/{id}', [EducationController::class, 'edit'])->name('editeducation');
        Route::put('/education/update/{id}', [EducationController::class, 'update'])->name('updateeducation');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/skills', [SkillsController::class,'index'])->name('addskills');
        Route::post('/insert/skills', [SkillsController::class, 'store'])->name('insertskills');
        Route::get('/skills/view', [SkillsController::class,'view'])->name('viewskills');
        Route::get('/skills/edit/{id}', [SkillsController::class, 'edit'])->name('editskills');
        Route::put('/skills/update/{id}', [SkillsController::class, 'update'])->name('updateskills');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/testimonial', [TestimonialController::class,'index'])->name('addtestimonial');
        Route::post('/insert/testimonial', [TestimonialController::class, 'store'])->name('inserttestimonial');
        Route::get('/testimonial/view', [TestimonialController::class,'view'])->name('viewtestimonial');
        Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('edittestimonial');
        Route::put('/testimonial/update/{id}', [TestimonialController::class, 'update'])->name('updatetestimonial');
    });

    Route::group(['prefix'=>'admin','as'=>'admin/'], function(){
        Route::get('/contact/enquiry/{type}', [ContactEnquiryController::class,'list'])->name('contactenquiry');
        Route::post('/contact/enquiry/update-status/{id}', [ContactEnquiryController::class, 'updateStatus'])->name('contactenquiryudpate');
    });

});
