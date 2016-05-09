<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="HTML5 Gamehub">
    <meta name="keywords"
          content="games,html5,online,web">
    <meta name="author" content="Toni Alvarez">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page Title -->
    <title>@yield('title')</title>

    <!-- Stylesheet -->
    <link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="{{ URL::to('/') }}/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">

    <header id="header" class="header">

        @include('base.header')

    </header>

    @yield('content')

    <footer class="footer">

        @include('base.footer')

    </footer>

</div>
<!-- end wrapper -->


<!-- external javascripts -->
<script src="{{ URL::to('/') }}/js/jquery-2.2.0.min.js"></script>
<script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>

</body>
</html>

