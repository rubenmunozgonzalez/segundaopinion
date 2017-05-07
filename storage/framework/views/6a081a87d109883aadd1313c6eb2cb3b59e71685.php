<div class="row">
    <div class="col-md-6 col-xs-3 ">
        <div class="logo">
            <a href="<?php echo URL::route('homePage'); ?>">
                <img src="<?php echo e(URL::to('public/assets/frontend/img/logo.png')); ?>"  alt="Logo">
            </a>
        </div>
    </div><!-- End of the logo -->


    <? if(Auth::guest()) { ?>
    <div class="col-md-6 col-xs-9">
        <div class="row header_sign_in">
            <div class="col-md-8 col-xs-6 ">
                <div class="pull-right hvr-float-shadow sign_in ">
                    <a href="<?php echo URL::route('signIn'); ?>"><i class="fa fa-sign-in"></i>  Entrar</a>
                </div>
            </div>
            <div class="col-md-4 col-xs-6 ">
                <div class="pull-left hvr-float-shadow join ">
                    <a href="<?php echo URL::route('signUpPatient'); ?>"><i class="fa fa-user-plus"></i> Realizar consulta</a>
                </div>
            </div>
        </div>
    </div>
    <? } else { ?>
    <div class="col-md-6 col-xs-9">
        <div class="row header_sign_in">
            <div class="col-md-8 col-xs-6 ">
                <div class="pull-right">
                    &nbsp;
                </div>
            </div>
            <div class="col-md-4 col-xs-6 ">
                <div class="pull-left hvr-float-shadow join ">
                    <a href="<?php echo URL::route('logout'); ?>"><i class="fa fa-sign-in"></i>  Salir</a>
                </div>
            </div>
        </div>
    </div>
    <? } ?>
</div>
