<?php $__env->startSection('page', trans('ticketit::admin.priority-create-title')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="well bs-component">
        <?php echo CollectiveForm::open(['route'=> $setting->grab('admin_route').'.priority.store', 'method' => 'POST', 'class' => 'form-horizontal']); ?>

            <legend><?php echo e(trans('ticketit::admin.priority-create-title')); ?></legend>
            <?php echo $__env->make('ticketit::admin.priority.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo CollectiveForm::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>