<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ url('admin/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ url('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('admin/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('admin/vendors/fontawesome/all.min.css') }}">
</head>

<body>
    <div id="app">
       @include('admin.layouts.sidebar')
        <div id="main">
            <div class="page-heading">
                <h3>Welcome {{ Auth::guard('admin')->user()->name }}
                    <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger btn-sm rounded-pill float-end">Log out</a>
                </h3>

            </div>
           @yield('content')
        </div>
    </div>
    <script src="{{ url('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('admin/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ url('admin/js/pages/dashboard.js') }}"></script>

    <script src="{{ url('admin/js/main.js') }}"></script>
    //Admin Custom Js File

</body>
@yield('scripts')
</html>
