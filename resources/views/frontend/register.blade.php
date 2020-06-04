<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ ASSET_HOST . '/plugins/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ ASSET_HOST . "/js/app.js" }}" defer></script>
    <script src="{{ ASSET_HOST . '/plugins/js/jquery-3.4.1.min.js' }}"></script>
    <script src="{{ ASSET_HOST . '/plugins/js/bootstrap.min.js' }}"></script>

</head>
<body>
    <div id="app">
        <div class="container">
            <register></register>
            <financial></financial>
        </div>
    </div>
</body>
</html>
