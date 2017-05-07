<?php $__env->startSection('content'); ?>
<div class="login-logo">
    <a href=""><b> Recordar contraseña </b></a>
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
         <?php echo Form::open(array('route' => 'adminForgotPass')) ?>

                    <div class="form-group has-feedback">
                        <?php echo Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Nombre de usuario...')); ?>
                        <span class="text-red"> <?php echo $errors->first('username'); ?></span>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo Form::submit('Recordar contraseña', array('class' => 'btn btn-primary btn-block btn-flat')) ?>
                        </div><!-- /.col -->
                    </div>


    <?php echo Form::close(); ?>

</div><!-- /.login-box-body -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.templates.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>