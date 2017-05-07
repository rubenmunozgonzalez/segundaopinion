<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.status-index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.status-index-title')); ?>

                <?php echo link_to_route(
                                    $setting->grab('admin_route').'.status.create',
                                    trans('ticketit::admin.btn-create-new-status'), null,
                                    ['class' => 'btn btn-primary pull-right']); ?>

            </h2>
        </div>

        <?php if($statuses->isEmpty()): ?>
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.status-index-no-statuses')); ?>

                <?php echo link_to_route($setting->grab('admin_route').'.status.create', trans('ticketit::admin.status-index-create-new')); ?>

            </h3>
        <?php else: ?>
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td><?php echo e(trans('ticketit::admin.table-id')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-name')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-action')); ?></td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($statuses as $status): ?>
                    <tr>
                        <td style="vertical-align: middle">
                            <?php echo e($status->id); ?>

                        </td>
                        <td style="color: <?php echo e($status->color); ?>; vertical-align: middle">
                            <?php echo e($status->name); ?>

                        </td>
                        <td>
                            <?php echo link_to_route(
                                                    $setting->grab('admin_route').'.status.edit', trans('ticketit::admin.btn-edit'), $status->id,
                                                    ['class' => 'btn btn-info'] ); ?>


                                <?php echo link_to_route(
                                                    $setting->grab('admin_route').'.status.destroy', trans('ticketit::admin.btn-delete'), $status->id,
                                                    [
                                                    'class' => 'btn btn-danger deleteit',
                                                    'form' => "delete-$status->id",
                                                    "node" => $status->name
                                                    ]); ?>

                            <?php echo CollectiveForm::open([
                                            'method' => 'DELETE',
                                            'route' => [
                                                        $setting->grab('admin_route').'.status.destroy',
                                                        $status->id
                                                        ],
                                            'id' => "delete-$status->id"
                                            ]); ?>

                            <?php echo CollectiveForm::close(); ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        $( ".deleteit" ).click(function( event ) {
            event.preventDefault();
            if (confirm("<?php echo trans('ticketit::admin.status-index-js-delete'); ?>" + $(this).attr("node") + " ?"))
            {
                $form = $(this).attr("form");
                $("#" + $form).submit();
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>