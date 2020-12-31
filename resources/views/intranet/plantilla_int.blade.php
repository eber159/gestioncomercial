<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title-page')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="{{ URL::asset('assets_int/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/dist/css/skins/_all-skins.min.css')}}">    
        
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/select2/dist/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/plugins/iCheck/all.css')}}">

        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">

        <link rel="stylesheet" href="{{URL::asset('assets_int/plugins/jquery.gritter/css/jquery.gritter.css')}}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


        <link rel="stylesheet" href="{{URL::asset('assets_int/plugins/datatables.report/css/jquery.dataTables.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets_int/plugins/datatables.report/css/buttons.dataTables.min.css')}}">

        <style>

            label {
                font-family: "Verdana", "Helvetica", sans-serif;
            }

            body {
                font-family: "Verdana", "Helvetica", sans-serif;
                font-size: 11px;
            }

            .skin-blue .main-header .logo {
                background-color: #334b58;
                color: #fff;
                border-bottom: 0 solid transparent;
            }

            .skin-blue .main-header .navbar {
                background-color: #334b58;
            }

            .main-header .sidebar-toggle {
                float: left;
                background-color: transparent;
                background-image: none;
                padding: 15px 15px;
                font-family: "Source Sans Pro", "Trebuchet MS", sans-serif;
                font-size: 16px;
            }

            .treeview-menu>li>a {
                padding: 5px 5px 5px 15px;
                display: block;
                font-size: 12px;
            }

            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                font-family: "Verdana", "Helvetica", sans-serif;
                padding-top: 1px;
                padding-bottom: 1px;
                padding-left: 5px;
                padding-right: 5px;
                line-height: 1.42857143;
                vertical-align: top;
                border-top: 1px solid #ddd;
                font-weight: normal;
                font-size: 11px;
            }


            .form-control {
                display: block;
                width: 100%;
                height: 30px;
                padding: 1px 8px 1px;
                font-size: 11px;
                font-family: "Verdana", "Helvetica", sans-serif;
            }

            .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                position: relative;
                min-height: 1px;
                padding-right: 8px;
                padding-left: 8px;
            }

            label {
                display: inline-block;
                max-width: 100%;
                margin-bottom: 3px;
                font-size: 12px;
                font-family: "Helvetica", "Helvetica", sans-serif;
                font-weight: 600;
            }

            .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn {
                height: 28px;
                padding: 5px 10px;
                font-size: 12px;
                line-height: 1.5;
                border-radius: 3px;
                font-family: "Helvetica", "Helvetica", sans-serif;
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                display: block;
                padding-left: 8px;
                padding-right: 20px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                font-family: "Helvetica", "Helvetica", sans-serif;
                font-weight: normal;
            }

            .fila_eliminada {
                background-color: red;
            }

            .form-control2 {
                display: block;
                width: 100%;
                height: 19px;
                padding: 1px 2px 1px;
                font-size: 12px;
                font-family: "Helvetica", "Helvetica", sans-serif;
            }

            .nav-tabs-custom {
                margin-bottom: 20px;
                background: #ececec;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
                border-radius: 3px;
            }

            .skin-blue .main-header .logo {
                background-color: #;
                color: #fff;
                border-bottom: 0 solid transparent;
            }

            .skin-blue .main-header .navbar {
                background-color: #;
            }

            .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
                background-color: #222d32;
            }

        </style>

    </head>
    <body class="sidebar-mini skin-blue fixed">
    <!-- <body class="hold-transition skin-red sidebar-mini"> -->    
        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="{{URL::to('/inicio')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>W</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b> <img src="" height="45px" > </b></span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        &nbsp; {{ Session::get('empresa') }}
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <i class="fa fa-cogs"></i>
                                  <ul class="dropdown-menu">
                                      <li><a href="#" onclick="RefrescarOpciones()" >Refrescar Opciones</a></li>
                                  </ul>
                                </a>
                            </li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{URL::asset('assets_int/dist/img/avatar5.png')}}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ Session::get('nombretrabajador') }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{URL::asset('assets_int/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
                                        <p>
                                            {{ Session::get('nombretrabajador') }}
                                            <small></small>
                                        </p>
                                    </li>
                                    
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" onclick="Logout()" class="btn btn-default btn-flat">Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>


            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{URL::asset('assets_int/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p style="">Usuario: {{ Session::get('nombreusuario') }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">OPCIONES DEL SISTEMA</li>
                        <li class="header">PERFIL: {{ Session::get('nombreperfil') }}</li>
                        
                        @foreach ($opciones as $opcion)
                        @if($opcion->idtipoobjeto == config('constants.tipoobjeto.modular') && ($opcion->nivel == 1))
                        <li class="treeview">
                            <a href="#">
                                <i class="{{ $opcion->icono }}"></i> <span>{{ $opcion->nombre }}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @foreach ($opciones as $opcion2)
                                @if($opcion2->idtipoobjeto == config('constants.tipoobjeto.modular') && ($opcion2->nivel == 2) && ($opcion2->idobjetopadre == $opcion->id) )
                                <li class="treeview">
                                    <a href="#">
                                        <i class="{{ $opcion2->icono }}"></i> <span>{{ $opcion2->nombre }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        @foreach ($opciones as $opcion3)
                                        @if($opcion3->idtipoobjeto == config('constants.tipoobjeto.general') && ($opcion3->nivel == 3) && ($opcion3->idobjetopadre == $opcion2->id) )
                                        <li class="{{ Request::is('$opcion3->propiedad') ? 'active' : '' }}"><a href="{{URL::to($opcion3->propiedad)}}"><i class="{{ $opcion3->icono }}"></i> {{ $opcion3->nombre }} </a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @if($opcion2->idtipoobjeto == config('constants.tipoobjeto.general') && ($opcion2->nivel == 2) && ($opcion2->idobjetopadre == $opcion->id) )
                                    <li class="{{ Request::is($opcion2->propiedad) ? 'active' : '' }}"><a href="{{URL::to($opcion2->propiedad)}}"><i class="{{ $opcion2->icono }}"></i> {{ $opcion2->nombre }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1 style="display:inline"> @yield('titulo-form') </h1>
                    @yield('subtitulo-form')
                    &nbsp;
                    <div id="divCargando" style="display:inline;"> <img src="{{URL::asset('assets_int/dist/img/spinner.gif')}}" height="35px"> Procesando Información </div>

                </section>

                @yield('botonera')

                @yield('contenido')

                <div class="modal modal-default fade" id="modal-espere-registro">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Precios Configurados</h4>
                            </div>

                            <div class="modal-body">
                                <div class="">
                                    <div id="divPrincipal">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


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
                                    <div class="col-lg-12 contact_col"><h4>Ingrese sus credenciales</h4></div>
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
                                        <a href="registro">No estás registrado?. Regístrate</a>
                                        Olvidaste tu contraseña? <a href="#" onclick="enviarClave()">Haz Click aquí, te enviaremos un correo.</a>
                                    </div>
                                    
                                </div>    
                                {{ Form::close() }}                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="main-footer">
                <div class="container">
                    <div class="pull-left hidden-xs">
                        <strong>Copyright &copy; 2020 <a href="">ERPWeb software</a>.</strong> Todos los derechos reservados. <a href="">{{ Session::get('empresa') }}</a> - <a href="">{{ Session::get('sede') }}</a>
                        <b>Version</b> 1.0.0
                    </div>
            </footer>

        </div>
        <!-- ./wrapper -->

        <script src="{{ URL::to('assets_int/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <script type="text/javascript">
					$(function () {
							$('#btnGuardar').hide();
							$('#btnCancelar').hide();
							$('#divRegistro').hide();
					});
        </script>

        <script src="{{ URL::to('assets_int/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/raphael/raphael.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/morris.js/morris.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

        <!--
        <script src="{{ URL::to('assets_int/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        -->

        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/buttons.flash.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/jszip.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/pdfmake.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/vfs_fonts.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/buttons.html5.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/datatables.report/js/buttons.print.min.js')}}"></script>

        <script src="{{ URL::to('assets_int/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{ URL::to('assets_int/dist/js/adminlte.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/dist/js/pages/dashboard.js')}}"></script>
        <script src="{{ URL::to('assets_int/dist/js/demo.js')}}"></script>

        <script src="{{ URL::to('assets_int/plugins/input-mask/jquery.inputmask.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/bootbox.min.js')}}"></script>

        <script src="{{ URL::to('assets_int/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/iCheck/icheck.min.js')}}"></script>

	<script src="{{ URL::to('assets_int/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/fullcalendar/dist/locale-all.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/fullcalendar/dist/popper.min.js')}}"></script>
	
        <script src="{{ URL::to('assets_int/bower_components/ckeditor/ckeditor.js')}}"></script>
        <script src="{{ URL::to('assets_int/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

        @yield('stripts_especific')

        <script>

            function SumarDias(dateObj, numDays) {
               dateObj.setDate(dateObj.getDate() + numDays);
               return dateObj;
            }

            function RestarDias(dateObj, numDays) {
               dateObj.setDate(dateObj.getDate() - numDays);
               return dateObj;
            }

            $(function () {
                $("#divCargando").hide();
            });

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
                                    window.location = "{{URL::to('intranet')}}";
                                }
                            },
                            complete: function () {

                            }
                        });
                    }
                });

                //=================== ********* ====================
            }

            function RefrescarOpciones() {
                //bootbox.confirm("¿Seguro que deseas salir del Sistema?", function (result) {
                    //if (result) {
                        var info = "";
                        $.ajax({
                            type: "POST",
                            async: false,
                            data: {},
                            url: "{{URL::to('refrescaropciones')}}",
                            dataType: "json",
                            beforeSend: function (data) {

                            },
                            success: function (data) {
                                //var oTableDetalles = $("#tblDetalles").dataTable();
                                //oTableDetalles.fnClearTable();
                                if (data !== null && typeof data === 'object') {
                                    window.location = "{{URL::to('intranet')}}";
                                }
                            },
                            complete: function () {
                                bootbox.alert("Opciones Actualizadas");
                            }
                        });
                    //}
                //});

                //=================== ********* ====================
            }

        </script>

    </body>
</html>
