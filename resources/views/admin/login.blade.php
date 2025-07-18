<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{$settings->title}}</title>

  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/base/vendor.bundle.base.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="apple-touch-icon" href="{{asset("$settings->favicon")}}">
  <link rel="shortcut icon" type="image/png" href="{{asset("$settings->favicon")}}">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row w-100 mx-0 d-flex align-items-center">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-4 px-3 px-sm-5">
              <div>
                <img src="{{asset("$settings->logo_dark")}}" alt="logo" width="100%">
              </div>
              @if (session('message'))
                <div class="alert alert-dark mt-3 mb-0">
                  <span><strong>{{session('message')}}</strong></span>
                </div>
              @endif
              <form class="pt-2" method="POST" action='{{route('login')}}'>
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail">Email</label>
                    <input type="email" class="form-control border-left-0" id="exampleInputEmail" placeholder="Email" name='email' value="{{old('email')}}">
                  <span class='text-danger'>
                    @error('email')
                      {{$message}}
                    @enderror
                  </span>  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                    <input type="password" class="form-control border-left-0" id="exampleInputPassword" placeholder="Password" name='password'>  
                  <span class='text-danger'>
                    @error('password')
                      {{$message}}
                    @enderror
                  </span>                      
                </div>
                <div class="">
                  <button class="btn col-md-12 btn-dark font-weight-medium auth-form-btn" type="submit" name='submit'>LOGIN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('js/template.js')}}"></script>
  <script src="{{asset('js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

</html>
