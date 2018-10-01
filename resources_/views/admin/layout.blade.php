<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Basic page needs -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') - Admin Panel</title>
        <!-- fevicon -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('admin.components.head')        
    </head>
    @include('admin.components.header')
    <div class="admin-main-wrapper">
        @include('admin.components.sidebar')
	    @yield('content')
    </div>
</html>
	