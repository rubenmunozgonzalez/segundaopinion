<?php $__env->startSection('content'); ?>
<div class="login-logo">
    <a href=""><b> Telemedicine </b></a>
</div><!-- /.login-logo -->
<div class="login-box-body">
    
         <?php if(Session::get('authentication_error') !== null){?>
               <div class="form-group has-feedback">
                    <div class="alert alert-danger alert-dismissable"> <?php  echo  Session::get('authentication_error'); ?></div>
                </div>
         <?php }?>
          <?php echo Form::open(array('route' => 'adminLoginCheck')) ?>

                        <div class="form-group has-feedback">
                            <?php echo Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Place username....')); ?>
                            <span class="text-red"> <?php echo $errors->first('username'); ?></span>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password....')); ?>
                            <span class="text-red"> <?php echo $errors->first('password'); ?></span>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="row">
                            <div class="col-xs-8">    
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name ="remember"> Remember Me
                                    </label>
                                </div>                        
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <?php echo Form::submit('Sign In', array('class' => 'btn btn-primary btn-block btn-flat')) ?>
                            </div><!-- /.col -->
                        </div>


    <?php // echo Form::close(); ?>

    <a href="#">I forgot my password</a><br>

</div><!-- /.login-box-body -->
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.templates.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>