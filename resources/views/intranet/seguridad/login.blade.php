<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel de Control | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ URL::asset('assets_int/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" >
  <link rel="stylesheet" href="{{ URL::asset('assets_int/bower_components/font-awesome/css/font-awesome.min.css')}}" >
  <link rel="stylesheet" href="{{ URL::asset('assets_int/bower_components/Ionicons/css/ionicons.min.css')}}" >
  <link rel="stylesheet" href="{{ URL::asset('assets_int/dist/css/AdminLTE.min.css')}}" >
  <link rel="stylesheet" href="{{ URL::asset('assets_int/plugins/iCheck/square/blue.css')}}" >
  <link rel="stylesheet" href="{{URL::asset('assets_int/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <style type="text/css">
    .login-box-body, .register-box-body {
        background: #fff;
        padding: 20px;
        border-top: 0;
        color: #666;
        border-radius: 15px;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
				font-family: "Source Sans Pro", "Calibri", sans-serif;
			    padding-top: 1px;
			    padding-bottom: 1px;
			    padding-left: 5px;
			    padding-right: 5px;
			    line-height: 1.42857143;
			    vertical-align: top;
			    border-top: 1px solid #ddd;
			}

      .btn-group-sm>.btn, .btn-sm {
          padding: 0px 3px;
          font-size: 12px;
          line-height: 1.5;
          border-radius: 3px;
      }

  </style>

</head>
<body class="hold-transition login-page" style="background: url('img/slide1.jpg') no-repeat center center fixed;background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Sistema de Gestión Comercial<br></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

    <form action="#" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" id="clave" name="clave">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="callout callout-danger" style="display:none" id="divError">
        Credenciales incorrectas!
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button class="btn btn-primary btn-block btn-flat" id="btnLogear" name="btnLogear">Accede</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<!--
    <div class="social-auth-links text-center">
      <p>- o -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
	-->
    <!-- /.social-auth-links -->

    <!--<a href="#">Olvidé mi contraseña</a><br>
    <a href="register.html" class="text-center">No tienes una cuenta?, Regístrate!</a>
    -->
    
  </div>
  <!-- /.login-box-body -->

    <div class="modal modal-default fade" id="modal-perfiles">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"
                          aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Elija su perfil</h4>
              </div>

              <div class="modal-body">
                <div id="divPerfiles">

                </div>
                  <!--
                  <div class="table-responsive">
                    <table id="tblDetalles" class="table table-bordered table-hover" style="width: 100%">
                      <thead>
                        <tr>
                          <th style="display:none">Id</th>
                          <th>Empresa</th>
                          <th>Sede</th>
                          <th>Trabajador</th>
                          <th>Perfil</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                  -->
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>

</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ URL::to('assets_int/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ URL::to('assets_int/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{ URL::to('assets_int/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::to('assets_int/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::to('assets_int/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ URL::to('assets_int/plugins/iCheck/icheck.min.js')}}"></script>

<script src="{{ URL::to('assets_int/plugins/bootbox.min.js')}}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    
    InicializarTabla();

    $("#btnLogear").on("click", function(event) {
      event.preventDefault();
      if($("#usuario").val()!=""){
        if($("#clave").val()!=""){
          Logear();
        }else{
          bootbox.alert("Ingrese una Clave")
        }
      }else{
        bootbox.alert("Ingrese un Usuario")
      }
      

    });

  });


  function InicializarTabla() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblDetalles').dataTable({
				"info": false,
				"order": false,
        "bFilter": false,
        "bPaginate": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"sWidth": "30%", "mDataProp": "Empresa"
					},{
						"sWidth": "15%", "mDataProp": "Sede"
					},{
						"sWidth": "15%", "mDataProp": "Trabajador"
					},{
						"sWidth": "15%", "mDataProp": "Nombre"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

  function Logear() {
    var info = "";
    $.ajax({
      type: "POST",
      async: false,
      data: {"usuario":$("#usuario").val(), "clave":$("#clave").val()},
      url: "logear",
      dataType: "json",
      beforeSend: function (data) {
        $("#divError").hide();
      },
      success: function (data) {
        var oTableDetalles = $("#tblDetalles").dataTable();
        oTableDetalles.fnClearTable();
        if (data !== null && typeof data === 'object') {
          if(data.obj !== null){
            if (data.obj.length >  0) {
                  $.each(data.obj, function (key, val) {
                      $("#id").val(val["id"]);
                      $("#codigo").val(val["codigo"]);
                      var Linea = 1;
                      if(data.perfiles.length > 0){
                          console.log(data.perfiles[0].id);
                          if(data.perfiles.length==1){
                            Acceder(data.perfiles[0].idusuario,data.perfiles[0].idperfil,data.perfiles[0].idempresa,data.perfiles[0].idsede,data.perfiles[0].idtrabajador);
                          }
                          if(data.perfiles.length>1){
                            $("#modal-perfiles").modal("show");
                            var divPerfiles = "";
                            divPerfiles += "<div>";
                            $.each(data.perfiles, function (key, val2) {

                                
                                divPerfiles += "<div class='row'><div class='col-md-12' style='background-color: white; text-color:white'><button class='btn btn-primary' onclick='Acceder("+val["id"]+","+val2["idperfil"]+","+val2["idempresa"]+","+val2["idsede"]+","+val2["idtrabajador"]+")' style='width:100%' >"+val2["empresa"]+" <span class='btn btn-default btn-xs'>"+ val2["nombreperfil"]+"</span> ["+val2["sede"]+"]</button></div></div>";
                                /*
                                var oTableDetalles = $("#tblDetalles").dataTable();
                                  var objdet = {"Id": val2["id"]
                                      ,"Empresa":  val2["empresa"]
                                      ,"Sede":  val2["sede"]
                                      ,"Trabajador": val2["nombretrabajador"]
                                      ,"Nombre": val2["nombreperfil"]
                                      ,"Acciones":"<a class='btn btn-success btn-sm' href='#' onclick='Acceder("+val["id"]+","+val2["idperfil"]+","+val2["idempresa"]+","+val2["idsede"]+","+val2["idtrabajador"]+")' style='width: 100%'>"
                                          +"<i class='fa fa-check'></i> Acceder"
                                        +"</a>"
                                      ,"Estado": val["activo"]
                                };
                                oTableDetalles.fnAddData(objdet);
                                Linea++;
                                */
                            });
                            $("#divPerfiles").html(divPerfiles);
                          }
                      }else{
                          bootbox.alert("El usuario no tiene un perfil asignado");
                      }
                  });
              }else{
                $("#divError").show();
              }
          }else{
            $("#divError").show();
          }
        }
      },
      complete: function(){
          
      }
    });
  //=================== ********* ====================
  }


  function Acceder(idusuario,idperfil,idempresa,idsede,idtrabajador) {
    var info = "";
    $.ajax({
      type: "POST",
      async: false,
      data: {"idusuario":idusuario, "idperfil":idperfil, "idempresa":idempresa, "idsede":idsede, "idtrabajador":idtrabajador},
      url: "acceder",
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
      complete: function(){
        
      } 
    });
  //=================== ********* ====================
  }

</script>
</body>
</html>
