@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Categor&iacute;as
@stop

@section('menu')
  <li><a href="{{ URL::to('inicio') }}" class="nav-link">Volver al Inicio</a></li>
@stop


@section('categorias')
  <div class="site-section" id="products-section" style="padding: 9em 0 0.5em">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6 mb-1">
          <select id="cmbCategorias" class="form-control">
              <option value="">Productos y Servicios</option>
              <option value="0" {{ ($idlinea == "0" ? "selected":"") }}>Todos</option>
              @foreach ($lineas as $p) 
                <option value="{{ $p->id }}" {{ ($idlinea == $p->id ? "selected":"") }} >{{ $p->nombre }}</option>
              @endforeach
          </select>
        </div>
        @if ($agent->isMobile())

          
            <?php $c=1 ?>
            @foreach ($botones as $b)
              
              <?php if ($c%3==0){ ?>
                  <div class="col" style="margin-bottom: 4px">
                    <a style="width: 100%; height: 100%" href="{{ $b->url }}" class="btn btn-primary" style="background-color: #002061;border-color: #002061;f">{{ $b->descripcion }}</a>
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

        <!--
        @foreach ($lineas as $p)
          <div class="col-lg-3 col-md-6 mb-1" style="height: 50px;">
            <div class="product-item">
              <a href="{{ URL::to('productos/'.$p->id) }}">
              <figure>
                <img src="{{ asset( config('constants.rutapublica.url').$p->imagen ) }}" alt="Image" class="img-fluid">
              </figure>
              </a>

            </div>
          </div>
        @endforeach
        -->

      </div>
    </div>
  </div>
@stop

@section('listaproductos')

  <style type="text/css">
    .pl-4, .px-4 {
        padding-left: 0rem!important;
        font-size: 13px;
    }
  </style>

	<div class="site-section" id="products-section" style="padding-top: 5px">
      <div class="container">


        @if ($agent->isMobile())

          <div class="row">
            <?php $c=1 ?>

            @foreach ($lineas as $l)

            <div id="categoria{{ $l->id }}"></div>
            <legend style="padding-left: 10px"><a href="{{ URL::to('productos/').$l->id }}">{{ $l->nombre }}</a></legend>
           

              @foreach ($productos as $p)
                @if($p->idlinea == $l->id)
                <?php if ($c%3==0){ ?>
                    <div class="col">
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
                        </div>
                        @if($info->ind_carro == 1)
                          <p>
                            <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $p->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Agregar al carro <i class="fa fa-shopping-cart-o"></i></a>
                          </p>
                        
                        @endif
                      </div>
                    </div></br>
                <?php }else{ ?>
                    <div class="col">
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
                        </div>

                        @if($info->ind_carro == 1)
                          <p>
                            <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $p->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Agregar al carro <i class="fa fa-shopping-cart-o"></i></a>
                          </p>
                        
                        @endif
                      </div>
                    </div>
                <?php } ?>

                <?php $c++ ?>
                @endif
              @endforeach

            @endforeach

            
          </div>

        @else

          <div class="row" >

            @foreach ($lineas as $l)
              
              <div id="categoria{{ $l->id }}"></div>
              <legend style="padding-left: 10px"><a href="{{ URL::to('productos/').$l->id }}">{{ $l->nombre }}</a></legend>
              
                @foreach ($productos as $p)
                @if($p->idlinea == $l->id)
                  <div class="col-lg-4 col-xs-6">
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
                      </div>

                      @if($info->ind_carro == 1)
                      
                        <p>
                          <a href="javascript:void(0);" onclick="AgregarProductoVendedor({{ $p->id }})" class="btn btn-black rounded-0 d-block d-lg-inline-block">Agregar al carro <i class="fa fa-shopping-cart-o"></i></a>
                        </p>
                      
                      @endif
                    </div>
                  </div>
                  <div class="clearfix visible-xs"></div>
                @endif
                @endforeach

            @endforeach

          </div>

        @endif

        

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


@section('categorias2')
  <div class="site-section" id="products-section" style="padding: 9em 0 0.5em">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6 mb-1">
          <select id="cmbCategorias2" class="form-control">
              <option value="" >Productos y Servicios</option>
              <option value="0" {{ ($idlinea == "0" ? "selected":"") }}>Todos</option>
              @foreach ($lineas as $p) 
                <option value="{{ $p->id }}" {{ ($idlinea == $p->id ? "selected":"") }} >{{ $p->nombre }}</option>
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

@section('scripts-add')

    <script type="text/javascript">
      $(document).ready(function () {
          
          $(function () {
              $("#myCarousel").carousel({
                  interval: 5000
              });
          });

          $('html, body').animate({
            scrollTop: $("#categoria{{ $idlinea }}").offset().top
          }, 2000);

          console.log($("#categoria15").offset().top);

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
                  console.log(parseFloat($("#stock").val()) - parseFloat($("#cantidadproducto").val()));
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