<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.user-index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.user-index-title')); ?>

                <?php echo link_to_route(
                                    $setting->grab('admin_route').'.user.create',
                                    trans('ticketit::admin.btn-create-new-user'), null,
                                    ['class' => 'btn btn-primary pull-right']); ?>

            </h2>
        </div>

        <?php if($users->isEmpty()): ?> 
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.user-index-no-agents')); ?>

                <?php echo link_to_route($setting->grab('admin_route').'.user.create', trans('ticketit::admin.user-index-create-new')); ?>

            </h3>
        <?php else: ?>
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td><?php echo e(trans('ticketit::admin.table-id')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-name')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-surnames')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-date')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-show-user')); ?></td>
                        <td><?php echo e(trans('ticketit::admin.table-remove-user')); ?></td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td>
                            <?php echo e($user->id); ?>

                        </td>
                        <td>
                            <?php echo e($user->name); ?>

                        </td>
                        <td>
                            <?php echo e($user->l_name_1); ?> <?php echo e($user->l_name_2); ?>

                        </td>
                        <td>
                            <?php echo e($user->updated_at); ?>

                        </td>
                        <td>
                            <?php echo CollectiveForm::open([
                            'method' => 'GET',
                            'route' => [
                                        $setting->grab('admin_route').'.user.edit',
                                        $user->id
                                        ],
                            'id' => "show-$user->id"
                            ]); ?>

                            <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-show'), ['class' => 'btn btn-info']); ?>

                            <?php echo CollectiveForm::close(); ?>

                        </td>
                        <td>
                            <?php echo CollectiveForm::open([
                            'method' => 'DELETE',
                            'route' => [
                                        $setting->grab('admin_route').'.user.destroy',
                                        $user->id
                                        ],
                            'id' => "delete-$user->id"
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