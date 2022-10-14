@extends('admin.layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>
                <p class="text-subtitle text-muted">For admin to check the list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
    <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
    </div>
    @endif
    @if(Session::has('msg'))
    <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>{{ Session::get('msg') }}
    </div>
    @endif
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table id="myTable" class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adminManage as $aM)
                        <tr>
                            <td>{{ $aM['id'] }}</td>
                            <td>{{ $aM['name'] }}</td>
                            <td>{{ $aM['type'] }}</td>
                            <td>{{ $aM['email'] }}</td>
                            <td>{{ $aM['mobile'] }}</td>
                            <td><img src="{{ asset('admin/photo/' . $aM['image']) }}" alt="Image" style="height: 100px; width:100px"></td>
                            <td>
                                @if($aM['status'] == "1")
                                    <a href="{{route('admin.updateStatus', ['id' => $aM['id']])}}" class="btn btn-outline-info btn-sm rounded-pill">
                                        Active
                                    </a>
                                    @else
                                    <a href="{{route('admin.updateStatus', ['id' => $aM['id']])}}" class="btn btn-outline-danger btn-sm rounded-pill">
                                        Inactive
                                    </a>
                                    @endif
                            </td>
                            <td>
                                @if($aM['type'] == "vendor")
                                    <a href="{{ url('admin/view-vendor-details/'.$aM['id']) }}" class="badge bg-secondary btn-sm rounded-pill">View</i></a>
                                @endif
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
