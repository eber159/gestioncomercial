@section('title-page')
	ErpWeb | Gestión Categorias
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Categorias <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> categorias</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('botonera')
	</br>
	<div class="col-md-12">
		<div class="box">
			<div class="box-footer">
				<select class="form-control" id="cmbGrupoFiltro" name="cmbGrupoFiltro" style="display: inline-block;width: 35%" onchange="Listar()">
					<option value="">Seleccione</option>
				</select>
				<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
				<button type="button" id="btnNuevoGrupo" name="btnNuevoGrupo" class="btn btn-default btn-sm"><i class="fa fa-file"></i> Nuevo Grupo</button>
				<button type="button" id="btnNuevoItem" name="btnNuevoItem" class="btn btn-default btn-sm"><i class="fa fa-file"></i> Nuevo Item</button>
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
												<th>Categoria</th>
												<th>Prefijo</th>
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
									<label for="">Grupo</label>
									<input type="text" class="form-control" id="grupo" name="grupo" placeholder="Ingrese Grupo" style="width: 100%">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Categoria Superior</label>
									<select class="form-control" id="idcategoriasuperior" name="idcategoriasuperior">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" style="width: 100%">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Prefijo</label>
									<input type="text" class="form-control" id="prefijo" name="prefijo" placeholder="Ingrese Prefijo" style="width: 100%">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Abreviatura</label>
									<input type="text" class="form-control" id="abreviatura" name="abreviatura" placeholder="Ingrese Abreviatura" style="width: 100%">
								</div>
							</div>

							<div style="display:none">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Glosa</label>
										<input type="text" class="form-control" id="glosa" name="glosa" placeholder="Ingrese Glosa" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Cod. Ctble</label>
										<input type="text" class="form-control" id="codctble" name="codctble" placeholder="Ingrese Cod. Ctble" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Cod. SUNAT</label>
										<input type="text" class="form-control" id="codigosunat" name="codigosunat" placeholder="Ingrese Código Sunat" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12" style="display: none">
									<div class="form-group">
										<label for="">Tipo Referencia</label>
										<input type="text" class="form-control" id="tiporeferencia" name="tiporeferencia" placeholder="Ingrese Familia" style="width: 100%">
									</div>tiporeferencia
								</div>
								<div class="col-md-12" style="display: none">
									<div class="form-group">
										<label for="">Referencia</label>
										<input type="text" class="form-control" id="referencia" name="referencia" placeholder="Ingrese Familia" style="width: 100%">
									</div>
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
			
			InicializarTabla();
			Listar();
			CargarComboGrupos();

			$("#btnNuevoGrupo").on("click", function(event) {
				MostrarRegistroGrupo();
				$("#id").val("");
				$('#frmRegistro')[0].reset();
			});
			
			$("#btnNuevoItem").on("click", function(event) {
				$("#id").val("");
				$('#frmRegistro')[0].reset();
				if($("#cmbGrupoFiltro").val()!==""){
					MostrarRegistroItem();
					$("#id").val("");
				}
				else{
					bootbox.alert("Seleccione un grupo");
				}
			});

			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'categoria/Guardar');
				if(resp=="ok"){
					//MostrarMensajeConfirmacion(data.message);
					MostrarLista();
					Listar();
					CargarComboGrupos();
				}else{
					bootbox.alert("Ocurrió un error en el registro");
				}
			});
			
			$("#btnListar").on("click", function(event) {
				Listar();
			});
			
		});
		

		function MostrarRegistroGrupo(){
			$("#divRegistro").show();
			$("#divLista").hide();
			
			//Activar los botones
			$('#btnListar').hide();
			$('#btnExportar').hide();
			$('#btnNuevoGrupo').hide();
			$('#btnNuevoItem').hide();
			$('#btnEditar').hide();
			$('#btnEliminar').hide();
			$('#btnGuardar').show();
			$('#btnCancelar').show();
			$("#idcategoriasuperior").val("");
			$("#grupo").prop("readonly",false);
			$("#idcategoriasuperior").prop("readonly",true);

		}

		function MostrarRegistroItem(){
			$("#divRegistro").show();
			$("#divLista").hide();
			
			//Activar los botones
			$('#btnListar').hide();
			$('#btnExportar').hide();
			$('#btnNuevoGrupo').hide();
			$('#btnNuevoItem').hide();
			$('#btnEditar').hide();
			$('#btnEliminar').hide();
			$('#btnGuardar').show();
			$('#btnCancelar').show();
			$("#grupo").prop("readonly",true);
			$("#idcategoriasuperior").prop("readonly",false);
			$("#grupo").val($("#cmbGrupoFiltro").val());
		}


		function MostrarLista(){
			$("#divRegistro").hide();
			$("#divLista").show();
			
			//Activar los botones
			$('#btnListar').show();
			$('#btnExportar').show();
			$('#btnNuevoItem').show();
			$('#btnNuevoGrupo').show();
			$('#btnGuardar').hide();
			$('#btnCancelar').hide();
			$('#btnEditar').hide();
			$('#btnEliminar').hide();
			$("#grupo").val("");
		}


		function Listar() {
			var form = $('#frmRegistro');
			var url = "categoria/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"grupo":$("#cmbGrupoFiltro").val()},
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
									,"Prefijo": val["prefijo"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='EditarItem(\"categoria/Leer\","+val["id"]+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"categoria/Eliminar\","+val["id"]+")' class='btn btn-danger btn-xs'>"
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

		function EditarItem(url,id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
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
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							CargarDatos(val);
							MostrarRegistroItem();
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
						"sWidth": "75%", "mDataProp": "Nombre"
					},{
						"sWidth": "70%", "mDataProp": "Prefijo"
					},{
						"sWidth": "15%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#codigo").val(val["codigo"]);
			$("#grupo").val(val["grupo"]);
			$("#nombre").val(val["nombre"]);
			$("#idcategoriasuperior").val(val["idcategoriasuperior"]);
			$("#prefijo").val(val["prefijo"]);
			$("#abreviatura").val(val["abreviatura"]);
			$("#glosa").val(val["glosa"]);
			$("#codctble").val(val["codctble"]);
			$("#codigosunat").val(val["codigosunat"]);
		}

		function CargarComboCategoriaSuperior() {
            var $combo = $("#cmbGrupoFiltro");
            $combo.empty();
            $.post('categoria/Listar',
                    function (data) {
                        $combo.append("<option value='0'>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboGrupos() {
            var $combo = $("#cmbGrupoFiltro");
            $combo.empty();
            $.post('categoria/ListarGrupos',
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.grupo + "'>"
                                    + item.grupo + "</option>");
                        });
                    }, 'json');
        }

	</script>	
@stop