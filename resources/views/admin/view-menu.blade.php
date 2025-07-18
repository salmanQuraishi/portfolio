@extends('admin.common.masterpage')
@section('content')
<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Menu</h4>
            <div class="table-responsive">
              <table id="example" class="table table-dark table-hover tablesorter" style="width:100%">
                <thead>
                  <tr>
                    <th>
                      Sr.
                    </th>
                    <th>
                        Menu name
                    </th>
                    <th>
                        Link
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
                @php $i = 1 ; @endphp
                @foreach ($menu as $menus) 
                    <tr>
                        <td>
                            {{$i++}}
                        </td>
                        <td>
                            {{$menus->menu_name}}
                        </td>
                        <td>
                            {{$menus->menu_link}}
                        </td>
                        <td>
                            @if ($menus->menu_status == 'show')
                                <button class='btn btn-inverse-success'>Show</button>
                            @else
                                <button class='btn btn-inverse-danger'>Hide</button>
                            @endif
                        </td>
                        <td>
                          {{$menus->created_at}}
                        </td>
                        <td>
                          {{$menus->updated_at}}
                        </td>
                        <td>
                            <a href='{{route('admin/editmenu',$menus->id)}}' class='btn btn-inverse-info'>Edit</a>
                            <a href='{{route('admin/deletemenu',$menus->id)}}' onclick="return confirm('Are you sure you want to delete this sub menu?');" class='btn btn-inverse-danger'>Delete</a>
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