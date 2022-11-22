@extends('admin.layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Catalogue Management</h3>
                <h5>Brands</h5>
                <p class="text-subtitle text-muted">For admin to check the list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <a class="btn btn-success btn-sm rounded-pill" href="{{route('admin.brand.add')}}">Add Brand</a>
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
                <table id="myTable" class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $brand['name'] }}</td>
                            <td>
                                @if($brand['status'] == "1")
                                <div class="form-check form-switch">
                                    <a href="javascript:void(0)" class="updatebrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" >
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" status="Active " checked>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>

                                    </a>
                                </div>
                                    @elseif ($brand['status'] == "0")
                                    <div class="form-check form-switch">
                                    <a  href="javascript:void(0)" class="updatebrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" >
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" status="Inactive">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Inactive</label>
                                    </a>
                                </div>
                                    @endif
                            </td>
                            <td>
                                <a href="{{route('admin.brand.edit',$brand['id']) }}"><i class="bi-solid bi-pencil-square" style="color: blue;"></a>
                                <a href="javascript:void(0)" class="confirmDelete" module="brand" moduleid="{{ $brand['id'] }}"><i class="bi-solid bi-trash-fill" style="color: red;"></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
