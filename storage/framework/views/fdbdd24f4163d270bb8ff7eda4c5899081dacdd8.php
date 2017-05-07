<?php $comment = unserialize($comment);?>
<?php $ticket = unserialize($ticket);?>



<?php $__env->startSection('subject'); ?>
	<?php echo e(trans('ticketit::email/globals.comment')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('link'); ?>
	<a style="background-color:<?php echo e($setting->grab('email.color_content_bg')); ?>;color:<?php echo e($setting->grab('email.color_header_bg')); ?>;display:inline-block;font-family: Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;" href="<?php echo e(route($setting->grab('main_route').'.show', $ticket->id)); ?>">
		<?php echo e(trans('ticketit::email/globals.view-ticket')); ?>

	</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo trans('ticketit::email/comment.data', [
	    'name'      =>  $comment->user->l_name_1.' '.$comment->user->l_name_2,
	    'subject'   =>  $ticket->subject,
	    'status'    =>  $ticket->status->name,
	    'category'  =>  $ticket->unit->name,
	    'comment'   =>  $comment->getShortContent()
	]); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($email, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>