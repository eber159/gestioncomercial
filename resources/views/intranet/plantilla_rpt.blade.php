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

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <style>

            label {
                font-family: "Source Sans Pro", "Trebuchet MS", sans-serif;
            }

            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                font-family: "Helvetica", "Helvetica", sans-serif;
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
                font-size: 12px;
                font-family: "Helvetica", "Helvetica", sans-serif;
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
                font-size: 13px;
                font-weight: 600;
            }

            .input-group-sm>.form-control, .input-group-sm>.input-group-addon, .input-group-sm>.input-group-btn>.btn {
                height: 28px;
                padding: 5px 10px;
                font-size: 12px;
                line-height: 1.5;
                border-radius: 3px;
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

            tr.group,
            tr.group:hover {
                background-color: #A3A3A3 !important;
            }

            tr.subgroup,
            tr.subgroup:hover {
                background-color: #ddd !important;
            }

        </style>

    </head>
    <body class="sidebar-mini skin-blue fixed sidebar-collapse">
    <!-- <body class="hold-transition skin-red sidebar-mini"> -->    
        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="{{URL::to('/inicio')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b> <img src="" height="50px" > </b></span>
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
                                    <!-- Menu Footer-->
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
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
                        
                        <li><a href=""><i class="fa fa-book"></i> <span>Manuales</span></a></li>
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

            <footer class="main-footer">
                <div class="container">
                    <div class="pull-left hidden-xs">
                        <strong>Copyright &copy; 2018 <a href="">ERPWeb software</a>.</strong> Todos los derechos reservados. <a href="">{{ Session::get('empresa') }}</a> - <a href="">{{ Session::get('sede') }}</a>
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

        <script src="{{ URL::to('assets_int/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('assets_int/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

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

        @yield('stripts_especific')

        <script>
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

        </script>

    </body>
</html>
