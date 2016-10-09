<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TiepPt - TiepPt's Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/brick-by-brick.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">

    <!-- Custom CSS -->
    <link href="{{ asset('theme/css/clean-blog.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <script>
        var BASE_URL = '{{ url('/') }}';
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    @include('theme.header')

    @yield('content')

    @include('theme.footer')

    <!-- jQuery -->
    <script src="{{ asset('theme/js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('theme/js/clean-blog.js') }}"></script>
    <script src="{{ asset('theme/js/brick-by-brick.min.js') }}"></script>

    @yield('footer')
</body>
</html>
