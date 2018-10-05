<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('admin.components.head')        
    </head>
    <div class="admin-modal-wrapper">
	    @yield('content')
    </div>
</html>
	