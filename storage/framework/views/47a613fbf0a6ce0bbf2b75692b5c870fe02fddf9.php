<table class="table table-condensed table-stripe ddt-responsive" class="ticketit-table">
    <thead>
        <tr>
            <td><?php echo e(trans('ticketit::lang.table-id')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-owner')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-subject')); ?></td>
            <td><?php echo e(trans('ticketit::lang.nid')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-status')); ?></td>
            <td><?php echo e(trans('ticketit::lang.table-last-updated')); ?></td>
          <?php if( $u->isAgent() || $u->isAdmin() ): ?>
            <td><?php echo e(trans('ticketit::lang.table-price')); ?></td>
          <?php endif; ?>
        </tr>
    </thead>
</table>
