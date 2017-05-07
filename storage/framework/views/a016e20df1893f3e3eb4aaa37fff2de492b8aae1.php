<?php $__env->startSection('content'); ?>
    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="tlmd_inner_page_heading">
                <h1> Pide una segunda opinión</h1>
                <p>Registraté en nuestro sistema para poder crear una consulta on-line</p>
                <hr>
            </div>
        </div>
    </div>
    <?php echo Form::open(array('class' => "form-horizontal", 'id' => "registration", 'route' => 'addPatient', 'files' => true))?>
    <div class="row">
        <div class="col-md-6 wow fadeInLeft animated">


            <div class=" form-group  form_section_title"> <h4> Información personal</h4></div>

            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Nombre:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('nombre', '', $attributes = array('class' => 'form-control', 'id' => "f_name", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Nombre')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('nombre'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Primer apellido:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('apellido_1', '', $attributes = array('class' => 'form-control', 'id' => "l_name_1", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Primer apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('apellido_1'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-xs-4"> Segundo apellido:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('apellido_2', '', $attributes = array('class' => 'form-control', 'id' => "l_name_2", 'pattern' => '([A-Za-záéíóúñ\- ]+)', 'placeholder' => ' Segundo apellido')); ?>
                    <span class="text-red"><?php echo $errors->patient->first('apellido_2'); ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="patient_gender" class="col-xs-4">Sexo:</label>
                <div class="col-xs-8">
                    <div class="col-sm-8">
                        <div class="radio">
                           <div class="col-xs-6">
                                <?php  echo Form::radio('sexo', 'male');?>
                                Hombre
                            </div>
                            <div class="col-xs-6">
                                <?php  echo Form::radio('sexo', 'female');?>
                                Mujer
                            </div>
                        </div>
                    </div>
                    <span class="text-red"><?php echo $errors->patient->first('sexo'); ?></span>
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
                    <!--<span class="text-red"><?php echo $errors->patient->first('month_birth'); ?></span>-->
                </div>
            </div>
            <div class="form-group">
                <label for="patient_age" class="col-xs-4">Edad:</label>
                <div class="col-xs-8">
                    <div class="col-xs-4">
                        <?php  echo Form::text('edad', null, $attributes = array('class' => 'form-control', 'readonly' => 'readonly'));?>
                    </div>
                    <span class="help-block">Mayor de 16 años</span>
                    <span class="text-red"><?php echo $errors->patient->first('edad'); ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nationalId" class="col-xs-4">DNI/NIE/Pasaporte:</label>
                <div class="col-xs-8">
                    <?php echo Form::text('nidno', '', $attributes = array('class' => 'form-control', 'id' => "inputNID", 'pattern' => '(([A-Z]{1,3})([-]?)(\d{6,9})([-]?)([A-Z]{1,2}))|((\d{8})([-]?)([A-Za-z]{1}))', 'placeholder' => 'Documento Nacional de Identidad/Pasaporte')); ?>
                    <span class="help-block">Ejemplo: DNI: 12345678-A<br/>
                                             Ejemplo: NIE: X-1234567B<br/>
                                             Ejemplo: Pasaporte: ABC123456789-EF</span>
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
                    <?php echo Form::password('repeat_password', array('class' => 'form-control', 'id' => "inputPassword", 'oninput' => "check(this)")); ?>
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
                <img style='height: 900px' src="<?php echo e(URL::to('public/assets/frontend/img/doctor.jpg')); ?>"/>
        </div>
    </div>
    <div id="conditions_modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header form_section_title">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Condiciones de uso de Segunda Opinión</h4>
              <p>Antes de continuar, debe aceptar las condiciones legales ligadas al servicio de Segunda Opinión</p>
            </div>
            <div class="modal-body">
              <div class=" form-group  "> <h4>1. GENERALIDADES</h4></div>
              <ul>
                  <li>Clínica CEMTRO pone a disposición de los usuarios un servicio de Segunda Opinión Médica en la Especialidad de Traumatología, Ortopedia y Medicina Deportiva, y en otras especialidades médico quirúrgicas en las que Clínica CEMTRO sea referente. </li>

                  <li>La Segunda Opinión Médica consiste en un nuevo informe médico en el que consta la apreciación de un profesional, distinto al que emitió el primer informe o diagnóstico médico, acerca de la patología sometida a su opinión, sin necesidad de una consulta presencial.</li>

                  <li>El acceso a este apartado “Segunda Opinión Médica” se realiza a través de nuestra web y la posterior gestión se realiza desde una plataforma propiedad de la Clínica Cemtro.  Con su acceso usted reconoce y acepta las condiciones de uso y la política de privacidad publicados en nuestro sitio web. </li>

                  <li>Los datos de carácter personal que usted facilite con ocasión de su consulta serán tratados con absoluta confidencialidad, solo para la finalidad con que se recaban. Serán conservados de acuerdo con los requisitos establecidos en la normativa sobre Protección de Datos de Carácter Personal, en particular la Ley 15/1999, de 13 de diciembre y su Reglamento.</li>
              </ul>
              <div class=" form-group "> <h4>2. TÉRMINOS Y CONDICIONES</h4></div>
              <ul>
                  <li>La solicitud del Servicio de Segunda Opinión Médica solo puede hacerse por un paciente mayor de 16 años. En el caso de menores o de personas incapacitadas, por los padres o representantes legales, previa acreditación suficiente de la representación.</li>

                  <li>La conversación mediante el sistema de tickets (preguntas y respuestas, hasta dos por pago y consulta) en el que se basa el sistema de la segunda opinión médica, tiene carácter meramente informativo, carece de la validez de un informe médico y de la consideración de diagnóstico médico.</li>

                  <li>El paciente debe facilitar una información veraz, exacta y concreta sobre la cuestión sometida o consulta. La respuesta que el especialista facilite sobre la consulta formulada estará condicionado por la información facilitada.</li>

                  <li>Clínica CEMTRO se reserva el derecho de aceptar o rechazar la consulta del paciente en un plazo no superior a quince días hábiles. En caso de no aceptación de la consulta, se procederá a la devolución del importe abonado por la misma.</li>


                  <li>El usuario podrá realizar la consulta seleccionando la especialidad y el equipo médico al que consulta, exponiendo su situación y respondiendo a las preguntas concretas que se hacen en el formulario de contacto. Inclusive también tiene la posibilidad de adjuntar archivos (Existe un tamaño máximo de los archivos que pueden cargarse, por lo que deberá optimizar su tamaño para adjuntarlos en su consulta). Con la realización del pago por parte del usuario, se cursará la consulta al equipo médico. Con la aceptación de la consulta por parte del médico, se procederá a la primera respuesta que se notificará por correo electrónico, con un enlace al sistema de consultas privado. </li>

                  <li>El Servicio de Segunda Opinión Médica tiene un coste de 80€ por consulta. En el caso de que Clínica CEMTRO acepte la consulta, el paciente recibirá un correo electrónico de confirmación de la misma y con un enlace de la primera respuesta del especialista en referencia a su caso, la cual podrá ser consultada o respondida por el usuario del servicio, obteniendo otra nueva respuesta por parte del especialista. En caso de querer reabrir la conversación por parte del usuario, se deberían depositar de nuevo 80€ para tener otro sistema de dos preguntas y dos respuestas del especialista. </li>

                  <li>En caso de que se precisase evaluar detenidamente archivos en otros formatos distintos a los aceptados por la plataforma, o con un tamaño superior al límite de la misma, se le solicitará que lo envíe a Clínica CEMTRO, a la atención del doctor/a a cargo de su caso, mediante un servicio de mensajería. </li>

                  <li>El intercambio de información entre el paciente y Clínica CEMTRO se hará de forma encriptada a fin de preservar la seguridad y la confidencialidad de los datos contenidos en la información navegando en protocolo HTTPS.</li>

                  <li>La consulta formulada por el paciente y la información sobre la misma emitida por Clínica CEMTRO, se conservará y custodiará por ésta de conformidad con lo establecido por las normas legales al respecto de la documentación clínica.</li>

                  <li>Con la segunda respuesta del especialista queda finalizada la consulta. Cualquier cuestión que se quiera plantear sobre la misma tendrá la consideración de nueva consulta a todos los efectos. </li>
              <div class="form-group">
                  &nbsp;
              </div>
              <div class="form-group">
                    <?php echo Form::checkbox('condiciones', null, null, array('id' => "condiciones"));?> Acepto las condiciones legales<br>
                    <?php echo Form::submit('Aceptar', array('class' => 'btn btn-primary btn-flat inside_body_submit')) ?>
                    <span class="text-red"><?php echo $errors->patient->first('condiciones'); ?></span>
              </div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php echo Form::close(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        $(document).on('change', 'select', function() {
            if ($('select[name=year_birth]').val() > '0' && $('select[name=month_birth]').val() > '0' && $('select[name=day_birth]').val() > '0') {
                $('input[name=edad]').val(moment().diff($('select[name=year_birth]').val()+'-'+$('select[name=month_birth]').val()+'-'+$('select[name=day_birth]').val(), 'years'));
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
        <?php if(!Session::has('condiciones')): ?>
            $('#registration').submit(function(event) {
                $('#conditions_modal').modal('show');
                $('#condiciones').attr('required', 'required');
                $('#registration').unbind('submit');
                event.preventDefault();
            });
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front_end.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>