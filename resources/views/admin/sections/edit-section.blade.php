@extends('admin.layouts.master')
@section('content')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Sections</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admin.edit.section',$data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Section Name" name="section_name" value="{{ $data->name }}">
                                        @error('section_name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Status</label>
                                    <div class="position-relative">
                                        <select name="section_status" id="section_status" class="form-control" value="{{ $data->status }}">
                                            <option value="">Select Status</option>
                                            <option value="1" @if($data->status == 1)
                                                selected  @endif>Active</option>
                                            <option value="0" @if($data->status == 0)
                                                selected  @endif>Inactive</option>
                                        </select>
                                        @error('section_status')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
