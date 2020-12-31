@extends('extranet.plantilla')

@section('title-page')
{{ $info->empresa }} | Productos / Servicios
@stop

@section('menu')
<li><a href="{{ URL::to('productos/'.$producto->idlinea) }}" class="nav-link"> << Volver</a></li>
@stop


@section('categorias')
<div class="site-section" id="products-section" style="padding: 9em 0 0.5em">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 mb-1">
                <select id="cmbCategorias" class="form-control">
                    <option value="" >Productos y Servicios</option>
                    <option value="0" {{ ($idlinea == "0" ? "selected":"") }}>Todos</option>
                    @foreach ($lineas as $p) 
                    <option value="{{ $p->id }}" {{ ($producto->idlinea == $p->id ? "selected":"") }} >{{ $p->nombre }}</option>
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
        padding: 22px 38px; 
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
        padding: 12px 28px; 
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



<div class="site-section bg-light" style="padding-top: 5px">
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
                            <img src="{{ asset( config('constants.rutapublica.url').$producto->imagen ) }}" alt="Image" class="img-fluid" height="70px">
                        </figure>
                    </a>
                    <div class="px-4">
                        <h3><a href="#">{{ $producto->nombre }}</a></h3>
                        @if($info->ind_carro == 1)
                            <div>
                                Precio: S/ {{ number_format($producto->precio,2) }}
                            </div>
                        @endif
                    </div>
                    @if($info->ind_carro == 1)
                        <p>
                            <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $producto->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Comprar<i class="fa fa-shopping-cart-o"></i></a>
                        </p>
                    @endif

                </div>
            </div>

            <div class="col-lg-8 col-md-6 mb-5" style="text-align: justify;">
                <p class="mb-4">{!! $producto->descripcion !!}</p>
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
                    {!! $producto->linkubicacion !!}
                </div>
            </div>
        </div>


        <legend>Todos los productos</legend>

        <div class="row">
            @if ($agent->isMobile())
            <?php $c=1 ?>
            @foreach ($lineas as $l)
              <legend style="padding-left: 10px">{{ $l->nombre }}</legend>
              @foreach ($productoscomunes as $p)
                    @if($p->idlinea == $l->id)
                      <?php if ($c%3==0){ ?>
                      <div class="col" style="margin-bottom: 4px">
                          <div class="product-item">
                              <a href="{{ URL::to('verproducto/'.$p->id) }}" >
                                  <figure>
                                      <img src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="Image" class="img-fluid" height="70px">
                                  </figure>
                              </a>
                              <div class="px-4" style="padding-left: 0px">
                                  <h3 style="text-align: left;font-size: 14px"><a href="#">{{ $p->nombre }}</a></h3>
                                  <h3 style="text-align: left;"><a href="#" style="color: red">S/ {{ number_format($p->precio,2) }}</a></h3>
                                  <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $p->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Comprar <i class="fa fa-shopping-cart-o"></i></a>
                              </div>
                          </div>
                      </div></br>
                      <?php }else{ ?>
                      <div class="col" style="margin-bottom: 4px">
                          <div class="product-item">
                              <a href="{{ URL::to('verproducto/'.$p->id) }}" >
                                  <figure>
                                      <img src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="Image" class="img-fluid" height="70px">
                                  </figure>
                              </a>
                              <div class="px-4" style="padding-left: 0px">
                                  <h3 style="text-align: left;font-size: 14px"><a href="#">{{ $p->nombre }}</a></h3>
                                  @if($info->ind_carro == 1) 
                                  <h3 style="text-align: left;"><a href="#" style="color: red">S/ {{ number_format($p->precio,2) }}</a></h3>
                                  @endif
                                 @if($info->ind_carro == 1) 
                                    <p>
                                        <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $p->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Comprar <i class="fa fa-shopping-cart-o"></i></a>
                                    </p>
                                  @endif
                              </div>
                          </div>
                      </div>
                      <?php } ?>

                      <?php $c++ ?>
                    @endif
                

              @endforeach
                
            @endforeach

            @else
              @foreach ($lineas as $l)
              <legend>{{ $l->nombre }}</legend>
              <div class="row">
                @foreach ($productoscomunes as $p)
                @if($p->idlinea == $l->id)
                <div class="col" style="margin-bottom: 4px">
                    <div class="product-item">
                        <a href="{{ URL::to('verproducto/'.$p->id) }}" >
                            <figure>
                                <img src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="Image" class="img-fluid" height="70px">
                            </figure>
                        </a>
                        <div class="px-4" style="padding-left: 0px">
                            <h3 style="text-align: left;font-size: 14px"><a href="#">{{ $p->nombre }}</a></h3>
                            @if($info->ind_carro == 1)
                                <h3 style="text-align: left;"><a href="#" style="color: red">S/ {{ number_format($p->precio,2) }}</a></h3>
                            @endif
                            @if($info->ind_carro == 1) 
                                <p>
                                    <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $p->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Agregar al carro <i class="fa fa-shopping-cart-o"></i></a>
                                </p>
                            @endif
                            
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
              </div>
              @endforeach

            @endif
        </div>
    </div>

