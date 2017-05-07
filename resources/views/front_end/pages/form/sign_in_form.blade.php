@extends('front_end.templates.default')
@section('content')
            <div class="row">
                <div class="col-md-5">
                        <h2>Entrar</h2>
                          <?php echo Form::open(array('class'=>"form-horizontal",'route' => 'adminLoginCheck', 'files' => true))?>
                            <div class="form-group">
                                <label for="inputText" class="control-label col-xs-4">Email:</label>
                                <div class="col-xs-8">
                                    <?php echo Form::text('username', '', $attributes = array('class' => 'form-control','id'=>"inputUsername",'placeholder' => 'Email')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-4">Contraseña:</label>
                                <div class="col-xs-8">
                                    <?php echo Form::password('password', array('class' => 'form-control','id'=>"inputPassword", 'placeholder' => 'Contraseña')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_password'); ?></span>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 300px">
                                <div class="col-xs-offset-4 col-xs-4">
                                     <?php echo Form::submit('Entrar', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                                </div>
                            </div>
                          <?php echo Form::close(); ?>
                </div>
                 
            </div>
@stop