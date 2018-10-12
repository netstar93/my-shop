<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    @include('head')
</head>
<body>
<div class="main">
    @include('header')
    <div class="main_content">
        @yield("middle_content")
    </div>
    {{--@include('footer') --}}
</div>
</body>
</html>