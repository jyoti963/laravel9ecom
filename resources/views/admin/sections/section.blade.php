@extends('admin.layouts.master')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Catalogue Management</h3>
                <h5>Sections</h5>
                <p class="text-subtitle text-muted">For admin to check the list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <a class="btn btn-success btn-sm rounded-pill" href="{{route('admin.add.section')}}">Add Section</a>
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
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section['id'] }}</td>
                            <td>{{ $section['name'] }}</td>
                            <td>
                                @if($section['status'] == "1")
                                    <a href="{{route('admin.section.updateStatus', ['id' => $section['id']])}}" class="btn btn-outline-info btn-sm rounded-pill">
                                        Active
                                    </a>
                                    @else
                                    <a href="{{route('admin.section.updateStatus', ['id' => $section['id']])}}" class="btn btn-outline-danger btn-sm rounded-pill">
                                        Inactive
                                    </a>
                                    @endif
                            </td>
                            <td>
                                <a href="{{route('admin.edit.section',['id' => $section['id']]) }}" class="badge bg-primary btn-sm rounded-pill">Edit</i></a>
                                <a href="javascript:void(0)" class="badge bg-danger btn-sm rounded-pill confirmDelete" module="section" moduleid="{{ $section['id'] }}">Delete</i></a>
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
