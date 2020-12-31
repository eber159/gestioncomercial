@section('title-page')
	ErpWeb | Gestión Trabajador
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Trabajadores <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Trabajadores</a></li>
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
												<th class="center">
													<label class="pos-rel">
														<input type="checkbox" class="ace" />
														<span class="lbl"></span>
													</label>
												</th>
												<th>Nombre</th>
												<th>Cargo</th>
												<th>Acciones
												</th>
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
			<div class="col-md-12">
				<form role="form" id="frmRegistro">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<input type="hidden" class="form-control" id="idpersona" name="idpersona" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-6">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Tipo Documento</label>
										<select class="form-control" id="idtipodocumento" name="idtipodocumento">
											<option value="">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">N° Documento</label>
										<input type="text" class="form-control" id="nrodocumento" name="nrodocumento" placeholder="Ingrese N° Doc." style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Nombres</label>
										<input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese nombres" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Apellido Paterno</label>
										<input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" placeholder="Apellido Paterno" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Apellido Materno</label>
										<input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" placeholder="Apellido Materno" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Sexo</label>
										<select class="form-control" id="sexo" name="sexo">
											<option value="M">Masculino</option>
											<option value="S">Femenino</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Fecha Nacimiento</label>
										<input type="text" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Dirección</label>
										<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese Dirección" style="width: 100%">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Empresa</label>
										<select class="form-control" id="idempresa" name="idempresa">
											<option value="">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Cargo</label>
										<select class="form-control" id="idcargotrabajador" name="idcargotrabajador">
											<option value="">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Estado Civil</label>
										<select class="form-control" id="idestadocivil" name="idestadocivil">
											<option value="">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Fecha Inicio Contrato</label>
										<input type="text" class="form-control" id="fechaingreso" name="fechaingreso" placeholder="" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Fecha Término Contrato</label>
										<input type="text" class="form-control" id="fechatermino" name="fechatermino" placeholder="" style="width: 100%">
									</div>
								</div>
							</div>
							<div class="col-md-6">

							</div>

						</div>
					  <!-- /.box-body -->
				</div>

				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos de Usuario</h3>
					</div>
					<div class="box-body">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Usuario</label>
								<input type="text" class="form-control" id="nombreusuario" name="nombreusuario" placeholder="Ingrese Nombre" style="width: 100%">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Password</label>
								<input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese Clave" required="required" style="width: 100%">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								<label for="">Sede</label>
								<select class="form-control" id="cmbSede" name="cmbSede"></select>
							</div>
							
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								<label for="">Perfil</label>
								<select class="form-control" id="cmbPerfil" name="cmbPerfil"></select>
							</div>
							
						</div>
					</div>
					
				</div>

				</form>



			</div>
		</div>
	</section>
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			
			InicializarTabla();
			Listar();
			CargarComboTipoDocumento();
			CargarEmpresas();
			CargarComboCargotrabajador();
			CargarComboEstadoCivil();
			CargarSedes();
			
			$('#fechanacimiento').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#fechanacimiento').datepicker("setDate", new Date());

			$('#fechaingreso').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#fechaingreso').datepicker("setDate", new Date());

			$('#fechatermino').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#fechatermino').datepicker("setDate", new Date());

			$("#btnGuardar").on("click", function(event) {
				if(validarGuardar()){
					var form = $('#frmRegistro');
					var resp = Guardar(form,'trabajador/Guardar');
					if(resp=="ok"){
						//MostrarMensajeConfirmacion(data.message);
						MostrarLista();
						Listar();
						
					}else{
						bootbox.alert("Ocurrió un error en el registro");
					}
				}
				
			});
			
			$("#btnListar").on("click", function(event) {
				Listar();
			});

			$("#btnNuevo").on("click", function(event) {
				$('#fechanacimiento').datepicker({
					format: 'yyyy-mm-dd'
				});
				$('#fechanacimiento').datepicker("setDate", new Date());

				$('#fechaingreso').datepicker({
					format: 'yyyy-mm-dd'
				});
				$('#fechaingreso').datepicker("setDate", new Date());
			});


			$("#idempresa").on("change", function(event) {
				$("#cmbPerfil").empty();
				if($("#idempresa").val()!=""){
					CargarPerfiles();
				}
			});

			$("#nombres").on("change", function(event) {
				GenerarNombreUsuario();
			});
			$("#apellidopaterno").on("change", function(event) {
				GenerarNombreUsuario();
			});
			$("#apellidomaterno").on("change", function(event) {
				GenerarNombreUsuario();
			});

		});
		
		function Listar() {
			var form = $('#frmRegistro');
			var url = "trabajador/Listar";
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
							var obj = {"Id": val["id"]
									,"Sel": ""
									,"Nombre": val["nombre"]
									,"Cargo": val["cargo"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='EditarTrabajador(\"trabajador/Leer\","+val["id"]+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"trabajador/Eliminar\","+val["id"]+")' class='btn btn-danger btn-xs'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</div></center>"};
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
				"search": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"bVisible": true, "sWidth": "5%", "mDataProp": "Sel"
					},{
						"sWidth": "60%", "mDataProp": "Nombre"
					}, {
						"sWidth": "20%", "mDataProp": "Cargo"
					},{
						"sWidth": "25%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#codigo").val(val["codigo"]);
			$("#nombre").val(val["nombre"]);
			$("#idtipodocumento").val(val["idtipodocumento"]);
			$("#idtipotrabajador").val(val["idtipotrabajador"]);
			$("#numerodocumento").val(val["numerodocumento"]);
			$("#idestadocivil").val(val["idestadocivil"]);
			$("#fechaingreso").val(val["fechaingreso"]);
			$("#abreviatura").val(val["abreviatura"]);
			if(val["indcliente"]==1){
				$("#indcliente").prop("checked",true);
			}else
			{
				$("#indcliente").prop("checked",false);
			}
			if(val["indproveedor"]==1){
				$("#indproveedor").prop("checked",true);
			}else
			{
				$("#indproveedor").prop("checked",false);
			}
			if(val["indsistema"]==1){
				$("#indsistema").prop("checked",true);
			}else
			{
				$("#indsistema").prop("checked",false);
			}
			$("#fechatermino").val(val["fechatermino"]);
		}

		function CargarComboTipoDocumento() {
            var $combo = $("#idtipodocumento");
            $combo.empty();
            $.post('categoria/Listar',{"grupo":"TIPO_DOCUMENTO_IDENTIDAD"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarPerfiles() {
            var $combo = $("#cmbPerfil");
            $combo.empty();
            $.post('../seguridad/perfil/Listar',{"idempresa":$("#idempresa").val()},
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

		/*
        function CargarComboTipotrabajador() {
            var $combo = $("#idtipotrabajador");
            $combo.empty();
            $.post('categoria/Listar',{"grupo":"TIPO_trabajador"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }
		*/

		 function CargarComboCargotrabajador() {
            var $combo = $("#idcargotrabajador");
            $combo.empty();
            $.post('categoria/Listar',{"grupo":"CARGO_TRABAJADOR"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarEmpresas() {
            var $combo = $("#idempresa");
            $combo.empty();
            $.post('empresa/Listar',{"indsistema":1},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarComboEstadoCivil() {
            var $combo = $("#idestadocivil");
            $combo.empty();
            $.post('categoria/Listar',{"grupo":"ESTADO_CIVIL"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }


		function EditarTrabajador(url,id) {
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
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#idcargotrabajador").val(val["idcargotrabajador"]);
							$("#fechaingreso").val(val["fechaingreso"]);
							$("#idempresa").val(val["idempresa"]);
							$("#fechatermino").val(val["fechatermino"]);
						});
						$.each(data.objpersona, function (key, val) {
							$("#idpersona").val(val["id"]);
							$("#idtipodocumento").val(val["idtipodocumento"]);
							$("#nrodocumento").val(val["nrodocumento"]);
							$("#nombres").val(val["nombres"]);
							$("#apellidopaterno").val(val["apellidopaterno"]);
							$("#apellidomaterno").val(val["apellidomaterno"]);
							$("#sexo").val(val["sexo"]);
							$("#direccion").val(val["direccion"]);
							$('#fechanacimiento').datepicker({
			                	format: 'yyyy-mm-dd'
				            });
				            $('#fechanacimiento').datepicker("setDate", val["fechanacimiento"]);
				            $('#fechainicio').datepicker({
			                	format: 'yyyy-mm-dd'
				            });
				            $('#fechainicio').datepicker("setDate", val["fechainicio"]);
							$("#idestadocivil").val(val["idestadocivil"]);
						});
						MostrarRegistro();
					}
				},
				complete: function(){
					$("input[type='number']").click(function () {
					   $(this).select();
					});
				} 
			});
			//=================== ********* ====================
		}


		function validarGuardar(){
	        if($("#idempresa").val()==""){
	            alert("No ha indicado la Empresa a la que pertenece el Trabajador");
	            return false;
			};
			if($("#idtipodocumento").val()==""){
	            alert("No ha indicado el tipo de documento");
	            return false;
			};
			if($("#id").val()==""){
				if($("#nombreusuario").val()==""){
		            alert("No ha indicado un nombre de usuario");
		            return false;
				};	
			}
			if($("#id").val()==""){
				if($("#clave").val()==""){
		            alert("No ha indicado una clave para el usuario");
		            return false;
				};	
			}
			
			return true;
	    }


	    function GenerarNombreUsuario(){
	    	var primernombre = $("#nombres").val();
	    	var apellidopaterno = $("#apellidopaterno").val();
	    	var apellidomaterno = $("#apellidomaterno").val();

	    	var primeraletranombre = primernombre.substring(0,1);
	    	var primeraletraapellidomaterno = apellidomaterno.substring(0,1);

	    	$("#nombreusuario").val(primeraletranombre+apellidopaterno+primeraletraapellidomaterno);
	    }


	</script>	
@stop