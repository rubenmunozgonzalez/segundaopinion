<?php $__env->startSection('page', trans('ticketit::admin.category-create-title')); ?>

<?php $__env->startSection('content'); ?>
    <div class="well bs-component">
        <?php echo CollectiveForm::open(['route'=> $setting->grab('admin_route').'.category.store', 'method' => 'POST', 'class' => 'form-horizontal']); ?>

            <legend><?php echo e(trans('ticketit::admin.category-create-title')); ?></legend>
            <?php echo $__env->make('ticketit::admin.category.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo CollectiveForm::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>