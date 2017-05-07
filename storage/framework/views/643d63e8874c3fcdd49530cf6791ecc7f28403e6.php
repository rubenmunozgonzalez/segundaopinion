<?php $__env->startSection('page', trans('ticketit::admin.agent-create-title')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('ticketit::shared.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><?php echo e(trans('ticketit::admin.agent-create-title')); ?></h2>
        </div>
        <?php if($users->isEmpty()): ?>
            <h3 class="text-center"><?php echo e(trans('ticketit::admin.agent-create-no-users')); ?></h3>
        <?php else: ?>
            <?php echo CollectiveForm::open(['route'=> $setting->grab('admin_route').'.agent.store', 'method' => 'POST', 'class' => 'form-horizontal']); ?>

            <div class="panel-body">
                <?php echo e(trans('ticketit::admin.agent-create-select-user')); ?>

            </div>
            <table class="table table-hover">
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <?php echo link_to_route($setting->grab('admin_route').'.agent.index', trans('ticketit::admin.btn-back'), null, ['class' => 'btn btn-default']); ?>

                            <?php echo CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']); ?>

                        </td>
                    </tr>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input name="agents[]" type="checkbox" value="<?php echo e($user->id); ?>" <?php echo $user->ticketit_agent ? "checked" : ""; ?>> <?php echo e($user->l_name_1); ?> <?php echo e($user->l_name_2); ?>

                                </label>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo CollectiveForm::close(); ?>

        <?php endif; ?>        
    </div>
    <?php echo $users->render(); ?>

    -->
    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-6 col-md-offset-4 ">
            <div class="tlmd_inner_page_heading">
                <h1> Nuevo especialista</h1>
                <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>-->
                <hr>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 wow fadeInLeft animated">

            <?php echo Form::open(array('class' => "form-horizontal", 'route' => 'addDoctor', 'files' => true))?>

            <div class=" form-group form_section_title "> <h4> Información personal</h4></div>

            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Nombre:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('f_name', '', $attributes = array('class' => 'form-control', 'id' => "f_name", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Nombre')); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('f_name'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Primer apellido:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('l_name_1', '', $attributes = array('class' => 'form-control', 'id' => "l_name_1", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Primer apellido')); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('l_name_1'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Segundo apellido:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('l_name_2', '', $attributes = array('class' => 'form-control', 'id' => "l_name_2", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Segundo apellido')); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('l_name_2'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="patient_gender" class="control-label col-xs-3">Sexo:</label>
                <div class="col-xs-9">
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
                        <span class="text-red"><?php echo $errors->doctor->first('gender'); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nationalId" class="control-label col-xs-3">DNI/NIE/Pasaporte:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('nidno', '', $attributes = array('class' => 'form-control', 'id' => "inputNID", 'pattern' => '(([A-Z]{1,3})([-]?)(\d{6,9})([-]?)([A-Z]{1,2}))|((\d{8})([-]?)([A-Za-z]{1}))', 'placeholder' => ' Documento Nacional de Identidad ')); ?>
                    <span class="help-block">Ejemplo: DNI: 12345678-A<br/>               
                                             Ejemplo: NIE: X-1234567B<br/>
                                             Ejemplo: Pasaporte: ABC123456789-EF</span>
                    <span class="text-red"><?php echo $errors->doctor->first('nidno'); ?></span>
                </div>
            </div>
            <!--
            <div class="form-group">
                <label for="inputBiography" class="control-label col-xs-3"> Especialidades: </label>
                <div class="col-xs-9">
                    <?php foreach($categories as $category): ?>
                        <?php  echo Form::checkbox('agent_cats[]', null, null, array());?> <?php echo $category->name; ?>

                    <?php endforeach; ?>
                    <span class="text-red"><?php echo $errors->doctor->first('about'); ?></span>
                </div>
            </div>  
            -->
            <div class="form-group">
                <label for="inputBiography" class="control-label col-xs-3"> Unidades: </label>
                <div class="col-xs-9">
                    <?php foreach($units as $unit): ?>
                        <?php  echo Form::checkbox('agent_cats[]', $unit->id, null, array());?> <?php echo $unit->name; ?>

                    <?php endforeach; ?>
                    <span class="text-red"><?php echo $errors->doctor->first('agent_cats'); ?></span>
                </div>
            </div>  
            <div class=" form-group form_section_title "> <h4> Información profesional</h4></div>
            <div class="form-group">
                <label for="medicalReg" class="control-label col-xs-3">ID Profesional:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('medical_reg_no', '', $attributes = array('class' => 'form-control', 'id' => "medical_reg_no", 'placeholder' => ' Número de registro de médico')); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('medical_reg_no'); ?></span>
                </div>
            </div>            
            <div class=" form-group form_section_title "> <h4> Información general</h4></div>
            <div class="form-group">
                <label for="inputPhone" class="control-label col-xs-3">Teléfono:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('movil', '', $attributes = array('class' => 'form-control', 'id' => "inputMobile", 'placeholder' => ' Número de teléfono')); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('movil'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="control-label col-xs-3">Email:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('email', '', $attributes = array('class' => 'form-control', 'id' => "inputEmail", 'placeholder' => ' Dirección de email')); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('email'); ?></span>
                </div>
            </div>
            <div class=" form-group form_section_title "> <h4> Información de la cuenta</h4></div>
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-3">Contraseña:</label>
                <div class="col-xs-9">
                    <?php echo Form::password('password', array('class' => 'form-control', 'id' => "inputPassword")); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('password'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword" class="control-label col-xs-3"> Confirmar contraseña:</label>
                <div class="col-xs-9">
                    <?php echo Form::password('repeat_password', array('class' => 'form-control', 'id' => "inputConfirmPassword")); ?>
                    <span class="text-red"><?php echo $errors->doctor->first('repeat_password'); ?></span>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make($master, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>