<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ url('admin/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ url('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('admin/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('admin/vendors/fontawesome/all.min.css') }}">
    {{--  datatables  --}}
    <link rel="stylesheet" href="{{ url('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/dataTables.bootstrap5.min.css') }}">
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
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{--  Admin Custom Js File  --}}
    <script src="{{ url('admin/js/custom.js') }}"></script>

</body>
@yield('scripts')
</html>
