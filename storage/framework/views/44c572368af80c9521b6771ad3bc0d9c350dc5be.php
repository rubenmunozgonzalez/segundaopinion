<?php $__env->startSection('content'); ?>
<div style="padding-top: 150px; padding-bottom: 150px;">
    <h2>¡Gracias por registrarte!</h2> 
    <h3 style="margin-bottom: 100px">Ya puedes acceder a realizar la consulta.</h3>    
    <a class="btn btn-success" href="/consultas/create">Realizar consulta</a>
</div>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('front_end.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>