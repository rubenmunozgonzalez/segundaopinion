<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::admin.category-index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.category-index-title')); ?>

                <?php echo link_to_route(
                                    $setting->grab('admin_route').'.category.create',
                                    trans('ticketit::admin.btn-create-new-category'), null,
                                    ['class' => 'btn btn-primary pull-right']); ?>

            </h2>
        </div>

        <?php if($categories->isEmpty()): ?>
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.category-index-no-categories')); ?>

                <?php echo link_to_route($setting->grab('admin_route').'.category.create', trans('ticketit::admin.category-index-create-new')); ?>

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
                <?php foreach($categories as $category): ?>
                    <tr>
                        <td style="vertical-align: middle">
                            <?php echo e($category->id); ?>

                        </td>
                        <td style="color: <?php echo e($category->color); ?>; vertical-align: middle">
                            <?php echo e($category->name); ?>

                        </td>
                        <td>
                            <?php echo link_to_route(
                                                    $setting->grab('admin_route').'.category.edit', trans('ticketit::admin.btn-edit'), $category->id,
                                                    ['class' => 'btn btn-info'] ); ?>


                                <?php echo link_to_route(
                                                    $setting->grab('admin_route').'.category.destroy', trans('ticketit::admin.btn-delete'), $category->id,
                                                    [
                                                    'class' => 'btn btn-danger deleteit',
                                                    'form' => "delete-$category->id",
                                                    "node" => $category->name
                                                    ]); ?>

                            <?php echo CollectiveForm::open([
                                            'method' => 'DELETE',
                                            'route' => [
                                                        $setting->grab('admin_route').'.category.destroy',
                                                        $category->id
                                                        ],
                                            'id' => "delete-$category->id"
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
            if (confirm("<?php echo trans('ticketit::admin.category-index-js-delete'); ?>" + $(this).attr("node") + " ?"))
            {
                var form = $(this).attr("form");
                $("#" + form).submit();
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>