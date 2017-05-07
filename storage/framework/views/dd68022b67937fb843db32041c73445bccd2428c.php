<?php $__env->startSection('content'); ?>

<h2 style="padding-top: 150px;">    
    Te has registrado correctamente. Verifica tu email para activar la cuenta</h2>
    <h1>&nbsp;</h1>
    <!--
    <a href="<?php echo URL::to('/signUpPatient') ?>" class="btn btn-danger pull-left">Volver al registro.</a>   
    -->
    <h1>&nbsp;</h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script>
      $(window).on('beforeunload', function() {
        $(window).on('unload', function() {
          window.location.href = '/signUpPatient';
        });

        return 'Not an empty string';
      });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('front_end.templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>