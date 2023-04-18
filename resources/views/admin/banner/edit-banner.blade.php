@extends('admin.layouts.master')
@section('content')
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Banners</h3>
                <h4 class="card-title">Edit Slider</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if (Session::has('delete'))
                        <div class="alert alert-danger"><i class="bi bi-file-excel"></i>{{ Session::get('delete') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success"><i class="bi bi-file-excel"></i>{{ Session::get('success') }}
                        </div>
                    @endif

                    {{--  Slider Image Modal  --}}
                    <div class="modal fade text-left" id="SliderModal" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{ url('front/banner_images/' . $banner->image) }}" alt="Image"
                                        style="height: 400px; width:470px;">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  End Slider Image Modal  --}}
                    <form class="form form-vertical" action="{{ url('admin/edit-banner/' . $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="mobile-id-icon">Slider Image</label>
                                        <div class="position-relative">
                                            <input type="file" class="form-control" name="banner_images">
                                            @if (!empty($banner->image))
                                                <div class="col-sm-6 col-md-6 mt-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#SliderModal">View Image</a>
                                                </div>
                                            @endif
                                            @error('banner_images')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Image Alternative Text</label>
                                        <div class="position-relative">
                                            <input class="form-control" placeholder="Enter Image Alternative Text"
                                                name="alt" value="{{ $banner->alt }}">

                                            @error('alt')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Type</label>
                                        <div class="position-relative">
                                            <select name="type" id="type" class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="Slider"
                                                    @if ($banner->type == 'Slider') selected='selected' @endif>Slider
                                                </option>
                                                <option value="Fix"
                                                    @if ($banner->type == 'Fix') selected='selected' @endif>Fix
                                                </option>
                                            </select>
                                            @error('type')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Title</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Enter Banner Title"
                                                name="title" value="{{ $banner->title }}">
                                            @error('title')
                                                <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Link</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Enter link here"
                                                name="link" value="{{ $banner->link }}">
                                            @error('link')
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
