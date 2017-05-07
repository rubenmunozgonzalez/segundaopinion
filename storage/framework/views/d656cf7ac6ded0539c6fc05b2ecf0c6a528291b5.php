<div class="panel panel-default">
    <div class="panel-body">
        <?php echo CollectiveForm::open(['method' => 'POST', 'route' => $setting->grab('main_route').'-comment.store', 'class' => 'form-horizontal', 'files' => true]); ?>



            <?php echo CollectiveForm::hidden('ticket_id', $ticket->id ); ?>


            <fieldset>
                <legend><?php echo trans('ticketit::lang.reply'); ?></legend>
                <div class="form-group">
                    <div class="col-lg-12">
                        <?php echo CollectiveForm::textarea('content', null, ['class' => 'form-control summernote-editor', 'rows' => "3"]); ?>

                    </div>
                </div>

                <div class="text-right col-md-12">
                    <?php echo CollectiveForm::submit( trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-primary']); ?>

                </div>
                
                <div class="text-right col-md-12">
                    <div class="form-group">
                        <?php echo CollectiveForm::file('attachments[0]', null, ['class' => 'form-control']); ?>

                        <span class="help-block pull-left"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>
                    </div>
                    <div class="form-group">      
                        <?php echo CollectiveForm::file('attachments[1]', null, ['class' => 'form-control']); ?>

                        <span class="help-block pull-left"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>             
                    </div>
                    <div class="form-group">
                        <?php echo CollectiveForm::file('attachments[2]', null, ['class' => 'form-control']); ?>

                        <span class="help-block pull-left"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>
                    </div>
                </div>
            </fieldset>
        <?php echo CollectiveForm::close(); ?>

    </div>
</div>
