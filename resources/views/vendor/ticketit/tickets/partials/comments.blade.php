@if(!$comments->isEmpty())
    @foreach($comments as $comment)
        <div class="panel {!! $comment->user->tickets_role ? "panel-info" : "panel-default" !!}">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {!! $comment->user->name !!}
                    <span class="pull-right"> @if (Carbon\Carbon::setLocale('es')) {!! $comment->created_at->diffForHumans() !!} @endif </span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="content">
                    <p> {!! $comment->html !!} </p>
                    <p> {!! $comment->attachments !!} </p>                
                </div>
            </div>
        </div>
    @endforeach
@endif