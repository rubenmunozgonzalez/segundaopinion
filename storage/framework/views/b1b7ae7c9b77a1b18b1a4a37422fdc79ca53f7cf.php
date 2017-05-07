<?php $__env->startSection('content'); ?>
 <section class="content-header">
          <h1>
           Amin Dashboard
            <small>it all starts here</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>