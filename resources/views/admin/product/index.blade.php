@extends('admin.layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Catalogue Management</h3>
                <h5>Products</h5>
                <p class="text-subtitle text-muted">For admin to check the list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <a class="btn btn-success btn-sm rounded-pill" href="{{url('admin/add-edit-product')}}">Add Product</a>
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
                                <th>Product Name</th>
                                <th>Category </th>
                                <th>Section </th>
                                <th>Added By</th>
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
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ $product['category']['category_name'] }}</td>
                                <td>{{ $product['section']['name'] }}</td>
                                <td>
                                    @if($product['admin_type'] == 'vendor')
                                        <a href="{{ url('view-vendor-details/'.$product[admin_id]) }}">{{ ucfirst($product['admin_type']) }}</a>
                                    @else
                                        {{ ucfirst($product['admin_type']) }}
                                    @endif
                                </td>
                                <td>{{ $product['product_discount'] }}</td>
                                <td>{{ $product['meta_title'] }}</td>
                                <td>{{ $product['meta_description'] }}</td>
                                <td>{{ $product['meta_keywords'] }}</td>
                                <td><img src="{{ url("admin/image/product_image/". $product['product_image'])}}" alt="Image" srcset="" style="height:100px; weight:100px;"></td>
                                <td>
                                    @if($product['status'] == "1")
                                <div class="form-check form-switch">
                                    <a href="javascript:void(0)" class="updateproductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" >
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" status="Active " checked>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>

                                    </a>
                                </div>
                                    @elseif ($product['status'] == "0")
                                    <div class="form-check form-switch">
                                    <a  href="javascript:void(0)" class="updateproductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" >
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" status="Inactive">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Inactive</label>
                                    </a>
                                </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/add-edit-product',['id' => $product['id']]) }}" class="badge bg-primary btn-sm rounded-pill">Edit</i></a>
                                    <a href="javascript:void(0)" class="badge bg-danger btn-sm rounded-pill confirmDelete" module="product" moduleid="{{ $product['id'] }}">Delete</i></a>
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
