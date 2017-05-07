<?php $__env->startSection('page', trans('ticketit::lang.create-ticket-title')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="well bs-component">
        <?php echo CollectiveForm::open([
                        'route'=>$setting->grab('main_route').'.store',
                        'method' => 'POST',
                        'class' => 'form-horizontal',
                        'files' => true
                        ]); ?>

            <legend><?php echo trans('ticketit::lang.create-new-ticket'); ?></legend>
            <div class="form-inline row">
                <!--
                <div class="form-group col-lg-4">
                    <?php echo CollectiveForm::label('priority', trans('ticketit::lang.priority') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']); ?>

                    <div class="col-lg-6">
                        <?php echo CollectiveForm::select('priority_id', $priorities, null, ['class' => 'form-control', 'required' => 'required']); ?>

                    </div>
                </div>
                -->
                <div class="form-group col-lg-6">
                    <?php echo CollectiveForm::label('category', trans('ticketit::lang.category') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']); ?>

                    <div class="col-lg-6">
                        <?php echo CollectiveForm::select('category_id', $categories, null, ['class' => 'form-control', 'required' => 'required']); ?>

                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <?php echo CollectiveForm::label('unit_id', trans('ticketit::lang.unit') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']); ?>

                    <div class="col-lg-6">
                        <?php echo CollectiveForm::select('unit_id', $units, null, ['class' => 'form-control', 'required' => 'required']); ?>

                    </div>
                </div>
                <?php echo CollectiveForm::hidden('agent_id', 'auto'); ?>

            </div>
            <br>
            <div class="form-group">
                <?php echo CollectiveForm::label('subject', trans('ticketit::lang.subject') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>

                <div class="col-lg-10">
                    <?php echo CollectiveForm::text('subject', null, ['class' => 'form-control', 'required' => 'required']); ?>

                    <!--<span class="help-block"><?php echo trans('ticketit::lang.create-ticket-brief-issue'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('content', trans('¿Qué le ocurre?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>

                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('content', null, ['class' => 'form-control summernote-editor', 'rows' => '5', 'required' => 'required']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué le ocurre?'); ?></span>-->
                </div>
                
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('cause', trans('¿Cómo comenzó?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('cause', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Cómo comenzó:?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('symptoms', trans('¿Qué síntomas tiene?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('symptoms', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué síntomas tiene?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('since', trans('¿Desde cuando le ocurre?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::text('since', null, ['class' => 'form-control']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Desde cuando le ocurre?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('reason', trans('¿A qué lo atribuye?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('reason', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿A qué lo atribuye?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('trigger', trans('¿En qué circunstancias se agrava o se reduce?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('trigger', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿En qué circunstancias se agrava o se reduce?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('intensity', trans('¿Qué intensidad tiene?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('intensity', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué intensidad tiene?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('consequences', trans('¿Qué repercusión tiene sobre su vida?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('consequences', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué repercusión tiene sobre su vida?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('reported', trans('¿Ha consultado con algún especialista por este problema?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::select('reported', ['No', 'Si'], null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Ha consultado con algún especialista por este problema?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('tests', trans('¿Qué pruebas le han hecho?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('tests', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué pruebas le han hecho?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('diagnostic', trans('¿Qué diagnósticos le han dado?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('diagnostic', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué diagnósticos le han dado?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('attachments', trans('Informe') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::file('attachments[0]', null, ['class' => 'form-control']); ?>

                    <span class="help-block"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>
                
                    <?php echo CollectiveForm::file('attachments[1]', null, ['class' => 'form-control']); ?>

                    <span class="help-block"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>
               
                    <?php echo CollectiveForm::file('attachments[2]', null, ['class' => 'form-control']); ?>

                    <span class="help-block"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>
                
                    <?php echo CollectiveForm::file('attachments[3]', null, ['class' => 'form-control']); ?>

                    <span class="help-block"><?php echo trans('pdf, doc, docx, jpg, png (8M máximo)'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('treatments', trans('¿Qué tratamientos ha recibido para este problema?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('treatments', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué tratamientos ha recibido para este problema?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('results', trans('¿Qué resultados ha tenido con estos tratamientos?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('results', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué resultados ha tenido con estos tratamientos?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('suggested', trans('¿Qué otros tratamientos le han sugerido para su problema?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo CollectiveForm::textarea('suggested', null, ['class' => 'form-control summernote-editor', 'rows' => '5']); ?>

                    <!--<span class="help-block"><?php echo trans('¿Qué otros tratamientos le han sugerido para su problema?'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <?php echo CollectiveForm::label('captcha', trans('Introduzca este texto de seguridad') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']); ?>                               
                <div class="col-lg-10">
                    <?php echo Captcha::img();; ?>

                    <?php echo Form::text('captcha'); ?>

                    <span class="text-red"><?php echo $errors->ticket->first('captcha'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php echo link_to_route($setting->grab('main_route').'.index', trans('ticketit::lang.btn-back'), null, ['class' => 'btn btn-default']); ?>                   
                    <?php echo CollectiveForm::submit(trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-default']); ?>

                </div>
            </div>
        <?php echo CollectiveForm::close(); ?>

    </div>    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('ticketit::tickets.partials.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>