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
            <h4 class="card-title">{{ isset($portfolio) ? 'Update' : 'Add' }} Portfolio</h4>

            <!-- Determine if it's an update or insert -->
            <form class="forms-sample" 
                  action="{{ isset($portfolio) ? route('admin/updateportfolio', $portfolio->id) : route('admin/insertportfolio') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
              @csrf
              @if (isset($portfolio)) 
                @method('PUT') <!-- Add PUT method for update -->
              @endif
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="Category">Category</label>
                  <select name="categoryid" id="Category" class="form-control form-control-sm">
                    <option value="" selected disabled>Select Category</option>
                    @foreach($portfoliocategory as $category)
                      <option value="{{$category->id}}" 
                              {{ isset($portfolio) && $portfolio->categoryid == $category->id ? 'selected' : '' }}>
                        {{$category->title}}
                      </option>
                    @endforeach
                  </select>
                  <span class="text-danger">
                    @error('categoryid') {{ $message }} @enderror
                  </span>
                </div>
                <div class="form-group col-md-6">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" 
                        value="{{ old('title', isset($portfolio) ? $portfolio->title : '') }}">
                  <span class="text-danger">
                    @error('title') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-6">
                  <label for="Company">Company</label>
                  <input type="text" class="form-control" name="company" id="Company" placeholder="Company" 
                        value="{{ old('company', isset($portfolio) ? $portfolio->company : '') }}">
                  <span class="text-danger">
                    @error('company') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-6">
                  <label for="Client">Client Name</label>
                  <input type="text" class="form-control" name="client" id="Client" placeholder="Client Name" 
                        value="{{ old('client', isset($portfolio) ? $portfolio->client : '') }}">
                  <span class="text-danger">
                    @error('client') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-4">
                  <label for="Designer">Designer</label>
                  <input type="text" class="form-control" name="designer" id="Designer" placeholder="Designer" 
                        value="{{ old('designer', isset($portfolio) ? $portfolio->designer : '') }}">
                  <span class="text-danger">
                    @error('designer') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-4">
                  <label for="Link">Link</label>
                  <input type="text" class="form-control" name="link" id="Link" placeholder="Link" 
                        value="{{ old('link', isset($portfolio) ? $portfolio->link : '') }}">
                  <span class="text-danger">
                    @error('link') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-4">
                  <label for="start_date">Start Date</label>
                  <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date" 
                        value="{{ old('start_date', isset($portfolio) ? $portfolio->start_date : '') }}">
                  <span class="text-danger">
                    @error('start_date') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-12">
                  <label for="short_desc">Short Description</label>
                  <textarea class="form-control" name="short_desc" id="short_desc" placeholder="Short Description">{{ old('short_desc', isset($portfolio) ? $portfolio->short_desc : '') }}</textarea>
                  <span class="text-danger">
                    @error('short_desc') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-12">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="Editor" placeholder="Description">{{ old('description', isset($portfolio) ? $portfolio->description : '') }}</textarea>
                  <span class="text-danger">
                    @error('description') {{$message}} @enderror
                  </span>
                </div>
                <div class="form-group col-md-4">
                  <label for="Image">Image</label>
                  <input type="file" class="form-control" name="image" id="Image">
                  <span class="text-danger">
                      @error('image') {{$message}} @enderror
                  </span>
                </div>
                <div class="col-md-2">
                  <img src="{{ isset($portfolio) && $portfolio->image ? asset($portfolio->image) : '' }}" id="image-preview" width="100%" alt="Current Portfolio Image" style="display: none;">
                </div>
                <div class="form-group col-md-6">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control form-control-sm">
                    <option value="show" {{ isset($portfolio) && $portfolio->status == 'show' ? 'selected' : '' }}>Show</option>
                    <option value="hide" {{ isset($portfolio) && $portfolio->status == 'hide' ? 'selected' : '' }}>Hide</option>
                  </select>
                  <span class="text-danger">
                    @error('status') {{$message}} @enderror
                  </span>
                </div>

              </div>
              <button type="submit" class="btn btn-primary me-2">
                {{ isset($portfolio) ? 'Update' : 'Submit' }}
              </button>
              <button type="reset" class="btn btn-light">Cancel</button>
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