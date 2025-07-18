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
                                {{ session('message') }}
                            </div>
                        @endif
                        <h4 class="card-title">
                            Add Gallery
                        </h4>

                        <form class="forms-sample" action="{{ route('admin/insertportfoliogallery',$rowId) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-11">
                                    <label for="Image">Image</label>
                                    <input type="file" class="form-control" name="image" id="Image" value="{{ old('image') }}">
                                    <span class="text-danger">
                                        @error('image') {{ $message }} @enderror
                                    </span>
                                </div>
                                <div class="col-md-1">
                                    <img src="" id="image-preview" width="100%" alt="Current Gallery Image" style="display: none;">
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h4 class="card-title">Gallery</h4>
                        <div class="table-responsive">
                            <table id="example" class="table table-dark table-hover tablesorter" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Portfolio</th>
                                        <th>Image</th>
                                        <th>Create Date</th>
                                        <th>Update Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($gallery as $data)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data->portfolio->title }}</td>
                                            <td>
                                                <img src="{{asset('/'.$data->image)}}" width="100px">
                                            </td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>{{ $data->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin/deleteportfoliogallery', $data->id) }}" class="btn btn-inverse-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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