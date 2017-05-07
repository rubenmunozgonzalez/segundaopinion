<?php $comment = unserialize($comment);?>
<?php $ticket = unserialize($ticket);?>

@extends($email)

@section('subject')
	{{ trans('ticketit::email/globals.comment') }}
@stop

@section('link')
	<a style="background-color:{{ $setting->grab('email.color_content_bg') }};color:{{ $setting->grab('email.color_header_bg') }};display:inline-block;font-family: Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;" href="{{ route($setting->grab('main_route').'.show', $ticket->id) }}">
		{{ trans('ticketit::email/globals.view-ticket') }}
	</a>
@stop

@section('content')
	{!! trans('ticketit::email/comment.data', [
	    'name'      =>  $comment->user->l_name_1.' '.$comment->user->l_name_2,
	    'subject'   =>  $ticket->subject,
	    'status'    =>  $ticket->status->name,
	    'category'  =>  $ticket->unit->name,
	    'comment'   =>  $comment->getShortContent()
	]) !!}
@stop
