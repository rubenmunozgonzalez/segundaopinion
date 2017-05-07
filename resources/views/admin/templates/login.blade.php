<!DOCTYPE html>
<html>
    <head>
         @include('admin.includes.head')
    </head>
    <body class="login-page">
        <div class="login-box">
            <!-- Content Wrapper. Contains page content -->
                @yield('content') 
        </div>
        @include('admin.includes.foot')
    </body>
</html>