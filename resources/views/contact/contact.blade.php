@php
   $title = 'Contact us';
@endphp
@section('title')
   {{$title}}
@endsection

@php
   use App\Models\Service;
   $services = Service::select('id', 'title')
               ->where('status', 'show')
               ->get();
@endphp

@extends('layout')
@section('main-content')
<div>
<div id="toastMessage"></div>

<style>
#toastMessage {
   position: fixed;
   top: 20px;
   right: 20px;
   background: #d4edda;
   color: #155724;
   padding: 12px 20px;
   border: 1px solid #c3e6cb;
   border-radius: 5px;
   box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
   z-index: 9999;
   font-family: sans-serif;
   opacity: 0;
   transform: translateY(-20px);
   transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
   pointer-events: none;
}
#toastMessage.show {
   opacity: 1;
   transform: translateY(0);
   pointer-events: auto;
}
</style>

   <main class="site-content" id="content">
      <!-- START: Breadcrumb Area -->
      <section class="breadcrumb_area" data-bg-image="{{asset('/')}}assets/img/breadcrumb/breadcrumb-bg.jpg" data-bg-color="#140C1C">
         <div class="container">
            <div class="row">
               <div class="col">
                  <div class="breadcrumb_content d-flex flex-column align-items-center">
                     <h2 class="title wow fadeInUp" data-wow-delay=".3s">Contact Us</h2>
                     <div class="breadcrumb_navigation wow fadeInUp" data-wow-delay=".5s">
                        <span><a href="index">Home</a></span>
                        <i class="far fa-long-arrow-right"></i>
                        <span class="current-item">Contact Us</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- END: Breadcrumb Area -->

      <!-- start: Contact Area -->
      <section class="contact-section" id="contact-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-md-7 order-2 order-md-1">
                  <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
                     <div class="section-header">
                        <h2 class="section-title">Let’s work together!</h2>
                        <p>I design and code beautifully simple things and i love what i do. Just simple like that!</p>
                     </div>
                     <div class="tj-contact-form">
                        <form id="contact-form" method="post">
                           <div class="row gx-3">
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="text" name="name" id="name" placeholder="First name" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="email" name="email" id="email" placeholder="Email address" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <input type="tel" name="phone" id="phone" placeholder="Phone number" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form_group">
                                    <select name="rowid" id="service" class="tj-nice-select">
                                       <option value="" selected disabled>Choose Service</option>
                                       @foreach ($services as $service)
                                          <option value="{{ encrypt($service->id) }}">{{ $service->title }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form_group">
                                    <textarea name="message" id="message" placeholder="Message"></textarea>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form_btn">
                                    <button type="submit" class="btn tj-btn-primary">Send Message</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-lg-5 offset-lg-1 col-md-5 d-flex flex-wrap align-items-center order-1 order-md-2">
                  <div class="contact-info-list">
                     <ul class="ul-reset">
                        <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight" data-wow-delay=".4s">
                           <div class="icon-box">
                              <i class="flaticon-phone-call"></i>
                           </div>
                           <div class="text-box">
                              <p>Phone</p>
                              <a href="tel:{{$settings->phone}}">{{$settings->phone}}</a>
                           </div>
                        </li>
                        <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight" data-wow-delay=".5s">
                           <div class="icon-box">
                              <i class="flaticon-mail-inbox-app"></i>
                           </div>
                           <div class="text-box">
                              <p>Email</p>
                              <a href="mailto:{{$settings->email}}">{{$settings->email}}</a>
                           </div>
                        </li>
                        <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight" data-wow-delay=".6s">
                           <div class="icon-box">
                              <i class="flaticon-location"></i>
                           </div>
                           <div class="text-box">
                              <p>Address</p>
                              <a href="#">{{$settings->address}}</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end: Contact Area -->
   </main>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();

        let submitBtn = $(this).find('button[type="submit"]');
        submitBtn.text('Sending...').prop('disabled', true);

        $.ajax({
            url: "{{ route('contact.enquiry') }}",
            method: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Reset the form
                $('#contact-form')[0].reset();

                // Show toast message
                const toast = document.getElementById("toastMessage");
                toast.textContent = "✅ " + response.message;
                toast.classList.add("show");
                setTimeout(() => {
                    toast.classList.remove("show");
                }, 3000);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let messages = '';
                    $.each(errors, function (key, value) {
                        messages += value[0] + "\n";
                    });
                    alert(messages);
                } else {
                    alert("Something went wrong. Please try again.");
                }
            },
            complete: function () {
                submitBtn.text('Send Message').prop('disabled', false);
            }
        });
    });
});
</script>


@endsection
