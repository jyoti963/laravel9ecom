@extends('admin.layouts.master')
@section('content')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Your Password</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Admin/User Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Input with icon left"
                                            id="first-name-icon" value="{{ $adminDtls['name'] }}" name="name">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Type</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Mobile" value="{{ $adminDtls['type'] }}" name="type">
                                        <div class="form-control-icon">
                                            <i class="bi bi-align-center"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Current Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control"
                                            placeholder="Enter Your Current Password" id="current_password" name="current_password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">New Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control"
                                            placeholder="Enter New Password" id="new_password" name="new_password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control"
                                            placeholder="Confirm Your Password" id="confirm-password" value="" name="confirm_password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class='form-check'>
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" id="remember-me-v"
                                            class='form-check-input' checked>
                                        <label for="remember-me-v">Remember Me</label>
                                    </div>
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
