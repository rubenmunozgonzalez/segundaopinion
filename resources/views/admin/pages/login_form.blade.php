@extends('admin.templates.login')
@section('content')
<div class="login-logo">
    <a href=""><b> Clínica CEMTRO </b></a>
</div><!-- /.login-logo -->
<div class="login-box-body">
         <p>
           <a href='/'><img src='/public/assets/frontend/img/logo.png'/></a>
         </p>
         <?php if(Session::get('authentication_error') !== null){?>
               <div class="form-group has-feedback">
                    <div class="alert alert-danger alert-dismissable"> <?php  echo  Session::get('authentication_error'); ?></div>
                </div>
         <?php }?>
        <?php if(Session::get('success_message') !== null){?>
               <div class="form-group has-feedback">
                    <div class="alert alert-success alert-dismissable"> <?php  echo  Session::get('success_message'); ?></div>
                </div>
         <?php }?>
         <?php echo Form::open(array('route' => 'adminLoginCheck')) ?>

                        <div class="form-group has-feedback">
                            <?php echo Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Nombre de usuario...')); ?>
                            <span class="text-red"> <?php echo $errors->first('username'); ?></span>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña...')); ?>
                            <span class="text-red"> <?php echo $errors->first('password'); ?></span>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name ="remember"> Recordarme
                                    </label>
                                </div>
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <?php echo Form::submit('Sign In', array('class' => 'btn btn-primary btn-block btn-flat')) ?>
                            </div><!-- /.col -->
                        </div>


    <?php // echo Form::close(); ?>

    <a href="/adminForgotPassword">Olvidé mi contraseña</a><br>

</div><!-- /.login-box-body -->

@stop
