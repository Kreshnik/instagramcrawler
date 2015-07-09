<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instagram Crawler @yield('title')</title>
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<div class="container">
    @yield('content')
</div>

@include('dialog.map')

<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=true"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.18/gmaps.min.js"></script>
<script src="{{ asset('app.js') }}"></script>
</body>
</html>
