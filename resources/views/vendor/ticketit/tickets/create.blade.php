@extends($master)
@section('page', trans('ticketit::lang.create-ticket-title'))

@section('content')
@include('ticketit::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::open([
                        'route'=>$setting->grab('main_route').'.store',
                        'method' => 'POST',
                        'class' => 'form-horizontal',
                        'files' => true
                        ]) !!}
            <legend>{!! trans('ticketit::lang.create-new-ticket') !!}</legend>
            <div class="form-inline row">
                <!--
                <div class="form-group col-lg-4">
                    {!! CollectiveForm::label('priority', trans('ticketit::lang.priority') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']) !!}
                    <div class="col-lg-6">
                        {!! CollectiveForm::select('priority_id', $priorities, null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                -->
                <div class="form-group col-lg-6">
                    {!! CollectiveForm::label('category', trans('ticketit::lang.category') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']) !!}
                    <div class="col-lg-6">
                        {!! CollectiveForm::select('category_id', $categories, null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    {!! CollectiveForm::label('unit_id', trans('ticketit::lang.unit') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']) !!}
                    <div class="col-lg-6">
                        {!! CollectiveForm::select('unit_id', $units, null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                {!! CollectiveForm::hidden('agent_id', 'auto') !!}
            </div>
            <br>
            <div class="form-group">
                {!! CollectiveForm::label('subject', trans('ticketit::lang.subject') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::text('subject', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <!--<span class="help-block">{!! trans('ticketit::lang.create-ticket-brief-issue') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('content', trans('¿Qué le ocurre?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('content', null, ['class' => 'form-control summernote-editor', 'rows' => '5', 'required' => 'required']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué le ocurre?') !!}</span>-->
                </div>

            </div>
            <div class="form-group">
                {!! CollectiveForm::label('since', trans('¿Desde cuando le ocurre?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::text('since', null, ['class' => 'form-control']) !!}
                    <!--<span class="help-block">{!! trans('¿Desde cuando le ocurre?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('reason', trans('¿A qué lo atribuye?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('reason', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿A qué lo atribuye?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('cause', trans('¿Cómo comenzó?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('cause', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Cómo comenzó:?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('symptoms', trans('¿Qué síntomas tiene?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('symptoms', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué síntomas tiene?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('intensity', trans('¿Qué intensidad tienen estos síntomas?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('intensity', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué intensidad tiene?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('trigger', trans('¿En qué circunstancias se agravan o se reducen los síntomas?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('trigger', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿En qué circunstancias se agrava o se reduce?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('consequences', trans('¿Qué repercusión tiene sobre su vida?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('consequences', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué repercusión tiene sobre su vida?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('reported', trans('¿Ha consultado con algún especialista por este problema?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::select('reported', ['No', 'Si'], null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Ha consultado con algún especialista por este problema?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('tests', trans('¿Qué pruebas le han hecho?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('tests', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué pruebas le han hecho?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('diagnostic', trans('¿Qué diagnósticos le han dado?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('diagnostic', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué diagnósticos le han dado?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('treatments', trans('¿Qué tratamientos ha recibido para este problema?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('treatments', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué tratamientos ha recibido para este problema?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('results', trans('¿Qué resultados ha tenido con estos tratamientos?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('results', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué resultados ha tenido con estos tratamientos?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('suggested', trans('¿Qué otros tratamientos le han sugerido para su problema?') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('suggested', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <!--<span class="help-block">{!! trans('¿Qué otros tratamientos le han sugerido para su problema?') !!}</span>-->
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('attachments', trans('Informe') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::file('attachments[0]', null, ['class' => 'form-control']) !!}
                    <span class="help-block">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>

                    {!! CollectiveForm::file('attachments[1]', null, ['class' => 'form-control']) !!}
                    <span class="help-block">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>

                    {!! CollectiveForm::file('attachments[2]', null, ['class' => 'form-control']) !!}
                    <span class="help-block">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>

                    {!! CollectiveForm::file('attachments[3]', null, ['class' => 'form-control']) !!}
                    <span class="help-block">{!! trans('pdf, doc, docx, jpg, png (8M máximo)') !!}</span>
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('captcha', trans('Introduzca este texto de seguridad') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Captcha::img('flat'); !!}
                    {!! Form::text('captcha') !!}
                    <span class="text-red"><?php echo $errors->ticket->first('captcha'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    {!! link_to_route($setting->grab('main_route').'.index', trans('ticketit::lang.btn-back'), null, ['class' => 'btn btn-default']) !!}
                    {!! CollectiveForm::submit(trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        {!! CollectiveForm::close() !!}
    </div>
@endsection

@section('footer')
    @include('ticketit::tickets.partials.summernote')
@endsection
