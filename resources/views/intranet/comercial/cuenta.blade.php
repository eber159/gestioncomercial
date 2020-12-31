@section('title-page')
	ErpWeb | Estado de Cuenta
@stop

@extends('plantilla_int')

@section('titulo-form')
	Registro de Estados de Cuenta <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Estado de Cuenta</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Registrados</h3>
					  	<div style="float: right;">
					  		<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
							<button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-default btn-sm"><i class="fa fa-file"></i> Nuevo </button>
							<button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i class="fa fa-excel"></i> Exportar</button>
					  	</div>
					</div>
					<div class="box-body">
						<div id="Lista">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table id="tblDatos" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th>Titular</th>
												<th>Tipo Cuenta</th>
												<th>Moneda</th>
												<th>Responsable</th>
												<th>Estado</th>
												<th>Saldo</th>
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
					<div class="box-header with-border">
					  <h3 class="box-title"></h3>
					  	<div style="float: left;">
					  		<label for="">Código</label>
					  		<div class="form-group" style="display: inline-block;">
					  			
								<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo Generado" style="width: 100%" readonly="readonly">
							</div>	
							&nbsp;
							<label for="">Fecha</label>
							<div class="form-group" style="display: inline-block; width: 35%">
								<input type="text" class="form-control" id="fecha" name="fecha" placeholder="" style="width: 100%">
							</div>
					  	</div>
					  	
						<div style="float: right;">
					  		<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
					  		<button type="button" id="btnAmpliarCredito" name="btnAmpliarCredito" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Ampliar Crédito</button>
							<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
					  	</div>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-12">
										<label for="">Cliente</label>
										<div class="input-group input-group-sm">
							                <select class="form-control select2" style="width: 100%;" id='idtitular' name="idtitular" ></select>
						                    <span class="input-group-btn">
						                      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
						                    </span>
							             </div>
									</div>								
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Moneda</label>
											<select class="form-control" style="width: 100%;" id='idmoneda' name="idmoneda" >
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Responsable </label>
											<select class="form-control" id="idvendedor" name="idvendedor">
												<option value=""></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Tipo Cuenta</label>
											<select class="form-control" style="width: 100%;" id='idtipocuenta' name="idtipocuenta" >
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Estado Cuenta</label>
											<select class="form-control" style="width: 100%;" id='idestadocuenta' name="idestadocuenta" >
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Saldo de la Cuenta</label>
											<input type="number" class="form-control" id="txtSaldocuenta" name="txtSaldocuenta" readonly="readonly" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Límite de Crédito</label>
											<input type="number" class="form-control" id="limitecredito" name="limitecredito" />
										</div>
									</div>
								</div>
							</div>
							
							

							<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
							            <ul class="nav nav-tabs">
							              <li class="active"><a href="#tab_1" data-toggle="tab">Movimientos</a> </li>
							            </ul>
							            <div class="tab-content">
								            <div class="tab-pane active" id="tab_1">
								            	<div class="row">
								            		<div class="col-md-12">
										            	<div class="col-md-4">
															<button type="button" id="btnListarDetalles" name="btnListarDetalles" class="btn btn-success btn-sm" style="display:none"><i class="fa fa-refresh"></i> Listar</button>
														</div>
								            		</div>
								            	</div>
								            	<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-12">
								            				<div class="table-responsive">
								            					<table id="tblDetalles" class="table table-bordered table-hover" style="width: 100%">
				                                                    <thead>
				                                                    <th style='display:none'></th>
				                                                    <th>Fecha</th>
				                                                    <th>Concepto</th>
				                                                    <th>CARGO</th>
				                                                    <th>ABONO</th>
				                                                    <th>SALDO</th>
				                                                    <th>Observación</th>
																	<th>Tipo Ref.</th>
																	<th>Rerefencia</th>
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
					  <!-- /.box-body -->
					  
					</form>
				</div>
			</div>
		</div>
	</section>
		


	<div class="modal modal-default fade" id="modalampliaciones">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">AMPLIACIÓN DE CRÉDITO</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-md-12">
                        	<form id="frmRegistroAmpliacion" action="#">
	                            <div class="col-md-6">
									<div class="form-group">
										<label for="">Monto de ampliación</label>
										<input type="number" class="form-control" id="monto" name="monto" placeholder="S/ Monto" style="width: 100%">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Fecha</label>
										<input type="text" class="form-control" id="fechaampliacion" name="fechaampliacion" placeholder="Fecha" style="width: 100%">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Glosa</label>
										<input type="texy" class="form-control" id="observacion" name="observacion" placeholder="Observación" style="width: 100%">
									</div>
								</div>
							</form>
							<div class="col-md-2">
								<div class="form-group">
									<button type="button" id="btnGuardarAmpliacion" name="btnGuardarAmpliacion" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Agregar</button>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<input type="hidden" class="form-control" id="idampliacion" name="idampliacion" >
								</div>
							</div>
                        </div>
                    </div>
                    <br/>
                    <div class='row'>
                    	<div class="col-md-12">
                    		<div class="table-responsive">
								<table id="tblAmpliaciones" class="table table-bordered table-hover" style="width: 100%">
									<thead>
										<tr>
											<th style="display:none">Id</th>
											<th>Fecha</th>
											<th>Monto Ampliacion</th>
											<th>Observación</th>
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


