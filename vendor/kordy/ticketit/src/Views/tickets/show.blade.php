@extends($master)
@section('page', trans('ticketit::lang.show-ticket-title') . trans('ticketit::lang.colon') . $ticket->subject)
@section('content')
        @include('ticketit::shared.header')
        @include('ticketit::tickets.partials.ticket_body')
        <br>
        <h2>{{ trans('ticketit::lang.comments') }}</h2>
        @include('ticketit::tickets.partials.comments')
        {!! $comments->render() !!}
        @if ($ticket->status->name != 'Completa')
            @include('ticketit::tickets.partials.comment_form')
        @endif
        @if ($ticket->status->name == 'Pendiente de pago')
            <div id="payment_modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" data-keyboard="false">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Consulta no pagada</h4>
                    </div>
                    {!! CollectiveForm::open([
                            'route'=> 'payment',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files' => false
                            ]) !!}
                    <div class="modal-body">
                      <p>Su consulta se encuentra en estado <span style="color: {{ $ticket->status->color }}">{{ $ticket->status->name }}</span></p>
                      <p>Por favor seleccione un medio de pago y pulse en <b>Pagar</b></p>


                            <div class="form-group">
                                {!! CollectiveForm::label('method', trans('Medio') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}                               
                                <div class="col-lg-10">
                                    {!! CollectiveForm::select('reported', ['Paypal', 'Tarjeta de crédito'], null, ['class' => 'form-control']) !!}
                                    <!--<span class="help-block">{!! trans('¿Ha consultado con algún especialista por este problema?') !!}</span>-->
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                     {!! CollectiveForm::close() !!} 
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @elseif ($ticket->status->name == 'Completa')
            <div id="reopen_modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" data-keyboard="false">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Consulta completada</h4>
                    </div>
                    {!! CollectiveForm::open([
                            'route'=> 'payment',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files' => false
                            ]) !!}
                    <div class="modal-body">
                      <p>Su consulta se encuentra en estado <span style="color: {{ $ticket->status->color }}">{{ $ticket->status->name }}</span></p>
                      <p>Si desea reabrirla,  seleccione un medio de pago y pulse en <b>Pagar</b></p>


                            <div class="form-group">
                                {!! CollectiveForm::label('method', trans('Medio') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}                               
                                <div class="col-lg-10">
                                    {!! CollectiveForm::select('reported', ['Paypal', 'Tarjeta de crédito'], null, ['class' => 'form-control']) !!}
                                    <!--<span class="help-block">{!! trans('¿Ha consultado con algún especialista por este problema?') !!}</span>-->
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                     {!! CollectiveForm::close() !!} 
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endif
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $( ".deleteit" ).click(function( event ) {
                event.preventDefault();
                if (confirm("{!! trans('ticketit::lang.show-ticket-js-delete') !!}" + $(this).attr("node") + " ?"))
                {
                    var form = $(this).attr("form");
                    $("#" + form).submit();
                }

            });
            $('#category_id').change(function(){
                var loadpage = "{!! route($setting->grab('main_route').'agentselectlist') !!}/" + $(this).val() + "/{{ $ticket->id }}";
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
            
            if ("{!! $ticket->status->name !!}" == "Pendiente de pago") {
                $('#payment_modal').modal('show');
            }
            
            if ("{!! $ticket->status->name !!}" == "Completa") {
                $('#reopen_modal').modal('show');
            }
        });
        
        
            
    </script>
    @include('ticketit::tickets.partials.summernote')
@endsection
