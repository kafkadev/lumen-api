<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Control Panel | </title>

    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="{{ asset('admin/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/timeline/timeline.css') }}" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="{{ asset('admin/css/sb-admin.css') }}" rel="stylesheet">
    <script type="text/javascript">
        var ADMIN_URL = '{{ url('admin') }}';
    </script>
</head>

<body>
    <div id="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        <div id="page-wrapper">
            @yield('content')
        </div>
        @include('admin.layouts.footer')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script type="text/javascript" src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script type="text/javascript" src="{{ asset('admin/js/sb-admin.js') }}"></script>

    @yield('footer')
</body>

</html>
