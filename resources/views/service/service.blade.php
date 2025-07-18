@php
   use App\Models\Service;
   $services = Service::where('status', 'show')->get();
@endphp

@if ($services->count() > 0)
   <section class="services-section" id="services-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
               <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">My Quality Services</h2>
               <p class="wow fadeInUp" data-wow-delay=".4s">
                 We put your ideas and thus your wishes in the form of a unique web project that inspires you and your
                 customers.
               </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="services-widget position-relative">
               @foreach($services as $index => $service)
                  <div
                  class="service-item {{ $index === 0 ? 'current' : '' }} d-flex flex-wrap align-items-center wow fadeInUp"
                  data-wow-delay=".{{ 5 + $index }}s">
                  <div class="left-box d-flex flex-wrap align-items-center">
                     <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                     <h3 class="service-title">{{ $service->title }}</h3>
                  </div>
                  <div class="right-box">
                     <p>{{ $service->short_desc }}</p>
                  </div>
                  <i class="flaticon-up-right-arrow"></i>
                  <button data-mfp-src="#service-wrapper" class="service-link modal-popup" data-id="{{ encrypt($service->id) }}"
                     data-description="{{ $service->description }}" data-image="{{ asset('/' . $service->image) }}">
                  </button>
                  </div>
               @endforeach
               <div class="active-bg wow fadeInUp" data-wow-delay=".5s"></div>
            </div>
          </div>
        </div>
      </div>
   </section>
@endif

<div id="service-wrapper" class="popup_content_area zoom-anim-dialog mfp-hide" data-lenis-prevent="">
   <div class="popup_modal_img">
      <img src="assets/img/services/modal-img.jpg" alt="">
   </div>
   <div class="popup_modal_content">
      <div class="service_details">
         <div class="row">
            <div class="col-lg-7 col-xl-8">
               <div class="service_details_content">
                  <div class="service_info">
                     <h6 class="subtitle"></h6>
                     <h2 class="title"></h2>
                     <div class="desc"></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-5 col-xl-4">
               <div class="tj_main_sidebar">
                  <div class="sidebar_widget contact_form">
                     <div class="widget_title">
                        <h3 class="title">Get in Touch</h3>
                     </div>
                     <form method="post" id="serviceContactForm">
                        <input type="hidden" name="rowid" class="rowid">
                        <div class="form_group">
                           <input type="text" name="name" placeholder="Name" autocomplete="off" required>
                        </div>
                        <div class="form_group">
                           <input type="email" name="email" placeholder="Email" autocomplete="off" required>
                        </div>
                        <div class="form_group">
                           <input type="tel" name="phone" placeholder="Phone" autocomplete="off">
                        </div>
                        <div class="form_group">
                           <textarea name="message" placeholder="Your message" autocomplete="off" required></textarea>
                        </div>
                        <div class="form_btn">
                           <button class="btn tj-btn-primary" type="submit">Send Message</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
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

<div id="toastMessage">✅ Message sent!</div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
      const buttons = document.querySelectorAll(".service-link");

      buttons.forEach(button => {
         button.addEventListener("click", function () {
            const rowid = this.getAttribute("data-id");
            const image = this.getAttribute("data-image");
            const description = this.getAttribute("data-description");

            document.querySelector("#service-wrapper .rowid").value = rowid;
            document.querySelector("#service-wrapper .popup_modal_img img").src = image;
            document.querySelector("#service-wrapper .desc").innerHTML = description;
         });
      });
   });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      
      const serviceButtons = document.querySelectorAll(".service-link");
      serviceButtons.forEach(button => {
         button.addEventListener("click", function () {
            const rowid = this.getAttribute("data-id");
            const image = this.getAttribute("data-image");
            const description = this.getAttribute("data-description");

            document.querySelector("#service-wrapper .rowid").value = rowid;
            document.querySelector("#service-wrapper .popup_modal_img img").src = image;
            document.querySelector("#service-wrapper .desc").innerHTML = description;
         });
      });
      
      const form = document.getElementById("serviceContactForm");

      form.addEventListener("submit", function (e) {
         e.preventDefault();

         const submitBtn = form.querySelector('button[type="submit"]');
         submitBtn.textContent = "Sending...";
         submitBtn.disabled = true;

         const formData = new FormData(form);

         fetch("{{ route('contact.enquiry') }}", {
            method: "POST",
            headers: {
               "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
         })
         .then(async response => {
            if (!response.ok) {
               if (response.status === 422) {
                  const data = await response.json();
                  let messages = "";
                  for (let field in data.errors) {
                     messages += data.errors[field][0] + "\n";
                  }
                  throw new Error("Validation Error:\n" + messages);
               } else {
                  throw new Error("Something went wrong. Please try again.");
               }
            }
            return response.json();
         })
         .then(data => {
            
            const toast = document.getElementById("toastMessage");
            toast.textContent = "✅ " + data.message;
            toast.classList.add("show");
            setTimeout(() => {
               toast.classList.remove("show");
            }, 3000);

            form.reset();
            
            if (window.jQuery && jQuery.magnificPopup) {
               jQuery.magnificPopup.close();
            }
         })
         .catch(error => {
            alert(error.message);
         })
         .finally(() => {
            submitBtn.textContent = "Send Message";
            submitBtn.disabled = false;
         });
      });
   });
</script>