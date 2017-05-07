<?php $__env->startSection('content'); ?>

    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-6 col-md-offset-4 ">
            <div class="tlmd_inner_page_heading">
                <h1> Pedir una segunda opinión</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                <hr>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 wow fadeInLeft animated">

            <?php echo Form::open(array('class' => "form-horizontal", 'route' => 'addPatient', 'files' => true))?>

            <div class=" form-group form_section_title "> <h4> Información personal</h4></div>

            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Nombre:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('f_name', '', $attributes = array('class' => 'form-control', 'id' => "f_name", 'placeholder' => ' Nombre')); ?>
                    <span class="text-red"><?php echo $errors->first('f_name'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Primer apellido:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('l_name_1', '', $attributes = array('class' => 'form-control', 'id' => "l_name_1", 'placeholder' => ' Primer apellido')); ?>
                    <span class="text-red"><?php echo $errors->first('l_name_1'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Segundo apellido:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('l_name_2', '', $attributes = array('class' => 'form-control', 'id' => "l_name_2", 'placeholder' => ' Segundo apellido')); ?>
                    <span class="text-red"><?php echo $errors->first('l_name_2'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="patient_gender" class="control-label col-xs-3">Sexo:</label>
                <div class="col-xs-9">
                    <div class="col-sm-6">
                        <div class="radio">
                           <div class="col-xs-6">
                                <?php  echo Form::radio('gender', 'male');?>
                                Hombre
                            </div>
                            <div class="col-xs-6">
                                <?php  echo Form::radio('gender', 'female');?>
                                Mujer
                            </div>
                        </div>
                        <span class="text-red"><?php echo $errors->first('gender'); ?></span>
                    </div>
                </div>
            </div>
            <!--
            <div class="form-group">
                <label for="bloodgroup" class="control-label col-xs-3">Grupo sanguíneo:</label>
                <div class="col-xs-9">
                    <?php
                    $bloodgroup = array(
                            'A +' => 'A +',
                            'A -' => 'A -',
                            'B +' => 'B +',
                            'B -' => 'B -',
                            'O +' => 'O +',
                            'O -' => 'O -',
                            'O -' => 'O -',
                            'O -' => 'O -',
                    );
                    echo Form::select('bloodgroup', $bloodgroup,'', $attributes = array('class' => 'form-control')); ?>
                    <span class="text-red"><?php echo $errors->first('bloodgroup'); ?></span>
                </div>
            </div>
            --> 
            <div class="form-group">
                <label for="nationalId" class="control-label col-xs-3">NIF:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('nidno', '', $attributes = array('class' => 'form-control', 'id' => "inputNID", 'placeholder' => 'National ID No')); ?>
                    <span class="text-red"><?php echo $errors->first('nidno'); ?></span>
                </div>
            </div>
            <!--
            <div class="form-group">
                <label for="inputBiography" class="control-label col-xs-3"> Enfermedades de gravedad: </label>
                <div class="col-xs-9">
                    <?php echo Form::textarea('about', '', $attributes = array('class' => 'form-control', 'id' => "BioGraphy", 'placeholder' => 'Enfermedades de gravedad')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('abouty'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-xs-3 control-label">Adjuntos</div>
                <div class="col-xs-9">
                    <?php echo Form::file('image');?>
                    <span class="text-red"><?php  echo  Session::get('image_validation_error'); ?></span>
                </div>
            </div>
            

            <div class=" form-group form_section_title "> <h4> Information professional</h4></div>
            
            <div class="form-group">
                <label for="medicalReg" class="control-label col-xs-3">Médico:</label>
                <div class="col-xs-9">
                    <?php echo Form::number('medical_reg_no', '', $attributes = array('class' => 'form-control', 'id' => "medical_reg_no", 'placeholder' => 'Medical Reg No')); ?>
                    <span class="text-red"><?php echo $errors->first('medical_reg_no'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Centro:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('p_job', '', $attributes = array('class' => 'form-control', 'id' => "l_name", 'placeholder' => 'Present Job')); ?>
                    <span class="text-red"><?php echo $errors->first('p_job'); ?></span>
                </div>
            </div>


            <div class="form-group">
                <label for="medicalSpeciality" class="control-label col-xs-3">Especialidad:</label>
                <div class="col-xs-9">
                    <?php
                    $medical_speciality = array(
                            'General Medicine' => 'General Medicine',
                            'General Surgery'  => 'General Surgery',
                            'Gynecology'       => 'Gynecology',
                            'Pediatrics'       => 'Pediatrics',
                            'Anesthesiology'   => 'Anesthesiology',
                            'Psychiatry'       => 'Psychiatry'
                    );
                    echo Form::select('medical_speciality', $medical_speciality,'', $attributes = array('class' => 'form-control')); ?>
                    <span class="text-red"><?php echo $errors->first('medical_speciality'); ?></span>
                </div>
            </div>

            -->
            <div class=" form-group form_section_title "> <h4> Información de contacto</h4></div>

            <div class="form-group">
                <label for="inputPhone" class="control-label col-xs-3">Teléfono:</label>
                <div class="col-xs-9">
                    <?php echo Form::number('mobile', '', $attributes = array('class' => 'form-control', 'id' => "inputMobile", 'placeholder' => 'Mobile No')); ?>
                    <span class="text-red"><?php echo $errors->first('mobile'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="control-label col-xs-3">Email:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('email', '', $attributes = array('class' => 'form-control', 'id' => "inputEmail", 'placeholder' => 'Email ID')); ?>
                    <span class="text-red"><?php echo $errors->first('email'); ?></span>
                </div>
            </div>


            <div class=" form-group form_section_title "> <h4> Credenciales</h4></div>
            <!--
            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3">User Name:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('username', '', $attributes = array('class' => 'form-control', 'id' => "inputUsername", 'placeholder' => 'Username')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('patient_username'); ?></span>
                </div>
            </div>
            -->
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Contraseña:</label>
                <div class="col-xs-9">
                    <?php echo Form::password('password', array('class' => 'form-control', 'id' => "inputPassword")); ?>
                    <span class="text-red"><?php echo $errors->patient->first('patient_password'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Escribir contraseña de nuevo:</label>
                <div class="col-xs-9">
                    <?php echo Form::password('password', array('class' => 'form-control', 'id' => "inputPassword")); ?>
                    <span class="text-red"><?php echo $errors->patient->first('patient_password'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <?php echo Form::submit('Siguiente', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                </div>
            </div>
            <?php echo Form::close(); ?>
        </div>
        <div class="col-md-6 wow fadeInRightBig animated">
            <div class="tlmd_form_page_image">
                <img src="<?php echo e(URL::to('public/assets/frontend/img/doctor.jpg')); ?>"/>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front_end.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>