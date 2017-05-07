<div class="panel panel-default">

    <div class="panel-heading">
        <h2><?php echo e(trans('ticketit::lang.index-my-payments')); ?>

            <?php echo link_to_route($setting->grab('main_route').'.payments.download', trans('ticketit::lang.btn-download-payments'), null, ['class' => 'btn btn-primary pull-right']); ?>

        </h2>
    </div>

    <div class="panel-body">
        <div id="message"></div>

        <?php echo $__env->make('ticketit::admin.payment.partials.datatable', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

</div>
