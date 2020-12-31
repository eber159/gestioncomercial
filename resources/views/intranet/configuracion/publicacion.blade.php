@section('title-page')
	ErpWeb | Gestión Testimonios
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Publicaciones <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Testimonios</a></li>
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
												<th>Línea</th>
												<th>Descripción</th>
												<th>Orden</th>
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
							<div class="row">

								<div class="col-md-12">
									<div class="form-group">
										<input type="checkbox" class="" id="indlink" name="indlink"> Publicación con acceso al contenido
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="">Título/Nombre</label>
										<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese Nombre del Cliente" style="width: 100%" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Orden</label>
										<input type="number" class="form-control" id="orden" name="orden" placeholder="Orden" style="width: 100%" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Descripción</label>
										<!--<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripcion" style="width: 100%" required>-->
										<textarea id="editor1" name="editor1" rows="10" cols="80">
						                    	
						                </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Video (código url)</label>
										<!--<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripcion" style="width: 100%" required>-->
										<textarea id="urlvideo" name="urlvideo" rows="10" cols="80" class="form-control">
						                    	
						                </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">MAPA</label>
										<!--<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripcion" style="width: 100%" required>-->
										<textarea id="urlmapa" name="urlmapa" rows="10" cols="80" class="form-control">
						                    	
						                </textarea>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<input type="checkbox" class="" id="indtexto" name="indtexto"> Mostrar Texto de la publicación
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="checkbox" class="" id="indtextocompleto" name="indtextocompleto"> Mostrar Texto COMPLETO de la publicación
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="">Tamaño de Publicación (Columna)</label>
										<!--<input type="checkbox" class="" id="indlargo" name="indlargo"> Publicación en todo el ancho de la página.-->
										<select id="indlargo" name="indlargo" class="form-control">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="">URL Externo</label>
										<input type="text" class="form-control" id="urlexterno" name="urlexterno" placeholder="Ingrese URL Externo" style="width: 100%" >
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Imagen</label>
										<input type="file" id="imagen" name="imagen" onchange="readURL(this);">
										<br/>
										<img id="imagensel" src="#" alt="your image" />
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
							            <ul class="nav nav-tabs">
							              <li class="active"><a href="#tab_1" data-toggle="tab">Imagenes</a> </li>
										  <li class=""><a href="#tab_2" data-toggle="tab">Videos</a> </li>
							            </ul>
							            <div class="tab-content">
											<div class="tab-pane active" id="tab_1">
												<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-12">
								            				<button type="button" id="btnAgregarImagen" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Agregar Imagen </button>
															<div class="table-responsive">
								            				<table id="tblImagenes" class="table table-bordered table-hover" style="width: 100%">
			                                                    <thead>
																	<tr>
																		<th style="display:none">Id</th>
																		<th>Descripción</th>
																		<th>Ruta</th>
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
											<div class="tab-pane" id="tab_2">
												<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-12">
								            				<button type="button" id="btnAgregarVideo" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Agregar Video </button>
															<div class="table-responsive">
								            				<table id="tblVideos" class="table table-bordered table-hover" style="width: 100%">
			                                                    <thead>
																	<tr>
																		<th style="display:none">Id</th>
																		<th>Descripción</th>
																		<th>URL</th>
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
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</section>


	<div class="modal modal-default fade" id="modalImagenes">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">AGREGAR IMÁGENES</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-md-12">
                        	<form id="frmRegistroImagen" role="form" enctype="multipart/form-data">

                        		<div class="col-md-12">
									<div class="form-group">
										<label for="">Descripción</label>
										<input type="text" class="form-control" id="descripcionimagen" name="descripcionimagen" placeholder="Ingrese Descripcion" style="width: 100%" required>
									</div>
								</div>

	                            <div class="col-md-12">
									<div class="form-group">
										<label for="">Imagen Principal</label>
										<input type="file" id="imagenrecurso" name="imagenrecurso">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="">Imagen Miniatura</label>
										<input type="file" id="imagenminiatura1" name="imagenminiatura1">
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<input type="hidden" class="form-control" id="idproductowebimagen" name="idproductowebimagen" >
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="">&nbsp; &nbsp;Agregar</label>
										<button type="submit" id="btnGuardarImagen" name="btnGuardarImagen" class="btn btn-success btn-sm"><i
	                                        class="fa fa-save"></i>Guardar</button>
									</div>
								</div>

							</form>
							
							
							
							
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                	
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>


    <div class="modal modal-default fade" id="modalvideos">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">AGREGAR VIDEOS</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-md-12">
                        	<form id="frmRegistroVideo" role="form" enctype="multipart/form-data">

                        		<div class="col-md-12">
									<div class="form-group">
										<label for="">Descripción</label>
										<input type="text" class="form-control" id="descripcionvideo" name="descripcionvideo" placeholder="Ingrese Descripcion" style="width: 100%" required>
									</div>
								</div>

	                            <div class="col-md-12">
									<div class="form-group">
										<label for="">Ruta Video</label>
										<input type="text" class="form-control" id="urlvideo" name="urlvideo" placeholder="Ingrese Descripcion" style="width: 100%" required>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="">Imagen Miniatura</label>
										<input type="file" id="imagenminiatura2" name="imagenminiatura2">
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<input type="hidden" class="form-control" id="idproductowebvideo" name="idproductowebvideo" >
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="">&nbsp; &nbsp;Agregar</label>
										<button type="submit" id="btnGuardarVideo" name="btnGuardarVideo" class="btn btn-success btn-sm"><i
	                                        class="fa fa-save"></i>Guardar</button>
									</div>
								</div>
							</form>
							
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
			
			InicializarTabla();
			InicializarTablaImagenes();
			InicializarTablaVideos();
			Listar();
			
			/*
			$("#btnGuardar").on("click", function(event) {
				var form = $('#frmRegistro');
				var resp = Guardar(form,'testimonio/Guardar');
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

			$("#btnAgregarImagen").on("click", function(event) {
				if($("#id").val()>0){
					var idproductoweb = $("#id").val();
					$("#idproductowebimagen").val(idproductoweb);
					$("#modalImagenes").modal("show");
				}else{
					bootbox.alert("Primero registre un producto/servicio")
				}
				
			});

			$("#btnAgregarVideo").on("click", function(event) {
				if($("#id").val()>0){
					var idproductoweb = $("#id").val();
					$("#idproductowebvideo").val(idproductoweb);
					$("#modalvideos").modal("show");
				}else{
					bootbox.alert("Primero registre un producto/servicio")
				}
			});

			CKEDITOR.replace('editor1')
		    //bootstrap WYSIHTML5 - text editor
		    $('.textarea').wysihtml5();
			
		});
		

		function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('#imagensel')
	                    .attr('src', e.target.result)
	                    .width(150)
	                    .height(100);
	            };

	            reader.readAsDataURL(input.files[0]);
	        }
	    }


    	function readURL2(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('#imagensel2')
	                    .attr('src', e.target.result).height(100);
	            };

	            reader.readAsDataURL(input.files[0]);
	        }
	    }


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
			var url = "publicacion/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: form.serialize(),
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
									,"Nombre": val["titulo"]
									,"Descripcion": val["descripcion"].substring(0, 250)+"..."
									,"Orden": val["orden"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-primary btn-xs' onclick='Editar(\"publicacion/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"publicacion/Eliminar\","+val["id"]+")' class='red'>"
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
		
		function ListarImagenes(idproductoweb) {
			var form = $('#frmRegistro');
			var url = "publicacionrecurso/Listar";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idproductowebfiltro":idproductoweb, "tiporecurso":1},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#divCargando").show();
				},
				success: function (data) {
					var oTable = $("#tblImagenes").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"Id": val["id"]
									,"Descripcion": "<a href='#' class='btn btn-default btn-xs' onclick='VerImagenRecurso("+val["id"]+")' ><i class='fa fa-image'></i></a>"+val["descripcion"]
									,"Ruta": val["rutarecurso"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='EliminarRecursos(\"publicacionrecurso/Eliminar\","+val["id"]+")' class='red'>"
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

		function ListarVideos(idproductoweb) {
			var url = "publicacionrecurso/Listar";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idproductowebfiltro":idproductoweb, "tiporecurso":2},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#divCargando").show();
				},
				success: function (data) {
					var oTable = $("#tblVideos").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"Id": val["id"]
									,"Codigo": val["id"]
									,"Descripcion": val["descripcion"]
									,"Ruta": val["rutarecurso"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='EliminarRecursos(\"publicacionrecurso/Eliminar\","+val["id"]+")' class='red'>"
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
						"sWidth": "10%", "mDataProp": "Nombre"
					},{
						"sWidth": "50%", "mDataProp": "Descripcion"
					},{
						"sWidth": "50%", "mDataProp": "Orden"
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

		function InicializarTablaImagenes() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblImagenes').dataTable({
				"info": false,
				"bFilter": false,
				"bInfo": false,
				"bOrder": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"sWidth": "30%", "mDataProp": "Descripcion"
					},{
						"sWidth": "30%", "mDataProp": "Ruta"
					},{
						"sWidth": "5%", "mDataProp": "Acciones"
					}]
			});
		}

		function InicializarTablaVideos() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblVideos').dataTable({
				"info": false,
				"bFilter": false,
				"bInfo": false,
				"bOrder": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"sWidth": "30%", "mDataProp": "Descripcion"
					},{
						"sWidth": "30%", "mDataProp": "Ruta"
					},{
						"sWidth": "5%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#titulo").val(val["titulo"]);
			//$("#descripcion").val(val["descripcion"]);
			CKEDITOR.instances['editor1'].setData(val["descripcion"]);
			var RutaImagen = "{{config('constants.rutapublica.url')}}"+val['imagen'];
			$('#imagensel').attr('src', RutaImagen).height(100);
			var RutaImagen2 = "{{config('constants.rutapublica.url')}}"+val['slider'];
			$('#imagensel2').attr('src', RutaImagen2).height(100);
			$("#urlvideo").val(val["urlvideo"]);
			$("#urlmapa").val(val["urlmapa"]);
			if(val["indlink"]==1){
				$("#indlink").prop("checked",true);
			}else
			{
				$("#indlink").prop("checked",false);
			}
			$("#urlexterno").val(val["urlexterno"]);
			if(val["indtexto"]==1){
				$("#indtexto").prop("checked",true);
			}else
			{
				$("#indlink").prop("checked",false);
			}

			if(val["indtextocompleto"]==1){
				$("#indtextocompleto").prop("checked",true);
			}else{
				$("#indtextocompleto").prop("checked",false);
			}

			/*
			if(val["indlargo"]==1){
				$("#indlargo").prop("checked",true);
			}else{
				$("#indlargo").prop("checked",false);
			}
			*/
			$("#indlargo").val(val["indlargo"]);


			$("#orden").val(val["orden"]);
			ListarImagenes(val["id"]);
			ListarVideos(val["id"]);
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
            var url = "publicacion/Guardar"; // the script where you handle the form input.  

            for ( instance in CKEDITOR.instances )
		    {
		        CKEDITOR.instances[instance].updateElement();
		    }

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

        $("#frmRegistroImagen").submit(function(e) {
            var url = "publicacionrecurso/GuardarImagen"; // the script where you handle the form input.  
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
                            $('#frmRegistroImagen')[0].reset()
							//MostrarLista();
							$("#modalImagenes").modal("hide");
							ListarImagenes($("#id").val());
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


        $("#frmRegistroVideo").submit(function(e) {
            var url = "publicacionrecurso/GuardarVideo"; // the script where you handle the form input.  
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
                            $('#frmRegistroImagen')[0].reset()
							//MostrarLista();
							$("#modalImagenes").modal("hide");
							ListarVideos($("#id").val());
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
				url: "publicacion/Leer",
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

		function VerImagenRecurso(id) {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "publicacionrecurso/Leer",
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
							var RutaImagen = "<center><img src=\"{{config('constants.rutapublica.url')}}"+val['rutarecurso']+"\" width='300px' ></center>";
							$("#divImagen").html(RutaImagen);
						});
					}
				}
			});
			//=================== ********* ====================
		}


	</script>	
@stop