<?php $__env->startSection('page', trans('ticketit::admin.agent-create-title')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.agent-create-title')); ?></h2>
        </div>
        <?php if($users->isEmpty()): ?>
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.agent-create-no-users')); ?></h3>
        <?php else: ?>
            <?php echo CollectiveForm::open(['route'=> $setting->grab('admin_route').'.agent.store', 'method' => 'POST', 'class' => 'form-horizontal']); ?>

            <div class="panel-body">
                <?php echo e(trans('ticketit::admin.agent-create-select-user')); ?>

            </div>
            <table class="table table-hover">
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <?php echo link_to_route($setting->grab('admin_route').'.agent.index', trans('ticketit::admin.btn-back'), null, ['class' => 'btn btn-default']); ?>

                            <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']); ?>

                        </td>
                    </tr>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agents[]" type="checkbox" value="<?php echo e($user->id); ?>" <?php echo $user->ticketit_agent ? "checked" : ""; ?>> <?php echo e($user->name); ?>

                                </label>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo CollectiveForm::close(); ?>

        <?php endif; ?>
    </div>
    <?php echo $users->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>