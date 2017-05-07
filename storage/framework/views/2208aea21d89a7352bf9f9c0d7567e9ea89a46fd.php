<?php $__env->startSection('page', trans('ticketit::admin.agent-create-title')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-6 col-md-offset-4 ">
            <div class="tlmd_inner_page_heading">
                <h1> Nuevo paciente</h1>
                <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>-->
                <hr>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 wow fadeInLeft animated">

            <?php echo Form::open(array('class' => "form-horizontal", 'route' => 'addPatient', 'files' => true))?>

            <div class=" form-group form_section_title "> <h4> Información personal</h4></div>

            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Nombre:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('f_name', '', $attributes = array('class' => 'form-control', 'id' => "f_name", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Nombre')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('f_name'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Primer apellido:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('l_name_1', '', $attributes = array('class' => 'form-control', 'id' => "l_name_1", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Primer apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('l_name_1'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Segundo apellido:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('l_name_2', '', $attributes = array('class' => 'form-control', 'id' => "l_name_2", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Segundo apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('l_name_2'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="patient_gender" class="col-xs-4">Sexo:</label>
                <div class="col-xs-8">
                    <div class="col-sm-6">
                        <div class="radio">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php  echo Form::radio('gender', 'male');?>
                                    Hombre
                                </div>
                                <div class="col-xs-6">
                                    <?php  echo Form::radio('gender', 'female');?>
                                    Mujer
                                </div>
                            </div>
                        </div>
                        <span class="text-red"><?php echo $errors->patient->first('gender'); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="patient_birthdate" class="col-xs-4">Fecha nacimiento:</label>
                <div class="col-xs-8">
                    <div class="col-xs-2">
                        <?php echo Form::select('day_birth', array_merge([0 => '--'], range(1,31)), $attributes = array('class' => 'form-control'));?>                                
                    </div>
                    <div class="col-xs-5">                        
                        <?php                            
                            $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];                            
                        ?>
                        <?php echo Form::select('month_birth', array_merge([0 => '--'], $months), $attributes = array('class' => 'form-control'));?>                                
                    </div>
                    <div class="col-xs-3">
                        <?php  echo Form::select('year_birth', [0 => '--'] + array_combine($r = range(date('Y') - 100, date('Y')), $r) ,$attributes = array('class' => 'form-control'));?>
                    </div>                      
                    <span class="text-red"><?php echo $errors->patient->first('month_birth'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="patient_age" class="col-xs-4">Edad:</label>
                <div class="col-xs-8">                    
                    <div class="col-xs-4">
                        <?php  echo Form::text('age', null, $attributes = array('class' => 'form-control', 'readonly' => 'readonly'));?>                                
                    </div>                      
                    <span class="help-block">Mayor de 16 años</span>
                    <span class="text-red"><?php echo $errors->patient->first('age'); ?></span>
                </div>
            </div> 
            <div class="form-group">
                <label for="nationalId" class="col-xs-4">DNI/NIE/Pasaporte:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('nidno', '', $attributes = array('class' => 'form-control', 'id' => "inputNID", 'pattern' => '(([A-Z]{1,3})([-]?)(\d{6,9})([-]?)([A-Z]{1,2}))|((\d{8})([-]?)([A-Za-z]{1}))', 'placeholder' => ' Documento Nacional de Identidad ')); ?>
                    <span class="help-block">Ejemplo: DNI: 12345678-A<br/>               
                                             Ejemplo: NIE: X-1234567B<br/>
                                             Ejemplo: Pasaporte: ABC123456789-EF</span>
                    <span class="text-red"><?php echo $errors->patient->first('nidno'); ?></span>
                </div>
            </div>                   
            <div class=" form-group form_section_title "> <h4> Información general</h4></div>
            <div class="form-group">
                <label for="inputPhone" class="col-xs-4">Teléfono:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('movil', '', $attributes = array('class' => 'form-control', 'id' => "inputMobile", 'placeholder' => ' Número de teléfono')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('movil'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-xs-4">Email:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('email', '', $attributes = array('class' => 'form-control', 'id' => "inputEmail", 'placeholder' => ' Dirección de email')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('email'); ?></span>
                </div>
            </div>
            <div class=" form-group form_section_title "> <h4> Información de la cuenta</h4></div>
            <div class="form-group">
                <label for="inputPassword" class="col-xs-4">Contraseña:</label>
                <div class="col-xs-8">
                    <?php echo Form::password('password', array('class' => 'form-control', 'id' => "inputPassword")); ?>
                    <span class="text-red"><?php echo $errors->patient->first('password'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword" class="col-xs-4"> Confirmar contraseña:</label>
                <div class="col-xs-8">
                    <?php echo Form::password('repeat_password', array('class' => 'form-control', 'id' => "inputConfirmPassword")); ?>
                    <span class="text-red"><?php echo $errors->patient->first('repeat_password'); ?></span>
                </div>
            </div>


            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <?php echo Form::submit('Registrar', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                </div>
            </div>
            
            <?php echo Form::close(); ?>
        </div>  
        <div class="col-md-6 wow fadeInRightBig animated">            
            <img style='height: 900px' src="<?php echo e(URL::to('public/assets/frontend/img/doctor.jpg')); ?>"/>
        </div>  
    </div>
<?php $__env->startSection('footer'); ?>
    <script>
        $(document).on('change', 'select', function() {
            if ($('select[name=year_birth]').val() > '0' && $('select[name=month_birth]').val() > '0' && $('select[name=day_birth]').val() > '0') {
                $('input[name=age]').val(moment().diff($('select[name=year_birth]').val()+'-'+$('select[name=month_birth]').val()+'-'+$('select[name=day_birth]').val(), 'years'));
            }
        });      
        
        function check(input) {
            if (input.value != document.getElementById('inputPassword').value) {
                input.setCustomValidity('Password Must be Matching.');
            } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>