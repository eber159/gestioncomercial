@section('title-page')
	ErpWeb | Gestión Mensajes
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Mensajes <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Mensajes</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop


@section('botonera')
	</br>
	<div class="col-md-12">
		<div class="box">
			<div class="box-footer">
				<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
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
												<th>Nombres</th>
												<th>Número</th>
												<th>Correo</th>
												<th>Asunto</th>
												<th>mensaje</th>
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

							<div class="col-md-6">
								<div class="form-group">
									<label for="">Cliente</label>
									<input type="text" class="form-control" id="cliente" name="cliente" placeholder="Ingrese Nombre del Cliente" style="width: 100%" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Descripción</label>
									<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripcion" style="width: 100%" required>
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
			
			InicializarTabla();
			Listar();

			$("#btnListar").on("click", function(event) {
				Listar();
			});

		});
		


		function Listar() {
			var form = $('#frmRegistro');
			var url = "mensaje/Listar";
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
									,"Nombres": val["nombres"]
									,"Numero": val["numero"]
									,"Correo": val["correo"]
									,"Asunto": val["asunto"]
									,"Mensaje": val["mensaje"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"mensaje/Eliminar\","+val["id"]+")' class='red'>"
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
						"sWidth": "20%", "mDataProp": "Nombres"
					},{
						"sWidth": "10%", "mDataProp": "Numero"
					},{
						"sWidth": "10%", "mDataProp": "Correo"
					},{
						"sWidth": "10%", "mDataProp": "Asunto"
					},{
						"sWidth": "40%", "mDataProp": "Mensaje"
					},{
						"sWidth": "15%", "mDataProp": "Acciones"
					}]
			});
		}


		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#nombre").val(val["nombre"]);
			$("#descripcion").val(val["descripcion"]);
			var RutaImagen = "{{config('constants.rutapublica.url')}}"+val['imagen'];
			$('#imagensel').attr('src', RutaImagen).height(100);
			var RutaImagen2 = "{{config('constants.rutapublica.url')}}"+val['slider'];
			$('#imagensel2').attr('src', RutaImagen2).height(100);
		}


        $("#frmRegistro").submit(function(e) {
            var url = "testimonio/Guardar"; // the script where you handle the form input.  
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
				url: "testimonio/Leer",
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