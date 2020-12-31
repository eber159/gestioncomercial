@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Nosotros
@stop


@section('about')
    <div class="site-section" id="about-section" style="padding-top: 9em;">
      <div class="container">


         @foreach ($nosotros as $n)
        <div class="row align-items-lg-center">
          <div class="col-md-7 mb-5 mb-lg-0 position-relative">
            <img src="{{ asset( config('constants.rutapublica.url').$n->imagen ) }}" class="img-fluid" alt="Image">
          </div>
          <div class="col-md-5 ml-auto">
            <h2 class="section-title mb-3"> {{ $n->titulo }} </h2>
              <p class="mb-4"> {{ $n->descripcion }} </p>
            <p>
          </div>
        </div><br/><br/>
        @endforeach
        

      </div>
    </div>

@stop
