@extends('admin.layouts.master')
@section('content')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h3>Categories</h3>
            <h4 class="card-title">Add Categories</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admin.add.section') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name">
                                        @error('category_name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Category Discount</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Category Discount" name="category_discount">
                                        @error('category_discount')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Category URL</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Category URL" name="url">
                                        @error('url')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Meta Title</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title">
                                        @error('meta_title')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Meta Description</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Meta Description" name="meta_description">
                                        @error('meta_description')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Meta Keywords</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Meta Keywords" name="meta_keywords">
                                        @error('meta_keywords')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Section</label>
                                    <div class="position-relative">
                                        <select name="section" id="section" class="form-control">
                                            <option value="">Select Section</option>
                                            @foreach ($getSections as $section)
                                            <option value="{{ $section['id'] }}">{{ $section['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('section')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Category Level</label>
                                    <div class="position-relative">
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="0">Main Category</option>
                                        </select>
                                        @error('parent_id')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Category Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control"
                                             name="category_images">
                                   </div>
                               </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Description</label>
                                    <div class="position-relative">
                                        <textarea class="form-control" placeholder="Enter Your Description" name="description"></textarea>
                                        @error('description')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
