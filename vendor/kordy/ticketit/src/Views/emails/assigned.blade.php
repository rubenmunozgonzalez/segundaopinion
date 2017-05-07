<?php $notification_owner = unserialize($notification_owner);?>
<?php $ticket = unserialize($ticket);?>

@extends($email)

@section('subject')
	{{ trans('ticketit::email/globals.assigned') }}
@stop

@section('link')
	<a style="background-color:{{ $setting->grab('email.color_content_bg') }};color:{{ $setting->grab('email.color_header_bg') }};display:inline-block;font-family: Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;" href="{{ route($setting->grab('main_route').'.show', $ticket->id) }}">
		{{ trans('ticketit::email/globals.view-ticket') }}
	</a>
@stop

@section('content')
	{!! trans('ticketit::email/assigned.data', [
		'name'      =>  $notification_owner->name,
		'subject'   =>  $ticket->subject,
		'status'    =>  $ticket->status->name,
		'category'  =>  $ticket->unit->name
	]) !!}
@stop
