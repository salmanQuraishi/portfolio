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
                            {{ isset($education) ? 'Edit Education' : 'Add Education' }}
                        </h4>

                        <form class="forms-sample row" action="{{ isset($education) ? route('admin/updateeducation', $education->id) : route('admin/inserteducation') }}" method="POST">
                            @csrf
                            @if (isset($education)) 
                                @method('PUT') <!-- Use PUT for updates -->
                            @endif
                            
                            <div class="form-group col-md-12">
                                <label for="Title">Title</label>
                                <input type="text" class="form-control" name="title" id="Title" placeholder="Title" value="{{ old('title', $education->title ?? '') }}">
                                <span class="text-danger">
                                    @error('title') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="University">University</label>
                                <input type="text" class="form-control" name="university" id="University" placeholder="University" value="{{ old('university', $education->university ?? '') }}">
                                <span class="text-danger">
                                    @error('university') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Year">Year</label>
                                <input type="text" class="form-control" name="year" id="Year" placeholder="Year" value="{{ old('year', $education->year ?? '') }}">
                                <span class="text-danger">
                                    @error('year') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampl">Status</label>
                                <select name="status" id="exampl" class="form-control form-control-sm">
                                    <option value="show" {{ (old('status', $education->status ?? '') == 'show') ? 'selected' : '' }}>Show</option>
                                    <option value="hide" {{ (old('status', $education->status ?? '') == 'hide') ? 'selected' : '' }}>Hide</option>
                                </select>
                                <span class="text-danger">
                                    @error('status') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-primary me-2">
                                    {{ isset($education) ? 'Update' : 'Submit' }}
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
