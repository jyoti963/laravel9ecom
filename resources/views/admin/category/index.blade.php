@extends('admin.layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Catalogue Management</h3>
                <h5>Categories</h5>
                <p class="text-subtitle text-muted">For admin to check the list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <a class="btn btn-success btn-sm rounded-pill" href="{{url('admin/add-edit-category')}}">Add Category</a>
                </nav>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
    <div class="alert alert-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
    </div>
    @endif
    @if(Session::has('msg'))
    <div class="alert alert-success"><i class="bi bi-check-circle"></i>{{ Session::get('msg') }}
    </div>
    @endif
    @if(Session::has('delete'))
    <div class="alert alert-danger"><i class="bi bi-file-excel"></i>{{ Session::get('delete') }}
    </div>
    @endif
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Parent Category</th>
                                <th>Section</th>
                                <th>URL</th>
                                <th>Discount</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th>Meta Keywords</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  <?php $number = 1; ?>  --}}
                            @foreach ($categories as $category)
                            @if(isset($category['parent_category']['category_name']) && !empty($category['parent_category']['category_name']))
                                @php
                                    $parent_category = $category['parent_category']['category_name'];
                                @endphp
                            @else
                                 @php
                                 $parent_category = 'Root';
                                 @endphp
                            @endif
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $category['category_name'] }}</td>
                                <td>{{ $parent_category }}</td>
                                <td>{{ $category['section']['name'] }}</td>
                                <td>
                                    <a href="#">{{ $category['url'] }}</a>
                                </td>
                                <td>{{ $category['category_discount'] }}</td>
                                <td>{{ $category['meta_title'] }}</td>
                                <td>{{ $category['meta_description'] }}</td>
                                <td>{{ $category['meta_keywords'] }}</td>
                                <td><img src="{{ url("admin/image/category_image/". $category['category_image'])}}" alt="Image" srcset="" style="height:100px; weight:100px;"></td>
                                <td>
                                    @if($category['status'] == "1")
                                <div class="form-check form-switch">
                                    <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" >
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" status="Active " checked>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>

                                    </a>
                                </div>
                                    @elseif ($category['status'] == "0")
                                    <div class="form-check form-switch">
                                    <a  href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" >
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" status="Inactive">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Inactive</label>
                                    </a>
                                </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/add-edit-category',['id' => $category['id']]) }}"><i class="bi-solid bi-pencil-square" style="color: blue;"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="category" moduleid="{{ $category['id'] }}"><i class="bi-solid bi-trash-fill" style="color: red;"></i></a>
                                </td>
                            </tr>
                            {{--  <?php $number++; ?>  --}}
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>
</div>
@endsection
