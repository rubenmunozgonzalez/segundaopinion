<table class="table table-condensed table-stripe ddt-responsive" class="ticketit-table">
    <thead>
        <tr>
            <td><?php echo e(trans('ticketit::lang.table-id')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-subject')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-status')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-last-updated')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-agent')); ?></td>
          <?php if( $u->isAgent() || $u->isAdmin() ): ?>
            <td><?php echo e(trans('ticketit::lang.table-priority')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-owner')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-category')); ?></td>
          <?php endif; ?>
        </tr>
    </thead>
</table>