<div class="row">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?php echo e(URL::to('public/assets/frontend/img/slide/slide1.jpg')); ?>" width="100%" alt="...">
                    <div class="carousel-caption">
                        <h1 class="wow bounceInRight animated"> Primera imagen</h1>
                        <p> Some description here </p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo e(URL::to('public/assets/frontend/img/slide/slide2.jpg')); ?>" width="100%" alt="...">
                    <div class="carousel-caption">
                        <h1 class="wow bounceInLeft animated"> Segunda imagen</h1>
                        <p> Some description here </p>
                    </div>
                </div>
                 <div class="item">
                    <img src="<?php echo e(URL::to('public/assets/frontend/img/slide/slide3.jpg')); ?>" width="100%"alt="...">
                    <div class="carousel-caption">
                       <h1 class="wow bounceInDown animated"> Tercera imagen</h1>
                       <p> Some description here </p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

