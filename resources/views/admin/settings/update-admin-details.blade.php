@extends('admin.layouts.master')
@section('content')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Admin Details</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-light-success color-success"><i
                   class="bi bi-check-circle"></i>{{ Session::get('success') }}
               </div>
                @endif
                <form class="form form-vertical" action="{{ route('update.admin.details') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Admin Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Input with icon left"
                                            id="first-name-icon" value="{{ Auth::guard('admin')->user()->email }}" name="email">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Type</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Enter your Type" value="{{ Auth::guard('admin')->user()->type }}" name="type">
                                        <div class="form-control-icon">
                                            <i class="bi bi-align-center"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Enter Your Name" value="{{ Auth::guard('admin')->user()->name }}" name="name">
                                            @error('name')
                                            <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Mobile</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Enter Your Mobile number" value="{{ Auth::guard('admin')->user()->mobile }}" name="mobile" maxlength="10" minlength="10">
                                            @error('mobile')
                                            <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control"
                                             name="image">
                                        <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image}}">

                                            {{--  @error(image')
                                            <div style="color: red;">{{ $message }}</div>
                                            @enderror  --}}
                                        <div class="form-control-icon">
                                            <i class="bi bi-image"></i>
                                        </div>

                                    </div>
                                    @if(Auth::guard('admin')->user()->image)
                                        {{--  <a target="_blank" href="{{ url( "admin/photo/".Auth::guard('admin')->user()->image) }}" class="btn btn-info rounded-pill btn-sm">View Image</a>  --}}
                                        <img src="{{ url("admin/photo/".Auth::guard('admin')->user()->image)}}" alt="Image" srcset="" style="height:200px; weight:200px;">
                                        @endif
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                    class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
