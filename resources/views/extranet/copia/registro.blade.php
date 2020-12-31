@extends('extranet.plantilla')

@section('title-page')
    Inicio
@stop

<!--<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/contact.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/contact.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/contact-responsive.css') }}">

<style type="text/css">
    .contactoform {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding: 15px;
        padding-left: 15px;
        border-size: 1px;
        border-style: groove;
    }
</style>

@section('content')
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <div class="section_subtitle"></div>
                        <div class="section_title"><h1> Registro de Usuarios</h1></div>
                    </div>
                </div>
            </div>
            <div class="row contact_row">
                <!-- Contact - About -->
                <form role="form" id="frmRegistro" enctype="multipart/form-data">
                    <div class="col-lg-12 ">
                        <div class="contactoform">
                            <div class="row">
                                <div class="col-lg-12 contact_col"><h3>Ingresa tus datos para generar un nuevo registro</h3></div>
                                <legend></legend>
                                <div class="col-lg-4 ">
                                    <label>Nombres:</label>
                                    <input type="text" class="form-control" id="nombres"  name="nombres" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apellidopaterno"  name="apellidopaterno" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellidomaterno"  name="apellidomaterno" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Usuario:</label>
                                    <input type="text" class="form-control" id="usuario"  name="usuario" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" id="password"  name="password" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Confirmar Password:</label>
                                    <input type="password" class="form-control" id="password2"  name="password2" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Fecha Nacimiento:</label>
                                    <input type="text" class="form-control" id="fechanacimiento"  name="fechanacimiento" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Teléfono Móvil:</label>
                                    <input type="text" class="form-control" id="telefonomovil"  name="telefonomovil" required/>
                                </div>
                                <div class="col-lg-4 ">
                                    <label>Teléfono Fijo:</label>
                                    <input type="text" class="form-control" id="telefonofijo"  name="telefonofijo" />
                                </div>
                                <div class="col-lg-12 ">
                                    <label>Correo electrónico:</label>
                                    <input type="text" class="form-control" id="correo"  name="correo" required/>
                                </div>
                            </div>
                            <div class="row">
                                <legend></legend>
                                <div class="col-lg-12 contact_col"><h3>Datos de la Empresa</h3></div>
                                
                                <div class="col-lg-3 ">
                                    <label>RUC:</label>
                                    <input type="text" class="form-control" id="ruc"  name="ruc" required/>
                                </div>
                                <div class="col-lg-6 ">
                                    <label>Razón Social:</label>
                                    <input type="text" class="form-control" id="razonsocial"  name="razonsocial" required/>
                                </div>
                                <div class="col-lg-12 ">
                                    <label>Dirección Fiscal</label>
                                    <input type="text" class="form-control" id="direccion"  name="direccion" required/>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 ">
                        <div class="">
                        <br/>
                            <div class="row">
                                <div class="col-lg-12 contact_col">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-xs btn-primary" style="background-color: #040c50"> ENVIAR REGISTRO </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--
                <div class="col-lg-4 contact_col">
                    <div class="contact_info">
                        <ul>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div><img src="images/placeholder_2.svg" alt=""></div>
                                </div>
                                <span>Main Str, no 23, New York</span>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div><img src="images/phone-call-2.svg" alt=""></div>
                                </div>
                                <span>+546 990221 123</span>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div><img src="images/envelope-2.svg" alt=""></div>
                                </div>
                                <span>hosting@contact.com</span>
                            </li>
                        </ul>
                    </div>
                </div>
                -->

                <!-- Contact - Image -->
                <div class="col-lg-4 contact_col">
                    <div class="contact_image d-flex flex-column align-items-center justify-content-center">
                        <img src="images/contact_image.jpg" alt="">
                    </div>
                </div>

            </div>

        </div>
    </div>
@stop


@section('content')

@stop

@section('scripts')
    <script type="text/javascript">

        $(function () {

            $('#fechanacimiento').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechanacimiento').datepicker("setDate", new Date());
                
        });

        $("#frmRegistro").submit(function(e) {
            var url = "intranet/seguridad/usuario/RegistroWeb"; // the script where you handle the form input.  
            var formData = new FormData(this);

            if($("#password").val()==$("#password2").val()){
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
                            bootbox.alert("Gracias por registrarse. Se ha enviado un correo de verificación a su bandeja de entrada.");   
                            $('#frmRegistro')[0].reset()
                            //MostrarLista();
                            //Listar();
                        }
                        else{
                            bootbox.alert(data.message);   
                        }
                   },
                   error: function (e){
                        alert(e);
                   }
                });
            }else{
                bootbox.alert("Las contraseñas no coinciden");
                $("#password").focus();
                $("#password").val("");
                $("#password2").val("");
            }

            
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    </script>
@stop