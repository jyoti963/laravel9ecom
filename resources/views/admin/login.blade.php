<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('admin.login') }}"><img src="{{ url('admin/images/logo/logo.png') }}" alt="Logo"></a>
                    </div>
                    <h4 class="auth-title">Log in.</h4>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                     @if(Session::has('error_msg'))
                     <div class="alert alert-light-danger color-danger"><i
                        class="bi bi-exclamation-circle"></i>{{ Session::get('error_msg') }}
                    </div>
                     @endif
                    <form action="{{ route('admin.login') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email*">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                            <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" id="password" class="form-control " placeholder="Password*">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                            <div style="color: red;">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-black-400" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-black-300">Don't have an account? <a href="auth-register.html"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
