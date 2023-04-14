@extends('admin.layouts.master')
@section('content')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h3>Banners</h3>
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(Session::has('delete'))
                <div class="alert alert-danger"><i class="bi bi-file-excel"></i>{{ Session::get('delete') }}
                </div>
                @endif

                <form class="form form-vertical" @if(empty($banner['id']))action="{{url('admin/add-edit-banner') }}"@else
                action="{{url('admin/add-edit-banner/'.$banner['id']) }}"

                @endif  method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Slider Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control"
                                             name="banner_images">
                                        @if(!empty($banner['banner_images']))
                                        <a target="_blank" href="{{ url('front/banner_images/'.$banner['image']) }}">View Image</a>&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="confirmDelete" module="banner-image" moduleid="{{ $banner['id'] }}">Delete Image</a>
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
                                        <input type="text" class="form-control" placeholder="Enter Image Alternative Text" name="alt"  @if(!empty($category['alt']))
                                        value="{{ $category['alt'] }}"@else value="{{ old('alt') }}"
                                     @endif>
                                        @error('alt')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Title</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Title" name="title" @if(!empty($category['title']))
                                        value="{{ $category['title'] }}"@else value="{{ old('title') }}"
                                     @endif>
                                        @error('title')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Meta Link</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Meta Link" name="link" @if(!empty($category['link']))
                                        value="{{ $category['link'] }}"@else value="{{ old('link') }}"
                                     @endif>
                                        @error('link')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">{{ $btn }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
