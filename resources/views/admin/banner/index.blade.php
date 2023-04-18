@extends('admin.layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Banner Management</h3>
                    <h5>Slider Image</h5>
                    <p class="text-subtitle text-muted">For admin to check the list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <a class="btn btn-success btn-sm rounded-pill" href="{{ route('admin.addbanner') }}">Add Slider
                            Image</a>
                    </nav>
                </div>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('msg'))
            <div class="alert alert-success"><i class="bi bi-check-circle"></i>{{ Session::get('msg') }}
            </div>
        @endif
        @if (Session::has('delete'))
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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Link</th>
                                    <th>Alt</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  <?php $number = 1; ?>  --}}
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ url('front/banner_images/' . $banner['image']) }}" alt="Image"
                                                srcset="" style="height:100px; weight:100px;"></td>
                                        <td>{{ $banner['title'] }}</td>
                                        <td>{{ $banner['type'] }}</td>
                                        <td>
                                            <a href="#">{{ $banner['link'] }}</a>
                                        </td>
                                        <td>{{ $banner['alt'] }}</td>
                                        <td>
                                            @if ($banner['status'] == '1')
                                                <div class="form-check form-switch">
                                                    <a href="javascript:void(0)" class="updateBannerStatus"
                                                        id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault" status="Active " checked>
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckDefault">Active</label>

                                                    </a>
                                                </div>
                                            @elseif ($banner['status'] == '0')
                                                <div class="form-check form-switch">
                                                    <a href="javascript:void(0)" class="updateBannerStatus"
                                                        id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault" status="Inactive">
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckDefault">Inactive</label>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/edit-banner', ['id' => $banner['id']]) }}"><i
                                                    class="bi-solid bi-pencil-square" style="color: blue;"></i></a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="banner"
                                                moduleid="{{ $banner['id'] }}"><i class="bi-solid bi-trash-fill"
                                                    style="color: red;"></i></a>
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
