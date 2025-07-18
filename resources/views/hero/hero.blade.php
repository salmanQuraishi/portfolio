@php
   use App\Http\Controllers\MainController;
   $profile = MainController::profile();
@endphp
<div>

   <section class="hero-section d-flex align-items-center" id="intro">

      <div class="intro_text">
         <svg viewbox="0 0 1320 300">
            <text x="50%" y="50%" text-anchor="middle">{{$profile->greeting}}</text>
         </svg>
      </div>
      <div class="container">
         <div class="row align-items-center">
            <div class="col-md-6">
               <div class="hero-content-box">
                  <span class="hero-sub-title">{{$profile->title}}</span>
                  <h1 class="hero-title"> {!!$profile->heading!!}</h1>

                  <div class="hero-image-box d-md-none text-center">
                     <img src="{{$profile->profile}}" alt="{{$profile->title}}">
                  </div>

                  <p class="lead">
                     {{$profile->description}}
                  </p>
                  <div class="button-box d-flex flex-wrap align-items-center">
                     <a href="{{$profile->cv}}" download="{{$profile->cv}}" target="_blank"
                        class="btn tj-btn-secondary">Download CV <i class="flaticon-download"></i></a>
                     <ul class="ul-reset social-icons">
                     @php
                     $socialLinks = is_array($profile->links) ? $profile->links : json_decode($profile->links, true) ?? explode(',', $profile->links);
                     $icons = ['fa-twitter', 'fa-instagram', 'fa-linkedin-in', 'fa-github'];
                    @endphp

                        @foreach ($socialLinks as $index => $link)
                     <li>
                        <a href="{{ $link }}" target="_blank">
                          <i class="fa-brands {{ $icons[$index] ?? 'fa-link' }}"></i>
                        </a>
                     </li>
                  @endforeach
                     </ul>

                  </div>
               </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
               <div class="hero-image-box text-center">
                  <img src="{{$profile->profile}}" alt="">
               </div>
            </div>
         </div>
         <div class="funfact-area">
            <div class="row">
               <div class="col-6 col-lg-3">
                  <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                     <div class="number"><span class="odometer" data-count="{{$profile->experience}}">0</span></div>
                     <div class="text">Years of <br>Experience</div>
                  </div>
               </div>
               <div class="col-6 col-lg-3">
                  <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                     <div class="number"><span class="odometer" data-count="{{$profile->project}}">0</span>+</div>
                     <div class="text">Project <br>Completed</div>
                  </div>
               </div>
               <div class="col-6 col-lg-3">
                  <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                     <div class="number"><span class="odometer" data-count="{{$profile->client}}">0</span>+</div>
                     <div class="text">Happy <br>Clients</div>
                  </div>
               </div>
               <div class="col-6 col-lg-3">
                  <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                     <div class="number"><span class="odometer" data-count="{{$profile->support_hours}}">0</span></div>
                     <div class="text">Hours of <br>Support Provided</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

</div>