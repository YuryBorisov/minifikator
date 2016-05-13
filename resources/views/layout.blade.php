<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery-2.0.0.min.js') }}"></script>
    @yield('js')
</head>
<body>
<div class="header">
    <div class="container-header">
        <div class="container-link"><a href="/">Minifikator</a></div>
    </div>
</div>
<div class="content">
    @yield('content')
</div>
</body>
</html>