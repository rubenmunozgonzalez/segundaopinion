<!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/knob/jquery.knob.js') }}"></script>

    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    
    <!-- Data table -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- datepicker -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for icheck  purposes -->
    <script type="text/javascript" src="{{ URL::asset('public/assets/admin/plugins/iCheck/icheck.min.js') }}"></script>
    
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      
      $(function() {
    $( "#datepicker" ).datepicker();
  });
      
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>