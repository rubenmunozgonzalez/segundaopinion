<?php $__env->startSection('content'); ?>
<?php echo $__env->make('ticketit::index', ['complete' => "false"], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>