</div>

</div>
</div>



    <div class="modal modal-default fade" id="modal-agregar-pedido" style="overflow-y: auto;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Agregar Producto</h5>
          </div>

          <div class="modal-body">
            <div class="">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <label>Producto:</label>
                          <input type="hidden" class="form-control" id="idproducto"  name="idproducto" disabled="disabled"/>
                          <input type="text" class="form-control" id="nombreproducto"  name="nombreproducto" disabled="disabled" />   
                        </div>
                        <div class="col-lg-12 col-md-12" id="divTallas" style="padding-top: 3px">
                            Tallas:
                            <select class="form-control" id="cmbTallas">
                              
                            </select>
                        </div>

                        <div class="col-lg-12 col-md-12" id="divStock" style="padding-top: 3px">
                            
                        </div>
                        <input type="hidden" id="indstock" />
                        <legend></legend>
                        <div class="col-md-4">
                          <label>Cantidad</label>
                          <input type="number" class="form-control" id="cantidadproducto" name="cantidadproducto" style="text-align: center">
                        </div>
                        <div class="col-md-4">
                          <label>Precio</label>
                          <input type="number" class="form-control" id="precioproducto" name="precioproducto" style="text-align: center">
                        </div>
                        <div class="col-md-4">
                          <label>Sub Total</label>
                          <input type="number" class="form-control" id="totalimporte" name="totalimporte" style="text-align: center">
                        </div>
                        <input type="hidden" class="form-control" id="stock" name="stock" style="text-align: center">
                    </div>

                    <div id="divDatosVendedor">

                      <div class="row">
                          <div class="col-lg-12 contact_col"><h5>Genere un nuevo pedido o Agregue a uno en curso.</h5></div>
                          <div class="col-lg-12 contact_col">
                              <input type="radio" id="chkNuevoPedido" name="chkTipoPedido" class="minimal"/> Nuevo Pedido
                              <input type="radio" id="chkPedidoActual" name="chkTipoPedido" class="minimal"/> Agregar a Pedido
                          </div>
                      </div>   

                      <div id="divNuevoPedido" class="row">
                          <div class="col-lg-12 col-md-12">
                            <label>Cliente:</label>
                            <input type="text" class="form-control" id="nombrecliente"  name="nombrecliente"/>   
                          </div>
                      </div>

                      <div id="dviPedidoExistente" class="row">
                          <div class="col-lg-12 contact_col">
                            <label>Pedido:</label>
                            <select class="form-control select2" id="idordenpedido" name="idordenpedido" style="width: 100%">
                              <option value="">Seleccione</option>
                            </select>
                          </div>
                      </div>  
                    </div>
                    

                    <legend></legend>
                    <div class="row">
                      <div class="col-lg-12 contact_col">
                          <button id="btnAgregarProductoVendedor" name="btnAgregarProductoVendedor" class="btn btn-xs btn-primary" style="background-color: #44C4AB"> AGREGAR </button>
                      </div>
                    </div>  
                 
              </div>
          </div>
        </div>
      </div>
    </div>





@stop

@section('scripts-add')

