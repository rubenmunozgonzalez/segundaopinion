<?php $__env->startSection('content'); ?>

    <div class="row  wow fadeInDown animated animated">
        <div class="col-md-10 col-md-offset-0 ">
            <div class="tlmd_inner_page_heading">
                <h1>Condiciones de uso de Segunda Opinión</h1>
                <p>Antes de continuar, debe aceptar las condiciones legales ligadas al servicio de Segunda Opinión</p>
                <hr>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 wow fadeInLeft animated">

            <?php echo Form::open(array('class' => "form-horizontal", 'route' => 'conditionsAccepted', 'files' => true))?>
            <div class=" form-group form_section_title "> <h4>1. GENERALIDADES</h4></div>
            <ul>
                <li>Clínica CEMTRO pone a disposición de los usuarios un servicio de Segunda Opinión Médica en la Especialidad de Traumatología, Ortopedia y Medicina Deportiva, y en otras especialidades médico quirúrgicas en las que Clínica CEMTRO sea referente. </li>

                <li>La Segunda Opinión Médica consiste en un nuevo informe médico en el que consta la apreciación de un profesional, distinto al que emitió el primer informe o diagnóstico médico, acerca de la patología sometida a su opinión, sin necesidad de una consulta presencial.</li>

                <li>El acceso a este apartado “Segunda Opinión Médica” se realiza a través de nuestra web y la posterior gestión se realiza desde una plataforma propiedad de la Clínica Cemtro.  Con su acceso usted reconoce y acepta las condiciones de uso y la política de privacidad publicados en nuestro sitio web. </li>

                <li>Los datos de carácter personal que usted facilite con ocasión de su consulta serán tratados con absoluta confidencialidad, solo para la finalidad con que se recaban. Serán conservados de acuerdo con los requisitos establecidos en la normativa sobre Protección de Datos de Carácter Personal, en particular la Ley 15/1999, de 13 de diciembre y su Reglamento.</li>
            </ul>
            <div class=" form-group form_section_title "> <h4>2. TÉRMINOS Y CONDICIONES</h4></div>
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
                <div class="col-xs-10">
                    <?php echo Form::checkbox('condiciones', null, null, array('id' => "condiciones"));?> Acepto las condiciones legales<br>
                    <?php echo Form::submit('Aceptar', array('class' => 'btn btn-primary btn-flat inside_body_submit')) ?>
                    <span class="text-red"><?php echo $errors->condiciones->first('condiciones'); ?></span>
                </div>
            </div>
            <div class="form-group">
                &nbsp;
            </div>
        </div>
        <?php echo Form::close(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
        $(document).on('change', 'select', function() {
            if ($('select[name=year_birth]').val() > '0' && $('select[name=month_birth]').val() > '0' && $('select[name=day_birth]').val() > '0') {
                $('input[name=age]').val(moment().diff($('select[name=year_birth]').val()+'-'+$('select[name=month_birth]').val()+'-'+$('select[name=day_birth]').val(), 'years'));
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front_end.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>