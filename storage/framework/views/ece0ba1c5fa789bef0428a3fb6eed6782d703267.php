<div class="panel panel-default">
    <div class="panel-body">
        <div class="content">
            <h2 class="header">
                <?php echo e($ticket->subject); ?>

                <span class="pull-right">
                    <?php if(! $ticket->completed_at && $close_perm == 'yes'): ?>
                            <?php echo link_to_route($setting->grab('main_route').'.complete', trans('ticketit::lang.btn-mark-complete'), $ticket->id,
                                                ['class' => 'btn btn-success']); ?>

                    <?php elseif($ticket->completed_at && $reopen_perm == 'yes'): ?>
                            <?php echo link_to_route($setting->grab('main_route').'.reopen', trans('ticketit::lang.reopen-ticket'), $ticket->id,
                                                ['class' => 'btn btn-success']); ?>

                    <?php endif; ?>
                    <?php if($u->isAgent() || $u->isAdmin()): ?>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-modal">
                            <?php echo e(trans('ticketit::lang.btn-edit')); ?>

                        </button>
                    <?php endif; ?>
                    <?php if($u->isAdmin()): ?>
                        <?php if($setting->grab('delete_modal_type') == 'builtin'): ?>
                            <?php echo link_to_route(
                                            $setting->grab('main_route').'.destroy', trans('ticketit::lang.btn-delete'), $ticket->id,
                                            [
                                            'class' => 'btn btn-danger deleteit',
                                            'form' => "delete-ticket-$ticket->id",
                                            "node" => $ticket->subject
                                            ]); ?>

                        <?php elseif($setting->grab('delete_modal_type') == 'modal'): ?>
<?php /* // OR; Modal Window: 1/2 */ ?>
                            <?php echo CollectiveForm::open(array(
                                    'route' => array($setting->grab('main_route').'.destroy', $ticket->id),
                                    'method' => 'delete',
                                    'style' => 'display:inline'
                               )); ?>

                            <button type="button"
                                    class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="<?php echo trans('ticketit::lang.show-ticket-modal-delete-title', ['id' => $ticket->id]); ?>"
                                    data-message="<?php echo trans('ticketit::lang.show-ticket-modal-delete-message', ['subject' => $ticket->subject]); ?>"
                             >
                              <?php echo e(trans('ticketit::lang.btn-delete')); ?>

                            </button>
                        <?php endif; ?>
                            <?php echo CollectiveForm::close(); ?>

<?php /* // END Modal Window: 1/2 */ ?>
                    <?php endif; ?>
                </span>
            </h2>
            <div class="panel well well-sm">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p> <strong><?php echo e(trans('ticketit::lang.owner')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?><?php echo e($ticket->user->name); ?></p>
                            <p>
                                <strong><?php echo e(trans('ticketit::lang.status')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?>

                                <?php if( $ticket->isComplete() && ! $setting->grab('default_close_status_id') ): ?>
                                    <span style="color: blue">Complete</span>
                                <?php else: ?>
                                    <span style="color: <?php echo e($ticket->status->color); ?>"><?php echo e($ticket->status->name); ?></span>
                                <?php endif; ?>

                            </p>
                            <p>
                                <strong><?php echo e(trans('ticketit::lang.priority')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?>

                                <span style="color: <?php echo e($ticket->priority->color); ?>">
                                    <?php echo e($ticket->priority->name); ?>

                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p> <strong><?php echo e(trans('ticketit::lang.responsible')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?><?php echo e($ticket->agent->name); ?></p>
                            <p>
                                <strong><?php echo e(trans('ticketit::lang.category')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?>

                                <span style="color: <?php echo e($ticket->category->color); ?>">
                                    <?php echo e($ticket->category->name); ?>

                                </span>
                            </p>
                            <p> <strong><?php echo e(trans('ticketit::lang.created')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?><?php echo e($ticket->created_at->diffForHumans()); ?></p>
                            <p> <strong><?php echo e(trans('ticketit::lang.last-update')); ?></strong><?php echo e(trans('ticketit::lang.colon')); ?><?php echo e($ticket->updated_at->diffForHumans()); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3><?php echo trans('ticketit::lang.create-ticket-brief-issue'); ?></h3>
                <p> <?php echo $ticket->html; ?> </p>
                <h3><?php echo trans('¿Qué le ocurre?'); ?></h3>
                <p> <?php echo $ticket->symptoms; ?> </p>
                <h3><?php echo trans('¿Desde cuando le ocurre?'); ?></h3>
                <p> <?php echo $ticket->since; ?> </p>
                <h3><?php echo trans('¿Cómo comenzó:?'); ?></h3>
                <p> <?php echo $ticket->cause; ?> </p>
                <h3><?php echo trans('¿A qué lo atribuye?'); ?></h3>
                <p> <?php echo $ticket->reason; ?> </p>
                <h3><?php echo trans('¿En qué circunstancias se agrava o se reduce?'); ?></h3>
                <p> <?php echo $ticket->trigger; ?> </p>
                <h3><?php echo trans('¿Qué intensidad tiene?'); ?></h3>
                <p> <?php echo $ticket->intensity; ?> </p>
                <h3><?php echo trans('¿Qué repercusión tiene sobre su vida?'); ?></h3>
                <p> <?php echo $ticket->consequences; ?> </p>
                <h3><?php echo trans('¿Ha consultado con algún especialista por este problema?'); ?></h3>
                <p> <?php echo $ticket->reported; ?> </p>
                <h3><?php echo trans('¿Qué pruebas le han hecho?'); ?></h3>
                <p> <?php echo $ticket->tests; ?> </p>
                <h3><?php echo trans('¿Qué diagnósticos le han dado?'); ?></h3>
                <p> <?php echo $ticket->diagnostic; ?> </p>
                <h3><?php echo trans('¿Qué tratamientos ha recibido para este problema?'); ?></h3>
                <p> <?php echo $ticket->treatments; ?> </p>
                <h3><?php echo trans('Adjuntar los informes que tenga tanto de pruebas de imagen como de consultas'); ?></h3>
                <p> <?php echo $ticket->attachments; ?> </p>                
                <h3><?php echo trans('¿Qué resultados ha tenido con estos tratamientos?'); ?></h3>
                <p> <?php echo $ticket->results; ?> </p>
                <h3><?php echo trans('¿Qué otros tratamientos le han sugerido para su problema?'); ?></h3>
                <p> <?php echo $ticket->suggested; ?> </p>
            </div>
        </div>
        <?php echo CollectiveForm::open([
                        'method' => 'DELETE',
                        'route' => [
                                    $setting->grab('main_route').'.destroy',
                                    $ticket->id
                                    ],
                        'id' => "delete-ticket-$ticket->id"
                        ]); ?>

        <?php echo CollectiveForm::close(); ?>

    </div>
</div>

    <?php if($u->isAgent() || $u->isAdmin()): ?>
        <?php echo $__env->make('ticketit::tickets.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

<?php /* // OR; Modal Window: 2/2 */ ?>
    <?php if($u->isAdmin()): ?>
        <?php echo $__env->make('ticketit::tickets.partials.modal-delete-confirm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php /* // END Modal Window: 2/2 */ ?>
