@extends('admin.common.masterpage')

@section('content')
<!-- partial -->
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">
                  {{session('message')}}
                </div>
            @endif
            <h4 class="card-title">{{ isset($skills) ? 'Update' : 'Add' }} Skills</h4>

            <form class="forms-sample" 
                  action="{{ isset($skills) ? route('admin/updateskills', $skills->id) : route('admin/insertskills') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
              @csrf
              @if (isset($skills)) 
                @method('PUT') <!-- Add PUT method for update -->
              @endif
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name='title' id="title" placeholder="Title" value='{{ old('title', isset($skills) ? $skills->title : '') }}'>
                  <span class='text-danger'>
                    @error('title')
                      {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group col-md-12">
                  <label for="Percent">Percent</label>
                  <input type="text" class="form-control" name='percent' placeholder="Percent" value="{{ old('percent', isset($skills) ? $skills->percent : '') }}" id="Percent">
                  <span class='text-danger'>
                    @error('percent')
                      {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group col-md-4">
                  <label for="Image">Image</label>
                  <input type="file" class="form-control" name="image" id="Image" width='100%'>
                  <span class="text-danger">
                      @error('image') {{$message}} @enderror
                  </span>
                </div>
                <div class="col-md-2">
                  <img src="{{ isset($skills) && $skills->image ? asset($skills->image) : '' }}" id="image-preview" width="100%" alt="Current Image" style="display: none;">
                </div>
                <div class="form-group col-md-6">
                  <label for="status">Status</label>
                  <select name='status' id='status' class="form-control form-control-sm">
                    <option value="show" {{ (isset($skills) && $skills->status == 'show') ? 'selected' : '' }}>Show</option>
                    <option value="hide" {{ (isset($skills) && $skills->status == 'hide') ? 'selected' : '' }}>Hide</option>
                  </select>
                  <span class='text-danger'>
                    @error('status')
                      {{$message}}
                    @enderror
                  </span>
                </div>
              </div>
              <button type="submit" name='submit' class="btn btn-primary me-2">
                {{ isset($skills) ? 'Update' : 'Submit' }}
              </button>
            </form>
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