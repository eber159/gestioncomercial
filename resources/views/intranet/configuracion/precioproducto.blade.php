@section('title-page')
	ErpWeb | Gestión Tipos
@stop

@extends('plantilla_int')

@section('titulo-form')
	Gestión de Precios de Productos <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Precio Producto </a></li>
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
												<th>Producto</th>
												<th>Precio Menor</th>
												<th>Precio Mayor</th>
												<th>Precio Distrib.</th>
												<th>Precio Caja</th>
												<th>Precio Factura</th>
												<th>
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
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Producto</label>
									<select class="form-control select2" style="width: 100%;" id='idproductobusqueda' name="idproducto" ></select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Precio Menor</label>
									<input type="number" class="form-control" id="preciomenor" name="preciomenor" placeholder="P. Menor" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Precio Mayor</label>
									<input type="number" class="form-control" id="preciomayor" name="preciomayor" placeholder="P. Mayor" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Precio Distribuidor</label>
									<input type="number" class="form-control" id="preciodistrib" name="preciodistrib" placeholder="P. Distrib." style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Precio Caja</label>
									<input type="number" class="form-control" id="preciocaja" name="preciocaja" placeholder="P. Caja" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Precio Factura</label>
									<input type="number" class="form-control" id="preciofactura" name="preciofactura" placeholder="P. Fact" style="width: 100%">
								</div>
							</div>
						</div>
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
			$(".select2").select2();
			InicializarTabla();
			CargarComboProducto();
			Listar();

			$("#btnNuevo").on("click", function(event) {
				MostrarRegistro();
				$("#id").val("");
				$('#fecha').datepicker({
	                format: 'yyyy-mm-dd'
	            });
	            $('#fecha').datepicker("setDate", new Date());
			});
			
			

			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'precioproducto/Guardar');
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
			var url = "precioproducto/Listar";
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
									,"Producto": val["nombreproducto"]
									,"PrecioMenor": val["preciomenor"]
									,"PrecioMayor": val["preciomayor"]
									,"PrecioDistrib": val["preciodistrib"]
									,"PrecioCaja": val["preciocaja"]
									,"PrecioFactura": val["preciofactura"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='Editar(\"precioproducto/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"precioproducto/Eliminar\","+val["id"]+")' class='red'>"
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
					}, {
						"sWidth": "40%", "mDataProp": "Producto"
					},{
						"sWidth": "10%", "mDataProp": "PrecioMenor"
					},{
						"sWidth": "10%", "mDataProp": "PrecioMayor"
					},{
						"sWidth": "10%", "mDataProp": "PrecioDistrib"
					},{
						"sWidth": "10%", "mDataProp": "PrecioCaja"
					},{
						"sWidth": "10%", "mDataProp": "PrecioFactura"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarComboProducto() {
            var $combo = $("#idproductobusqueda");
            $combo.empty();
            $.post('../configuracion/material/Listar',
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#idproducto").val(val["idproducto"]).trigger('change');
			$("#preciomenor").val(val["preciomenor"]);
			$("#preciomayor").val(val["preciomayor"]);
			$("#preciodistrib").val(val["preciodistrib"]);
			$("#preciocaja").val(val["preciocaja"]);
			$("#preciofactura").val(val["preciofactura"]);
		}

	</script>	
@stop