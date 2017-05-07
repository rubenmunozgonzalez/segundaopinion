@extends('front_end.templates.default')
@section('content')

<h2 style="padding-top: 150px;">    
    Te has registrado correctamente. Verifica tu email para activar la cuenta</h2>
    <h1>&nbsp;</h1>
    <!--
    <a href="<?php echo URL::to('/signUpPatient') ?>" class="btn btn-danger pull-left">Volver al registro.</a>   
    -->
    <h1>&nbsp;</h1>
@endsection
@section('footer')
    <script>
      $(window).on('beforeunload', function() {
        $(window).on('unload', function() {
          window.location.href = '/signUpPatient';
        });

        return 'Not an empty string';
      });
    </script>
@stop

