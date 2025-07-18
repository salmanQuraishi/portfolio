@extends('admin.common.masterpage')
@section('content')
<!-- partial -->
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">WebSetting</h4>
            @if (session('message'))
              <div class="alert alert-success">
                {{session('message')}}
              </div>
            @endif
            @foreach ($setting as $settings)
              <form class="forms-sample" action="{{route('admin/updatesetting')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="Logo">Logo Light</label>
                    <input type="file" class="form-control" name="logo" id="Logo">
                    <span class="text-danger">
                        @error('logo') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="col-md-1">
                    <img src="{{ isset($settings) && $settings->logo ? asset($settings->logo) : '' }}" id="logo-preview" width="100%" alt="Current Logo" style="display: none;">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="Favicon">Favicon Light</label>
                    <input type="file" class="form-control" name="favicon" id="Favicon">
                    <span class="text-danger">
                        @error('favicon') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="col-md-1">
                    <img src="{{ isset($settings) && $settings->favicon ? asset($settings->favicon) : '' }}" id="favicon-preview" width="100%" alt="Current Favicon" style="display: none;">
                  </div>            
                  <div class="form-group col-md-5">
                    <label for="Logo_dark">Logo Dark</label>
                    <input type="file" class="form-control" name="logo_dark" id="Logo_dark">
                    <span class="text-danger">
                        @error('logo_dark') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="col-md-1">
                    <img src="{{ isset($settings) && $settings->logo_dark ? asset($settings->logo_dark) : '' }}" id="logo-dark-preview" width="100%" alt="Current Logo Dark" style="display: none;">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="Favicon_dark">Favicon Dark</label>
                    <input type="file" class="form-control" name="favicon_dark" id="Favicon_dark">
                    <span class="text-danger">
                        @error('favicon_dark') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="col-md-1">
                    <img src="{{ isset($settings) && $settings->favicon_dark ? asset($settings->favicon_dark) : '' }}" id="favicon-dark-preview" width="100%" alt="Current Favicon Dark" style="display: none;">
                  </div>            
                  <div class="form-group col-md-3">
                    <label for="exampleInputName1">Title</label>
                    <input type="text" class="form-control" name='title' id="exampleInputName1" placeholder="Title" value="{{ old('title', $settings->title) }}">
                    <span class='text-danger'>
                      @error('title')
                        {{$message}}
                      @enderror
                    </span>
                  </div>
            
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Email</label>
                    <input type="text" class="form-control" name='email' id="exampleInputEmail3" placeholder="Email" value="{{ old('email', $settings->email) }}">
                    <span class='text-danger'>
                      @error('email')
                        {{$message}}
                      @enderror
                    </span>
                  </div>
            
                  <div class="form-group col-md-3">
                    <label for="exampleInputmobile3">Mobile</label>
                    <input type="number" class="form-control" name='phone' id="exampleInputmobile3" placeholder="Mobile" value="{{ old('phone', $settings->phone) }}">
                    <span class='text-danger'>
                      @error('phone')
                        {{$message}}
                      @enderror
                    </span>
                  </div>
            
                  <div class="form-group col-md-3">
                    <label for="exampleInputmobile3">Pre Loader Text</label>
                    <input type="text" class="form-control" name='preloader' id="exampleInputmobile3" placeholder="Pre Loader Text" value="{{ old('preloader', $settings->preloader) }}">
                    <span class='text-danger'>
                      @error('preloader')
                        {{$message}}
                      @enderror
                    </span>
                  </div>
            
                  <div class="form-group col-md-12">
                    <label for="Address">Address</label>
                    <textarea type="text" class="form-control" name='address' id="Address" placeholder="Address" rows='6'>{{ old('address', $settings->address) }}</textarea>
                    <span class='text-danger'>
                      @error('address')
                        {{$message}}
                      @enderror
                    </span>
                  </div>
                </div>
                <button type="submit" name='submit' class="btn btn-primary me-2">Submit</button>
              </form>
            @endforeach
          
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  @endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {

    if ($('#logo-preview').attr('src') !== '') {
      $('#logo-preview').show();
    } else {
      $('#logo-preview').hide();
    }
    $('#Logo').change(function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#logo-preview').attr('src', e.target.result).show();
      }
      reader.readAsDataURL(this.files[0]);
    });

    if ($('#logo-dark-preview').attr('src') !== '') {
      $('#logo-dark-preview').show();
    } else {
      $('#logo-dark-preview').hide();
    }
    $('#Logo_dark').change(function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#logo-dark-preview').attr('src', e.target.result).show();
      }
      reader.readAsDataURL(this.files[0]);
    });

    if ($('#favicon-preview').attr('src') !== '') {
      $('#favicon-preview').show();
    } else {
      $('#favicon-preview').hide();
    }
    $('#Favicon').change(function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#favicon-preview').attr('src', e.target.result).show();
      }
      reader.readAsDataURL(this.files[0]);
    });

    if ($('#favicon-dark-preview').attr('src') !== '') {
      $('#favicon-dark-preview').show();
    } else {
      $('#favicon-dark-preview').hide();
    }
    $('#Favicon_dark').change(function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#favicon-dark-preview').attr('src', e.target.result).show();
      }
      reader.readAsDataURL(this.files[0]);
    });

  });
</script>