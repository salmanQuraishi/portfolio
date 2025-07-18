@extends('admin.common.masterpage')
@section('content')
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div  iv class="card">
          <div class="card-body">
            <h4 class="card-title">Profile</h4>
            @if (session('success'))
              <div class="alert alert-success">
                {{session('success')}}
              </div>
            @endif
            @foreach ($profile as $profiles)
            
            @endforeach

              <form class="forms-sample" action="{{ route('admin/updateprofile') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputName1">Title</label>
                    <input type="text" class="form-control" name='title' id="exampleInputName1" placeholder="Title"
                    value='{{ old('title', $profiles->title) }}'>
                    <span class='text-danger'>
                    @error('title') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="Heading">Heading</label>
                    <input type="text" class="form-control" name='heading' id="Heading" placeholder="Heading"
                    value='{{ old('heading', $profiles->heading) }}'>
                    <span class='text-danger'>
                    @error('heading') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="Greeting">Greeting</label>
                    <input type="text" class="form-control" name='greeting' id="Greeting" placeholder="Greeting"
                    value='{{ old('greeting', $profiles->greeting) }}'>
                    <span class='text-danger'>
                    @error('greeting') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" name='description' id="description"
                    rows='4'>{{ old('description', $profiles->description) }}</textarea>
                    <span class='text-danger'>
                    @error('description') {{$message}} @enderror
                    </span>
                  </div>
                  @php
                    $links = json_decode($profiles->links, true);
                  @endphp
                  <div class="form-group col-md-6">
                    <label for="links">Link 1</label>
                    <input type="text" class="form-control" name='links[]' id="links" placeholder="Link 1"
                    value='{{ $links[0] ?? '' }}'>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="links">Link 2</label>
                    <input type="text" class="form-control" name='links[]' id="links" placeholder="Link 2"
                    value='{{ $links[1] ?? '' }}'>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="links">Link 3</label>
                    <input type="text" class="form-control" name='links[]' id="links" placeholder="Link 3"
                    value='{{ $links[2] ?? '' }}'>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="links">Link 4</label>
                    <input type="text" class="form-control" name='links[]' id="links" placeholder="Link 4"
                    value='{{ $links[3] ?? '' }}'>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="Experience">Experience</label>
                    <input type="text" class="form-control" name='experience' id="Experience" placeholder="Experience"
                    value='{{ old('experience', $profiles->experience) }}'>
                    <span class='text-danger'>
                    @error('experience') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="project">Project</label>
                    <input type="text" class="form-control" name='project' id="project" placeholder="Project"
                    value='{{ old('project', $profiles->project) }}'>
                    <span class='text-danger'>
                    @error('project') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="Client">Client</label>
                    <input type="text" class="form-control" name='client' id="Client" placeholder="Client"
                    value='{{ old('client', $profiles->client) }}'>
                    <span class='text-danger'>
                    @error('client') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="support_hours">Support Hours</label>
                    <input type="text" class="form-control" name='support_hours' id="support_hours"
                    placeholder="Support Hours" value='{{ old('support_hours', $profiles->support_hours) }}'>
                    <span class='text-danger'>
                    @error('support_hours') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="form-group col-md-5">
                    <label for="Image">Profile</label>
                    <input type="file" class="form-control" name="profile" id="Image">
                    <span class="text-danger">
                        @error('profile') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="col-md-1">
                    <img src="{{ isset($profiles) && $profiles->profile ? asset($profiles->profile) : '' }}" id="image-preview" width="100%" alt="Current Profile Image" style="display: none;">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="cv">CV</label>
                    <input type="file" class="form-control" name='cv' id="cv">
                    <span class='text-danger'>
                    @error('cv') {{$message}} @enderror
                    </span>
                  </div>
                  <div class="col-md-1">
                    <a href="{{ asset($profiles->cv) }}" target="_blank">
                      <img src="{{ asset('/images/images.png') }}" width="100%">
                    </a>
                  </div>
                </div>
                <button type="submit" name='submit' class="btn btn-primary me-2">Submit</button>
              </form>

          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    if ($('#image-preview').attr('src') !== '') {
      $('#image-preview').show();
    } else {
      $('#image-preview').hide();
    }
    $('#Image').change(function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#image-preview').attr('src', e.target.result).show();
      }
      reader.readAsDataURL(this.files[0]);
    });
  });
</script>