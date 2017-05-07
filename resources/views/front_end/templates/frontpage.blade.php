<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    @include('front_end.includes.head')
    </head>
    <body style="overflow-x:hidden">
        <!--[if lt IE 7]>
            <p class="browsehappy">We are Extreamly sorry, But the browser you are using is probably from when civilization started. Which is way behind to view this site properly. Please update to a modern browser, At least a real browser. </p>
        <![endif]-->
        <div class="vjbbones-body" >        
            <!-- Add your site ******* or ******* application content here -->
            <div class="container">
                <header>
                    @include('front_end.includes.header')
                </header>
            </div><!-- end of the header -->

            <section class='tlmd-main-menu'>
                <div class='container'>
                    @include('front_end.includes.menu')
                </div><!--End of the container--> 
            </section>  <!-- end of the menu-->


            <!--<div class="container">-->
                <section>
                    <div class='container'>
                        @include('front_end.includes.slide_show')
                    </div>
                </section> <!-- End of the Upper massege section   
            <!--</div>  End of the Front massege -->

            <div class="container">
                <section>
                    @yield('content')
                </section><!-- End of the Body section -->
            </div> <!-- end of the body-->

            <footer>
               @include('front_end.includes.upper_footer')
            </footer><!-- End of the footer section-->

            <footer class="lower-footer">
                @include('front_end.includes.lower_footer')
            </footer>
            <!-- End Your site ******* or ******* application content here -->  

        </div><!-- vjbbones-body end here -->

        <!--####### site script content here ########-->
         @include('front_end.includes.foot')
    </body>
</html>
