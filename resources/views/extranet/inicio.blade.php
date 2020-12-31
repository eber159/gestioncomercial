@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Inicio
@stop

@section('banner')
  <!--<div class="site-section" id="products-section">-->
  <!--<div class="container">-->

	<div class="site-blocks-cover2" style="margin-top: 100px">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <?php $c=0 ?>
      <ol class="carousel-indicators">
        @foreach ($slider as $p)
        <?php if($c==0){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $c ?>" class="active"></li>
        <?php }else{ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $c ?>" class=""></li>
        <?php } ?>
        <?php $c++ ?>
        @endforeach
      </ol>

      <?php $row=0 ?>
      <div class="carousel-inner">
        @foreach ($slider as $p)
        <?php if($row==0){ ?>
            <div class="carousel-item active">
                  @if($p->link=="" || $p->link=="NULL")
                    <img class="d-block w-100" src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="{{ $p->titulo }}">
                  @else
                    <a href="{{ $p->link }}" target="_blank"><img class="d-block w-100" src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="{{ $p->titulo }}"></a>
                  @endif
                  
                  <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $p->titulo }}</h5>
                    <p>{{ $p->descripcion }}</p>
                  </div>
            </div>
        <?php }else{ ?>

            <div class="carousel-item">
                   @if($p->link=="" || $p->link=="NULL")
                    <img class="d-block w-100" src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="{{ $p->titulo }}">
                  @else
                    <a href="{{ $p->link }}" target="_blank"><img class="d-block w-100" src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="{{ $p->titulo }}"></a>
                  @endif

                  <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $p->titulo }}</h5>
                    <p>{{ $p->descripcion }}</p>
                  </div>
            </div>

        <?php } ?>

        <?php $row++ ?>
        
        @endforeach

      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>   
  <!--</div>  -->
  <!--</div> -->
@stop


@section('categorias')
  <div class="site-section" id="products-section" style="padding: 0.5em 0 0.5em">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6 mb-1">
          <select id="cmbCategorias" class="form-control">
              <option value="">Productos y Servicios</option>
              <option value="0">Todos</option>
              @foreach ($lineas as $p) 
                <option value="{{ $p->id }}">{{ $p->nombre }}</option>
              @endforeach
          </select>
        </div>

        
        @if ($agent->isMobile())

          
            <?php $c=1 ?>
            @foreach ($botones as $b)
              
              <?php if ($c%3==0){ ?>
                  <div class="col" style="margin-bottom: 4px">
                    <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;">{{ $b->descripcion }}</a>
                  </div></br>
              <?php }else{ ?>
                  <div class="col" style="margin-bottom: 4px">
                    <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;">{{ $b->descripcion }}</a>
                  </div>
              <?php } ?>

              <?php $c++ ?>
            @endforeach
        
        @else

            @foreach ($botones as $b)
              <div class="col" style="margin-bottom: 4px">
                <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;">{{ $b->descripcion }}</a>
              </div>
            @endforeach
          
        @endif


      </div>
    </div>
  </div>
@stop

