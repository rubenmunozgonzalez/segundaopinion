@extends('admin.templates.login')
@section('content')
<div class="login-logo">
    <a href=""><b> Cambiar contraseña </b></a>
</div><!-- /.login-logo -->
<div class="login-box-body">
     <?php if(Session::get('authentication_error') !== null){?>
           <div class="form-group has-feedback">
                <div class="alert alert-danger alert-dismissable"> <?php  echo  Session::get('authentication_error'); ?></div>
            </div>
     <?php }?>
     <?php echo Form::open(array('route' => 'adminChangePass')) ?>

            <div class="form-group has-feedback">
                <?php echo Form::text('username', $username, array('class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => 'Nombre de usuario...')); ?>
                <span class="text-red"> <?php echo $errors->first('username'); ?></span>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?php echo Form::password('password',  array('class' => 'form-control', 'placeholder' => 'Contraseña...')); ?>
                <span class="text-red"> <?php echo $errors->first('password'); ?></span>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?php echo Form::password('repeat_password',  array('class' => 'form-control', 'placeholder' => 'Repetir contraseña...')); ?>
                <span class="text-red"> <?php echo $errors->first('repeat_password'); ?></span>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-xs-6">
                    <?php echo Form::submit('Cambiar contraseña', array('class' => 'btn btn-primary btn-block btn-flat')) ?>
                </div><!-- /.col -->
            </div>


    <?php echo Form::close(); ?>

</div><!-- /.login-box-body -->

@stop
