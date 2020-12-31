@section('title-page')
	ErpWeb | Gestión Almacenes
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Almacenes <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Almacenes</a></li>
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
												<th>Codigo</th>
												<th>Nombre</th>
												<th>Clase</th>
												<th>Tipo</th>
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
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Codigo</label>
									<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese Codigo" style="width: 100%">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Almacen" style="width: 100%">
								</div>
							</div>

							<div class="col-md-12" style="display: none">
								<div class="form-group">
									<label for="">Clase</label>
									<select class="form-control" id="cmbclase" name="cmbclase" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>

							<div class="col-md-12" style="display: none">
								<div class="form-group">
									<label for="">Tipo</label>
									<select class="form-control" id="cmbtipo" name="cmbtipo" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>

							
							
						</div>
					  <!-- /.box-body -->

<!-- 					  	<div class="panel panel-primary">
					  		<div class="panel-body">
					  			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					  				
					  			</div>

					  		</div>
					  	</div> -->
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

			//CargarComboTipo();
			//CargarComboClase();
			InicializarTabla();
			Listar();
			
			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'almacen/Guardar');
				if(resp=="ok"){
					//MostrarMensajeConfirmacion(data.message);
					$('#frmRegistro')[0].reset()
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
		
		function CargarComboTipo() {
            var $combo = $("#cmbtipo");
            $combo.empty();
            $.post('tipoalmacen/Listar',
                    function (data) {
                        $combo.append("<option value='0'>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboClase() {
            var $combo = $("#cmbclase");
            $combo.empty();
            $.post('clasealmacen/Listar',
                    function (data) {
                        $combo.append("<option value='0'>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function Listar() {
			var form = $('#frmRegistro');
			var url = "almacen/Listar";
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
									,"Nombre": val["nombre"]
									,"Clase": val["nombreclasealmacen"]
									,"Tipo": val["nombretipoalmacen"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' onclick='Editar(\"almacen/Leer\","+val["id"]+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"almacen/Eliminar\","+val["id"]+")' class='btn btn-danger btn-xs'>"
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
				"search": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					}, {
						"sWidth": "20%", "mDataProp": "Codigo"
					},{
						"sWidth": "20%", "mDataProp": "Nombre"
					},{
						"sWidth": "40%", "mDataProp": "Clase"
					},{
						"sWidth": "40%", "mDataProp": "Tipo"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#codigo").val(val["codigo"]);
			$("#cmbtipo").val(val["idtipo"]);
			$("#cmbclase").val(val["idclase"]);
			$("#nombre").val(val["nombre"]);
		}

	</script>	
@stop