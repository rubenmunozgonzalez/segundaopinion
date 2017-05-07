<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style type="text/css">
      @import  url(http://fonts.googleapis.com/css?family=Droid+Sans);

      img {
        max-width: 600px;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
    }

    a {
        text-decoration: none;
        border: 0;
        outline: none;
        color: #bbbbbb;
    }

    a img {
        border: none;
    }

    td, h1, h2, h3  {
        font-family: Helvetica, Arial, sans-serif;
        font-weight: 400;
    }

    td {
        text-align: center;
    }

    body {
        -webkit-font-smoothing:antialiased;
        -webkit-text-size-adjust:none;
        width: 100%;
        height: 100%;
        color: <?php echo e($setting->grab('email.color_body_bg')); ?>;
        background: #ffffff;
        font-size: 16px;
    }

    table {
        border-collapse: collapse !important;
    }

    .subject {
        color: #ffffff;
        font-size: 36px;
    }

    .force-full-width {
      width: 100% !important;
  }

</style>

<style type="text/css" media="screen">
  @media  screen {
    td, h1, h2, h3 {
      font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
  }
}
</style>

<style type="text/css" media="only screen and (max-width: 480px)">
    @media  only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
    }
}
</style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#fff; -webkit-text-size-adjust:none" bgcolor="#fff">
    <br>
    <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
      <tr>
        <td align="center" valign="top" bgcolor="#fff"  width="100%">
          <center>
            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
              <tr>
                <td align="center" valign="top">

              <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="<?php echo e($setting->grab('email.color_header_bg')); ?>">
                <tr>
                    <td class="subject">
                    <br>
                        <?php echo $__env->yieldContent('subject'); ?>
                  </td>
              </tr>
              <tr>
                <td>

                  <center>
                    <table cellpadding="0" cellspacing="0" width="80%">
                      <tr>
                        <td style="margin: 20px; text-align: left color:#187272;" align="left">
                            <br>
                            <?php echo $__env->yieldContent('content'); ?>
                            <br>
                            <br>
                        </td>
                    </tr>
                </table>
            </center>

        </td>
    </tr>
</table>

<table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="<?php echo e($setting->grab('email.color_content_bg')); ?>">
<tr>
    <td>

      <center>
        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
          <tr>
            <td style="color:#933f24;">
            <br>
                <?php echo $__env->yieldContent('link'); ?>
            <br><br>
          </td>
      </tr>
      <tr>
          <td style="color:#933f24;">
              <?php echo e($setting->grab('email.signoff')); ?><br>
              <?php echo e($setting->grab('email.signature')); ?>

              <br><br>
          </td>
      </tr>
  </table>
</center>

</td>
</tr>
<tr>
    <td>
                      <div><!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="<?php echo e($setting->grab('email.color_button_bg')); ?>">
                          <w:anchorlock/>
                          <center>
                            <![endif]-->
                            <a href="<?php echo e(url($setting->grab('admin_route'))); ?>"
                            style="background-color:<?php echo e($setting->grab('email.color_button_bg')); ?>;border-radius:4px;color:#ffffff;display:inline-block;font-family: Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;"><?php echo e($setting->grab('email.dashboard')); ?></a>
                        <!--[if mso]>
                          </center>
                        </v:roundrect>
                        <![endif]--></div>
                        <br>
                        <br>
                    </td>
                </tr>
            </table>

            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="<?php echo e($setting->grab('email.color_footer_bg')); ?>" style="margin: 0 auto">
              <tr>
                <td style="background-color:<?php echo e($setting->grab('email.color_footer_bg')); ?>;">
                    <br>
                    <br>
                      <?php if( (bool) $setting->grab('email.google_plus_link') ): ?>
                        <a href="<?php echo e($setting->grab('email.google_plus_link')); ?>"><img src="https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4" alt="google+"></a>
                      <?php endif; ?>
                      <?php if( (bool) $setting->grab('email.facebook_link') ): ?>
                        <a href="<?php echo e($setting->grab('email.facebook_link')); ?>"><img src="https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt" alt="facebook"></a>
                      <?php endif; ?>
                      <?php if( (bool) $setting->grab('email.twitter_link') ): ?>
                        <a href="<?php echo e($setting->grab('email.twitter_link')); ?>"><img src="https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe" alt="twitter"></a>
                      <?php endif; ?>
                    <br>
                    <br>
                </td>
            </tr>
            <!-- Not implemented
            <tr>
                <td style="color:#bbbbbb; font-size:12px;">
                  <a href="#">View in browser</a> | <a href="#">Unsubscribe</a> | <a href="#">Contact</a>
                  <br><br>
              </td>
          </tr>
          -->
          <tr>
            <td style="color:#933f24; font-size:12px;">
             <a href="<?php echo e($setting->grab('email.footer_link')); ?>">
                <?php echo e($setting->grab('email.footer')); ?>

             </a>
             <br>
             <br>
         </td>
     </tr>
 </table>





</td>
</tr>
</table>
</center>
</td>
</tr>
</table>
</body>
</html>
