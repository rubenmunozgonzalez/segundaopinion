 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src=" <?php echo e(URL::asset('public/assets/frontend/js/vendor/jquery-1.10.2.min.js')); ?>"><\/script>')</script>
        
        <script src="<?php echo e(URL::asset('public/assets/frontend/js/wow.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/assets/frontend/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/assets/frontend/js/plugins.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/assets/frontend/js/vjbones-main.js')); ?>"></script>  

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                //********my code**************//  
               new WOW().init();
            });//jQuery end 
        </script>  
        <!--####### site script end  here ########--> 

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = '//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X');
            ga('send', 'pageview');
            
        </script>