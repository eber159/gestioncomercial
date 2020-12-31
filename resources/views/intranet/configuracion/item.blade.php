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
												<th>Certificado</th>
												<th>Stock</th>
												<th>Precio</th>
												<th>Forma</th>
												<th>Carats</th>
												<th>Claridad</th>
												<th>Color</th>
												<th>Corte</th>
												<th>Pulido</th>
												<th>Simetría</th>
												<th>Fluorescente</th>
												<th>Lab</th>
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
					
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Certificado</label>
									<input type="number" class="form-control" id="certificado" name="certificado" placeholder="Ingrese Codigo" style="width: 100%" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Stock</label>
									<input type="number" class="form-control" id="stock" name="stock" placeholder="0" style="width: 100%" step="any" required>
								</div>
							</div>
						

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Precio</label>
									<input type="number" class="form-control" id="precio" name="precio" placeholder="0" style="width: 100%" step="any" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Forma</label>
									<!--<input type="text" class="form-control" id="forma" name="forma" placeholder="Forma" style="width: 100%" >-->
									<select class="form-control" id="forma" name="forma">
										<option value="ROUND">ROUND</option>
										<option value="PRINCESS">PRINCESS</option>
										<option value="PEAR">PEAR</option>
										<option value="HEART">HEART</option>
										<option value="OVAL">OVAL</option>
										<option value="MARQUISE">MARQUISE</option>
										<option value="EMERALD">EMERALD</option>
										<option value="RADIANT">RADIANT</option>
										<option value="CUSHION">CUSHION</option>
										<option value="CUSHION MBR">CUSHION MBR</option>
										<option value="OTHER">OTHER</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Carats</label>
									<input type="number" class="form-control" id="carats" name="carats" placeholder="Carats" style="width: 100%" step="any">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Claridad</label>
									<select class="form-control" id="claridad" name="claridad">
										<option value="">Seleccione</option>
										<option value="FL">FL</option>
										<option value="IF">IF</option>
										<option value="VVS1">VVS1</option>
										<option value="VVS2">VVS2</option>
										<option value="VS1">VS1</option>
										<option value="VS2">VS2</option>
										<option value="SI1">SI1</option>
										<option value="SI2">SI2</option>
										<option value="SI3">SI3</option>
										<option value="I1">I1</option>
										<option value="I2">I2</option>
										<option value="I3">I3</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Color</label>
									<select class="form-control" id="color" name="color">
										<option value="">Seleccione</option>
										<option value="WH">WHITE</option>
										<option value="YL">YELLOW</option>
										<option value="NV">NONE VISIBLE</option>
										<option value="BRN0">BROWN</option>
										<option value="BRN1">BRN1</option>
										<option value="BRN2">BRN2</option>
										<option value="BRN3">BRN3</option>
										<option value="GREY">GREY</option>
										<option value="PINK">PINK</option>
										<option value="FANCY">FANCY</option>
										<option value="GRE">GRE</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Corte</label>
									<select class="form-control" id="corte" name="corte">
										<option value="">Seleccione</option>
										<option value="EX">EXCELENT</option>
										<option value="VG">VERY GOOD</option>
										<option value="GD">GOOD</option>
										<option value="F">FAIR</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Pulido</label>
									<select class="form-control" id="pulido" name="pulido">
										<option value="">Seleccione</option>
										<option value="EX">EXCELENT</option>
										<option value="VG">VERY GOOD</option>
										<option value="GD">GOOD</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Simetría</label>
									<select class="form-control" id="simetria" name="simetria">
										<option value="">Seleccione</option>
										<option value="EX">EXCELENT</option>
										<option value="VG">VERY GOOD</option>
										<option value="GD">GOOD</option>
										<option value="F">FAIR</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Fluorescence</label>
									<select class="form-control" id="fluorescent" name="fluorescent">
										<option value="">Seleccione</option>
										<option value="N">None Fluroescence</option>
										<option value="FNT">Faint Fluroescence</option>
										<option value="MED">Medium Fluroescence</option>
										<option value="STG">Strong Fluroescence</option>
										<option value="VST">Very Strong Fluroescence</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Lab</label>
									<select class="form-control" id="lab" name="lab">
										<option value="GIA">GIA</option>
										<option value="IGI">IGI</option>
										<option value="HRD">HRD</option>
										<option value="EGL">EGL</option>
										<option value="IIDGR">IIDGR</option>
										<option value="AGS">AGS</option>
										<option value="FAITH">FAITH</option>
										<option value="FM">FM</option>
										<option value="FMI">FMI</option>
										<option value="FMG">FMG</option>
										<option value="FMG/I">FMG/I</option>
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
			
			//CargarComboFamilia();
			//CargarComboUnidadMedida();
			InicializarTabla();
			//InicializarTablaPrecios();
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
			var url = "item/Listar";
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
									,"Certificado": val["certificado"]
									,"Stock": val["stock"]
									,"Precio": val["precio"]
									,"Forma": val["forma"]
									,"Carats": val["carats"]
									,"Claridad": val["claridad"]
									,"Color": val["color"]
									,"Corte": val["corte"]
									,"Pulido": val["pulido"]
									,"Simetria": val["simetria"]
									,"Fluorescent": val["fluorescent"]
									,"Lab": val["lab"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-primary btn-xs' onclick='Editar(\"item/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"item/Eliminar\","+val["id"]+")' class='red'>"
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
						"sWidth": "8%", "mDataProp": "Certificado"
					},{
						"sWidth": "8%", "mDataProp": "Stock"
					},{
						"sWidth": "8%", "mDataProp": "Precio"
					},{
						"sWidth": "8%", "mDataProp": "Forma"
					},{
						"sWidth": "8%", "mDataProp": "Carats"
					},{
						"sWidth": "8%", "mDataProp": "Claridad"
					},{
						"sWidth": "8%", "mDataProp": "Color"
					},{
						"sWidth": "8%", "mDataProp": "Corte"
					},{
						"sWidth": "8%", "mDataProp": "Pulido"
					},{
						"sWidth": "8%", "mDataProp": "Simetria"
					},{
						"sWidth": "8%", "mDataProp": "Fluorescent"
					},{
						"sWidth": "8%", "mDataProp": "Lab"
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
			$("#certificado").val(val["certificado"]);
			$("#stock").val(val["stock"]);
			$("#precio").val(val["precio"]);
			$("#forma").val(val["forma"]);
			$("#carats").val(val["carats"]);
			/*CargarComboSubfamilia(val["idfamilia"]);*/
			$("#claridad").val(val["claridad"]);
			$("#color").val(val["color"]);
			$("#corte").val(val["corte"]);
			$("#pulido").val(val["pulido"]);
			$("#simetria").val(val["simetria"]);
			$("#fluorescent").val(val["fluorescent"]);
			$("#lab").val(val["lab"]);
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
            var url = "item/Guardar"; // the script where you handle the form input.  
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