@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			$('.select2').select2()
			InicializarTabla();
			InicializarTablaDetalles();
			InicializarTablaAmpliaciones();
			Listar();
			CargarComboMoneda();
			CargarComboEmpresa();
			CargarComboTipoCuenta();
			CargarComboEstadoCuenta();
			CargarTrabajadores();

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
							"sWidth": "40%", "mDataProp": "Titular"
						}, {
							"sWidth": "20%", "mDataProp": "TipoCuenta"
						}, {
							"sWidth": "5%", "mDataProp": "Moneda"
						}, {
							"sWidth": "25%", "mDataProp": "Responsable"
						}, {
							"sWidth": "10%", "mDataProp": "Estado"
						}, {
							"sWidth": "10%", "mDataProp": "Saldo"
						}, {
							"sWidth": "10%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "className": "text-right",
						    "mRender": function (data, type, full) {
                            	return parseFloat(data).toFixed(2);
                        	}
						}]
				});
			}
			
			function InicializarTablaDetalles() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var Table = $('#tblDetalles').dataTable({
					"info": false,
					"bFilter": false,
					"bPaginate": false,
					"bSort": false,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						},{
							"sWidth": "5%", "mDataProp": "Fecha"
						},{
							"sWidth": "30%", "mDataProp": "Concepto"
						},{
							"sWidth": "10%", "mDataProp": "Cargo"
						},{
							"sWidth": "10%", "mDataProp": "Abono"
						},{
							"sWidth": "10%", "mDataProp": "Saldo"
						},{
							"sWidth": "35%", "mDataProp": "Glosa"
						},{
							"sWidth": "10%", "mDataProp": "TipoReferencia"
						},{
							"sWidth": "10%", "mDataProp": "Referencia"
						}],
					'columnDefs':[
						{
						      "targets": [3,4,5],
						      "className": "text-right",
						}],
					'fnRowCallback': function( nRow, aData, iDisplayIndex ) {
			            /* Append the grade to the default row class name */
			            if ( aData["Estado"] == "0" )
			            {
			            	$('td', nRow).css('background-color', 'Red');
			            	$('td', nRow).css('display', 'none');
			            	//$('td', nRow).addClass("fila_eliminada");
			            }else
			            {
			            	$('td', nRow).css('background-color', 'White');
			            	//$('td', nRow).addClass("fila_eliminada");	
			            }	
			        }
				});
			}

			function InicializarTablaAmpliaciones() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var Table = $('#tblAmpliaciones').dataTable({
					"info": false,
					"order": false,
					"search": false,
					"processing": true,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						}, {
							"sWidth": "20%", "mDataProp": "Fecha"
						}, {
							"sWidth": "20%", "mDataProp": "Monto"
						}, {
							"sWidth": "60%", "mDataProp": "Observacion"
						}, {
							"sWidth": "10%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "className": "text-right",
						    "mRender": function (data, type, full) {
                            	return parseFloat(data).toFixed(2);
                        	}
						}]
				});
			}

			$("input[type='number']").click(function () {
			   $(this).select();
			});
			
			$("#btnNuevo").on("click", function(event) {
				$('#frmRegistro')[0].reset();
				document.getElementById('limitecredito').readOnly = false;
				MostrarRegistro();
				$("#id").val("");
				$('#fecha').datepicker({
                	format: 'yyyy-mm-dd'
	            }).attr('readonly', 'readonly');
	            $('#fecha').datepicker("setDate", new Date());
	            $('#fechaampliacion').datepicker({
                	format: 'yyyy-mm-dd'
	            }).attr('readonly', 'readonly');
	            $('#fechaampliacion').datepicker("setDate", new Date());

                $("#idestadocuenta").val({{ config('constants.estadocuenta.activo') }});
                $("#idtitular").val('').trigger('change');
                var oTableDetalles = $("#tblDetalles").dataTable();
				oTableDetalles.fnClearTable();
                InicializarCantidades();

			});

			$("#btnGuardar").on("click", function(event) {
				GuardarCuenta();
			});


			$("#btnListar").on("click", function(event) {
				Listar();
			});
			
			$("#btnAmpliarCredito").on("click", function(event) {
				ListarAmpliaciones();
			});

			$("#btnGuardarAmpliacion").on("click", function(event) {
				GuardarAmpliacion();
			});
			
		});
		
	
		function ListarAmpliaciones() {
			var form = $('#frmRegistro');
			var url = "cuentaampliacion/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idcuenta":$("#id").val()},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#modalampliaciones").modal("show")
				},
				success: function (data) {
					var oTable = $("#tblAmpliaciones").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"Id": val["id"]
									,"Monto": val["monto"]
									,"Fecha": val["fecha"]
									,"Observacion": val["observacion"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='EliminarAmpliacion(\"cuentaampliacion/Eliminar\","+val["id"]+")' class='red'>"
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


		function validarGuardarAmpliacion(){
	        if($("#monto").val()=="" && $("#fecha").val()==""){
	            bootbox.alert("Debe definir al menos un precio");
	            return false;
	        }
	        return true;
	    }


		function GuardarAmpliacion(){
			if(validarGuardarAmpliacion()){
				var obj = {
					"id": ""
					,"idcuenta": $("#id").val()
					,"monto": $("#monto").val()
					,"fecha": $("#fechaampliacion").val()
					,"observacion": $("#observacion").val()
				};

				var resp = "";
				$.ajax({
					type: "POST",
					async: false,
					data: obj,
					url: "../comercial/cuentaampliacion/Guardar",
					dataType: "json",
					beforeSend: function (data) {
						
					},
					success: function (data) {
						if (data !== null && typeof data === 'object') {
							if(data.success == true){
								ListarAmpliaciones();
								$('#frmRegistroAmpliacion')[0].reset();
								EditarCuenta("cuenta/Leer",$("#id").val());
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

		function EliminarAmpliacion(url,id) {
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
								ListarAmpliaciones();
								EditarCuenta("cuenta/Leer",$("#id").val());
							}
						}
					});
				}
			});
			//=================== ********* ====================
		}

	
		function validarAgregarProducto(){
			var estado = true;
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];

			    var idprod = data["IdProducto"];

			    if(estado && data["Estado"]==1){
			    	if($("#idproductobusqueda").val()==idprod){
				    	bootbox.alert("El producto ya existe en la lista");
		            	estado = false;
				    }
			    }
			    

			} );
			/*
	        if($scope.SerOC==""){
	            alert("No ha indicado la serie para la compra.");
	            return false;
	        }
	        */
	        return estado;
	    }

		function InicializarCantidades(){
			$("#cantidadbusqueda").val(0);
			$("#preciobusqueda").val(0);
			$("#dsctobusqueda").val(0);
			$("#idproductobusqueda").val('').trigger('change');
		}

		function GuardarCuenta(){
			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"codigo": $("#codigo").val()
				,"idtitular": $("#idtitular").val()
				,"idtipocuenta": $("#idtipocuenta").val()
				,"idestadocuenta": $("#idestadocuenta").val()
				,"idmoneda": $("#idmoneda").val()
				,"fecha": $("#fecha").val()
				,"idvendedor": $("#idvendedor").val()
				,"limitecredito": $("#limitecredito").val()
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../comercial/cuenta/Guardar",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						if(data.success == true){
							bootbox.alert(data.message);
							MostrarLista();
							Listar();
							$('#frmRegistro')[0].reset();
							resp = "ok";
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


		/*

		function Listar() {
			var form = $('#frmRegistro');
			var url = "../comercial/cuenta/Listar";
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
									,"Titular": val["titular"]
									,"TipoCuenta": val["tipo"]
									,"Moneda": val["moneda"]
									,"Responsable": val["responsable"]
									,"Estado": val["estado"]
									,"Saldo": val["saldo"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a class='btn btn-xs btn-default' href='javascript:;' onclick='EditarCuenta(\"cuenta/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a class='btn btn-xs btn-danger' href='javascript:;' onclick='Eliminar(\"cuenta/Eliminar\","+val["id"]+")' class='red'>"
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
		*/


		function Listar() {
			var form = $('#frmRegistro');
			var url = "../comercial/cuenta/Listar";
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

					var boton_aprobar = "";
					var boton_rechazar = "";

					var oTable = $("#tblDatos").dataTable();
	                oTable.fnDestroy();
	                oTable.DataTable( {
	                    data: data.lista,
	                    "columns": [
	                                { "data": 'id', "width": "5%", "visible": false},
	                                { "data": 'titular', "width": "30%"},
	                                { "data": 'tipo', "width": "10%"},
	                                { "data": 'moneda', "width": "10%"},
	                                { "data": 'responsable', "width": "20%"},
	                                { "data": 'estado', "width": "10%"},
	                                { "data": 'saldo', "width": "10%", className: 'dt-body-right'},
	                                

	                                { "data": null,
	                                        "searchable": true,
	                                        "orderable":true,
	                                        "render": function (data, type, row) {
	                                        	return "<center><div class='hidden-sm hidden-xs action-buttons'>"
															+"<a class='btn btn-xs btn-default' href='javascript:;' onclick='EditarCuenta(\"cuenta/Leer\","+row.id+")' class='blue'>"
																+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
															+"</a>&nbsp;"
															+"<a class='btn btn-xs btn-danger' href='javascript:;' onclick='Eliminar(\"cuenta/Eliminar\","+row.id+")' class='red'>"
																+"<i class='ace-icon fa fa-times bigger-130'></i>"
															+"</a>"
														+"</div></center>"
												+"</div>";
	                                    	},"width": "15%"
	                                },
	                            ],
	                    "dom": 'Bfrtip',
	                    "buttons": [
	                        'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
	                    ] ,
	                    "paging": true,
	                    "order": [[ 1, "asc" ]],
	                    "autoWidth": false,
	                    "info": true,
	                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],

	                } );
					$("#divCargando").hide();
				},
				finally: function (){
					$("#divCargando").hide();
				}
			});
			//=================== ********* ====================
		}

		
		function EditarCuenta(url,id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			$('#frmRegistro')[0].reset();
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					//document.getElementById('limitecredito').readOnly = true;
				},
				success: function (data) {
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#codigo").val(val["codigo"]);
							$("#idtitular").val(val["idtitular"]).trigger('change');
							$("#idtipocuenta").val(val["idtipocuenta"]);
							$("#idestadocuenta").val(val["idestadocuenta"]);
							$('#fecha').datepicker({
			                	format: 'yyyy-mm-dd'
				            }).attr('readonly', 'readonly');
				            $('#fecha').datepicker("setDate", val["fecha"]);
				            $("#idvendedor").val(val["idvendedor"]);
				            $("#txtSaldocuenta").val(val["saldo"]);
				            $("#limitecredito").val(val["limitecredito"]);

					        var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetalles").dataTable();
								
					            var objdet = {"Id": val2["id"]
					            		,"Fecha": val2["fecha"]
										,"Concepto": val2["concepto"]
										,"Cargo": val2["CARGO"]
										,"Abono": val2["ABONO"]
										,"Saldo": val2["saldo"]
										,"Glosa": val2["glosa"]
										,"TipoReferencia": val2["tiporeferencia"]
										,"Referencia":val2["referencia"]
										};
								oTableDetalles.fnAddData(objdet);
								Linea++;
					        });
							MostrarRegistro();
						});
					}
				},
				complete: function(){
					$("input[type='number']").click(function () {
					   $(this).select();
					});
					var oTableDetalles = $("#tblDetalles").DataTable();
					oTableDetalles.rows().eq(0).each( function ( index ) {
					    var row = oTableDetalles.row( index );
					    var data = row.data();
					    var Linea = data["Row"];
					    $("#txtCantidad"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
						$("#txtPrecioUnit"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
						$("#txtPrecioPromo"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
						$("#txtDescuento"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
					});
				} 
			});
			//=================== ********* ====================
		}



		// CARGAR COMBOS

		function CargarComboMoneda() {
            var $combo = $("#idmoneda");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"MONEDA"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboEstadoCuenta() {
            var $combo = $("#idestadocuenta");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_CUENTA"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboTipoCuenta() {
            var $combo = $("#idtipocuenta");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_CUENTA"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboEmpresa() {
            var $combo = $("#idtitular");
            $combo.empty();
            $.post('../configuracion/empresa/Listar',
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function CargarTrabajadores() {
            var $combo = $("#idvendedor");
            $combo.empty();
			var idempresa = "{{Session::get('idempresa')}}";
            $.post('../configuracion/trabajador/Listar',{"idempresa":idempresa},
                    function (data) {
                        $combo.append("<option value=''>Seleccione Vendedor</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function calcularValorLinea(item){
        	var cant = parseFloat($("#txtCantidad"+item).val());
        	var precio = parseFloat($("#txtPrecioUnit"+item).val());
        	var dscto = parseFloat($("#txtDescuento"+item).val());
        	$("#txtValorVenta"+item).val(((cant*precio)-dscto).toFixed(4));
        	calcularTotales();
        }

        function calcularTotales(){
        	var oTable2 = $("#tblDetalles").DataTable();
        	var subtotal = parseFloat(0);
        	var totaligv = parseFloat(0);
        	var totaldscto = parseFloat(0);
        	var totalneto = parseFloat(0);
			oTable2.rows().eq(0).each( function ( index ) {

			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
			    if(data["Estado"]==1){
					var precio = parseFloat($("#txtPrecioUnit"+fila).val());
				   	var cantidad = parseFloat($("#txtCantidad"+fila).val());
				   	var dscto = parseFloat($("#txtDescuento"+fila).val());
				   	var neto = parseFloat($("#txtValorVenta"+fila).val());

				    subtotal = (parseFloat(subtotal) + (parseFloat(precio)*parseFloat(cantidad))).toFixed(2);
				    totalneto = (parseFloat(totalneto) + parseFloat(neto)).toFixed(2);
				    totaldscto = (parseFloat(totaldscto) + parseFloat(dscto)).toFixed(2);
				}
			});

			$("#subtotal").val(subtotal);
			$("#totaldscto").val(totaldscto);
			$("#impuestovta").val(0);
			$("#total").val(totalneto);
        }

	</script>	
@stop