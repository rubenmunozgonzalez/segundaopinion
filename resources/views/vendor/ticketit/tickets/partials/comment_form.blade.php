<div class="panel panel-default">
    <div class="panel-body">
        {!! CollectiveForm::open(['method' => 'POST', 'route' => $setting->grab('main_route').'-comment.store', 'class' => 'form-horizontal', 'files' => true]) !!}


            {!! CollectiveForm::hidden('ticket_id', $ticket->id ) !!}

            <fieldset>
                <legend>{!! trans('ticketit::lang.reply') !!}</legend>
                <div class="form-group">
                    <div class="col-lg-12">
                        {!! CollectiveForm::textarea('content', null, ['class' => 'form-control summernote-editor', 'rows' => "3"]) !!}
                    </div>
                </div>

                <div class="text-right col-md-12">
                    {!! CollectiveForm::submit( trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-primary']) !!}
                </div>
                
                <div class="text-right col-md-12">
                    <div class="form-group">
                        {!! CollectiveForm::file('attachments[0]', null, ['class' => 'form-control']) !!}
                        <span class="help-block pull-left">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>
                    </div>
                    <div class="form-group">      
                        {!! CollectiveForm::file('attachments[1]', null, ['class' => 'form-control']) !!}
                        <span class="help-block pull-left">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>             
                    </div>
                    <div class="form-group">
                        {!! CollectiveForm::file('attachments[2]', null, ['class' => 'form-control']) !!}
                        <span class="help-block pull-left">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>
                    </div>
                </div>
            </fieldset>
        {!! CollectiveForm::close() !!}
    </div>
</div>
