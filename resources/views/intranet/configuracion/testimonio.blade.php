@section('title-page')
	ErpWeb | Gestión Testimonios
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Testimonios <small>Panel de Control</small>
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
									<label for="">Título/Nombre</label>
									<input type="text" class="form-control" id="cliente" name="cliente" placeholder="Ingrese Nombre del Cliente" style="width: 100%" required>
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
									<label for="">Link</label>
									<input type="text" class="form-control" id="link" name="link" placeholder="Ingrese Link" style="width: 100%">
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
			var url = "testimonio/Listar";
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
									,"Nombre": "<a href='#' class='btn btn-default btn-xs' onclick='VerImagen("+val["id"]+")' ><i class='fa fa-image'></i></a>"+val["cliente"]
									,"Descripcion": val["descripcion"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-primary btn-xs' onclick='Editar(\"testimonio/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"testimonio/Eliminar\","+val["id"]+")' class='red'>"
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
			$("#cliente").val(val["cliente"]);
			$("#link").val(val["link"]);
			//$("#descripcion").val(val["descripcion"]);
			CKEDITOR.instances['editor1'].setData(val["descripcion"]);
			var RutaImagen = "{{config('constants.rutapublica.url')}}"+val['imagen'];
			$('#imagensel').attr('src', RutaImagen).height(100);
			var RutaImagen2 = "{{config('constants.rutapublica.url')}}"+val['slider'];
			$('#imagensel2').attr('src', RutaImagen2).height(100);
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
            var url = "testimonio/Guardar"; // the script where you handle the form input.  

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