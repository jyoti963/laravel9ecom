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
                        <a class="btn btn-success btn-sm rounded-pill" href="{{route('admin.category.add')}}">Add Category</a>
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
                                <th>Name</th>
                                <th>Description</th>
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
                            @foreach ($categories as $category)
                            @if(isset($category['parentCategory']['category_name']) && !empty($category['parentCategory']['category_name']))
                                @php
                                    $parent_category = $category['parentCategory']['category_name'];
                                @endphp
                            @else
                                 @php
                                 $parent_category = 'Root';
                                 @endphp
                            @endif
                            <tr>
                                <td>{{ $category['id'] }}</td>
                                <td>{{ $category['category_name	'] }}</td>
                                <td>{{ $category['description'] }}</td>
                                <td>{{ $parent_category }}</td>
                                <td>{{ $category['section']['name'] }}</td>
                                <td>{{ $category['url'] }}</td>
                                <td>{{ $category['category_discount'] }}</td>
                                <td>{{ $category['meta_title'] }}</td>
                                <td>{{ $category['meta_description'] }}</td>
                                <td>{{ $category['meta_keywords'] }}</td>
                                <td><img src="{{ url("admin/photo/". $category['image'])}}" alt="Image" srcset="" style="height:200px; weight:200px;"></td>
                                <td>
                                    @if($section['status'] == "1")
                                        <a href="{{route('admin.category.updateStatus', ['id' => $category['id']])}}" class="btn btn-outline-info btn-sm rounded-pill">
                                            Active
                                        </a>
                                        @else
                                        <a href="{{route('admin.category.updateStatus', ['id' => $category['id']])}}" class="btn btn-outline-danger btn-sm rounded-pill">
                                            Inactive
                                        </a>
                                        @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.category.edit',['id' => $category['id']]) }}" class="badge bg-primary btn-sm rounded-pill">Edit</i></a>
                                    <a href="javascript:void(0)" class="badge bg-danger btn-sm rounded-pill confirmDelete" module="category" moduleid="{{ $category['id'] }}">Delete</i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>
</div>
@endsection
