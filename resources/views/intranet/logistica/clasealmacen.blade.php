@section('title-page')
	ErpWeb | Gestión Clase Almacenes
@stop

@extends('plantilla_int')

@section('titulo-form')
	Gestión de Clase Almacenes <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Clase Almacenes</a></li>
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
												<th class="center">
													<label class="pos-rel">
														<input type="checkbox" class="ace" />
														<span class="lbl"></span>
													</label>
												</th>
												<th>Nombre</th>
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
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Clase Almacen" style="width: 100%">
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

			InicializarTabla();
			Listar();
			
			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'clasealmacen/Guardar');
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

		function Listar() {
			var form = $('#frmRegistro');
			var url = "clasealmacen/Listar";
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
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='Editar(\"clasealmacen/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"clasealmacen/Eliminar\","+val["id"]+")' class='red'>"
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
						"sWidth": "40%", "mDataProp": "Nombre"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#nombre").val(val["nombre"]);
		}

	</script>	
@stop