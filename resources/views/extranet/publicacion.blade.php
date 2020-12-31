@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Publicaciones
@stop

@section('menu')
  <li><a href="{{ URL::to('inicio') }}" class="nav-link"> << Volver</a></li>
@stop


@section('categorias')
  <div class="site-section" id="products-section" style="padding: 9em 0 0.5em">
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


@section('producto')

  
  <style type="text/css">
      
    /* content */

    @import url(https://fonts.googleapis.com/css?family=Open+Sans);

    #amazingcarousel-2 .amazingcarousel-image { 
      position: relative;
      padding: 4px;
    }

    #amazingcarousel-2 .amazingcarousel-image img {
      display: block;
      width: 100%;
      max-width: 100%;
      border: 0;
      margin: 0;
      padding: 0;
      -moz-border-radius: 0px;
      -webkit-border-radius: 0px;
      border-radius: 0px;
      -moz-box-shadow:  0 1px 4px rgba(0, 0, 0, 0.2);
      -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
    }

    #amazingcarousel-2 .amazingcarousel-title {
      position:relative;
      font:14px 'Open Sans', sans-serif;
      color:#333333;
      margin:6px;
      text-align:center;
      text-shadow:0px 1px 1px #fff;
    }

    /* carousel */

    #amazingcarousel-container-2 {
      padding: 32px 48px; 
    }

    #amazingcarousel-2 .amazingcarousel-list-container { 
      padding: 16px 0;
    }

    /* item */

    #amazingcarousel-2 .amazingcarousel-item-container {
      text-align: center;
      padding: 4px;
      background-color: #fff;
      border: 1px solid #ddd;
      -moz-box-shadow: 0px 0px 5px 1px rgba(96, 96, 96, 0.1);
      -webkit-box-shadow: 0px 0px 5px 1px rgba(96, 96, 96, 0.1);
      box-shadow: 0px 0px 5px 1px rgba(96, 96, 96, 0.1);
    }

    /* arrows */

    #amazingcarousel-2 .amazingcarousel-prev {
      left: 0%;
      top: 50%;
      margin-left: -48px;
      margin-top: -16px;
    }

    #amazingcarousel-2 .amazingcarousel-next {
      right: 0%;
      top: 50%;
      margin-right: -48px;
      margin-top: -16px;
    }

    /* navigation bullets */

    #amazingcarousel-2 .amazingcarousel-nav {
      position: absolute;
      width: 100%;
      top: 100%;
    }

    #amazingcarousel-2 .amazingcarousel-bullet-wrapper {
      margin: 4px auto;
    }



    /* ---------------------------------------------------------- */


    #amazingcarousel-3 .amazingcarousel-image { 
      position: relative;
      padding: 4px;
    }

    #amazingcarousel-3 .amazingcarousel-image img {
      display: block;
      width: 100%;
      max-width: 100%;
      border: 0;
      margin: 0;
      padding: 0;
      -moz-border-radius: 0px;
      -webkit-border-radius: 0px;
      border-radius: 0px;
      -moz-box-shadow:  0 1px 4px rgba(0, 0, 0, 0.2);
      -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
    }

    #amazingcarousel-3 .amazingcarousel-title {
      position:relative;
      font:14px 'Open Sans', sans-serif;
      color:#333333;
      margin:6px;
      text-align:center;
      text-shadow:0px 1px 1px #fff;
    }

    /* carousel */

    #amazingcarousel-container-3 {
      padding: 32px 48px; 
    }

    #amazingcarousel-3 .amazingcarousel-list-container { 
      padding: 16px 0;
    }

    /* item */

    #amazingcarousel-3 .amazingcarousel-item-container {
      text-align: center;
      padding: 4px;
      background-color: #fff;
      border: 1px solid #ddd;
      -moz-box-shadow: 0px 0px 5px 1px rgba(96, 96, 96, 0.1);
      -webkit-box-shadow: 0px 0px 5px 1px rgba(96, 96, 96, 0.1);
      box-shadow: 0px 0px 5px 1px rgba(96, 96, 96, 0.1);
    }

    /* arrows */

    #amazingcarousel-3 .amazingcarousel-prev {
      left: 0%;
      top: 50%;
      margin-left: -48px;
      margin-top: -16px;
    }

    #amazingcarousel-3 .amazingcarousel-next {
      right: 0%;
      top: 50%;
      margin-right: -48px;
      margin-top: -16px;
    }

    /* navigation bullets */

    #amazingcarousel-3 .amazingcarousel-nav {
      position: absolute;
      width: 100%;
      top: 100%;
    }

    #amazingcarousel-3 .amazingcarousel-bullet-wrapper {
      margin: 4px auto;
    }

    .google-maps {
        position: relative;
        padding-bottom: 25%; // This is the aspect ratio
        height: 0;
        overflow: hidden;
    }
    .google-maps iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
    }


    .video {
        position: relative;
        padding-bottom: 100%; // This is the aspect ratio
        height: 0;
        overflow: hidden;
    }
    .video iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
    }

  </style>
  


	 <div class="site-section bg-light">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
          </div>
        </div>
        <div class="row">

            <div class="col-lg-4 col-md-6 mb-5">
              <div class="product-item">
                <a href="#">
                <figure>
                  <img src="{{ asset( config('constants.rutapublica.url').$publicacion->imagen ) }}" alt="Image" class="img-fluid" height="70px">
                </figure>
                </a>
                <div class="px-4">
                  <h3><a href="#">{{ $publicacion->titulo }}</a></h3>
                  <div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-lg-8 col-md-6 mb-5" style="text-align: justify;">
                <p class="mb-4">{!! $publicacion->descripcion !!}</p>
                
            </div>

        </div>


        <div class="row">
          <div class="demo-slider">

            <div id="amazingcarousel-container-2">
                <div id="amazingcarousel-2" style="display:none;position:relative;width:100%;max-width:720px;margin:0px auto 0px;">
                    <div class="amazingcarousel-list-container">
                        <ul class="amazingcarousel-list">

                            @foreach ($imagenes as $i)
                            <li class="amazingcarousel-item">
                                <div class="amazingcarousel-item-container">
                                  <div class="amazingcarousel-image"><a href="{{ asset( config('constants.rutapublica.url').$i->rutarecurso ) }}" title="Golden Wheat Field"  class="html5lightbox" data-group="amazingcarousel-2"><img src="{{ asset( config('constants.rutapublica.url').$i->rutarecurso ) }}" /></a></div>
                                </div>
                            </li>
                            @endforeach

                           
                        </ul>
                        <div class="amazingcarousel-prev"></div>
                        <div class="amazingcarousel-next"></div>
                    </div>
                    <div class="amazingcarousel-nav"></div>
                </div>
            </div>
          </div>  


        </div>

        <div class="row">

          @foreach ($videos as $v)
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="video">
                    {!! $v->rutarecurso !!}
                </div>
            </div>
          @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-6 mb-5">
              <div class="google-maps">
                  {!! $publicacion->urlmapa !!}
              </div>
            </div>
        </div>


        </div>
        
      </div>
    </div>

    <div class="site-section border-bottom" id="contenido-section" style="padding: 0.5em 0 0.5em">
      <div class="container">
        <h4>Todas las publicaciones</h4>
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

