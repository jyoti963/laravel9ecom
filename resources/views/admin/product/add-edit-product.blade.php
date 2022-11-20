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
                <form class="form form-vertical" @if(empty($product['id']))action="{{url('admin/add-edit-product') }}"@else
                action="{{url('admin/add-edit-product/'.$product['id']) }}"
                @endif  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Select Category</label>
                                    <div class="position-relative">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $section)
                                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                                @foreach ($section['categories'] as $category)
                                                   <option value="{{ $category['category_name'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&rAarr;{{ $category['category_name'] }}</option>
                                                   @foreach ($category['subcategories'] as $subcategory)
                                                     <option value="{{ $subcategory['category_name'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&rarr;{{ $subcategory['category_name'] }}</option>
                                                   @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Select Brand</label>
                                    <div class="position-relative">
                                        <select name="brand_id" id="brand_id" class="form-control">
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                               <option value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" @if(!empty($product['product_name']))
                                           value="{{ $product['product_name'] }}"@else value="{{ old('product_name') }}"
                                        @endif>
                                        @error('product_name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Code</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Product Code" name="product_code"  @if(!empty($product['product_code']))
                                        value="{{ $product['product_code'] }}"@else value="{{ old('product_code') }}"
                                     @endif>
                                        @error('product_code')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Color</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Product Color" name="product_color" @if(!empty($product['product_color']))
                                        value="{{ $product['product_color'] }}"@else value="{{ old('product_color') }}"
                                     @endif>
                                        @error('product_color')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Price</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" @if(!empty($product['product_price']))
                                        value="{{ $product['product_price'] }}"@else value="{{ old('product_price') }}"
                                     @endif>
                                        @error('product_price')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Discount (%)</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Product Discount" name="product_discount" @if(!empty($product['product_discount']))
                                        value="{{ $product['product_discount'] }}"@else value="{{ old('product_discount') }}"
                                     @endif>
                                        @error('product_discount')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Weight</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Product Weight" name="product_weight" @if(!empty($product['product_weight']))
                                        value="{{ $product['product_weight'] }}"@else value="{{ old('product_weight') }}"
                                     @endif>
                                        @error('product_weight')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Product Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control"
                                             name="product_images">
                                        @if(!empty($product['product_image']))
                                        <a href="{{ url('admin/image/product_images'.$product['product_image']) }}">View Image</a>&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="confirmDelete" module="product-image" moduleid="{{ $product['id'] }}">Delete Image</a>

                                        @endif
                                             @error('product_images')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                   </div>
                               </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Product Video</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control"
                                             name="product_video">
                                        @if(!empty($product['product_video']))
                                        <a href="{{ url('admin/videos/product_videos'.$product['product_video']) }}">View Video</a>&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="confirmDelete" module="product-video" moduleid="{{ $product['id'] }}">Delete Video</a>

                                        @endif
                                             @error('product_videos')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                   </div>
                               </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Product Description</label>
                                    <div class="position-relative">
                                        <textarea class="form-control" placeholder="Enter Your Description" name="product_description"></textarea>
                                        @error('product_description')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Meta Title</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" @if(!empty($product['meta_title']))
                                        value="{{ $product['meta_title'] }}"@else value="{{ old('meta_title') }}"
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
                                        <input type="text" class="form-control" placeholder="Enter Meta Description" name="meta_description" @if(!empty($product['meta_description']))
                                        value="{{ $product['meta_description'] }}"@else value="{{ old('meta_description') }}"
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
                                        <input type="text" class="form-control" placeholder="Enter Meta Keywords" name="meta_keywords" @if(!empty($product['meta_keywords']))
                                        value="{{ $product['meta_keywords'] }}"@else value="{{ old('meta_keywords') }}"
                                     @endif>
                                        @error('meta_keywords')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-icon">Featured Item</label>
                                        <input type="checkbox" name="is_featured" value="Yes" @if(!empty($product['is_featured']) && $product['is_featured'] == 'Yes')
                                        checked=""
                                     @endif >
                                        @error('is_featured')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
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
