<!DOCTYPE html>
<html>
    <head>
         <?php echo $__env->make('admin.includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </head>
    <body class="login-page">
        <div class="login-box">
            <!-- Content Wrapper. Contains page content -->
                <?php echo $__env->yieldContent('content'); ?> 
        </div>
        <?php echo $__env->make('admin.includes.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>