@section('scripts-add')

    

    <script type="text/javascript">
      
        jQuery(document).ready(function(){
          //var jsFolder = "https://amazingcarousel.com/wp-content/uploads/amazingcarousel/2/carouselengine/";
          var jsFolder = "{{ asset( config('constants.rutapublica.url').'/img/' ) }}";
          if ( typeof html5Lightbox === "undefined" )
          {
              html5Lightbox = jQuery(".html5lightbox").html5lightbox({
                  jsfolder:jsFolder,
                  barheight:64,
                  showtitle:true,
                  showdescription:false,
                  shownavigation:false,
                  thumbwidth:80,
                  thumbheight:60,
                  thumbtopmargin:12,
                  thumbbottommargin:8,
                  titlebottomcss:'{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}',
                  descriptionbottomcss:'{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}'
              });
          }
          jQuery("#amazingcarousel-2").amazingcarousel({
              jsfolder:jsFolder,
              width:240,
              height:180,
              arrowhideonmouseleave:1000,
              itembottomshadowimagetop:100,
              donotcrop:false,
              navheight:16,
              random:false,
              showhoveroverlay:true,
              height:180,
              arrowheight:32,
              itembackgroundimagewidth:100,
              skin:"Classic",
              responsive:true,
              bottomshadowimage:"bottomshadow-110-95-0.png",
              navstyle:"bullets",
              enabletouchswipe:true,
              backgroundimagetop:-40,
              arrowstyle:"always",
              bottomshadowimagetop:95,
              transitionduration:1000,
              lightboxshowtitle:true,
              hoveroverlayimage:"hoveroverlay-64-64-3.png",
              itembottomshadowimage:"itembottomshadow-100-100-5.png",
              lightboxshowdescription:false,
              width:240,
              showitembottomshadow:false,
              showhoveroverlayalways:false,
              navimage:"bullet-16-16-0.png",
              lightboxtitlebottomcss:"{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}",
              lightboxshownavigation:false,
              showitembackgroundimage:false,
              itembackgroundimage:"",
              backgroundimagewidth:110,
              playvideoimagepos:"center",
              circular:true,
              arrowimage:"arrows-32-32-2.png",
              scrollitems:1,
              showbottomshadow:false,
              lightboxdescriptionbottomcss:"{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}",
              supportiframe:false,
              transitioneasing:"easeOutExpo",
              itembackgroundimagetop:0,
              showbackgroundimage:false,
              lightboxbarheight:64,
              showplayvideo:true,
              spacing:18,
              lightboxthumbwidth:80,
              scrollmode:"page",
              navdirection:"horizontal",
              itembottomshadowimagewidth:100,
              backgroundimage:"",
              lightboxthumbtopmargin:12,
              arrowwidth:32,
              transparent:false,
              navmode:"page",
              lightboxthumbbottommargin:8,
              interval:3000,
              lightboxthumbheight:60,
              navspacing:8,
              pauseonmouseover:true,
              imagefillcolor:"FFFFFF",
              playvideoimage:"playvideo-64-64-0.png",
              visibleitems:3,
              navswitchonmouseover:false,
              direction:"horizontal",
              usescreenquery:false,
              bottomshadowimagewidth:110,
              screenquery:{
                mobile: {
                  screenwidth: 600,
                  visibleitems: 1
                }
              },
              navwidth:16,
              loop:0,
              autoplay:false
          });

          jQuery("#amazingcarousel-3").amazingcarousel({
              jsfolder:jsFolder,
              width:240,
              height:180,
              arrowhideonmouseleave:1000,
              itembottomshadowimagetop:100,
              donotcrop:false,
              navheight:16,
              random:false,
              showhoveroverlay:true,
              height:180,
              arrowheight:32,
              itembackgroundimagewidth:100,
              skin:"Classic",
              responsive:true,
              bottomshadowimage:"bottomshadow-110-95-0.png",
              navstyle:"bullets",
              enabletouchswipe:true,
              backgroundimagetop:-40,
              arrowstyle:"always",
              bottomshadowimagetop:95,
              transitionduration:1000,
              lightboxshowtitle:true,
              hoveroverlayimage:"hoveroverlay-64-64-3.png",
              itembottomshadowimage:"itembottomshadow-100-100-5.png",
              lightboxshowdescription:false,
              width:240,
              showitembottomshadow:false,
              showhoveroverlayalways:false,
              navimage:"bullet-16-16-0.png",
              lightboxtitlebottomcss:"{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}",
              lightboxshownavigation:false,
              showitembackgroundimage:false,
              itembackgroundimage:"",
              backgroundimagewidth:110,
              playvideoimagepos:"center",
              circular:true,
              arrowimage:"arrows-32-32-2.png",
              scrollitems:1,
              showbottomshadow:false,
              lightboxdescriptionbottomcss:"{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}",
              supportiframe:false,
              transitioneasing:"easeOutExpo",
              itembackgroundimagetop:0,
              showbackgroundimage:false,
              lightboxbarheight:64,
              showplayvideo:true,
              spacing:18,
              lightboxthumbwidth:80,
              scrollmode:"page",
              navdirection:"horizontal",
              itembottomshadowimagewidth:100,
              backgroundimage:"",
              lightboxthumbtopmargin:12,
              arrowwidth:32,
              transparent:false,
              navmode:"page",
              lightboxthumbbottommargin:8,
              interval:3000,
              lightboxthumbheight:60,
              navspacing:8,
              pauseonmouseover:true,
              imagefillcolor:"FFFFFF",
              playvideoimage:"playvideo-64-64-0.png",
              visibleitems:3,
              navswitchonmouseover:false,
              direction:"horizontal",
              usescreenquery:false,
              bottomshadowimagewidth:110,
              screenquery:{
                mobile: {
                  screenwidth: 600,
                  visibleitems: 1
                }
              },
              navwidth:16,
              loop:0,
              autoplay:false
          });
      });

    </script>

@stop
