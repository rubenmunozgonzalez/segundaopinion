@extends('front_end.templates.default')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-4 wow fadeInDownBig animated">
        <div class="tlmd_inner_page_heading">
            <h1> FAQ for Patient</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            <hr>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 wow fadeInUp animated">
        <div class="tlmd_inner_page_body">
            <h4> 1. First Question ?</h4>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard
                dummy text ever since the 1500s, when an unknown printer 
                took a galley of type and scrambled it to make a type specimen 
                book. It has survived not only five centuries, but also
                the leap into electronic typesetting, remaining essentially 
                unchanged. It was popularised in the 1960s with the 
                release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing 
                software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>

            <h4> 2. Second Question ?</h4>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard
                dummy text ever since the 1500s, when an unknown printer 
                took a galley of type and scrambled it to make a type specimen 
                book. It has survived not only five 
            </p>

            <h4> 3. Third Question ?</h4>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard
                dummy text ever since the 1500s, when an unknown printer 
                took a galley of type and scrambled it to make a type specimen 
                book. It has survived not only five centuries, but also
                the leap into electronic typesetting, remaining essentially 
                unchanged. 
            </p>

            <h4> 4. Fourth Question ?</h4>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard
            dummy text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a type specimen 
            book. It has survived not only five centuries, but also
            the leap into electronic typesetting, remaining essentially 
            unchanged. 
            </p>

            <h4> 5. Fifth Question ?</h4>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard
            dummy text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a type specimen 
            book. It has survived not only five centuries, but also
            the leap into electronic typesetting, remaining essentially 
            unchanged. 
            </p>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-5 tlmd_signup_button  hvr-hang">
        <a href="<?php echo URL::route('signUpPatient',array('class' => 'inside_body_submit')); ?>"><i class="fa fa fa-user-plus"> Join US </i></a>
    </div>
</div>

<div style="padding-bottom:30px; "></div>
@stop
