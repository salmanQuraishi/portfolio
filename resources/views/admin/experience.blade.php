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
                            {{ isset($experience) ? 'Edit Experience' : 'Add Experience' }}
                        </h4>

                        <form class="forms-sample row" action="{{ isset($experience) ? route('admin/updateexperience', $experience->id) : route('admin/insertexperience') }}" method="POST">
                            @csrf
                            @if (isset($experience)) 
                                @method('PUT') <!-- Use PUT for updates -->
                            @endif
                            
                            <div class="form-group col-md-12">
                                <label for="Title">Title</label>
                                <input type="text" class="form-control" name="title" id="Title" placeholder="Title" value="{{ old('title', $experience->title ?? '') }}">
                                <span class="text-danger">
                                    @error('title') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Company">Company</label>
                                <input type="text" class="form-control" name="company" id="Company" placeholder="Company" value="{{ old('company', $experience->company ?? '') }}">
                                <span class="text-danger">
                                    @error('company') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Year">Year</label>
                                <input type="text" class="form-control" name="year" id="Year" placeholder="Year" value="{{ old('year', $experience->year ?? '') }}">
                                <span class="text-danger">
                                    @error('year') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampl">Status</label>
                                <select name="status" id="exampl" class="form-control form-control-sm">
                                    <option value="show" {{ (old('status', $experience->status ?? '') == 'show') ? 'selected' : '' }}>Show</option>
                                    <option value="hide" {{ (old('status', $experience->status ?? '') == 'hide') ? 'selected' : '' }}>Hide</option>
                                </select>
                                <span class="text-danger">
                                    @error('status') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-primary me-2">
                                    {{ isset($experience) ? 'Update' : 'Submit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
