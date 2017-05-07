@extends('front_end.templates.frontpage')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tlmd-main-content" id="join">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="tlmd-join-us">
                        <h1>¡Pidenos una segunda opinión!</h1>
                        <p>Clinica CEMTRO te ofrece la posibilidad de realizar consultas online a través de nuestro servicio Segunda Opinión.</p>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-5">
                     <div class="tlmd-join-doctor">
                        <h2>Join as a Doctor.</h2>
                            <?php echo Form::open(array('class'=>"form-horizontal",'route' => 'addDoctor', 'files' => true));
                                echo Form::hidden('role',$value = "doctor");
                            ?>
                             <div class="form-group">
                                <label for="inputText" class="control-label col-xs-2">Name:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('name', '', $attributes = array('class' => 'form-control','id'=>"inputName",'placeholder' => 'Name')); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('name'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputText" class="control-label col-xs-2">User Name:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('username', '', $attributes = array('class' => 'form-control','id'=>"inputUsername",'placeholder' => 'Username')); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label col-xs-2">Email:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('email', '', $attributes = array('class' => 'form-control','id'=>"inputEmail",'placeholder' => 'Email ID')); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('email'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nationalId" class="control-label col-xs-2">National Id:</label>
                                <div class="col-xs-10">
                                     <?php echo Form::number('nidno', '', $attributes = array('class' => 'form-control','id'=>"inputNID",'placeholder' => 'National ID No')); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('nidno'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="control-label col-xs-2">Gender:</label>
                                
                                <label class="radio-inline"><input type="radio" name="gender">Male</label>
                                <label class="radio-inline"><input type="radio" name="gender">Female</label>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="control-label col-xs-2">Mobile:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::number('mobile', '', $attributes = array('class' => 'form-control','id'=>"inputMobile",'placeholder' => 'Mobile No')); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('mobile'); ?></span>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Password:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::password('password', array('class' => 'form-control','id'=>"inputPassword")); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('password'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBiography" class="control-label col-xs-2"> About: </label>
                                <div class="col-xs-10">
                                    <?php echo Form::textarea('biography', '', $attributes = array('class' => 'form-control','id'=>"BioGraphy",'placeholder' => 'BioGraphy')); ?>
                                    <span class="text-red"><?php echo $errors->doctor->first('biography'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-4">
                                     <?php echo Form::submit('Registrar', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                                </div>
                            </div>
                          <?php echo Form::close(); ?>
                    </div>
                </div>
                <div class="col-md-2">
                </div>

                <div class="col-md-5">
                    <div class="tlmd-join-patient">
                        <h2>Pedir una segunda opinión.</h2>
                          <?php echo Form::open(array('class'=>"form-horizontal",'route' => 'addPatient', 'files' => true))?>
                            <div class="form-group">
                                <label for="inputText" class="control-label col-xs-2">Name:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('patient_name', '', $attributes = array('class' => 'form-control','id'=>"inputName",'placeholder' => 'Name')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_name'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputText" class="control-label col-xs-2">User Name:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('patient_username', '', $attributes = array('class' => 'form-control','id'=>"inputUsername",'placeholder' => 'Username')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nationalId" class="control-label col-xs-2">National Id:</label>
                                <div class="col-xs-10">
                                     <?php echo Form::number('patient_nidno', '', $attributes = array('class' => 'form-control','id'=>"inputNID",'placeholder' => 'National ID No')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_nidno'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="patient_gender" class="control-label col-xs-2">Gender:</label>
                                
                                <label class="radio-inline"><input type="radio" name="gender">Male</label>
                                <label class="radio-inline"><input type="radio" name="gender">Female</label>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="control-label col-xs-2">Mobile:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::number('patient_mobile', '', $attributes = array('class' => 'form-control','id'=>"inputMobile",'placeholder' => 'Mobile No')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_mobile'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label col-xs-2">Email:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::text('patient_email', '', $attributes = array('class' => 'form-control','id'=>"inputEmail",'placeholder' => 'Email ID')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_email'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Password:</label>
                                <div class="col-xs-10">
                                    <?php echo Form::password('patient_password', array('class' => 'form-control','id'=>"inputPassword")); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_password'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBiography" class="control-label col-xs-2"> About: </label>
                                <div class="col-xs-10">
                                    <?php echo Form::textarea('patient_biography', '', $attributes = array('class' => 'form-control','id'=>"BioGraphy",'placeholder' => 'BioGraphy')); ?>
                                    <span class="text-red"><?php echo $errors->patient->first('patient_biography'); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-4">
                                     <?php echo Form::submit('Registrar', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                                </div>
                            </div>
                          <?php echo Form::close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop