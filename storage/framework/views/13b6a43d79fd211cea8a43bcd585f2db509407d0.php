<?php if(!$comments->isEmpty()): ?>
    <?php foreach($comments as $comment): ?>
        <div class="panel <?php echo $comment->user->tickets_role ? "panel-info" : "panel-default"; ?>">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $comment->user->name; ?>

                    <span class="pull-right"> <?php echo $comment->created_at->diffForHumans(); ?> </span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="content">
                    <p> <?php echo $comment->html; ?> </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>