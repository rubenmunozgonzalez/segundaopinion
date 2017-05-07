
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticketit Installation</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <h1 style="text-align: center"><?php echo e(trans('ticketit::install.initial-setup')); ?></h1>
  <form class="form-signin" action="<?php echo e(url('/tickets-install')); ?>" method="post" style="max-width: 500px">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <h3 class="form-signin-heading"><?php echo e(trans('ticketit::install.master-template-file')); ?></h3>
        <select id="master" name="master" class="form-control" required autofocus>
            <?php foreach($views_files_list as $name => $path): ?>
                <option value="<?php echo e($name); ?>"><?php echo e($path); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <div class="form-group" id="other-path-group" style="display: none">
            <label for="other_path"><?php echo e(trans('ticketit::install.master-template-other-path')); ?></label>
            <input type="text" id="other_path" name="other_path" class="form-control" />
            <span id="helpBlock" class="help-block">
                <?php echo e(trans('ticketit::install.master-template-other-path-ex')); ?>

            </span>
        </div>

        <h3 class="form-signin-heading"><?php echo e(trans('ticketit::install.admin-select')); ?></h3>
        <select id="admin_id" name="admin_id" class="form-control" required autofocus>
            <?php foreach($users_list as $id => $name): ?>
                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
            <?php endforeach; ?>
        </select>
        <span id="helpBlock" class="help-block">
            <?php echo e(trans('ticketit::install.admin-select-help-block')); ?>

        </span>
        <br>

        <div class="well small" style="border: 1px solid #ccc">
            <?php if(!empty($inactive_migrations)): ?>
                <b><?php echo e(trans('ticketit::install.migrations-to-be-installed')); ?></b>
                <ul>
                    <?php foreach($inactive_migrations as $mig): ?>
                        <li><?php echo e($mig); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <b><?php echo e(trans('ticketit::install.all-tables-migrated')); ?></b>
            <?php endif; ?>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            <?php echo e(trans('ticketit::install.proceed')); ?>

        </button>
    </form>

</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="public/assets/frontend/js/bootstrap.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
<script>
    $('#master').change(function() {
        opt = $(this).val();
        if (opt=="another") {
            $('#other-path-group').show();
        } else {
            $('#other-path-group').hide();
        }
    });
</script>
</body>
</html>
