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
                            {{ isset($category) ? 'Edit Portfolio Category' : 'Add Portfolio Category' }}
                        </h4>

                        <form class="forms-sample" action="{{ isset($category) ? route('admin/updateportfoliocategory', $category->id) : route('admin/insertportfoliocategory') }}" method="POST">
                            @csrf
                            @if (isset($category)) 
                                @method('PUT') <!-- Use PUT for updates -->
                            @endif
                            
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <input type="text" class="form-control" name="title" id="Title" placeholder="Title" value="{{ old('title', $category->title ?? '') }}">
                                <span class="text-danger">
                                    @error('title') {{ $message }} @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="exampl">Status</label>
                                <select name="status" id="exampl" class="form-control form-control-sm">
                                    <option value="show" {{ (old('status', $category->status ?? '') == 'show') ? 'selected' : '' }}>Show</option>
                                    <option value="hide" {{ (old('status', $category->status ?? '') == 'hide') ? 'selected' : '' }}>Hide</option>
                                </select>
                                <span class="text-danger">
                                    @error('status') {{ $message }} @enderror
                                </span>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary me-2">
                                {{ isset($category) ? 'Update' : 'Submit' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Portfolio Categories</h4>
                        <div class="table-responsive">
                            <table id="example" class="table table-dark table-hover tablesorter" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th>Update Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($portfoliocategory as $data)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>
                                                @if ($data->status == 'show')
                                                    <button class="btn btn-inverse-success">Show</button>
                                                @else
                                                    <button class="btn btn-inverse-danger">Hide</button>
                                                @endif
                                            </td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>{{ $data->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin/editportfoliocategory', $data->id) }}" class="btn btn-inverse-info">Edit</a>
                                                <!-- Add delete option if needed -->
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
