@extends($master)
@section('page', trans('ticketit::admin.agent-create-title'))

@section('content')
    @include('ticketit::shared.header')    
    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-6 col-md-offset-4 ">
            <div class="tlmd_inner_page_heading">
                <h1> Editar paciente</h1>
                <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>-->
                <hr>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 wow fadeInLeft animated">

            <?php echo Form::open(array('class' => "form-horizontal", 'route' => 'updatePatient'))?>
            <?php echo Form::hidden('id', $user->id) ?>
            <div class=" form-group form_section_title "> <h4> Información personal</h4></div>

            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Nombre:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('f_name', $user->name, $attributes = array('class' => 'form-control', 'id' => "f_name", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Nombre')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('f_name'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Primer apellido:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('l_name_1', $user->l_name_1, $attributes = array('class' => 'form-control', 'id' => "l_name_1", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Primer apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('l_name_1'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputText" class="control-label col-xs-3"> Segundo apellido:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('l_name_2', $user->l_name_2, $attributes = array('class' => 'form-control', 'id' => "l_name_2", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Segundo apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('l_name_2'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="patient_gender" class="control-label col-xs-3">Edad:</label>
                <div class="col-xs-9">
                    <div class="col-sm-6">
                        <?php echo Form::text('age', Carbon::parse($user->birthdate)->diff(Carbon::now())->format('%y'), $attributes = array('class' => 'form-control', 'id' => "age", 'readonly' => 'readonly', 'placeholder' => ' Edad')); ?>
                        <span class="text-red"><?php echo $errors->patient->first('age'); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="patient_gender" class="control-label col-xs-3">Sexo:</label>
                <div class="col-xs-9">
                    <div class="col-sm-6">
                        <div class="radio">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php  echo Form::radio('gender', 'male', $user->gender == 'male'?true:false);?>
                                    Hombre
                                </div>
                                <div class="col-xs-6">
                                    <?php  echo Form::radio('gender', 'female', $user->gender == 'female'?true:false);?>
                                    Mujer
                                </div>
                            </div>
                        </div>
                        <span class="text-red"><?php echo $errors->patient->first('gender'); ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nationalId" class="control-label col-xs-3">DNI/NIE/Pasaporte:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('nidno', $user->nid, $attributes = array('class' => 'form-control', 'id' => "inputNID", 'pattern' => '(([A-Z]{1,3})([-]?)(\d{6,9})([-]?)([A-Z]{1,2}))|((\d{8})([-]?)([A-Za-z]{1}))', 'placeholder' => ' Documento Nacional de Identidad ')); ?>
                    <span class="help-block">Ejemplo: DNI: 12345678-A<br/>               
                                             Ejemplo: NIE: X-1234567B<br/>
                                             Ejemplo: Pasaporte: ABC123456789-EF</span>
                    <span class="text-red"><?php echo $errors->patient->first('nidno'); ?></span>
                </div>
            </div>                      
            <div class=" form-group form_section_title "> <h4> Información general</h4></div>
            <div class="form-group">
                <label for="inputPhone" class="control-label col-xs-3">Teléfono:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('movil', $user->mobile, $attributes = array('class' => 'form-control', 'id' => "inputMobile", 'placeholder' => ' Número de teléfono')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('movil'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="control-label col-xs-3">Email:</label>
                <div class="col-xs-9">
                    <?php echo Form::text('email', $user->email, $attributes = array('class' => 'form-control', 'id' => "inputEmail", 'placeholder' => ' Dirección de email')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('email'); ?></span>
                </div>
            </div>            

            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <?php echo Form::submit('Guardar', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                </div>
            </div>
            
            <?php echo Form::close(); ?>
        </div>  
        <div class="col-md-6 wow fadeInRightBig animated">            
            <img style='height: 900px' src="{{URL::to('public/assets/frontend/img/doctor.jpg')}}"/>
        </div>  
    </div>
@stop
