<?php $__env->startSection('page'); ?>
<?php echo e(trans('ticketit::admin.config-index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- configuration -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo e(trans('ticketit::admin.config-index-title')); ?>

            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <?php echo link_to_route(
                    $setting->grab('admin_route').'.configuration.index',
                    trans('ticketit::admin.btn-back'), null,
                    ['class' => 'btn btn-default']); ?>

                <?php echo link_to_route(
                    $setting->grab('admin_route').'.configuration.create',
                    trans('ticketit::admin.btn-create-new-config'), null,
                    ['class' => 'btn btn-primary']); ?>

            </div>
        </h3>
    </div>
    <?php if($configurations->isEmpty()): ?>
        <div class="well text-center"><?php echo e(trans('ticketit::admin.config-index-no-settings')); ?></div>
    <?php else: ?>
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#init-configs"><?php echo e(trans('ticketit::admin.config-index-initial')); ?></a></li>
            <li><a data-toggle="tab" href="#ticket-configs"><?php echo e(trans('ticketit::admin.config-index-tickets')); ?></a></li>
            <li><a data-toggle="tab" href="#email-configs"><?php echo e(trans('ticketit::admin.config-index-notifications')); ?></a></li>
            <li><a data-toggle="tab" href="#perms-configs"><?php echo e(trans('ticketit::admin.config-index-permissions')); ?></a></li>
            <li><a data-toggle="tab" href="#editor-configs"><?php echo e(trans('ticketit::admin.config-index-editor')); ?></a></li>
            <li><a data-toggle="tab" href="#other-configs"><?php echo e(trans('ticketit::admin.config-index-other')); ?></a></li>
        </ul>
    <br />
        <div class="tab-content">
            <div id="init-configs" class="tab-pane fade in active">
                <?php echo $__env->make('ticketit::admin.configuration.tables.init_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div id="ticket-configs" class="tab-pane fade">
                <?php echo $__env->make('ticketit::admin.configuration.tables.ticket_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div id="email-configs" class="tab-pane fade">
                <?php echo $__env->make('ticketit::admin.configuration.tables.email_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div id="perms-configs" class="tab-pane fade">
                <?php echo $__env->make('ticketit::admin.configuration.tables.perms_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div id="editor-configs" class="tab-pane fade">
                <?php echo $__env->make('ticketit::admin.configuration.tables.editor_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div id="other-configs" class="tab-pane fade">
                <?php echo $__env->make('ticketit::admin.configuration.tables.other_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php /*<?php echo $__env->make('ticketit::admin.configuration.common.paginate', ['records' => $configurations], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
</div>
<!-- // Configuration -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>