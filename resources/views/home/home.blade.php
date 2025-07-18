@php
    $title = 'Home'
@endphp
@section('title')
    {{$title}}
@endsection
@extends('layout')
@section('main-content')

<div>

   <main class="site-content" id="content">
      
      @include('hero.hero')

      @include('service.service')

      @include('portfolio.portfolio')

      @include('experienceeducation.experienceeducation')

      @include('skills.skills')

      @include('testimonial.testimonial')
     
   </main>

</div>

@endsection