@php
   $title = 'About';
   use App\Http\Controllers\MainController;
   $funFect = MainController::profile();
@endphp
@section('title')
   {{$title}}
@endsection
@extends('layout')
@section('main-content')
   <main class="site-content" id="content">
      <!-- START: Breadcrumb Area -->
      <section class="breadcrumb_area" data-bg-image="./assets/img/breadcrumb/breadcrumb-bg.jpg" data-bg-color="#140C1C">
         <div class="container">
            <div class="row">
               <div class="col">
                  <div class="breadcrumb_content d-flex flex-column align-items-center">
                     <h2 class="title wow fadeInUp" data-wow-delay=".3s">About</h2>
                     <div class="breadcrumb_navigation wow fadeInUp" data-wow-delay=".5s">
                        <span><a href="index">Home</a></span>
                        <i class="far fa-long-arrow-right"></i>
                        <span class="current-item">About</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- END: Breadcrumb Area -->

      @include('experienceeducation.experienceeducation')

      @include('skills.skills')

      <!-- start: Counter Area -->
      <section class="counter-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="funfact-area">
                     <div class="row">
                        <div class="col-6 col-lg-3">
                           <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center wow fadeInUp" data-wow-delay=".3s">
                              <div class="number"><span class="odometer" data-count="{{$funFect->experience}}">0</span></div>
                              <div class="text">Years of <br>Experience</div>
                           </div>
                        </div>
                        <div class="col-6 col-lg-3">
                           <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center wow fadeInUp" data-wow-delay=".4s">
                              <div class="number"><span class="odometer" data-count="{{$funFect->project}}">0</span>+</div>
                              <div class="text">Project <br>Completed</div>
                           </div>
                        </div>
                        <div class="col-6 col-lg-3">
                           <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center wow fadeInUp" data-wow-delay=".5s">
                              <div class="number"><span class="odometer" data-count="{{$funFect->client}}">0</span>K</div>
                              <div class="text">Happy <br>Clients</div>
                           </div>
                        </div>
                        <div class="col-6 col-lg-3">
                           <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                              <div class="number"><span class="odometer" data-count="{{$funFect->support_hours}}">0</span></div>
                              <div class="text">Hours of <br>Support Provided</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end: Counter Area -->

      <!-- start: Text Area -->
      <section class="text-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="section-header">
                     <div class="heading-left">
                        <p class="wow fadeInUp" data-wow-delay=".3s">Want to start a project?</p>
                        <h2 id="anim" class="section-title wow fadeInUp" data-wow-delay=".4s">Let’s have a chat</h2>
                     </div>
                     <div class="chat-mail wow fadeInRight" data-wow-delay=".5s">
                        <a class="link" href="mailto:info@salman.com">info@salman.com <i class="fa-light fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end: Text Area -->
   </main>
@endsection