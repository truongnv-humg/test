<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ ASSET_HOST . '/plugins/css/bootstrap.min.css' }}">

    <script src="{{ ASSET_HOST . "/js/app.js" }}" defer></script>
    <script src="{{ ASSET_HOST . '/plugins/js/jquery-3.4.1.min.js' }}"></script>
    <script src="{{ ASSET_HOST . '/plugins/js/bootstrap.min.js' }}"></script>
    @yield("styles")
    <title>Admin</title>
</head>
<body>
<div  id="app">
    @yield('body')
</div>

</body>
@yield("scripts")
<script src="{{ ASSET_HOST. '/plugins/js/notify.js' }}"></script>
</html>