@section('clientes')
    <div class="site-section border-bottom" id="contenido-section" style="padding: 0.5em 0 0.5em">
      <div class="container">
        <div class="row">
          @foreach ($publicaciones as $p)


          @if(trim($p->urlvideo)!='')
              <div class="col-md-4 col-sm-6 col-xs-6 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100" style="height: 100%">
                <div class="video">
                    {!! $p->urlvideo !!}
                </div>
              </div>
          @else

              @if($p->indlargo == 1)
              <div class="col-md-12 col-sm-6 col-xs-6 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100" style="height: 100%">
              @elseif($p->indlargo == 2)
              <div class="col-md-6 col-sm-6 col-xs-6 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100" style="height: 100%">
              @else
              <div class="col-md-4 col-sm-6 col-xs-6 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100" style="height: 100%">
              @endif

                  @if($p->urlexterno=='')
                    <a href="{{ URL::to('verpublicacion/'.$p->id) }}">
                        <img src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="Image" class="img-fluid rounded w-100 mb-3">
                    </a>
                  @else
                    <a href="{{ $p->urlexterno }}" target="_blank">
                      <img src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="Image" class="img-fluid rounded w-100 mb-3">
                    </a>
                  @endif

                  @if($p->indtexto==1)
                      @if($p->indtextocompleto==0)
                        <p class="" style="text-align: justify;">{!! $p->descripcion !!}</p>
                      @else
                        @if(strlen($p->descripcion) > 90)
                          <p class="" style="text-align: justify;">
                              {!! str_limit($p->descripcion, $limit = 90, $end = '...') !!}

                              @if($p->urlexterno=='')
                                  <a href="{{ URL::to('verpublicacion/'.$p->id) }}"> ver m&aacute;s.</a>
                              @else
                                  <a href="{{ $p->urlexterno }}"> ver m&aacute;s.</a>
                              @endif

                          </p>
                        @else
                          <p class="" style="text-align: justify;">{!! $p->descripcion !!}</p>
                        @endif
                      @endif
                  @endif
                
              </div>
          @endif




          @endforeach
        </div>
      </div>
    </div>
@stop

@section('categorias2')
  <div class="site-section" id="products-section" style="padding: 0.5em 0 0.5em">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6 mb-1">
          <select id="cmbCategorias2" class="form-control">
              <option value="">Productos y Servicios</option>
              <option value="0">Todos</option>
              @foreach ($lineas as $p) 
                <option value="{{ $p->id }}">{{ $p->nombre }}</option>
              @endforeach
          </select>
        </div>

        
        @if ($agent->isMobile())

          
            <?php $c=1 ?>
            @foreach ($botones as $b)
              
              <?php if ($c%3==0){ ?>
                  <div class="col" style="margin-bottom: 4px">
                    <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;">{{ $b->descripcion }}</a>
                  </div></br>
              <?php }else{ ?>
                  <div class="col" style="margin-bottom: 4px">
                    <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;">{{ $b->descripcion }}</a>
                  </div>
              <?php } ?>

              <?php $c++ ?>
            @endforeach
        
        @else

            @foreach ($botones as $b)
              <div class="col" style="margin-bottom: 4px">
                <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;">{{ $b->descripcion }}</a>
              </div>
            @endforeach
          
        @endif


      </div>
    </div>
  </div>
@stop


@section('testimonios')
  <div class="site-section testimonial-wrap" id="testimonials-section" style="padding: 0.5em 0 0.5em">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">Nuestros Clientes Opinan</h3>
            <h2 class="section-title mb-3">Testimonios</h2>
          </div>
        </div>
      </div>
      <div class="slide-one-item home-slider owl-carousel">
           @foreach ($testimonios as $t)
          <div>
            <div class="testimonial">
              <figure class="mb-4 d-block align-items-center justify-content-center">
                <div><a href="{{ $t->link }}" target="_blank"><img src="{{ asset( config('constants.rutapublica.url').$t->imagen ) }}" alt="Image" class="w-100 img-fluid mb-3"></a></div>
              </figure>
              <blockq{uote class="mb-3">
                <p>{!! $t->descripcion !!}</p>
              </blockquote>
              <p class="text-black"><strong>{{ $t->cliente }}</strong></p>
            </div>
          </div>
          @endforeach
        </div>
    </div>
@stop


@section('enlaces')
    <div class="site-section testimonial-wrap" id="testimonials-section" style="padding: 0.5em 0 0.5em">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Referencias</h2>
          </div>
        </div>
      </div>
      <div class="slide-one-item home-slider owl-carousel">
           @foreach ($enlaces as $e)
           
          <div>
            <div class="testimonial">
              <figure class="mb-4 d-block align-items-center justify-content-center">
                <div><a href="{{ $e->url }}" target="_blank"><img src="{{ asset( config('constants.rutapublica.url').$e->imagen ) }}" alt="Image" class="w-100 img-fluid mb-3"></a></div>
              </figure>
            </div>
          </div>
          @endforeach
        </div>
    </div


@stop


@section('scripts-add')
  <script type="text/javascript">
    $(function () {


    });
  </script>
@stop