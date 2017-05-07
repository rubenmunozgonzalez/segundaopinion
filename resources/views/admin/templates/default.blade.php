<!DOCTYPE html>
<html>
  <head>
     @include('admin.includes.head')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        @include('admin.includes.header')
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        @include('admin.includes.sidebar')
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         @yield('content')
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
         @include('admin.includes.footer')
      </footer>
      <aside class="control-sidebar control-sidebar-dark">
          @include('admin.includes.aside')
      </aside>
       @include('admin.includes.foot')
    </div><!-- ./wrapper -->
  </body>
</html>
