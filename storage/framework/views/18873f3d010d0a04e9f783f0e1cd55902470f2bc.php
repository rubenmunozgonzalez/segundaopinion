<?php $__env->startSection('content'); ?>
            <div class="row">
                <div class="col-md-5">
                        <h2>Entrar</h2>
                          <?php echo Form::open(array('class'=>"form-horizontal",'route' => 'adminLoginCheck', 'files' => true))?>
                            <div class="form-group">
                                <label for="inputText" class="control-label col-xs-2">Email:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('username', '', $attributes = array('class' => 'form-control','id'=>"inputUsername",'placeholder' => 'Email')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Password:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::password('password', array('class' => 'form-control','id'=>"inputPassword", 'placeholder' => 'Contraseña')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_password'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-4">
                                     <?php echo Form::submit('Entrar', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                                </div>
                            </div>
                          <?php echo Form::close(); ?>
                </div>
                 
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front_end.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>