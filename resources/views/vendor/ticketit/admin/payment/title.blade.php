<div class="panel panel-default">

    <div class="panel-heading">
        <h2>{{ trans('ticketit::lang.index-my-payments') }}
            {!! link_to_route($setting->grab('main_route').'.payments.download', trans('ticketit::lang.btn-download-payments'), null, ['class' => 'btn btn-primary pull-right']) !!}
        </h2>
    </div>

    <div class="panel-body">
        <div id="message"></div>

        @include('ticketit::admin.payment.partials.datatable')
    </div>

</div>
