@section('title-page')
	ErpWeb | Gestión Empresas
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Empresas <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Empresas</a></li>
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
								<div>
									<table id="tblDatos" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th>Codigo</th>
												<th>N° Doc.</th>
												<th>Nombre</th>
												<th>Dirección</th>
												<th>Teléfono</th>
												<th>Zona</th>
												<th>
													<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
													Acciones
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
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Codigo</label>
										<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo Generado" style="width: 50%" readonly="readonly">
									</div>
								</div>
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
										<input type="text" class="form-control" id="numerodocumento" name="numerodocumento" placeholder="Ingrese N° Doc." style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Nombre</label>
										<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre de la empresa" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Teléfono 1</label>
										<input type="text" class="form-control" id="telefono1" name="telefono1" placeholder="TELEFONO 1" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Teléfono 2</label>
										<input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="TELEFONO 2" style="width: 100%">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Tipo Empresa</label>
										<select class="form-control" id="idtipoempresa" name="idtipoempresa">
											<option value="">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Abreviatura</label>
										<input type="text" class="form-control" id="abreviatura" name="abreviatura" placeholder="Ingrese Abreviatura de la empresa" style="width: 100%">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">Fecha Nacimiento</label>
										<input type="text" class="form-control" id="fechanac" name="fechanac" placeholder="" style="width: 100%">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="">Fecha Registro</label>
										<input type="text" class="form-control" id="fecharegistro" name="fecharegistro" placeholder="" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="checkbox" class="" id="indcliente" name="indcliente"> Cliente
									</div>
									<div class="form-group">
										<input type="checkbox" class="" id="indproveedor" name="indproveedor"> Proveedor
									</div>
									<div class="form-group" style="display: none">
										<input type="checkbox" class="" id="indsistema" name="indsistema"> Sucursal
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Direccion Principal</label>
										<input type="text" class="form-control" id="direccion1" name="direccion1" placeholder="Ingrese direccion principal" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Direccion Secundaria</label>
										<input type="text" class="form-control" id="direccion2" name="direccion2" placeholder="Ingrese direccion secundaria" style="width: 100%">
									</div>
								</div>
							</div>
							<!--
							<div class="nav-tabs-custom">
					            <ul class="nav nav-tabs">
					              <li class="active"><a href="#tab_1" data-toggle="tab">Direcciones</a> </li>
					            </ul>
					            <div class="tab-content">
					              <div class="tab-pane active" id="tab_1">
					              	<button type="button" id="btnAgregarDireccion" name="btnAgregarDireccion" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Agregar Dirección </button>
					               
					              </div>
					            </div>

							</div>
							-->
					  <!-- /.box-body -->
					  
					</form>
				</div>
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
			CargarComboTipoEmpresa();

			$('#fechanac').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('#fechanac').datepicker("setDate", new Date());
			
			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'empresa/Guardar');
				if(resp=="ok"){
					//MostrarMensajeConfirmacion(data.message);
					MostrarLista();
					Listar();
					
				}else{
					bootbox.alert("Ocurrió un error en el registro");
				}
			});
			
			$("#btnListar").on("click", function(event) {
				Listar();
			});
			
		});
		
		function Listar() {
			var form = $('#frmRegistro');
			var url = "empresa/Listar";
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
									,"Codigo": val["codigo"]
									,"NroDoc": val["numerodocumento"]
									,"Nombre": val["nombre"]
									,"Direccion": val["direccion1"]
									,"Telefono": val["telefono1"]
									,"Zona": val["direccion2"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='Editar(\"empresa/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"empresa/Eliminar\","+val["id"]+")' class='red'>"
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
					}, {
						"sWidth": "10%", "mDataProp": "Codigo"
					},{
						"sWidth": "10%", "mDataProp": "NroDoc"
					},{
						"sWidth": "30%", "mDataProp": "Nombre"
					},{
						"sWidth": "30%", "mDataProp": "Direccion"
					},{
						"sWidth": "10%", "mDataProp": "Telefono"
					},{
						"sWidth": "10%", "mDataProp": "Zona"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#codigo").val(val["codigo"]);
			$("#nombre").val(val["nombre"]);
			$("#idtipodocumento").val(val["idtipodocumento"]);
			$("#idtipoempresa").val(val["idtipoempresa"]);
			$("#numerodocumento").val(val["numerodocumento"]);
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
			$("#direccion1").val(val["direccion1"]);
			$("#direccion2").val(val["direccion2"]);
			$("#telefono1").val(val["telefono1"]);
			$("#telefono2").val(val["telefono2"]);
			$('#fechanac').datepicker({
            	format: 'yyyy-mm-dd'
            });
            $('#fechanac').datepicker("setDate", val["fechanac"]);
            $("#fecharegistro").val(val["fecharegistro"]);
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

        function CargarComboTipoEmpresa() {
            var $combo = $("#idtipoempresa");
            $combo.empty();
            $.post('categoria/Listar',{"grupo":"TIPO_EMPRESA"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

	</script>	
@stop