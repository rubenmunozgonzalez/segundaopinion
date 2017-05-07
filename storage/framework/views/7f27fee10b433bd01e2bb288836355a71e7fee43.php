<?php $comment = unserialize($comment);?>
<?php $ticket = unserialize($ticket);?>



<?php $__env->startSection('subject'); ?>
	<?php echo e(trans('ticketit::email/globals.comment')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('link'); ?>
	<a style="color:#ffffff" href="<?php echo e(route($setting->grab('main_route').'.show', $ticket->id)); ?>">
		<?php echo e(trans('ticketit::email/globals.view-ticket')); ?>

	</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo trans('ticketit::email/comment.data', [
	    'name'      =>  $comment->user->name,
	    'subject'   =>  $ticket->subject,
	    'status'    =>  $ticket->status->name,
	    'category'  =>  $ticket->category->name,
	    'comment'   =>  $comment->getShortContent()
	]); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($email, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>