@section('title-page')
	ErpWeb | Información General
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Información General <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Información General</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista" style="display:none">
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
												<th>UnidadMedida</th>
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
		<div class="row" id="divRegistro" >
			<div class="col-md-12">
				<div class="box box-primary">
					<form role="form" id="frmRegistro" enctype="multipart/form-data">
						<div class="box-header with-border">

						<button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" ><i class="fa fa-save"></i> Guardar</button>
						</div>
					
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%; display: none">
						<div class="box-body">

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombre Empresa</label>
									<input type="text" class="form-control" id="empresa" name="empresa" placeholder="Ingrese Nombre del Producto" style="width: 100%" required>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Banner Principal</label>
									<input type="file" id="imagen" name="imagen">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Dirección</label>
									<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese Nombre del Producto" style="width: 100%" required>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Teléfono 1</label>
									<input type="text" class="form-control" id="telefono1" name="telefono1" placeholder="Ingrese Nombre del Producto" style="width: 100%">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Teléfono 2</label>
									<input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Ingrese Nombre del Producto" style="width: 100%">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Correo</label>
									<input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese Nombre del Producto" style="width: 100%" required>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nosotros Resumen</label>
									<textarea class="form-control" id="nosotrosresumen" name="nosotrosresumen" placeholder="Resumen Descripción" style="width: 100%" required rows='10'></textarea>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Link Facebook</label>
									<input type="text" class="form-control" id="linkfacebook" name="linkfacebook" placeholder="Ingrese Link Facebook" style="width: 100%" >
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Link Twitter</label>
									<input type="text" class="form-control" id="linktwitter" name="linktwitter" placeholder="Ingrese Link Twitter" style="width: 100%" >
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Link Instagram</label>
									<input type="text" class="form-control" id="linkinstagram" name="linkinstagram" placeholder="Ingrese Link Instagram" style="width: 100%" >
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Link LinkedIn</label>
									<input type="text" class="form-control" id="linklikedin" name="linklikedin" placeholder="Ingrese Link LinkedIn" style="width: 100%" >
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Link Whatsapp</label>
									<input type="text" class="form-control" id="linkwhatsapp" name="linkwhatsapp" placeholder="Ingrese Link Whatsapp" style="width: 100%" >
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Términos y Condiciones</label>
									<textarea class="form-control" id="nosotros" name="nosotros" placeholder="Descripción de la Empresa" style="width: 100%" required rows='15'></textarea>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Pie de Página</label>
									<!--<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripcion" style="width: 100%" required>-->
									<textarea name="editor1" rows="10" cols="80">
					                    	
					                </textarea>
								</div>
							</div>


							<div style="">
								<legend>Favicon</legend>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Seleccione Imagen</label>
										<input type="file" id="slide1" name="slide1">
									</div>
								</div>								
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Orden de las Publicaciones</label>
									<select class="form-control" id="orden_publicaciones" name="orden_publicaciones">
										<option value="asc">Ascendente</option>
										<option value="desc">Descendente</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Mostrar Carro Compras</label>
									<select class="form-control" id="ind_carro" name="ind_carro">
										<option value="1">SI</option>
										<option value="0">NO</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Mostrar Testimonios</label>
									<select class="form-control" id="ind_testimonios" name="ind_testimonios">
										<option value="1">SI</option>
										<option value="0">NO</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Agregar Forma de Pago</label>
									<textarea name="formapago" rows="10" cols="40">
					                    	
					                </textarea>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="">Agregar Datos para Impresiones</label>
									<textarea name="datosimpresion" rows="10" cols="40">
					                    	
					                </textarea>
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
		
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
			MostrarRegistro();
			InicializarTabla();
			LeerInfo(1);
			//Listar();

			$("#btnGuardarPrecios").on("click", function(event) {
				GuardarPrecios();
			});

			CKEDITOR.replace('editor1');
			CKEDITOR.replace('formapago');
			CKEDITOR.replace('datosimpresion');
		    //bootstrap WYSIHTML5 - text editor
		    $('.textarea').wysihtml5();


		    CKEDITOR.editorConfig = function( config ) {
			    config.enterMode = CKEDITOR.ENTER_BR;
			};

			
		});

		function Listar() {
			var form = $('#frmRegistro');
			var url = "material/Listar";
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
									,"Codigo": val["codigo"]
									,"Nombre": "<a href='#' class='btn btn-default btn-xs' onclick='VerImagen("+val["id"]+")' ><i class='fa fa-image'></i></a>"+val["nombre"]
									,"UnidadMedida": val["nombreunidadmedida"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-default btn-xs' onclick='ListarPrecios("+val["id"]+")' class='blue'>"
														+"PRECIOS"
													+"</a>&nbsp;"
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
						"sWidth": "10%", "mDataProp": "UnidadMedida"
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
			$("#empresa").val(val["empresa"]);
			$("#direccion").val(val["direccion"]);
			$("#telefono1").val(val["telefono1"]);
			$("#telefono2").val(val["telefono2"]);
			$("#correo").val(val["correo"]);
			$("#nosotros").val(val["nosotros"]);
			$("#nosotrosresumen").val(val["nosotrosresumen"]);
			$("#linkfacebook").val(val["linkfacebook"]);
			$("#linktwitter").val(val["linktwitter"]);
			$("#linkinstagram").val(val["linkinstagram"]);
			$("#linklikedin").val(val["linklikedin"]);
			$("#linkwhatsapp").val(val["linkwhatsapp"]);
			$("#orden_publicaciones").val(val["orden_publicaciones"]);
			$("#ind_carro").val(val["ind_carro"]);
			$("#ind_testimonios").val(val["ind_testimonios"]);

			CKEDITOR.on('instanceReady', function(evt) {
				CKEDITOR.instances.editor1.setData(val["footer"]);
				CKEDITOR.instances['formapago'].setData(val["formapago"]);
				CKEDITOR.instances['datosimpresion'].setData(val["datosimpresion"]);
			});
			 
		}



        $("#frmRegistro").submit(function(e) {
            var url = "informaciongeneral/Guardar"; // the script where you handle the form input.  

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
                            //$('#frmRegistro')[0].reset()
							//MostrarLista();
							//Listar();
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


		function LeerInfo(id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			$('#frmRegistro')[0].reset();
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "informaciongeneral/Leer",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							CargarDatos(data.obj);
							MostrarRegistro();
						});
					}
				}
			});
			//=================== ********* ====================
		}

	</script>	
@stop