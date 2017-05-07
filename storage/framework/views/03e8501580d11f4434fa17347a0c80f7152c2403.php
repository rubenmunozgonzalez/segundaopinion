<?php $__env->startSection('page', trans('ticketit::lang.show-ticket-title') . trans('ticketit::lang.colon') . $ticket->subject); ?>
<?php $__env->startSection('content'); ?>
        <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('ticketit::tickets.partials.ticket_body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <br>
        <h2><?php echo e(trans('ticketit::lang.comments')); ?></h2>
        <?php echo $__env->make('ticketit::tickets.partials.comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $comments->render(); ?>

        <?php echo $__env->make('ticketit::tickets.partials.comment_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script>
        $(document).ready(function() {
            $( ".deleteit" ).click(function( event ) {
                event.preventDefault();
                if (confirm("<?php echo trans('ticketit::lang.show-ticket-js-delete'); ?>" + $(this).attr("node") + " ?"))
                {
                    var form = $(this).attr("form");
                    $("#" + form).submit();
                }

            });
            $('#category_id').change(function(){
                var loadpage = "<?php echo route($setting->grab('main_route').'agentselectlist'); ?>/" + $(this).val() + "/<?php echo e($ticket->id); ?>";
                $('#agent_id').load(loadpage);
            });
            $('#confirmDelete').on('show.bs.modal', function (e) {
                $message = $(e.relatedTarget).attr('data-message');
                $(this).find('.modal-body p').text($message);
                $title = $(e.relatedTarget).attr('data-title');
                $(this).find('.modal-title').text($title);

                // Pass form reference to modal for submission on yes/ok
                var form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });

            <!-- Form confirm (yes/ok) handler, submits form -->
            $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
                $(this).data('form').submit();
            });
        });
    </script>
    <?php echo $__env->make('ticketit::tickets.partials.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>