@section('title-page')
	Intranet | Gestión Usuarios
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Usuarios <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Usuarios</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('botonera')
	</br>
	<div class="col-md-12">
		<div class="box">
			<div class="box-footer">
				<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
				<button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-default btn-sm"><i class="fa fa-file"></i> Nuevo </button>
				<button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i class="fa fa-excel"></i> Exportar</button>
				<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
				<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
			</div>
		</div>
	</div>
@stop
@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Registrados</h3>
					</div>
					<div class="box-body">
						<div id="Lista">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table id="tblDatos" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th>Usuario</th>
												<th>Password</th>
												<th>RUC</th>
												<th>Empresa</th>
												<th>Estado</th>
												<th>Acción</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="divRegistro" style="display:none">
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" style="width: 100%">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Password</label>
									<input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese Clave" style="width: 100%">
								</div>
							</div>
						</div>
					  <!-- /.box-body -->
					  
					</form>
				</div>
			</div>

			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Perfiles asignados</h3>
					</div>
					
					<div class="box-body">
						<div class="col-xs-12">
							<div class="col-xs-4">
								<select class="form-control" id="cmbEmpresa" name="cmbEmpresa"></select>
							</div>
							<div class="col-xs-4">
								<select class="form-control" id="cmbSede" name="cmbSede"></select>
							</div>
							<div class="col-xs-4">
								<select class="form-control" id="cmbPerfil" name="cmbPerfil"></select>
							</div>
							<div class="col-xs-12">
								<label>Trabajador</label>
								<select class="select2" id="cmbTrabajador" name="cmbTrabajador" style="width: 100%"></select>
							</div>
							<div class="col-xs-3">
								<label>&nbsp;</label>
								<button type="button" id="btnAsignar" name="btnAsignar" class="btn btn-default btn-sm btn-right" style="display: inline-block;width: 100%;align:right"><i class="fa fa-plus"></i> Agregar Perfil </button>
							</div>
						

							<table id="tblPerfiles" class="table table-bordered table-hover" style="width: 100%">
								<thead>
									<tr>
										<th style="display:none">Id</th>
										<th>Empresa</th>
										<th>Sede</th>
										<th>Trabajador</th>
										<th>Perfil</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			$('.select2').select2();
			InicializarTabla();
			InicializarTablaPerfiles();
			Listar();
			//CargarPerfiles();
			CargarEmpresas();
			CargarSedes();


			$("#btnGuardar").on("click", function(event) {
				if(validar()){
					var form = $('#frmRegistro');
					var resp = Guardar(form,'usuario/Guardar');
					if(resp=="ok"){
						//MostrarMensajeConfirmacion(data.message);
						$('#frmRegistro')[0].reset();
						MostrarLista();
						Listar();
					}else{
						bootbox.alert("Ocurrió un error en el registro");
					}
				}
			});
			
			$("#btnAsignar").on("click", function(event) {
				if(validarPerfil()){
					AsignarPerfil();
				}
			});

			$("#btnListar").on("click", function(event) {
				Listar();
			});

			$("#cmbEmpresa").on("change", function(event) {
				$("#cmbPerfil").empty();
				if($("#cmbEmpresa").val()!=""){
					CargarPerfiles();
				}
			});

			$("#cmbEmpresa").on("change", function(event) {
				$("#cmbTrabajador").empty();
				if($("#cmbEmpresa").val()!=""){
					CargarTrabajadores();
				}
			});

		});
		
		function validar(){
	        if($("#nombre").val()==""){
	            bootbox.alert("No ha indicado el nombre del usuario.");
	            return false;
	        }
	        return true;
	    }

	    function validarPerfil(){
	    	if($("#id").val()==""){
	            bootbox.alert("Registre el Usuario");
	            return false;
	        }
	        if($("#cmbPerfil").val()==""){
	            bootbox.alert("Seleccione un perfil");
	            return false;
	        }
	        return true;
	    }

	    

		function Listar() {
			var form = $('#frmRegistro');
			var url = "usuario/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: form.serialize(),
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTable = $("#tblDatos").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							/*
							$botonactivar ="";
							if(val["estadousuario"]=="ACTIVO"){
								$botonactivar = "<a href='javascript:;' class='btn btn-warning btn-xs' onclick='CambiarEstado("+val["id"]+",0)' class='blue'><i class='fa fa-arrow-down'></i></a>";
							}else{
								$botonactivar = "<a href='javascript:;' class='btn btn-success btn-xs' onclick='CambiarEstado("+val["id"]+",1)' class='blue'><i class='fa fa-arrow-up'></i></a>";
							}
							*/
							var obj = {"Id": val["id"]
									,"Usuario": val["nombre"]
									,"Password": "********"
									,"RUC": val["numerodocumento"]
									,"Empresa": val["nombrecliente"]
									,"Estado": val["estadousuario"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-default btn-xs' onclick='EditarUsuario(\"usuario/Leer\","+val["id"]+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"usuario/Eliminar\","+val["id"]+")' class='red'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</center>"};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}

		
		
		function InicializarTabla() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblDatos').dataTable({
				"info": false,
				"order": false,
				"searbch": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"sWidth": "10%", "mDataProp": "Usuario"
					},{
						"sWidth": "5%", "mDataProp": "Password"
					},{
						"sWidth": "5%", "mDataProp": "RUC"
					},{
						"sWidth": "15%", "mDataProp": "Empresa"
					},{
						"sWidth": "5%", "mDataProp": "Estado"
					},{
						"sWidth": "15%", "mDataProp": "Acciones"
				}]
			});
		}

		function InicializarTablaPerfiles() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblPerfiles').dataTable({
				"bInfo": false,
				"bPaginate": false,
				"bFilter": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"sWidth": "30%", "mDataProp": "Empresa"
					},{
						"sWidth": "15%", "mDataProp": "Sede"
					},{
						"sWidth": "15%", "mDataProp": "Trabajador"
					},{
						"sWidth": "15%", "mDataProp": "Perfil"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#clave").val(val["clave"]);
			$("#nombre").val(val["nombre"]);
			$("#idtrabajador").val(val["idtrabajador"]);
		}

		function ValidarAsignacion(){
			if($("#cmbPerfil").val()==""){
				bootbox.alert("Seleccione un Perfil");
				return false;
			}
			if($("#cmbEmpresa").val()==""){
				bootbox.alert("Seleccione una Empresa");
				return false;
			}
			if($("#cmbSede").val()==""){
				bootbox.alert("Seleccione una Sede");
				return false;
			}
			if($("#cmbTrabajador").val()==""){
				bootbox.alert("Seleccione un Trabajador para asociar al Perfil");
				return false;
			}
			return true;
		}

		function AsignarPerfil(){
			if(ValidarAsignacion()){
				//Obtener Objetos
				//Cabecera
				var obj = {
					"id":""
					,"idsede":$("#cmbSede").val()
					,"idperfil": $("#cmbPerfil").val()
					,"idusuario": $("#id").val()
					,"idtrabajador": $("#cmbTrabajador").val()
					,"idempresa": $("#cmbEmpresa").val()
				};

				var resp = "";
				$.ajax({
					type: "POST",
					async: false,
					data: obj,
					url: "../seguridad/perfilusuario/Guardar",
					dataType: "json",
					beforeSend: function (data) {
						
					},
					success: function (data) {
						if (data !== null && typeof data === 'object') {
							if(data.success == true){
								bootbox.alert(data.message);
								//MostrarLista();
								//ListarPerfiles();
								ListarPerfilesxUsuario($("#id").val());
								//$('#frmRegistro')[0].reset();
								//resp = "ok";
							}
						}
						else
						{
							alert("Ocurrio un error en el registro");
							resp = "error";
						}
					}
				});
				return resp;	
			}
		}

		function CargarPerfiles() {
            var $combo = $("#cmbPerfil");
            $combo.empty();
            $.post('../seguridad/perfil/Listar',{"idempresa":$("#cmbEmpresa").val()},
                    function (data) {
                        $combo.append("<option value=''>Seleccione Perfil</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarTrabajadores() {
            var $combo = $("#cmbTrabajador");
            $combo.empty();
            $.post('../configuracion/trabajador/Listar',{"idempresa":$("#cmbEmpresa").val()},
                    function (data) {
                        $combo.append("<option value=''>Seleccione Perfil</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarSedes() {
            var $combo = $("#cmbSede");
            $combo.empty();
            $.post('../configuracion/sede/Listar',
                    function (data) {
                        $combo.append("<option value=''>Seleccione Sede</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarEmpresas() {
            var $combo = $("#cmbEmpresa");
            $combo.empty();
            $.post('../configuracion/empresa/Listar', {"indsistema": "1"} ,
                    function (data) {
                        $combo.append("<option value=''>Seleccione Empresa</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function EditarUsuario(url,id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			$('#frmRegistro')[0].reset();
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTableDetalles = $("#tblPerfiles").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#clave").val(val["clave"]);
							$("#nombre").val(val["nombre"]);
							$("#idtrabajador").val(val["idtrabajador"]);

					        $.each(data.perfiles, function (key, val2) {
					        	var oTableDetalles = $("#tblPerfiles").dataTable();
					            var objdet = {"Id": val2["id"]
										,"Empresa": val2["empresa"]
										,"Sede": val2["sede"]
										,"Trabajador": val2["nombretrabajador"]
					            		,"Perfil": val2["nombreperfil"]
										,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
														+"<a href='javascript:;' onclick='Quitar("+val2["id"]+")'>"
															+"<i class='ace-icon fa fa-times bigger-130'></i>"
														+"</a>&nbsp;"
													+"</div></center>"
										};
								oTableDetalles.fnAddData(objdet);
					        });
						});
						MostrarRegistro();
					}
				},
				complete: function(){
					
				} 
			});
			//=================== ********* ====================
		}
		
		function ListarPerfilesxUsuario(id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idusuario":id},
				url: "../seguridad/perfilusuario/Listar",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTableDetalles = $("#tblPerfiles").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val2) {
							var oTableDetalles = $("#tblPerfiles").dataTable();
							var objdet = {"Id": val2["id"]
									,"Empresa": val2["empresa"]
									,"Sede": val2["sede"]
									,"Trabajador": val2["nombretrabajador"]									
									,"Perfil": val2["nombreperfil"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='Quitar("+val2["id"]+")'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>&nbsp;"
												+"</div></center>"
									};
							oTableDetalles.fnAddData(objdet);
						});
					}
				},
				complete: function(){
					
				} 
			});
			//=================== ********* ====================
		}

		function Quitar(id) {
			bootbox.confirm("¿Seguro que deseas quitar el perfil?", function(result) {
				if(result){
					var info = "";
					$.ajax({
						type: "POST",
						async: false,
						data: {"id":id},
						url: "../seguridad/perfilusuario/Eliminar",
						dataType: "json",
						beforeSend: function (data) {
							
						},
						success: function (data) {
							if (data !== null && typeof data === 'object') {
								bootbox.alert(data.message);
								ListarPerfilesxUsuario($("#id").val());
							}
						}
					});
				}
			});
			//=================== ********* ====================
		}


		function CambiarEstado(id,estado){
			$msgpreg = "";
			$msgrpta = "";

			if(estado == 1){
				$msgpreg = "¿Seguro que deseas Activar al Usuario?";
				$msgrpta = "Usuario Activado";
			}else{
				$msgpreg = "¿Seguro que deseas Desactivar al Usuario?";
				$msgrpta = "Usuario Desactivado";
			}


			bootbox.confirm($msgpreg, function(result) {
				if(result){
					$.ajax({
						type: "POST",
						async: false,
						data: {"id":id,"estado": estado},
						url: "{{ URL::to('intranet/seguridad/usuario/CambiarEstado') }}",
						dataType: "json",
						beforeSend: function (data) {
							
						},
						success: function (data) {
							if(data.success == true){
								bootbox.alert($msgrpta);
								Listar();
							}else{
								bootbox.alert(data.message);
								console.log(data.message);
							}
							if(data.success == "session"){
								bootbox.alert(data.message);
							}
						},
						error: function (data) {
							bootbox.alert(data.message);
							onsole.log(data.message);
						}
					});
				}
			});
		}

	</script>	
@stop