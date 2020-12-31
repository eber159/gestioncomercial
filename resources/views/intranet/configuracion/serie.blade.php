@section('title-page')
	ErpWeb | Gestión Series
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Series <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Tipo Cambio</a></li>
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
												<th>Tipo Documento</th>
												<th>Serie</th>
												<th>Número Correlativo</th>
												<th>Compra/Venta</th>
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
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tipo Documento</label>
									<select class="form-control" id="idtipodocumento" name="idtipodocumento" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Serie</label>
									<input type="text" class="form-control" id="nroserie" name="nroserie" placeholder="Ingrese Serie" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Número</label>
									<input type="text" class="form-control" id="nrocorrelativo" name="nrocorrelativo" placeholder="Número correlativo actual" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Compra/Venta</label>
									<select class="form-control" id="indcompraventa" name="indcompraventa" placeholder="Seleccione" style="width: 100%">
										<option value="C">Compra</option>
										<option value="V">Venta</option>
									</select>
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

			CargarComboTipoDocumento();
			InicializarTabla();
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
				if(ValidarRegistro()){
					var form = $('#frmRegistro');
					var resp = Guardar(form,'serie/Guardar');
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
			
			$('#nroserie').focusout(function() {			
				$('#nroserie').val(formatoDocumento($('#nroserie').val(),4));
			})
			$('#nrocorrelativo').focusout(function() {			
				$('#nrocorrelativo').val(formatoDocumento($('#nrocorrelativo').val(),12));
			})
			$('#nrocorrelativo').on('input', function () { 
				this.value = this.value.replace(/[^0-9]/g,'');
			});

		});
		

		function ValidarRegistro(){
			if($("#idtipodocumento").val()==""){
	            alert("No ha indicado el Tipo de Documento");
	            return false;
			};
			if($("#nroserie").val()==""){
	            bootbox.alert("No ha indicado la Serie que desea registrar");
	            return false;
			};
			if($("#nrocorrelativo").val()==""){
	            bootbox.alert("No ha indicado el Número correlativo");
	            return false;
			};
			return true;
		}
		

		function Listar() {
			var form = $('#frmRegistro');
			var url = "serie/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {},
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
									,"Tipo Documento": val["tipodoc"]
									,"Serie": val["nroserie"]
									,"Correlativo": val["nrocorrelativo"]
									,"CompraVenta": val["indcompraventa"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='Editar(\"serie/Leer\","+val["id"]+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"serie/Eliminar\","+val["id"]+")' class='btn btn-danger btn-xs'>"
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
						"sWidth": "30%", "mDataProp": "Tipo Documento"
					},{
						"sWidth": "20%", "mDataProp": "Serie"
					},{
						"sWidth": "20%", "mDataProp": "Correlativo"
					},{
						"sWidth": "20%", "mDataProp": "CompraVenta"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#idtipodocumento").val(val["idtipodocumento"]);
			$("#nroserie").val(val["nroserie"]);
			$("#nrocorrelativo").val(val["nrocorrelativo"]);
			$("#indcompraventa").val(val["indcompraventa"]);
		}

		function CargarComboTipoDocumento() {
            var $combo = $("#idtipodocumento");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_DOCUMENTO"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function formatoDocumento(texto,cantidad)
		{
			var ln = ""
			for (var i = 1 ;i<=cantidad-texto.length;i++){
				ln = ln + "0"
			}
			return ln + texto
		}

	</script>	
@stop