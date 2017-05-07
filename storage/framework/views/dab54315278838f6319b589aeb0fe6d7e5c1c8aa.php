<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.administrator-index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.administrator-index-title')); ?>

                <?php echo link_to_route(
                                    $setting->grab('admin_route').'.administrator.create',
                                    trans('ticketit::admin.btn-create-new-administrator'), null,
                                    ['class' => 'btn btn-primary pull-right']); ?>

            </h2>
        </div>

        <?php if($administrators->isEmpty()): ?>
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.administrator-index-no-administrators')); ?>

                <?php echo link_to_route($setting->grab('admin_route').'.administrator.create', trans('ticketit::admin.administrator-index-create-new')); ?>

            </h3>
        <?php else: ?>
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <td><?php echo e(trans('ticketit::admin.table-id')); ?></td>
                    <td><?php echo e(trans('ticketit::admin.table-name')); ?></td>
                    <td><?php echo e(trans('ticketit::admin.table-remove-administrator')); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($administrators as $administrator): ?>
                    <tr>
                        <td>
                            <?php echo e($administrator->id); ?>

                        </td>
                        <td>
                            <?php echo e($administrator->name); ?>

                        </td>
                        <td>
                            <?php echo CollectiveForm::open([
                            'method' => 'DELETE',
                            'route' => [
                                        $setting->grab('admin_route').'.administrator.destroy',
                                        $administrator->id
                                        ],
                            'id' => "delete-$administrator->id"
                            ]); ?>

                            <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-remove'), ['class' => 'btn btn-danger']); ?>

                            <?php echo CollectiveForm::close(); ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>