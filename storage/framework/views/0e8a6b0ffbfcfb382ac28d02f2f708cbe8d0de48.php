<?php $notification_owner = unserialize($notification_owner);?>
<?php $ticket = unserialize($ticket);?>
<?php $original_ticket = unserialize($original_ticket);?>



<?php $__env->startSection('subject'); ?>
	<?php echo e(trans('ticketit::email/globals.transfer')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('link'); ?>
	<a style="background-color:<?php echo e($setting->grab('email.color_content_bg')); ?>;color:<?php echo e($setting->grab('email.color_header_bg')); ?>;display:inline-block;font-family: Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;" href="<?php echo e(route($setting->grab('main_route').'.show', $ticket->id)); ?>">
		<?php echo e(trans('ticketit::email/globals.view-ticket')); ?>

	</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo trans('ticketit::email/transfer.data', [
	    'name'          =>  $notification_owner->name,
	    'subject'       =>  $ticket->subject,
	    'status'        =>  $ticket->status->name,
	    'agent'         =>  $original_ticket->agent->name,
	    'old_category'  =>  $original_ticket->unit->name,
	    'new_category'  =>  $ticket->category->name
	]); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($email, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>