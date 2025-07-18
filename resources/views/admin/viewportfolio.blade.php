@extends('admin.common.masterpage')
@section('content')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
        <h4 class="card-title">Portfolio</h4>
        <div class="table-responsive">
          <table id="example" class="table table-dark table-hover tablesorter" style="width:100%">
          <thead>
            <tr>
            <th>
              Sr.
            </th>
            <th>
              Category
            </th>
            <th>
              Title
            </th>
            <th>
              Image
            </th>
            <th>
              Status
            </th>
            <th>
              Create Date
            </th>
            <th>
              Update Date
            </th>
            <th>
              Action
            </th>
            </tr>
          </thead>
          <tbody>
            @php $i = 1;  @endphp
            @foreach ($portfolio as $data) 
        <tr>
        <td>
          {{$i++}}
        </td>
        <td>
          {{$data->category->title}}
        </td>
        <td>
          {{$data->title}}
        </td>
        <td>
          <img src="{{asset('/' . $data->image)}}" width="100px">
        </td>
        <td>
          @if ($data->status == 'show')
        <button class='btn btn-inverse-success'>Show</button>
      @else
      <button class='btn btn-inverse-danger'>Hide</button>
    @endif
        </td>
        <td>
          {{$data->created_at}}
        </td>
        <td>
          {{$data->updated_at}}
        </td>
        <td>
          <a href='{{route('admin/editportfolio', $data->id)}}' class='btn btn-inverse-info'>Edit</a>
          <a href='{{route('admin/viewportfoliogallery', $data->id)}}' class='btn btn-inverse-warning'>Gallery</a>
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