<div class="panel panel-default">
    <div class="panel-body">
        <div class="content">
            <h2 class="header">
                {{ $ticket->subject }}
                <span class="pull-right">
                    @if($u->isAgent() || $u->isAdmin())
                        @if(! $ticket->completed_at && $close_perm == 'yes')
                                {!! link_to_route($setting->grab('main_route').'.complete', trans('ticketit::lang.btn-mark-complete'), $ticket->id,
                                                    ['class' => 'btn btn-success']) !!}
                        @elseif($ticket->completed_at && $reopen_perm == 'yes')
                                {!! link_to_route($setting->grab('main_route').'.reopen', trans('ticketit::lang.reopen-ticket'), $ticket->id,
                                                    ['class' => 'btn btn-success']) !!}
                        @endif                    
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-modal">
                            {{ trans('ticketit::lang.btn-edit')  }}
                        </button>
                    @endif
                    @if($u->isAdmin())
                        @if($setting->grab('delete_modal_type') == 'builtin')
                            {!! link_to_route(
                                            $setting->grab('main_route').'.destroy', trans('ticketit::lang.btn-delete'), $ticket->id,
                                            [
                                            'class' => 'btn btn-danger deleteit',
                                            'form' => "delete-ticket-$ticket->id",
                                            "node" => $ticket->subject
                                            ])
                            !!}
                        @elseif($setting->grab('delete_modal_type') == 'modal')
{{-- // OR; Modal Window: 1/2 --}}
                            {!! CollectiveForm::open(array(
                                    'route' => array($setting->grab('main_route').'.destroy', $ticket->id),
                                    'method' => 'delete',
                                    'style' => 'display:inline'
                               ))
                            !!}
                            <button type="button"
                                    class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="{!! trans('ticketit::lang.show-ticket-modal-delete-title', ['id' => $ticket->id]) !!}"
                                    data-message="{!! trans('ticketit::lang.show-ticket-modal-delete-message', ['subject' => $ticket->subject]) !!}"
                             >
                              {{ trans('ticketit::lang.btn-delete') }}
                            </button>
                        @endif
                            {!! CollectiveForm::close() !!}
{{-- // END Modal Window: 1/2 --}}
                    @endif
                </span>
            </h2>
            <div class="panel well well-sm">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p> <strong>{{ trans('ticketit::lang.owner') }}</strong>{{ trans('ticketit::lang.colon') }}{{ $ticket->user->name }}</p>
                            <p>
                                <strong>{{ trans('ticketit::lang.status') }}</strong>{{ trans('ticketit::lang.colon') }}
                                @if( $ticket->isComplete() && ! $setting->grab('default_close_status_id') )
                                    <span style="color: blue">Complete</span>
                                @else
                                    <span style="color: {{ $ticket->status->color }}">{{ $ticket->status->name }}</span>
                                @endif

                            </p>
                            <p> <strong>{{ trans('ticketit::lang.created') }}</strong>{{ trans('ticketit::lang.colon') }}{{ $ticket->created_at->diffForHumans() }}</p>
                            <p> <strong>{{ trans('ticketit::lang.last-update') }}</strong>{{ trans('ticketit::lang.colon') }}{{ $ticket->updated_at->diffForHumans() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p> <strong>{{ trans('ticketit::lang.responsible') }}</strong>{{ trans('ticketit::lang.colon') }}{{ $ticket->agent->name }}</p>
                            <p>
                                <strong>{{ trans('ticketit::lang.category') }}</strong>{{ trans('ticketit::lang.colon') }}
                                <span style="color: {{ $ticket->category->color }}">
                                    {{ $ticket->category->name }}
                                </span>
                            </p> 
                            <p>
                                <strong>{{ trans('ticketit::lang.unit') }}</strong>{{ trans('ticketit::lang.colon') }}
                                <span style="color: {{ $ticket->unit->color }}">
                                    {{ $ticket->unit->name }}
                                </span>
                            </p> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3>{!! trans('ticketit::lang.create-ticket-brief-issue') !!}</h3>
                <p> {!! $ticket->html !!} </p>
                <h3>{!! trans('¿Qué le ocurre?') !!}</h3>
                <p> {!! $ticket->symptoms !!} </p>
                <h3>{!! trans('¿Desde cuando le ocurre?') !!}</h3>
                <p> {!! $ticket->since !!} </p>
                <h3>{!! trans('¿Cómo comenzó:?') !!}</h3>
                <p> {!! $ticket->cause !!} </p>
                <h3>{!! trans('¿A qué lo atribuye?') !!}</h3>
                <p> {!! $ticket->reason !!} </p>
                <h3>{!! trans('¿En qué circunstancias se agrava o se reduce?') !!}</h3>
                <p> {!! $ticket->trigger !!} </p>
                <h3>{!! trans('¿Qué intensidad tiene?') !!}</h3>
                <p> {!! $ticket->intensity !!} </p>
                <h3>{!! trans('¿Qué repercusión tiene sobre su vida?') !!}</h3>
                <p> {!! $ticket->consequences !!} </p>
                <h3>{!! trans('¿Ha consultado con algún especialista por este problema?') !!}</h3>
                <p> {!! $ticket->reported !!} </p>
                <h3>{!! trans('¿Qué pruebas le han hecho?') !!}</h3>
                <p> {!! $ticket->tests !!} </p>
                <h3>{!! trans('¿Qué diagnósticos le han dado?') !!}</h3>
                <p> {!! $ticket->diagnostic !!} </p>
                <h3>{!! trans('¿Qué tratamientos ha recibido para este problema?') !!}</h3>
                <p> {!! $ticket->treatments !!} </p>
                <h3>{!! trans('Adjuntar los informes que tenga tanto de pruebas de imagen como de consultas') !!}</h3>
                <p> {!! $ticket->attachments !!} </p>                
                <h3>{!! trans('¿Qué resultados ha tenido con estos tratamientos?') !!}</h3>
                <p> {!! $ticket->results !!} </p>
                <h3>{!! trans('¿Qué otros tratamientos le han sugerido para su problema?') !!}</h3>
                <p> {!! $ticket->suggested !!} </p>
            </div>
        </div>
        {!! CollectiveForm::open([
                        'method' => 'DELETE',
                        'route' => [
                                    $setting->grab('main_route').'.destroy',
                                    $ticket->id
                                    ],
                        'id' => "delete-ticket-$ticket->id"
                        ])
        !!}
        {!! CollectiveForm::close() !!}
    </div>
</div>

    @if($u->isAgent() || $u->isAdmin())
        @include('ticketit::tickets.edit')
    @endif

{{-- // OR; Modal Window: 2/2 --}}
    @if($u->isAdmin())
        @include('ticketit::tickets.partials.modal-delete-confirm')
    @endif
{{-- // END Modal Window: 2/2 --}}
