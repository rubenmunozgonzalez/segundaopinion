<?php $__env->startSection('page', trans('ticketit::lang.show-ticket-title') . trans('ticketit::lang.colon') . $ticket->subject); ?>
<?php $__env->startSection('content'); ?>
        <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('ticketit::tickets.partials.ticket_body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <br>
        <h2><?php echo e(trans('ticketit::lang.comments')); ?></h2>
        <?php echo $__env->make('ticketit::tickets.partials.comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $comments->render(); ?>

        <?php if($ticket->status->name != 'Completa'): ?>
            <?php echo $__env->make('ticketit::tickets.partials.comment_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if($ticket->status->name == 'Pendiente de pago'): ?>
            <div id="payment_modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" data-keyboard="false">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Consulta no pagada</h4>
                    </div>
                    <?php echo CollectiveForm::open([
                            'route'=> 'payment',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files' => false
                            ]); ?>

                    <div class="modal-body">
                      <p>Su consulta se encuentra en estado <span style="color: <?php echo e($ticket->status->color); ?>"><?php echo e($ticket->status->name); ?></span></p>
                      <p>Por favor seleccione un medio de pago y pulse en <b>Pagar</b></p>


                            <div class="form-group">
                                <?php echo CollectiveForm::label('method', trans('Medio') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                                <div class="col-lg-10">
                                    <?php echo CollectiveForm::select('reported', ['Paypal', 'Tarjeta de crédito'], null, ['class' => 'form-control']); ?>

                                    <!--<span class="help-block"><?php echo trans('¿Ha consultado con algún especialista por este problema?'); ?></span>-->
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                     <?php echo CollectiveForm::close(); ?> 
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <?php elseif($ticket->status->name == 'Completa'): ?>
            <div id="reopen_modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" data-keyboard="false">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Consulta completada</h4>
                    </div>
                    <?php echo CollectiveForm::open([
                            'route'=> 'payment',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files' => false
                            ]); ?>

                    <div class="modal-body">
                      <p>Su consulta se encuentra en estado <span style="color: <?php echo e($ticket->status->color); ?>"><?php echo e($ticket->status->name); ?></span></p>
                      <p>Si desea reabrirla,  seleccione un medio de pago y pulse en <b>Pagar</b></p>


                            <div class="form-group">
                                <?php echo CollectiveForm::label('method', trans('Medio') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                                <div class="col-lg-10">
                                    <?php echo CollectiveForm::select('reported', ['Paypal', 'Tarjeta de crédito'], null, ['class' => 'form-control']); ?>

                                    <!--<span class="help-block"><?php echo trans('¿Ha consultado con algún especialista por este problema?'); ?></span>-->
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                     <?php echo CollectiveForm::close(); ?> 
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <?php endif; ?>
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
            
            if ("<?php echo $ticket->status->name; ?>" == "Pendiente de pago") {
                $('#payment_modal').modal('show');
            }
            
            if ("<?php echo $ticket->status->name; ?>" == "Completa") {
                $('#reopen_modal').modal('show');
            }
        });
        
        
            
    </script>
    <?php echo $__env->make('ticketit::tickets.partials.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>