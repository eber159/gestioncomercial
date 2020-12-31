@section('title-page')
	ErpWeb | Gestión Productos
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Productos <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop


@section('botonera')
	</br>
	<div class="col-md-12">
		<div class="box">
			<select id="indstockbusqueda" class="form-control" >
				<option value="">TODOS</option>
				<option value="1">CON STOCK</option>
				<option value="0">SIN STOCK</option>
			</select>
			<div class="box-footer">
				<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
				<button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-default btn-sm"><i class="fa fa-file"></i> Nuevo </button>
				<button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i class="fa fa-excel"></i> Exportar</button>
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
												<th>Producto</th>
												<th>Linea</th>
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
			<div class="col-md-12">
				<div class="box box-primary">
					<form role="form" id="frmRegistro" enctype="multipart/form-data">
						<div class="box-header with-border">
						  <h3 class="box-title">Datos Principales</h3>

						<button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
						<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
						</div>
					
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%; display: none">
						<div class="box-body">
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Codigo</label>
									<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese Codigo" style="width: 100%">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre del Producto" style="width: 100%" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Código Barras</label>
									<input type="text" class="form-control" id="codigobarras" name="codigobarras" placeholder="Ingrese Codigo de Barras" style="width: 100%">
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Imagen</label>
									<input type="file" id="imagen" name="imagen">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Producto asociado</label>
									<select class="form-control select2" id="idproductoasociado" name="idproductoasociado" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione un producto</option>
										@foreach ($productos as $p)
					               			@if($p->codigo != '')
					               				<option value="{{ $p->id }}">[{{ $p->codigo }}] {{ $p->nombre }}</option>
					               			@else
					               				<option value="{{ $p->id }}">{{ $p->nombre }}</option>
					               			@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Producto publicado</label>
									<select class="form-control" id="indpublicado" name="indpublicado">
										<option value="1">SI</option>
										<option value="0">NO</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Prod. con STOCK</label>
									<select class="form-control" id="indstock" name="indstock">
										<option value="1">SI</option>
										<option value="0">NO</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Prod. Lotizable</label>
									<select class="form-control" id="indlotizable" name="indlotizable">
										<option value="0">NO</option>
										<option value="1">SI</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Descripción</label>
									<input type="text" class="form-control" id="descripcionguia" name="descripcionguia" placeholder="Ingrese Descripcion" style="width: 100%" required>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Línea</label>
									<select class="form-control" id="idlinea" name="idlinea" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Marca</label>
									<input type="text" class="form-control" id="marca" name="marca" placeholder="Ingrese Marca" style="width: 100%">
									<!--
									<select class="form-control" id="marca" name="marca">
										<option value="CHEMLIQ">CHEMLIQ</option>
										<option value="HADA">HADA</option>
									</select>
								-->
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Modelo</label>
									<input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ingrese Modelo" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tamaño / Talla</label>
									<input type="text" class="form-control" id="tamanio" name="tamanio" placeholder="Ingrese Tamaño" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Color</label>
									<input type="text" class="form-control" id="color" name="color" placeholder="Ingrese Color" style="width: 100%">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Precio</label>
									<input type="number" class="form-control" id="precioventa" name="precioventa" placeholder="Ingrese Precio Material" style="width: 100%" step="0.01">
								</div>
							</div>

							<div class="col-md-6" style="display: none">
								<div class="form-group">
									<label for="">Peso</label>
									<input type="number" class="form-control" id="peso" name="peso" placeholder="Ingrese Precio Material" style="width: 100%">
								</div>
							</div>

							<div class="col-md-6" style="display: none">
								<div class="form-group">
									<label for="">Familia</label>
									<select class="form-control" id="cmbfamilia" name="cmbfamilia" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>

							<div class="col-md-6" style="display: none">
								<div class="form-group">
									<label for="">Subfamilia</label>
									<select class="form-control" id="cmbsubfamilia" name="cmbsubfamilia" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label for="">UnidaMedida</label>
									<select class="form-control" id="cmbunidadmedida" name="cmbunidadmedida" placeholder="Seleccione" style="width: 100%">
										<option value="">Seleccione</option>
									</select>
								</div>
							</div>

							

						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
		


	<div class="modal modal-default fade" id="modalprecios">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">PRECIOS POR PRODUCTO</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-md-12">
                        	<form id="frmRegistroPrecios" action="#">
                            <div class="col-md-2">
								<div class="form-group">
									<label for="">Precio Menor</label>
									<input type="number" class="form-control" id="preciomenor" name="preciomenor" placeholder="P. Menor" style="width: 100%">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Precio Mayor</label>
									<input type="number" class="form-control" id="preciomayor" name="preciomayor" placeholder="P. Mayor" style="width: 100%">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Precio Distribuidor</label>
									<input type="number" class="form-control" id="preciodistrib" name="preciodistrib" placeholder="P. Distrib." style="width: 100%">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Precio Caja</label>
									<input type="number" class="form-control" id="preciocaja" name="preciocaja" placeholder="P. Caja" style="width: 100%">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Precio Liquidación</label>
									<input type="number" class="form-control" id="preciofactura" name="preciofactura" placeholder="P. Fact" style="width: 100%">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Precio Oferta</label>
									<input type="number" class="form-control" id="preciooferta" name="preciooferta" placeholder="P. Fact" style="width: 100%">
								</div>
							</div>
							</form>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">&nbsp; &nbsp;Agregar</label>
									<button type="button" id="btnGuardarPrecios" name="btnGuardarPrecios" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Guardar</button>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<input type="hidden" class="form-control" id="idproductoprecio" name="idproductoprecio" >
								</div>
							</div>
                        </div>
                    </div>
                    <br/>
                    <div class='row'>
                    	<div class="col-md-12">
                    		<div class="table-responsive">
								<table id="tblPrecios" class="table table-bordered table-hover" style="width: 100%">
									<thead>
										<tr>
											<th style="display:none">Id</th>
											<th>Precio Menor</th>
											<th>Precio Mayor</th>
											<th>Precio Distrib.</th>
											<th>Precio Caja</th>
											<th>Precio Liq.</th>
											<th>Precio Oferta</th>
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
                <div class="modal-footer">
                	
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

    <div class="modal modal-default fade" id="modalimagen">
        <div class="modal-dialog" style="width: 30%">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div id="divImagen">
                    </div>
                </div>
                <div class="modal-footer">
                	
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			
			CargarComboFamilia();
			CargarComboUnidadMedida();
			CargarComboLineas();
			InicializarTabla();
			InicializarTablaPrecios();
			Listar();
			
			/*
			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'material/Guardar');
				if(resp=="ok"){
					//MostrarMensajeConfirmacion(data.message);
					$('#frmRegistro')[0].reset()
					MostrarLista();
					Listar();
				}else{
					bootbox.alert("Ocurrió un error en el registro");
				}
			});
			*/

			$("#btnListar").on("click", function(event) {
				Listar();
			});

			$("#btnGuardarPrecios").on("click", function(event) {
				GuardarPrecios();
			});
			
		});
		
		$('#cmbfamilia').change(function(){
				CargarComboSubfamilia($(this).val());
 		});

		function CargarComboUnidadMedida() {
            var $combo = $("#cmbunidadmedida");
            $combo.empty();
            $.post('unidadmedida/Listar',
                    function (data) {
                        $combo.append("<option value='0'>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboLineas() {
            var $combo = $("#idlinea");
            $combo.empty();
            $.post('linea/Listar',
                    function (data) {
                        $combo.append("<option value='0'>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarComboFamilia() {
            var $combo = $("#cmbfamilia");
            $combo.empty();
            $.post('familia/Listar',
                    function (data) {
                        $combo.append("<option value='0'>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboSubfamilia(idfamilia) {
            var $combo = $("#cmbsubfamilia");
            $combo.empty();
            $.get('subfamilia/ListarxFamilia/'+idfamilia,
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
			var url = "material/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: { "indstock":$("#indstockbusqueda").val() },
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#divCargando").show();
				},
				success: function (data) {
					var oTable = $("#tblDatos").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"Id": val["id"]
									,"Codigo": val["codigo"]
									,"Nombre": "<a href='#' class='btn btn-default btn-xs' onclick='VerImagen("+val["id"]+")' ><i class='fa fa-image'></i></a>"+val["nombre"]
									,"Linea": val["linea"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-primary btn-xs' onclick='Editar(\"material/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"material/Eliminar\","+val["id"]+")' class='red'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</center>"};
							oTable.fnAddData(obj);
						});
					}
					$("#divCargando").hide();
				},
				finally: function (){
					$("#divCargando").hide();
				}
			});
			//=================== ********* ====================
		}
		

		function ListarPrecios(idproducto) {
			var form = $('#frmRegistro');
			var url = "precioproducto/Listar";
			var info = "";
			$("#idproductoprecio").val(idproducto);
			$.ajax({
				type: "POST",
				async: false,
				data: {"idproducto":idproducto},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#modalprecios").modal("show")
				},
				success: function (data) {
					var oTable = $("#tblPrecios").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"Id": val["id"]
									,"PrecioMenor": val["preciomenor"]
									,"PrecioMayor": val["preciomayor"]
									,"PrecioDistrib": val["preciodistrib"]
									,"PrecioCaja": val["preciocaja"]
									,"PrecioFactura": val["preciofactura"]
									,"PrecioOferta": val["preciooferta"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='EliminarPrecios(\"precioproducto/Eliminar\","+val["id"]+")' class='red'>"
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
				"processing": true,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					}, {
						"sWidth": "10%", "mDataProp": "Codigo"
					},{
						"sWidth": "50%", "mDataProp": "Nombre"
					},{
						"sWidth": "10%", "mDataProp": "Linea"
					},{
						"sWidth": "15%", "mDataProp": "Acciones"
					}]
			});
		}

		function InicializarTablaPrecios() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblPrecios').dataTable({
				"info": false,
				"bFilter": false,
				"bInfo": false,
				"bOrder": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
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
						"sWidth": "10%", "mDataProp": "PrecioOferta"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#codigo").val(val["codigo"]);
			$("#nombre").val(val["nombre"]);
			$("#descripcionguia").val(val["descripcionguia"]);
			$("#peso").val(val["peso"]);
			$("#precioventa").val(val["precioventa"]);
			$("#codigobarras").val(val["codigobarras"]);
			$("#cmbfamilia").val(val["idfamilia"]);
			/*CargarComboSubfamilia(val["idfamilia"]);*/
			$("#cmbsubfamilia").val(val["idsubfamilia"]);
			$("#cmbunidadmedida").val(val["idunidadmedida"]);
			$("#marca").val(val["marca"]);
			$("#modelo").val(val["modelo"]);
			$("#tamanio").val(val["tamanio"]);
			$("#color").val(val["color"]);
			$("#idlinea").val(val["idlinea"]);
			$("#indpublicado").val(val["indpublicado"]);
			$("#idproductoasociado").val(val["idproductoasociado"]);
			$("#indstock").val(val["indstock"]);
		}




		function validarGuardarPrecios(){
	        if($("#preciomayor").val()=="" && $("#preciomenor").val()=="" && $("#preciodistrib").val()=="" && $("#preciocaja").val()=="" && $("#preciofactura").val()=="" && $("#preciooferta").val()==""){
	            bootbox.alert("Debe definir al menos un precio");
	            return false;
	        }
	        return true;
	    }

		function GuardarPrecios(){
			if(validarGuardarPrecios()){
				var obj = {
					"id": ""
					,"idproducto": $("#idproductoprecio").val()
					,"preciomayor": $("#preciomayor").val()
					,"preciomenor": $("#preciomenor").val()
					,"preciodistrib": $("#preciodistrib").val()
					,"preciocaja": $("#preciocaja").val()
					,"preciofactura": $("#preciofactura").val()
					,"preciooferta": $("#preciooferta").val()
				};

				var resp = "";
				$.ajax({
					type: "POST",
					async: false,
					data: obj,
					url: "../configuracion/precioproducto/Guardar",
					dataType: "json",
					beforeSend: function (data) {
						
					},
					success: function (data) {
						if (data !== null && typeof data === 'object') {
							if(data.success == true){
								ListarPrecios($("#idproductoprecio").val());
								$('#frmRegistroPrecios')[0].reset();
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


		function EliminarPrecios(url,id) {
			bootbox.confirm("¿Seguro que deseas eliminar el registro?", function(result) {
				if(result){
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
								bootbox.alert(data.message);
								ListarPrecios($("#idproductoprecio").val());
							}
						}
					});
				}
			});
			//=================== ********* ====================
		}




        $("#frmRegistro").submit(function(e) {
            var url = "material/Guardar"; // the script where you handle the form input.  
            var formData = new FormData(this);
            $.ajax({
                   	type: "POST",
                   	url: url,
                   	data: formData, // serializes the form's elements.
                   	cache:false,
	                contentType: false,
	                processData: false,
                   success: function(data)
                   {
                        if(data.success==true){
                        	bootbox.alert("Registro exitoso");   
                            $('#frmRegistro')[0].reset()
							MostrarLista();
							Listar();
                        }
                        else{
                            bootbox.alert(data.message);   
                        }
                   },
                   error: function (e){
                   		alert(e);
                   }
                 });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


        function redirectPost(url) {
            var form = document.createElement('form');
            document.body.appendChild(form);
            form.method = 'post';
            form.action = url;
            form.submit();
        }

        function VerImagen(id) {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "material/Leer",
				dataType: "json",
				beforeSend: function (data) {
					$("#modalimagen").modal("show")
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							//var Imagen = val["imagen"];
							//console.log(val["imagen"]);
							//var Ruta = String(Imagen);
							var RutaImagen = "<center><img src=\"{{config('constants.rutapublica.url')}}"+val['imagen']+"\" width='300px' ></center>";
							$("#divImagen").html(RutaImagen);
						});
					}
				}
			});
			//=================== ********* ====================
		}


	</script>	
@stop