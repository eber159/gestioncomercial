@extends('extranet.plantilla')

@section('title-page')
    Inicio
@stop

<!--<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/contact.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/contact.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminstyleextranet/styles/contact_responsive.css') }}">

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

    .contact_col:not(:last-child) {
        margin-bottom: 20px;
    }

</style>

@section('content')
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <div class="section_subtitle">Accede o regístrate para acceder</div>
                        <div class="section_title"><h1>LOGIN</h1></div>
                    </div>
                </div>
            </div>
            <div class="row contact_row">
                <!-- Contact - About -->

                <div class="col-lg-6 contact_col">
                    {{ Form::open(array('url' => 'intranet', 'method' => 'post', 'files' => true, 'enctype'=>'multipart/form-data', 'id'=>"frmConsulta")) }}
                        <div class="contactoform">
                            <div class="col-lg-12 contact_col"><h3>Ingresa si estás registrado</h3></div>
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
                                <button id="btnIngresar" name="btnIngresar" class="btn btn-xs btn-primary" style="background-color: #040c50"> INGRESAR </button>
                            </div>
                        </div>    
                    {{ Form::close() }}
                    
                </div>

                <div class="col-lg-6 contact_col">
                    <div class="contactoform">
                        <div class="col-lg-12 contact_col"><h3>Aún no estás registrado?</h3></div>
                        <div class="col-lg-12 contact_col">
                            <a href="registro" class="btn btn-xs btn-primary" style="background-color: #040c50"> REGÍSTRATE AHORA </a>
                        </div>
                    </div>
                </div>

                <!-- Contact - Image -->
                <div class="col-lg-4 contact_col">
                    <div class="contact_image d-flex flex-column align-items-center justify-content-center">
                        <img src="images/contact_image.jpg" alt="">
                    </div>
                </div>

            </div>

        </div>
    </div>


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
                  </div>
              </div>

          </div>
          <!-- /.modal-content -->
      </div>


@stop


@section('content')

@stop

<script src="{{ asset('assets_int/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets_int/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{ asset('assets_int/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets_int/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets_int/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets_int/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{ asset('assets_int/plugins/bootbox.min.js')}}"></script>



<script>

    $(document).ready(function () {

        $("#frmConsulta").submit(function(e) {
            var url = "logear"; // the script where you handle the form input.
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
                                          if(data.perfiles.length>1){
                                              var oTableDetalles = $("#tblDetalles").dataTable();
                                              oTableDetalles.fnClearTable();
                                              $("#modal-perfiles").modal("show");
                                              var divPerfiles = "";
                                              divPerfiles += "<div>";
                                              $.each(data.perfiles, function (key, val2) {
                                                  divPerfiles += "<div class='row'><div class='col-md-12' style='background-color: white; text-color:white'><button class='btn btn-primary' onclick='Acceder("+val["id"]+","+val2["idperfil"]+","+val2["idempresa"]+","+val2["idsede"]+","+val2["idtrabajador"]+")' style='width:100%' >"+val2["empresa"]+" <span class='btn btn-default btn-xs'>"+ val2["nombreperfil"]+"</span> ["+val2["sede"]+"]</button></div></div>";
                                              });
                                              $("#divPerfiles").html(divPerfiles);
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
            if(id==1){
              url = "acceder";
            }
            if(id==2){
              url = "accedercliente";
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
                  if(id==1){
                    window.location = "{{URL::to('intranet')}}";
                  }
                  if(id==2){
                    window.location = "{{URL::to('principal')}}";
                  }
                }
              },
              complete: function(){
                
              } 
            });
          //=================== ********* ====================
          }

    });



/*

  $(function () {
    
    InicializarTabla();

    $("#btnIngresar").on("click", function(event) {
      if($("#usuario").val()!=""){
        if($("#password").val()!=""){
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
      data: {"usuario":$("#usuario").val(), "clave":$("#password").val()},
      url: "logear",
      dataType: "json",
      beforeSend: function (data) {
        $("#divError").hide();
      },
      success: function (data) {
        var oTableDetalles = $("#tblDetalles").dataTable();
        oTableDetalles.fnClearTable();
        if (data !== null && typeof data === 'object') {
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
          window.location = "{{URL::to('inicio')}}";
        }
      },
      complete: function(){
        
      } 
    });
  //=================== ********* ====================
  }
    */
</script>