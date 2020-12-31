@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Términos y Condiciones
@stop


@section('terminos')
    <div class="site-section" id="about-section" style="padding-top: 10em;">
      <div class="container">


        <div class="row align-items-lg-center">
          <div class="col-md-2 mb-5 mb-lg-0 position-relative">

          </div>
          <div class="col-md-10 ml-auto">
            <h3 class="section-sub-title">infórmate más</h3>
            <h2 class="section-title mb-3">Términos y Condiciones</h2>
              <p class="mb-4"> {{ $info->nosotros }} </p>
            <p>
          </div>
        </div>
        

      </div>
    </div>

@stop
