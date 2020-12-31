<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title-page')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyleextranet/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets_int/plugins/iCheck/all.css')}}" >

    <link rel="icon" type="image/png" href="{{ asset($info->slide1) }}">

    
    <style type="text/css">
      .pb-3, .py-3 {
          padding-bottom: 3px;
      }

      .pt-4, .py-4 {
          padding-top: 1.0rem!important;
      }

      .social-media li a {
          color: #fff;
          display: inline-block;
          width: 30px;
          height: 30px;
          border-radius: 50%;
          background: #64bf59;
          position: relative;
      }

      a {
        color: #64bf59;
      }


      .site-blocks-cover2 {
          margin-top: 90px;
      }

      .site-blocks-cover, .site-blocks-cover > .container > .row {
          min-height: 400px;
          height: calc(100vh);
      }

      .site-section {
          padding: 2em 0;
          background-color: #fff;
      }

      .mb-5, .my-5 {
          margin-bottom: 1rem!important;
      }

      .section-sub-title {
          font-size: 13px;
          color: #000000;
          letter-spacing: .2em;
          text-transform: uppercase;
          font-weight: 700;
      }

      .product-item figure {
          overflow: hidden;
          position: relative;
          margin-bottom: 10px;
      }

      .dropdown-submenu {
        position: relative;
      }

      .dropdown-submenu a::after {
        transform: rotate(-90deg);
        position: absolute;
        right: 6px;
        top: .8em;
      }

      .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .1rem;
        margin-right: .1rem;
      }


      .redes-flotantes {
        position: fixed;
        right: 4px;
        top: 85%;
        z-index: 20;
      }

      .redes-flotantes img {
        float: right; clear: right;
         margin: 5px;
        -moz-transform: scale(.8) ;
        -webkit-transform: scale(.8) ;
        -o-transform: scale(.8) ;
        -ms-transform: scale(.8) ;
        transform: scale(.8) ;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
      }

      .redes-flotantes img:hover {
        -moz-transform: scale(1.1) rotate(6deg);
        -webkit-transform: scale(1.1) rotate(6deg);
        -o-transform: scale(1.1) rotate(6deg);
        -ms-transform: scale(1.1) rotate(6deg);
        transform: scale(1.1) rotate(6deg);
      }

      .mb-5, .my-5 {
          margin-bottom: 0.8rem!important;
      }

      .mb-3, .my-3 {
          margin-bottom: 0.8rem!important;
      }


      body {
          line-height: 1.7;
          color: black;
          font-weight: 400;
          font-size: 1rem;
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

      .site-blocks-cover2 {
          margin-top: 140px;
      }
        .btn-primary {
            color: #fff;
            background-color: #002061;
            border-color: #002061;
            margin-bottom: 5px;
        }

        .testimonial figure img {
            max-width: 200px;
            margin: 0 auto;
            border-radius: 0%;
        }

        .pb-3, .py-3 {
            padding-bottom: 0.3rem!important;
        }
        .pt-3, .py-3 {
            padding-top: 0.3rem!important;
        }
        .pt-4, .py-4 {
            padding-top: 0.5rem!important;
        }

    </style>

  </head>



  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  

    <div class='redes-flotantes'>


  <div class="separator" style="clear: both; text-align: left;"></div>
  <div class="separator" style="clear: both; text-align: center;"></div>
  <div class="separator" style="clear: both; text-align: center;"></div>
  <div class="separator" style="clear: both; text-align: left;">
    <a href="{{ $info->linkwhatsapp }}" style="clear: left; float: left; margin-bottom: 1em; margin-right: 1em;" target="_blank"><img border="0" data-original-height="79" data-original-width="79" src="{{ asset('adminstyleextranet/images/whatsapp_icono.png') }}" /></a>
  </div>

  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    <div class="top-bar py-3 bg-light" id="home-section" >
      <div class="container">
        <div class="row align-items-center">
         
          <div class="col-6 text-left">
            <ul class="social-media">
              <li><a href="{{ $info->linkfacebook }}" class=""><span class="icon-facebook"></span></a></li>
              <li><a href="{{ $info->linktwitter }}"  class=""><span class="icon-twitter"></span></a></li>
              <li><a href="{{ $info->linkinstagram }}" class=""><span class="icon-instagram"></span></a></li>
              <li><a href="{{ $info->linklikedin }}" class=""><span class="icon-linkedin"></span></a></li>
            </ul>
          </div>
          <div class="col-6">
            <p class="mb-0 float-right">
              <span class="mr-3"><a href="tel://#"> <span class="icon-phone mr-2" style="position: relative; top: 2px;"></span><span class="d-none d-lg-inline-block text-black">{{ $info->telefono1 }}</span></a></span>
              <span>
                <a href="{{ $info->linkwhatsapp }}">
                  <span class="icon-whatsapp mr-2" style="position: relative; top: 2px;"></span>
                  <span class="d-none d-lg-inline-block text-black"></span>
                </a>
              </span>
              <span>
                @if(Session::get('idusuario')!= '')
                  <a href="#" onclick="Logout()">
                      <span onclick="Logout()" class="icon-user mr-2" style="position: relative; top: 2px; font-size: 22px"></span>
                      <span class="d-none d-lg-inline-block text-blue">Salir</span > 
                  </a>
                @else
                  <a href="#" onclick="verLogin()">
                      <span onclick="verLogin()"class="icon-user mr-2" style="position: relative; top: 2px; font-size: 22px"></span>
                      <span class="d-none d-lg-inline-block text-blue">Iniciar Sesión</span>
                  </a>
                @endif
                
              </span>
              @if($info->ind_carro == 1)
                <span >
                  <a href="{{ URL::to('carrito') }}">
                      <span class="icon-shopping-cart mr-2" style="position: relative; top: 2px; font-size: 22px"></span>
                      <span class="d-none d-lg-inline-block text-black"> ({{$cantcarrito}})</span>
                  </a>
                </span>
              @endif
            </p>
            
          </div>
        </div>
      </div> 
    </div>

    <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner" style="height: 85px">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="{{ URL::to('/inicio') }}" class="text-black mb-0"><img src="{{ asset($info->logo) }}" style="height: 85px" /></a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">

                <li><a href="{{ URL::to('inicio') }}" class="nav-link">Inicio</a></li>
                <!--<li><a href="{{ URL::to('inicio#products-section') }}" class="nav-link">Productos - Servicios</a></li>-->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos y Servicios</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ URL::to('productos/0') }}">Todos</a></li>
                    @foreach ($lineas as $p)
                      <li><a class="dropdown-item" href="{{ URL::to('productos/'.$p->id) }}">{{ $p->nombre }}</a></li>
                    @endforeach
                    
                  </ul>
                </li>
                <li><a href="{{ URL::to('nosotros') }}" class="nav-link">Nosotros</a></li>
                <li><a href="{{ URL::to('intranet') }}" class="nav-link" target="_blank">Intranet</a></li>
                <li><a href="{{ URL::to('contacto') }}" class="nav-link">Contacto</a></li>
                
                @if($info->ind_carro == 1)
                  <li><a href="#" onclick="irMisPedidos()" class="nav-link" target="_blank">Mis Pedidos</a></li>
                @endif

              </ul>

            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>


    @yield('banner')

    @yield('categorias')
    
    @yield('listaproductos')

    @yield('producto')
    
    @yield('clientes')

    @yield('about')

    @yield('carrito')

    @yield('contacto')

    @yield('terminos')

    @yield('categorias2')

    @if($info->ind_testimonios==1)
      @yield('testimonios')    
    @endif

    @yield('enlaces')

    <div class="modal modal-default fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Ingresar</h4>
          </div>

          <div class="modal-body">
            <div class="">
              {{ Form::open(array('url' => 'intranet', 'method' => 'post', 'files' => true, 'enctype'=>'multipart/form-data', 'id'=>"frmConsulta")) }}
                    <div class="contactoform">
                        <div class="col-lg-12 contact_col"><h4>Ingresa si estás registrado</h4></div>
                        <div class="col-lg-12 contact_col">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" id="usuario"  name="usuario" required="required" />
                        </div>
                        <div class="col-lg-12 contact_col">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="clave"  name="clave" required="required"/>
                        </div>
                        <div class="callout callout-danger" style="display:none" id="divError">
                            Credenciales incorrectas!
                        </div>
                        <br/>
                        <div class="col-lg-12 contact_col">
                            <button id="btnIngresar" name="btnIngresar" class="btn btn-xs btn-primary" style="background-color: #44C4AB"> INGRESAR </button>
                        </div>
                        <div class="col-lg-12 contact_col">
                            <a href="#" onclick="verRegistro()">No estás registrado?. Regístrate</a>
                            Olvidaste tu contraseña? <a href="#" onclick="enviarClave()">Haz Click aquí, te enviaremos un correo.</a>
                        </div>
                        
                    </div>    
                  {{ Form::close() }}         
              </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal modal-default fade" id="modal-registro" style="overflow-y: auto;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Registro de Usuarios</h4>
          </div>

          <div class="modal-body">
            <div class="">
              {{ Form::open(array('url' => 'intranet', 'method' => 'post', 'files' => true, 'enctype'=>'multipart/form-data', 'id'=>"frmRegistrar")) }}
                    <div class="row">
                        <div class="col-lg-12 contact_col"><h4>Datos de Acceso</h4></div>
                        <div class="col-lg-12 contact_col">
                            <label>Usuario (Correo electrónico):</label>
                            <input type="text" class="form-control" id="usuario"  name="usuario" required="required" />
                        </div>
                        <div class="col-lg-12 contact_col">
                            <label>Clave (Genera una clave):</label>
                            <input type="password" class="form-control" id="clave"  name="clave" required="required"/>
                        </div>

                        <div class="col-lg-12 contact_col"><h4>Datos Personales</h4></div>
                        <div class="col-lg-12 ">
                            <label>Nombres:</label>
                            <input type="text" class="form-control" id="nombres"  name="nombres" required/>
                        </div>
                        <div class="col-lg-6 ">
                            <label>Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellidopaterno"  name="apellidopaterno" required/>
                        </div>
                        <div class="col-lg-6 ">
                            <label>Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidomaterno"  name="apellidomaterno" required/>
                        </div>
                        <!--
                        <div class="col-lg-6 ">
                            <label>Tipo Documento</label>
                            <select class="form-control" id="idtipodocumento" name="idtipodocumento">
                                <option value="1">DNI</option>
                                <option value="2">RUC</option>
                                <option value="3">PASAPORTE</option>
                            </select>
                        </div>

                        <div class="col-lg-6 ">
                            <label>N° Documento:</label>
                            <input type="text" class="form-control" id="ruc"  name="ruc" required/>
                        </div>
                      -->
                        <div class="col-lg-12 ">
                            <label>Dirección <f style="color: red; font-size: 11px">(Opcional)</f>:</label>
                            <input type="text" class="form-control" id="direccion"  name="direccion"/>
                        </div>
                        <div class="col-lg-6 ">
                            <label>Teléfono Móvil <f style="color: red; font-size: 11px">(Opcional)</f>:</label>
                            <input type="text" class="form-control" id="telefonomovil"  name="telefonomovil"/>
                        </div>
                        <div class="col-lg-6 ">
                            <label>Teléfono Fijo <f style="color: red; font-size: 11px">(Opcional)</f>:</label>
                            <input type="text" class="form-control" id="telefonofijo"  name="telefonofijo" />
                        </div>

                        <div class="callout callout-danger" style="display:none" id="divError">
                            Complete los datos!
                        </div>
                        <legend></legend>
                        <div class="col-lg-12 contact_col">
                            <button id="btnRegistrar" name="btnRegistrar" class="btn btn-xs btn-primary" style="background-color: #44C4AB"> REGISTRAR </button>
                        </div>
                        
                    </div>    
                  {{ Form::close() }}         
              </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer bg-white" style="padding: 0.1px">
      <div class="container">

        <div class="row">
          <div class="col-md-12">
            <div class="row">
               <!--
              <div class="col-md-2">
               <h2 class="footer-heading mb-4">{{ $info->empresa }}</h2>
              </div>
              -->
              <div class="col-md-5 ">
                <p> {!! $info->footer !!} </p>
              </div>
              <!--
              <div class="col-md-3 ">
                <h2 class="footer-heading mb-4">Accesos Rápidos</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Nosotros</a></li>
                  <li><a href="#">Servicios</a></li>
                  <li><a href="#">Productos</a></li>
                  <li><a href="#">Contacto</a></li>
                </ul>
              </div>
              <div class="col-md-2">
                <h2 class="footer-heading mb-4">Síguenos</h2>
                <ul class="list-unstyled">
                  <li><a href="{{ $info->linkfacebook }}" class="pl-3 pr-3"><span class="icon-facebook"></span></a></li>
                  <li><a href="{{ $info->linktwitter }}" class="pl-3 pr-3"><span class="icon-twitter"></span></a></li>
                  <li><a href="{{ $info->linkinstagram }}" class="pl-3 pr-3"><span class="icon-instagram"></span></a></li>
                  <li><a href="{{ $info->linklikedin }}" class="pl-3 pr-3"><span class="icon-linkedin"></span></a></li>
                  <li><a href="{{ $info->linkwhatsapp }}" class="pl-3 pr-3"><span class="icon-whatsapp"></span></a></li>
                </ul>
              </div>
            -->
            </div>
          </div>
        </div>

        <div class="row pt-2 mt-2 text-center" style="margin-top: 1rem">
          <div class="col-md-12">
            <div class="border-top" style="padding-top: 1px">
              <h5 >Términos y Condiciones</h5>
              <p style="font-size: 11px; line-height : 16px;">{{ $info->nosotros }}</p>
            </div>
          </div>    
        </div>

        <div class="row pt-2 mt-2 text-center" style="margin-top: 1rem">
          <div class="col-md-12">
            <div class="border-top pt-2">
              <p style="font-size: 13px; line-height : 25px;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Miladev Software</p>
              
            </div>
          </div>    
        </div>

      </div>

    </footer>

  </div> <!-- .site-wrap -->

  <script src="{{ asset('adminstyleextranet/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/popper.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/aos.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('adminstyleextranet/js/jquery.sticky.js') }}"></script>

  <script src="{{ asset('adminstyleextranet/js/amazingcarousel.js?ver=1.2') }}"></script>

  <script src="{{ asset('adminstyleextranet/js/main.js') }}"></script>
  <script src="{{ URL::to('assets_int/plugins/bootbox.min.js')}}"></script>
  <script src="{{ URL::to('assets_int/plugins/iCheck/icheck.min.js')}}"></script>
    

  <script>
    $(function () {
        $('.dropdown-submenu > a').on("click", function(e) {
          var submenu = $(this);
          $('.dropdown-submenu .dropdown-menu').removeClass('show');
          submenu.next('.dropdown-menu').addClass('show');
          e.stopPropagation();
      });

      $('.dropdown').on("hidden.bs.dropdown", function() {
          // hide any open menus when parent closes
          $('.dropdown-menu.show').removeClass('show');
      });

      $( "#cmbCategorias" ).change(function() {
        var idcategoria = $("#cmbCategorias").val();
        //alert(idcategoria);
        if(idcategoria != ""){
          url = "{{ URL::to('productos') }}"+"/"+idcategoria;
          window.open(url, "_self");
          //return false;
        }
      });

      $( "#cmbCategorias2" ).change(function() {
        var idcategoria = $("#cmbCategorias2").val();
        //alert(idcategoria);
        if(idcategoria != ""){
          url = "{{ URL::to('productos') }}"+"/"+idcategoria;
          window.open(url, "_self");
          //return false;
        }
      });

    });


    function verLogin(){
      $("#modal-login").modal("show");
    }

    function verRegistro(){
      $("#modal-login").modal("hide");
      $("#modal-registro").modal("show");
    }

    function enviarClave() {
              
      if($("#usuario").val()!=""){
        $.ajax({
              type: "POST",
              async: false,
              data: {"idusuario":$("#usuario").val()},
              url: "{{ URL::to('intranet/seguridad/usuario/enviarclave') }}",
              dataType: "json",
              beforeSend: function (data) {
                
              },
              success: function (data) {
                //var oTableDetalles = $("#tblDetalles").dataTable();
                //oTableDetalles.fnClearTable();
                if (data !== null && typeof data === 'object') {
                  bootbox.alert(data.message);
                }
              },
              complete: function(){
                
              } 
            });
          }else{
            bootbox.alert("Ingrese el usuario");
          }

        //=================== ********* ====================
        }


    $("#frmRegistrar").submit(function(e) {
        var url = "{{ URL::to('intranet/seguridad/usuario/RegistroWeb') }}"; // the script where you handle the form input.  
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            cache:false,
            contentType: false,
            processData: false,
           success: function(data)
           {
                if(data.success==true){
                    bootbox.alert("Gracias por registrarse!!");   
                    $('#frmRegistrar')[0].reset()
                    $("#modal-registro").modal("hide");
                    //MostrarLista();
                    //Listar();
                }
                else{
                    bootbox.alert(data.message);   
                }
           },
           error: function (e){
               bootbox.alert(e.message);
           }
        });
        
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    $("#frmConsulta").submit(function(e) {
        var url = "{{ URL::to('logear') }}"; // the script where you handle the form input.
        $("#divError").hide();   
        $.ajax({
               type: "POST",
               url: url,
               data: {"usuario":$("#usuario").val(), "clave":$("#clave").val()}, // serializes the form's elements.
               success: function(data)
               {
                    if (data.obj !== null && typeof data.obj === 'object') {
                      if (data.obj.length >  0) {
                          $.each(data.obj, function (key, val) {
                              $("#id").val(val["id"]);
                              $("#codigo").val(val["codigo"]);

                              
                              if(val["indcorreoverificado"]=="1"){
                                if(data.perfiles.length > 0){
                                      console.log(data.perfiles[0].id);
                                      if(data.perfiles.length==1){
                                          Acceder(data.perfiles[0].idusuario,data.perfiles[0].idperfil,data.perfiles[0].idempresa,data.perfiles[0].idsede,data.perfiles[0].idtrabajador,data.perfiles[0].idperfil);
                                      }
                                }else{
                                    bootbox.alert("El usuario no tiene un perfil asignado");
                                }
                              }else{
                                  bootbox.alert("Verifique su correo electrónico para poder acceder");
                              }

                          });
                      }else{
                        //$("#divError").show();
                        bootbox.alert("Credenciales incorrectas, Regístrese o Contáctenos.");
                      }
                    }else{
                      //$("#divError").show();
                      bootbox.alert("Credenciales incorrectas, Regístrese o Contáctenos.");
                    }
               }
             });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    function redirectPost(url) {
          var form = document.createElement('form');
          document.body.appendChild(form);
          form.method = 'post';
          form.action = url;
          /*
          for (var name in data) {
              var input = document.createElement('input');
              input.type = 'hidden';
              input.name = name;
              input.value = data[name];
              form.appendChild(input);
          }
          */
          form.submit();
      }

      function Acceder(idusuario,idperfil,idempresa,idsede,idtrabajador,id) {
          var info = "";
          var url = "";

          if(idperfil=="2"){
            url = "{{ URL::to('accedercliente') }}";
          }else{
            url = "{{ URL::to('acceder') }}";
          }

          
          $.ajax({
            type: "POST",
            async: false,
            data: {"idusuario":idusuario, "idperfil":idperfil, "idempresa":idempresa, "idsede":idsede, "idtrabajador":idtrabajador},
            url: url,
            dataType: "json",
            beforeSend: function (data) {
              
            },
            success: function (data) {
              //var oTableDetalles = $("#tblDetalles").dataTable();
              //oTableDetalles.fnClearTable();
              if (data !== null && typeof data === 'object') {
                if(id==2 || id==3){
                  window.location = "{{URL::to('/')}}";
                }else{
                  window.location = "{{URL::to('intranet')}}";
                }
              }
            },
            complete: function(){
              
            } 
          });
        //=================== ********* ====================
        }

        function Logout() {
            bootbox.confirm("¿Seguro que deseas salir del Sistema?", function (result) {
                if (result) {
                    var info = "";
                    $.ajax({
                        type: "POST",
                        async: false,
                        data: {},
                        url: "{{URL::to('logout')}}",
                        dataType: "json",
                        beforeSend: function (data) {

                        },
                        success: function (data) {
                            //var oTableDetalles = $("#tblDetalles").dataTable();
                            //oTableDetalles.fnClearTable();
                            if (data !== null && typeof data === 'object') {
                                window.location = "{{URL::to('inicio')}}";
                            }
                        },
                        complete: function () {

                        }
                    });
                }
            });

            //=================== ********* ====================
        }

        function irMisPedidos(){
          var tipousuario = "";
          var url = "{{ URL::to('intranet') }}";

          if("{{ Session::get('idusuario') }}"==""){
            url = "{{ URL::to('intranet') }}";
          }else{
            if("{{ Session::get('idperfil') }}"=="2"){
              url = "{{ URL::to('intranet/comercial/ordenpedidousuario') }}";
            }else{
              url = "{{ URL::to('intranet/comercial/ordenpedidovendedor') }}";
            } 
          }

          window.location = url;

        }

  </script>


  @yield('scripts-add')


  </body>
</html>