<script type="text/javascript">
    $(document).ready(function () {

    $(function () {
    $("#myCarousel").carousel({
    interval: 5000
    });
    });
    });
    function AgregarCarro(idproducto){

    bootbox.confirm("Seguro que desea agregar el producto al carro de compras?", function (result) {
    if (result) {
    var info = "";
    $.ajax({
    type: "POST",
            async: false,
            data: {"idproducto":idproducto, "cantidad":1},
            url: "{{URL::to('agregarproductocarro')}}",
            dataType: "json",
            beforeSend: function (data) {

            },
            success: function (data) {
            //var oTableDetalles = $("#tblDetalles").dataTable();
            //oTableDetalles.fnClearTable();
            if (data !== null && typeof data === 'object') {
            bootbox.alert("Producto Agregado");
            }
            },
            complete: function () {

            }
    });
    }
    });
    }

</script>

<script type="text/javascript">

    jQuery(document).ready(function(){
    //var jsFolder = "https://amazingcarousel.com/wp-content/uploads/amazingcarousel/2/carouselengine/";
    var jsFolder = "{{ asset( config('constants.rutapublica.url').'/img/' ) }}";
    if (typeof html5Lightbox === "undefined")
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
            backgroundimagetop: - 40,
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
            backgroundimagetop: - 40,
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

<script type="text/javascript">
    
     $(document).ready(function () {

          $("#chkNuevoPedido").iCheck('check');
          $("#divNuevoPedido").show();
          $("#dviPedidoExistente").hide();

          $("input[name='chkTipoPedido']").click(function () {
            if(this.id=="chkNuevoPedido"){
                $("#divNuevoPedido").show();
                $("#dviPedidoExistente").hide();
                $("#nombrecliente").val("");
             }
             if(this.id=="chkPedidoActual"){
                $("#dviPedidoExistente").show();
                $("#divNuevoPedido").hide();
                $("#idordenpedido").val("").trigger('change');
                CargarPedidosVendedor();
             }
          });

          $('#btnAgregarProductoVendedor').click(function (e) {
            e.preventDefault();

            if("{{ Session::get('idusuario') }}"==""){
              if($("#cantidadproducto").val()=="" || $("#cantidadproducto").val()=="0"){
                bootbox.alert("Seleccione una cantidad v?ida");
              }else{
                if( (parseFloat($("#stock").val()) - parseFloat($("#cantidadproducto").val())) >= 0 ){
                  AgregarCarro($("#idproducto").val(),$("#cantidadproducto").val());  
                }else{
                  bootbox.alert("El producto seleccionado no cuenta con stock disponible.");
                }
              } 
            }else{
                if("{{ Session::get('idperfil') }}"=="2"){
                    if($("#cantidadproducto").val()=="" || $("#cantidadproducto").val()=="0"){
                      bootbox.alert("Seleccione una cantidad v?ida");
                    }else{
                        if( (parseFloat($("#stock").val()) - parseFloat($("#cantidadproducto").val())) >= 0 ){
                            AgregarCarro($("#idproducto").val(),$("#cantidadproducto").val());
                        }else{
                            bootbox.alert("El producto seleccionado no cuenta con stock disponible.");      
                        }
                    } 
                }else{
                  if( (parseFloat($("#stock").val()) - parseFloat($("#cantidadproducto").val())) >= 0 ){

                    if($("input[id=chkNuevoPedido]:checked").val()){
                        if($("#nombrecliente").val()==""){
                          bootbox.alert("Ingrese un nombre del Cliente al pedido");
                        }else{
                          if($("#idproducto").val()==""){
                            bootbox.alert("Seleccione un producto");
                          }else{
                            if($("#cantidadproducto").val()=="" || $("#cantidadproducto").val()=="0"){
                              bootbox.alert("Seleccione una cantidad v?ida");
                            }else{
                              AgregarCarroVendedor();
                            } 
                          }
                        }
                        
                      }
                      if($("input[id=chkPedidoActual]:checked").val()){
                        if($("#idordenpedido").val()==""){
                          bootbox.alert("Seleccione un pedido");
                        }else{

                          if($("#idproducto").val()==""){
                            bootbox.alert("Seleccione un producto");
                          }else{
                            if($("#cantidadproducto").val()=="" || $("#cantidadproducto").val()=="0"){
                              bootbox.alert("Seleccione una cantidad v?ida");
                            }else{
                              AgregarCarroVendedor();
                            } 
                          }
                        }
                      }
                  }else{
                      bootbox.alert("El producto seleccionado no cuenta con stock disponible.");
                  }
                }
            }

          });


          $('#cmbTallas').change(function(){
              LeerTalla($("#idproducto").val());
          });

      });

      
      function AgregarCarro(idproducto,cantidad){

        //bootbox.confirm("Seguro que desea agregar el producto al carro de compras?", function (result) {
                //if (result) {
                    var info = "";
                    $.ajax({
                        type: "POST",
                        async: false,
                        data: {"idproducto":idproducto,"cantidad":cantidad,"talla":$("#cmbTallas").val()},
                        url: "{{URL::to('agregarproductocarro')}}",
                        dataType: "json",
                        beforeSend: function (data) {

                        },
                        success: function (data) {
                            //var oTableDetalles = $("#tblDetalles").dataTable();
                            //oTableDetalles.fnClearTable();
                            if (data !== null && typeof data === 'object') {
                                bootbox.alert("Producto Agregado");
                                $("#modal-agregar-pedido").modal("hide");
                                $("#cantidadproducto").val("1");
                            }
                        },
                        complete: function () {

                        }
                    });
                //}
          //});
      }
      

      function CargarPedidosVendedor() {
        var nombreusuario = "{{ Session::get('nombreusuario') }}";
        var $combo = $("#idordenpedido");
        $combo.empty();
        $.post("{{ URL::to('intranet/comercial/ordenpedido/Listar2') }}",{"nombreusuario":nombreusuario,"idestado":21},
        function (data) {
            $combo.append("<option value=''>Seleccione</option>");
            $.each(data.lista, function (index, item) {
                $combo.append("<option value='" + item.id + "'>"
                        + item.fecha + " - " + item.nombrecliente + "</option>");
            });
        }, 'json');
      }

      function AgregarProductoVendedor(idproducto){

          var info = "";
          $.ajax({
            type: "POST",
            async: false,
            data: {"id":idproducto},
            url: "{{ URL::to('intranet/configuracion/productoweb/Leer') }}",
            dataType: "json",
            beforeSend: function (data) {
              $("#divTallas").val("");
              $("#divStock").html("");
              $("#modal-agregar-pedido").modal("show");
            },
            success: function (data) {
              var stock = "0";
              if (data !== null && typeof data === 'object') {
                $.each(data.obj, function (key, val) {
                  $("#idproducto").val(idproducto);
                  $("#nombreproducto").val(val["nombre"]);
                  $("#cantidadproducto").val("1");
                  $("#precioproducto").val( parseFloat(val["precio"]).toFixed(2) );

                  $("#indstock").val(val["indstock"]);
                  if(val["indstock"]==1){
                    $("#stock").val(val["stock"]);
                    stock = val["stock"];
                  }else{
                    $("#stock").val(0);
                    stock = val["stock_tallas"];
                  }
                  
                  /*
                  var cadtallas = "";
                  if ( data.tallas.length > 0 ) {
                    cadtallas +="Tallas: ";
                    $.each(data.tallas, function (key, val2) {
                      cadtallas += "<button class='btn btn-default' onclick='hola'>"+val2["tamanio"]+"</button>&nbsp;";
                      console.log(cadtallas);
                    });
                    $("#divTallas").html(cadtallas);
                  }
                  */
                  var $combo = $("#cmbTallas");
                  $combo.empty();
                  $combo.append("<option value=''>Seleccione</option>");
                  $.each(data.tallas, function (index, item) {
                      $combo.append("<option value='" + item.tamanio + "'>"
                              + item.tamanio + "</option>");
                  });

                  if ( data.tallas.length > 0 ) {
                    $("#divTallas").css("display","block");
                  }else{
                    $("#divTallas").css("display","none");
                  }
                  

                  var cadstock = "";
                  if ( parseFloat(stock) > 0 ) {
                    cadstock = "Stock: " + parseInt(stock) + " unidades disponibles.";
                    $("#divStock").html(cadstock);
                  }
                  

                });
                calcularTotales();
              }
            },
            complete: function(){
              
                if("{{ Session::get('idusuario') }}"==""){
                    $("#divDatosVendedor").hide();
                    $("#totalimporte").prop( "disabled", true );
                    $("#precioproducto").prop( "disabled", true );
                }else{
                  if("{{ Session::get('idperfil') }}"=="2"){
                    $("#divDatosVendedor").hide();
                    $("#totalimporte").prop( "disabled", true );
                    $("#precioproducto").prop( "disabled", true );
                  }else{
                    $("#divDatosVendedor").show();
                    CargarPedidosVendedor();
                    $("#totalimporte").prop( "disabled", false );
                    $("#precioproducto").prop( "disabled", false );
                  } 
                }
                
            } 
        });
        //=================== ********* ====================
      }



      function LeerTalla(idproducto){

          var info = "";
          $.ajax({
            type: "POST",
            async: false,
            data: {"id":idproducto, "talla":$("#cmbTallas").val()},
            url: "{{ URL::to('intranet/configuracion/productoweb/LeerTalla') }}",
            dataType: "json",
            beforeSend: function (data) {
                $("#stock").val(0);
                $("#divStock").html("");
            },
            success: function (data) {
              var stock = "0";
              if (data !== null && typeof data === 'object') {
                $.each(data.obj, function (key, val) {

                  $("#stock").val(val["stock_tallas"]);
                  stock = val["stock_tallas"];

                  var cadstock = "";
                  if ( parseFloat(stock) > 0 ) {
                    cadstock = "Stock: " + parseInt(stock) + " unidades disponibles.";
                    $("#divStock").html(cadstock);
                  }
                  

                });
                calcularTotales();
              }
            },
            complete: function(){
              
            } 
        });
        //=================== ********* ====================
      }


      $("#cantidadproducto").bind('keyup', function () {
          calcularTotales();
      });

      $("#precioproducto").bind('keyup', function () {
          calcularTotales();
      });

      $("#totalimporte").bind('keyup', function () {
          var cantidad = 0;
          cantidad = parseFloat($("#totalimporte").val()  / $("#precioproducto").val()).toFixed(2);
          $("#cantidadproducto").val(cantidad);
      });      

      function calcularTotales(){
        var precio = parseFloat($("#cantidadproducto").val()) * parseFloat($("#precioproducto").val());
        $("#totalimporte").val(precio.toFixed(2));
      }

      function AgregarCarroVendedor(){
        
        //bootbox.confirm("Seguro que desea agregar el producto al carro de compras?", function (result) {
            //if (result) {
                $.ajax({
                    type: "POST",
                    async: false,
                    data: {"idproducto":$("#idproducto").val()
                          ,"cantidad":$("#cantidadproducto").val()
                          ,"idpedido":$("#idordenpedido").val()
                          ,"nombrecliente":$("#nombrecliente").val()
                          ,"precio":$("#precioproducto").val()
                          ,"importe":$("#totalimporte").val()
                          ,"talla":$("#cmbTallas").val()
                        },
                    url: "{{URL::to('agregarproductocarrovendedor')}}",
                    dataType: "json",
                    beforeSend: function (data) {

                    },
                    success: function (data) {
                        //var oTableDetalles = $("#tblDetalles").dataTable();
                        //oTableDetalles.fnClearTable();
                        if (data !== null && typeof data === 'object') {
                            $("#modal-agregar-pedido").modal("hide");
                            bootbox.alert(data.message);
                        }
                    },
                    complete: function () {

                    }
                });
              //}
          //});
          
      }

</script>

@stop


@section('categorias2')
<div class="site-section" id="products-section" style="padding: 9em 0 0.5em">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 mb-1">
                <select id="cmbCategorias2" class="form-control">
                    <option value="" >Productos y Servicios</option>
                    <option value="0" {{ ($idlinea == "0" ? "selected":"") }}>Todos</option>
                    @foreach ($lineas as $p) 
                    <option value="{{ $p->id }}" {{ ($producto->idlinea == $p->id ? "selected":"") }} >{{ $p->nombre }}</option>
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