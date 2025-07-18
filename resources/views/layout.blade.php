<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">

   <title> {{$settings->title}} - @yield('title')</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <link rel="apple-touch-icon" href="{{$settings->favicon}}">
   <link rel="shortcut icon" type="image/png" href="{{$settings->favicon}}">

   <!-- CSS here -->
   <link rel="stylesheet" href="assets/css/animate.min.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome-pro.min.css">
   <link rel="stylesheet" href="assets/css/flaticon_gerold.css">
   <link rel="stylesheet" href="assets/css/nice-select.css">
   <link rel="stylesheet" href="assets/css/backToTop.css">
   <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
   <link rel="stylesheet" href="assets/css/swiper.min.css">
   <link rel="stylesheet" href="assets/css/odometer-theme-default.css">
   <link rel="stylesheet" href="assets/css/magnific-popup.css">
   <link rel="stylesheet" href="assets/css/main.css">
   <link rel="stylesheet" href="assets/css/light-mode.css">
   <link rel="stylesheet" href="assets/css/meanmenu.css">
   <link rel="stylesheet" href="assets/css/responsive.css">
   
   <!-- about page css -->
   <link rel="stylesheet" href="assets/css/main-2.css">
   <link rel="stylesheet" href="assets/css/main-3.css">
   <link rel="stylesheet" href="assets/css/responsive-2.css">
   <link rel="stylesheet" href="assets/css/responsive-3.css">


</head>
<!-- <body class="light-mode"> -->
<body>

   @include('header')

   @yield('main-content')

   @include('footer')


     <!-- JSS here -->
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>

   <script src="assets/js/gsap.min.js"></script>
   <script src="assets/js/gsap-scroll-to-plugin.min.js"></script>
   <script src="assets/js/gsap-scroll-trigger.min.js"></script>
   <script src="assets/js/gsap-split-text.min.js"></script>
   <script src="assets/js/lenis.min.js"></script>

   <script src="assets/js/nice-select.min.js"></script>
   <script src="assets/js/backToTop.js"></script>
   <script src="assets/js/appear.min.js"></script>
   <script src="assets/js/wow.min.js"></script>
   <script src="assets/js/lightcase.js"></script>
   <script src="assets/js/owl.carousel.min.js"></script>
   <script src="assets/js/swiper.min.js"></script>
   <script src="assets/js/imagesloaded-pkgd.js"></script>
   <script src="assets/js/isotope.pkgd.min.js"></script>
   <script src="assets/js/odometer.min.js"></script>
   <script src="assets/js/magnific-popup.js"></script>
   <script src="assets/js/validate.min.js"></script>
   <script src="assets/js/meanmenu.js"></script>
   <script src="assets/js/main.js"></script>
</body>

</html>