<?php $__env->startSection('page'); ?>
    <?php echo e(trans('ticketit::lang.index-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('ticketit::tickets.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/505bef35b56/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="//cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
	<script>
	    $('.table').DataTable({
	        processing: false,
	        serverSide: true,
	        responsive: true,
        	lengthMenu: <?php echo e(json_encode($setting->grab('length_menu'))); ?>,
	        ajax: '<?php echo route($setting->grab('main_route').'.data', $complete); ?>',
	        language: {
				decimal:        "<?php echo e(trans('ticketit::lang.table-decimal')); ?>",
				emptyTable:     "<?php echo e(trans('ticketit::lang.table-empty')); ?>",
				info:           "<?php echo e(trans('ticketit::lang.table-info')); ?>",
				infoEmpty:      "<?php echo e(trans('ticketit::lang.table-info-empty')); ?>",
				infoFiltered:   "<?php echo e(trans('ticketit::lang.table-info-filtered')); ?>",
				infoPostFix:    "<?php echo e(trans('ticketit::lang.table-info-postfix')); ?>",
				thousands:      "<?php echo e(trans('ticketit::lang.table-thousands')); ?>",
				lengthMenu:     "<?php echo e(trans('ticketit::lang.table-length-menu')); ?>",
				loadingRecords: "<?php echo e(trans('ticketit::lang.table-loading-results')); ?>",
				processing:     "<?php echo e(trans('ticketit::lang.table-processing')); ?>",
				search:         "<?php echo e(trans('ticketit::lang.table-search')); ?>",
				zeroRecords:    "<?php echo e(trans('ticketit::lang.table-zero-records')); ?>",
				paginate: {
					first:      "<?php echo e(trans('ticketit::lang.table-paginate-first')); ?>",
					last:       "<?php echo e(trans('ticketit::lang.table-paginate-last')); ?>",
					next:       "<?php echo e(trans('ticketit::lang.table-paginate-next')); ?>",
					previous:   "<?php echo e(trans('ticketit::lang.table-paginate-prev')); ?>"
				},
				aria: {
					sortAscending:  "<?php echo e(trans('ticketit::lang.table-aria-sort-asc')); ?>",
					sortDescending: "<?php echo e(trans('ticketit::lang.table-aria-sort-desc')); ?>"
				},
			},
	        columns: [
	            { data: 'id', name: 'ticketit.id' },
	            { data: 'subject', name: 'subject' },
	            { data: 'status', name: 'ticketit_statuses.name' },
	            { data: 'updated_at', name: 'ticketit.updated_at' },
            	{ data: 'agent', name: 'users.name' },
	            <?php if( $u->isAgent() || $u->isAdmin() ): ?>
		            { data: 'priority', name: 'ticketit_priorities.name' },
	            	{ data: 'owner', name: 'users.name' },
		            { data: 'category', name: 'ticketit_categories.name' }
	            <?php endif; ?>
	        ]
	    });
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>