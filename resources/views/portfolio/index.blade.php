@php
   $title = 'Portfolio';
@endphp
@section('title')
   {{$title}}
@endsection
@extends('layout')
@section('main-content')

   <main class="site-content" id="content">
      
      <section class="breadcrumb_area" data-bg-image="./assets/img/breadcrumb/breadcrumb-bg.jpg" data-bg-color="#140C1C">
         <div class="container">
            <div class="row">
               <div class="col">
                  <div class="breadcrumb_content d-flex flex-column align-items-center">
                     <h2 class="title wow fadeInUp" data-wow-delay=".3s">Portfolio</h2>
                     <div class="breadcrumb_navigation wow fadeInUp" data-wow-delay=".5s">
                        <span><a href="index">Home</a></span>
                        <i class="far fa-long-arrow-right"></i>
                        <span class="current-item">Portfolio</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      @include('portfolio.portfolio')
      
   </main>
@endsection