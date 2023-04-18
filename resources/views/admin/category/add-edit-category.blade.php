@extends('admin.layouts.master')
@section('content')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h3>Categories</h3>
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(Session::has('delete'))
                <div class="alert alert-danger"><i class="bi bi-file-excel"></i>{{ Session::get('delete') }}
                </div>
                @endif

                 {{--  Category Image Modal  --}}
                <div class="modal fade text-left" id="categoryModal" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{ url('admin/image/category_image/'.$category['category_image']) }}" alt="Image" style="height: 400px; width:470px;" >
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  End Category Image Modal  --}}

                <form class="form form-vertical" @if(empty($category['id']))action="{{url('admin/add-edit-category') }}"@else
                action="{{url('admin/add-edit-category/'.$category['id']) }}"
                @endif  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" @if(!empty($category['category_name']))
                                           value="{{ $category['category_name'] }}"@else value="{{ old('category_name') }}"
                                        @endif>
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
                                        <input type="text" class="form-control" placeholder="Enter Category Discount" name="category_discount"  @if(!empty($category['category_discount']))
                                        value="{{ $category['category_discount'] }}"@else value="{{ old('category_discount') }}"
                                     @endif>
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
                                        <input type="text" class="form-control" placeholder="Enter Category URL" name="url" @if(!empty($category['url']))
                                        value="{{ $category['url'] }}"@else value="{{ old('url') }}"
                                     @endif>
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
                                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" @if(!empty($category['meta_title']))
                                        value="{{ $category['meta_title'] }}"@else value="{{ old('meta_title') }}"
                                     @endif>
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
                                        <input type="text" class="form-control" placeholder="Enter Meta Description" name="meta_description" @if(!empty($category['meta_description']))
                                        value="{{ $category['meta_description'] }}"@else value="{{ old('meta_description') }}"
                                     @endif>
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
                                        <input type="text" class="form-control" placeholder="Enter Meta Keywords" name="meta_keywords" @if(!empty($category['meta_keywords']))
                                        value="{{ $category['meta_keywords'] }}"@else value="{{ old('meta_keywords') }}"
                                     @endif>
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
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option value="">Select Section</option>
                                            @foreach ($getSections as $section)
                                            <option value="{{ $section['id'] }}" @if(!empty($category['section_id']) && $category['section_id'] === $section['id'])
                                            selected
                                         @endif>{{ $section['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('section_id')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="appendCategoryLevel">
                                @include('admin.category.append-category-level')
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Category Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control"
                                             name="category_images">
                                        @if(!empty($category['category_image']))
                                        <div class="col-sm-6 col-md-6 mt-2">
                                            <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#categoryModal">View Image</a>
                                        </div>
                                        <a href="javascript:void(0)" class="confirmDelete" module="category-image" moduleid="{{ $category['id'] }}">Delete Image</a>
                                        @endif
                                             @error('category_images')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                   </div>
                               </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Description</label>
                                    <div class="position-relative">
                                        <textarea class="form-control" placeholder="Enter Your Description" name="description">{{ $category['description'] }}</textarea>
                                        @error('description')
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
