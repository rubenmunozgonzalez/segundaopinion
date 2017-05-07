@extends('front_end.templates.default')
@section('content')

    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-6 col-md-offset-4 ">
            <div class="tlmd_inner_page_heading">
                <h1> Pide una segunda opinión</h1>
                <p>Nuestros especialistas pueden aconsejarte sobre tu caso</p>
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
                    <?php echo Form::text('f_name', '', $attributes = array('class' => 'form-control', 'id' => "f_name", 'pattern' => '([A-Za-záéíóúñ\-]+)', 'placeholder' => ' Nombre')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('f_name'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Primer apellido:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('l_name_1', '', $attributes = array('class' => 'form-control', 'id' => "l_name_1", 'pattern' => '([A-Za-záéíóúñ\-]+)', 'placeholder' => ' Primer apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('l_name_1'); ?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Segundo apellido:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('l_name_2', '', $attributes = array('class' => 'form-control', 'id' => "l_name_2", 'pattern' => '([A-Za-záéíóúñ\-]+)', 'placeholder' => ' Segundo apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('l_name_2'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="patient_gender" class="col-xs-4">Sexo:</label>
                <div class="col-xs-8">
                    <div class="col-sm-8">
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
                    <span class="text-red"><?php echo $errors->patient->first('age'); ?></span>
                </div>
            </div> 
            <div class="form-group">
                <label for="nationalId" class="col-xs-4">DNI/Pasaporte:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('nidno', '', $attributes = array('class' => 'form-control', 'id' => "inputNID", 'pattern' => '(([A-Z]{3})([-]?)(\d{6})([-]?)([A-Z]?))|((\d{8})([-]?)([A-Za-z]{1}))', 'placeholder' => 'Documento Nacional de Identidad/Pasaporte')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('nidno'); ?></span>
                </div>
            </div>            
            <div class=" form-group form_section_title "> <h4> Información de contacto</h4></div>

            <div class="form-group">
                <label for="inputPhone" class="col-xs-4">Teléfono:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('movil', '', $attributes = array('class' => 'form-control', 'id' => "inputMobile", 'placeholder' => 'Número de teléfono móvil')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('movil'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-xs-4">Email:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('email', '', $attributes = array('class' => 'form-control', 'id' => "inputEmail", 'placeholder' => 'Dirección de email')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('email'); ?></span>
                </div>
            </div>
            <div class=" form-group form_section_title "> <h4> Credenciales</h4></div>            
            <div class="form-group">
                <label for="inputPassword" class="col-xs-4">Contraseña:</label>
                <div class="col-xs-8">
                    <?php echo Form::password('password', array('class' => 'form-control', 'id' => "inputPassword")); ?>
                    <span class="text-red"><?php echo $errors->patient->first('password'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-xs-4">Repita contraseña:</label>
                <div class="col-xs-8">
                    <?php echo Form::password('repeat_password', array('class' => 'form-control', 'id' => "inputPassword")); ?>
                    <span class="text-red"><?php echo $errors->patient->first('repeat_password'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-offset-4 col-xs-8">
                    <?php echo Form::submit('Siguiente', array('class' => 'btn btn-primary btn-block btn-flat inside_body_submit')) ?>
                </div>
            </div>
            
            <div class="form-group">
                &nbsp;
            </div>            
        </div>
        <div class="col-md-6 wow fadeInRightBig animated">
            <div class="tlmd_form_page_image">
                <img src="{{URL::to('public/assets/frontend/img/doctor.jpg')}}"/>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title" id="exampleModalLabel">Condiciones legales</h2>
                  <!--
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  -->
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <?php  echo Form::checkbox('accept_conditions', null, null, array('id' => "accept_conditions"));?> Acepto las condiciones legales
                  <button type="button" onclick="if($('#accept_conditions').is(':checked')) { $('#myModal').modal('hide'); }" class="btn btn-primary">Aceptar</button>            
                </div>
              </div>
            </div>
        </div>
        <?php echo Form::close(); ?>
    </div>    
@endsection
@section('footer')
    <script>
        $(document).on('change', 'select', function() {
            if ($('select[name=year_birth]').val() > '0' && $('select[name=month_birth]').val() > '0' && $('select[name=day_birth]').val() > '0') {
                $('input[name=age]').val(moment().diff($('select[name=year_birth]').val()+'-'+$('select[name=month_birth]').val()+'-'+$('select[name=day_birth]').val(), 'years'));
            }
        });
        if (!if($('#accept_conditions').is(':checked'))) {
            $('#myModal').modal('show');
        }
    </script>
@endsection