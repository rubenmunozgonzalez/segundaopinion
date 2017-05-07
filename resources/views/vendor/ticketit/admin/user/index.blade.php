@extends($master)

@section('page')
    {{ trans('ticketit::admin.user-index-title') }}
@stop

@section('content')
    @include('ticketit::shared.header')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ trans('ticketit::admin.user-index-title') }}
                {!! link_to_route(
                                    $setting->grab('admin_route').'.user.create',
                                    trans('ticketit::admin.btn-create-new-user'), null,
                                    ['class' => 'btn btn-primary pull-right'])
                !!}
            </h2>
        </div>

        @if ($users->isEmpty()) 
            <h3 class="text-center">{{ trans('ticketit::admin.user-index-no-agents') }}
                {!! link_to_route($setting->grab('admin_route').'.user.create', trans('ticketit::admin.user-index-create-new')) !!}
            </h3>
        @else
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>{{ trans('ticketit::admin.table-id') }}</td>
                        <td>{{ trans('ticketit::admin.table-name') }}</td>
                        <td>{{ trans('ticketit::admin.table-surnames') }}</td>
                        <td>{{ trans('ticketit::admin.table-date') }}</td>
                        <td>{{ trans('ticketit::admin.table-show-user') }}</td>
                        <td>{{ trans('ticketit::admin.table-remove-user') }}</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->l_name_1 }} {{ $user->l_name_2 }}
                        </td>
                        <td>
                            {{ $user->updated_at }}
                        </td>
                        <td>
                            {!! CollectiveForm::open([
                            'method' => 'GET',
                            'route' => [
                                        $setting->grab('admin_route').'.user.edit',
                                        $user->id
                                        ],
                            'id' => "show-$user->id"
                            ]) !!}
                            {!! CollectiveForm::submit(trans('ticketit::admin.btn-show'), ['class' => 'btn btn-info']) !!}
                            {!! CollectiveForm::close() !!}
                        </td>
                        <td>
                            {!! CollectiveForm::open([
                            'method' => 'DELETE',
                            'route' => [
                                        $setting->grab('admin_route').'.user.destroy',
                                        $user->id
                                        ],
                            'id' => "delete-$user->id"
                            ]) !!}
                            {!! CollectiveForm::submit(trans('ticketit::admin.btn-remove'), ['class' => 'btn btn-danger']) !!}
                            {!! CollectiveForm::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>
@stop
