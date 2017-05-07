<!DOCTYPE html>
<html>
  <head>
     <?php echo $__env->make('admin.includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <?php echo $__env->make('admin.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <?php echo $__env->make('admin.includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <?php echo $__env->yieldContent('content'); ?>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
         <?php echo $__env->make('admin.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </footer>
      <aside class="control-sidebar control-sidebar-dark">
          <?php echo $__env->make('admin.includes.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </aside>
       <?php echo $__env->make('admin.includes.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div><!-- ./wrapper -->
  </body>
</html>
