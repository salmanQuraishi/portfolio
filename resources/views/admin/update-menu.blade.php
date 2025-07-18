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
            <h4 class="card-title">Update Menu</h4>
            <form class="forms-sample" action="{{route('admin/updatemenu',$menu->id)}}" method="POST">
              @csrf
              <div class="form-group">
                <label for="exampleInputName1">Menu Name</label>
                <input type="text" class="form-control" name='menu_name' id="exampleInputName1" placeholder="Menu Name" value='{{$menu->menu_name}}'>
                <span class='text-danger'>
                  @error('menu_name')
                    {{$message}}
                  @enderror
                </span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Menu Link</label>
                <input type="text" class="form-control" name='menu_link' id="exampleInputEmail3" placeholder="Email" value='{{$menu->menu_link}}'>
                <span class='text-danger'>
                  @error('menu_link')
                    {{$message}}
                  @enderror
                </span>
              </div>
              <div class="form-group">
                <label for="exampl">Menu Status</label>
                <select name='menu_status' id='exampl' class="form-control form-control-sm">
                  <option selected disabled >Select Menu Status</option>
                  @if ($menu->menu_status == 'show')
                  <option selected value='show'>Show</option>
                  <option value='hide'>Hide</option>
                  @else
                  <option value='show'>Show</option>
                  <option selected value='hide'>Hide</option>
                  @endif
                </select>
                <span class='text-danger'>
                  @error('menu_status')
                    {{$message}}
                  @enderror
                </span>
              </div>
              <button type="submit" name='submit' class="btn btn-primary me-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  @endsection