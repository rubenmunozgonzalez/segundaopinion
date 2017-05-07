<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.priority-index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.priority-index-title')); ?>

                <?php echo link_to_route(
                                    $setting->grab('admin_route').'.priority.create',
                                    trans('ticketit::admin.btn-create-new-priority'), null,
                                    ['class' => 'btn btn-primary pull-right']); ?>

            </h2>
        </div>

        <?php if($priorities->isEmpty()): ?>
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.priority-index-no-priorities')); ?>

                <?php echo link_to_route($setting->grab('admin_route').'.priority.create', trans('ticketit::admin.priority-index-create-new')); ?>

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
                <?php foreach($priorities as $priority): ?>
                    <tr>
                        <td style="vertical-align: middle">
                            <?php echo e($priority->id); ?>

                        </td>
                        <td style="color: <?php echo e($priority->color); ?>; vertical-align: middle">
                            <?php echo e($priority->name); ?>

                        </td>
                        <td>
                            <?php echo link_to_route(
                                                    $setting->grab('admin_route').'.priority.edit', trans('ticketit::admin.btn-edit'), $priority->id,
                                                    ['class' => 'btn btn-info'] ); ?>


                                <?php echo link_to_route(
                                                    $setting->grab('admin_route').'.priority.destroy', trans('ticketit::admin.btn-delete'), $priority->id,
                                                    [
                                                    'class' => 'btn btn-danger deleteit',
                                                    'form' => "delete-$priority->id",
                                                    "node" => $priority->name
                                                    ]); ?>

                            <?php echo CollectiveForm::open([
                                            'method' => 'DELETE',
                                            'route' => [
                                                        $setting->grab('admin_route').'.priority.destroy',
                                                        $priority->id
                                                        ],
                                            'id' => "delete-$priority->id"
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
            if (confirm("<?php echo trans('ticketit::admin.priority-index-js-delete'); ?>" + $(this).attr("node") + " ?"))
            {
                $form = $(this).attr("form");
                $("#" + $form).submit();
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>