<div class="modal fade" id="ticket-edit-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-modal-Label">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            <?php echo CollectiveForm::model($ticket, [
                 'route' => [$setting->grab('main_route').'.update', $ticket->id],
                 'method' => 'PATCH',
                 'class' => 'form-horizontal'
             ]); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><?php echo e(trans('ticketit::lang.flash-x')); ?></span></button>
                <h4 class="modal-title" id="ticket-edit-modal-Label"><?php echo e($ticket->subject); ?></h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="form-group col-lg-12">
                        <?php echo CollectiveForm::label('agent_id', trans('ticketit::lang.agent') . trans('ticketit::lang.colon'), [
                            'class' => 'col-lg-4 control-label'
                        ]); ?>

                        <div class="col-lg-8">
                            <?php echo CollectiveForm::select(
                                'agent_id',
                                $agent_lists,
                                $ticket->agent_id,
                                ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-12">
                        <?php echo CollectiveForm::label('category_id',  trans('ticketit::lang.unit') . trans('ticketit::lang.colon'), [
                            'class' => 'col-lg-4 control-label'
                        ]); ?>

                        <div class="col-lg-8">
                            <?php echo CollectiveForm::select('category_id', $category_lists, $ticket->unit_id, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <?php echo CollectiveForm::label('status_id', trans('ticketit::lang.status') . trans('ticketit::lang.colon'), [
                            'class' => 'col-lg-4 control-label'
                        ]); ?>

                        <div class="col-lg-8">
                            <?php echo CollectiveForm::select('status_id', $status_lists, $ticket->status_id, ['class' => 'form-control']); ?>

                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('ticketit::lang.btn-close')); ?></button>
                        <?php echo CollectiveForm::submit(trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-primary']); ?>

                    </div>
                    <?php echo CollectiveForm::close(); ?>

                </div>
            </div>
        </div>
