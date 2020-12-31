@section('title-page')
	ErpWeb | Gestión Compras
@stop

@extends('plantilla_int')

@section('titulo-form')
	Registro de Compras <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Compras</a></li>
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
								<div>
									<table id="tblDatos" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th>Fecha Reg.</th>
												<th>Fecha Compra</th>
												<th>Proveedor</th>
												<th>Moneda</th>
												<th>M/S</th>
												<th>Total (S/)</th>
												<th>Estado</th>
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
							<div class="form-group" style="display: inline-block; width: 15%">
								<input type="text" class="form-control" id="fecharegistro" name="fecharegistro" placeholder="" style="width: 100%">
							</div>
							&nbsp;
							<label for="">T.C.</label>
							<div class="form-group" style="display: inline-block; width: 10%">
								<input type="number" class="form-control" id="tipocambio" name="tipocambio" placeholder="" style="width: 100%; text-align: right;">
							</div>
							&nbsp;
							<label for="">Tipo</label>
							<div class="form-group" style="display: inline-block; width: 20%">
								<select class="form-control" style="width: 100%;" id='indmaterialservicio' name="indmaterialservicio" >
									<option value="M">Material</option>
									<option value="S">Servicio</option>
								</select>
							</div>
					  	</div>
					  	
						<div style="float: right;">
					  		<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
							<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
					  	</div>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									
									<div class="col-md-6">
										<label for="">&nbsp;</label>
										<div class="input-group input-group-sm">
							                <input type="checkbox" style="width: 100%;" id='chkGenerarDocumento' name="chkGenerarDocumento" /> Generar Documento
							             </div>
									</div>
									
									<div class="col-md-12">
										<label for="">Proveedor</label>
										<div class="input-group input-group-sm">
							                <select class="form-control select2" style="width: 100%;" id='idcliente' name="idcliente" >
							                	@foreach ($proveedores as $p)
													<option value="{{ $p->id }}">{{ $p->nombre }}</option>
												@endforeach
							                </select>
						                    <span class="input-group-btn">
						                      <button type="button" id="btnRefrescarEmpresas" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
						                    </span>
							             </div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="">Cuenta Cargo</label>
											<select class="form-control" style="width: 100%;" id='idcuenta' name="idcuenta" >
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Sub Cuenta</label>
											<select class="form-control" style="width: 100%;" id='idsubcuenta' name="idsubcuenta" >
												<option value=""></option>
											</select>
										</div>
									</div>


									<div class="col-md-12">
										<div class="form-group">
											<label for="">Observaciones</label>
											<input type="text" class="form-control" id="glosa" name="glosa" placeholder="Observaciones" style="width: 100%">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Moneda</label>
											<select class="form-control" id="idmoneda" name="idmoneda">
												@foreach ($monedas as $m)
													<option value="{{ $m->id }}">{{ $m->nombre }}</option>
												@endforeach
												
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Tipo Pago</label>
											<select class="form-control" id="idtipopago" name="idtipopago">
												@foreach ($tipospago as $t)
													<option value="{{ $t->id }}">{{ $t->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Fecha Recepción</label>
											<input type="text" class="form-control" id="fecharecepcion" name="fecharecepcion" placeholder="" style="width: 100%">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="col-md-8">
										<div class="form-group">
											<label for="">Estado</label>
											<select class="form-control" id="idestado" name="idestado">
												@foreach ($estadoorden as $t)
													<option value="{{ $t->id }}">{{ $t->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Fecha Compra</label>
											<input type="text" class="form-control" id="fechacompra" name="fechacompra" placeholder="" style="width: 100%">
										</div>
									</div>
								</div>	
								<div class="col-md-6">
									<div class="col-md-8">
										<div class="form-group">
											<label for="">Vendedor</label>
											<select class="form-control" id="idvendedor" name="idvendedor">
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Tipo Orden</label>
											<select class="form-control" id="idtipoorden" name="idtipoorden">
												@foreach ($tipoorden as $t)
													<option value="{{ $t->id }}">{{ $t->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="">Sub Total</label>
											<input type="number" class="form-control" id="subtotal" name="subtotal" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Total IGV</label>
											<input type="number" class="form-control" id="impuestovta" name="impuestovta" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Total Dscto</label>
											<input type="number" class="form-control" id="totaldscto" name="totaldscto" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Total Neto</label>
											<input type="number" class="form-control" id="total" name="total" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>

								</div>
							</div>
						
							<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
							            <ul class="nav nav-tabs">
							              <li class="active"><a href="#tab_1" data-toggle="tab">Materiales/Servicios</a> </li>
										  <li class=""><a href="#tab_2" data-toggle="tab">Documentos</a> </li>
							            </ul>
							            <div class="tab-content">
								            <div class="tab-pane active" id="tab_1">
								            	<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-5">
										            		<label for="">Material/Servicio</label>
										            		<select class="form-control select2" style="width: 100%;" id='idproductobusqueda' name="idproducto" >
																<option value="">SELECCIONE</option>
																
															</select>
										            	</div>
														<div class="col-md-2">
										            		<label for="">Unidad Medida</label>
										            		<select class="form-control" style="width: 100%;" id='idunidadmedida' name="idunidadmedida" >
																@foreach ($unidades as $u)
																	<option value="{{ $u->id }}">{{ $u->nombre }}</option>
																@endforeach
															</select>
										            	</div>
										            	<div class="col-md-1">
															<label for="">Cantidad</label>
															<input type="number" class="form-control" id="cantidadbusqueda" name="cantidadbusqueda" placeholder="" style="width: 100%; text-align: right;">
														</div>	

														<div class="col-md-1">
															<label for="">Precio</label>
															<input type="number" class="form-control" id="preciobusqueda" name="preciobusqueda" placeholder="" style="width: 100%; text-align: right;">
														</div>

														<div class="col-md-1">
															<label for="">Dscto</label>
															<input type="number" class="form-control" id="dsctobusqueda" name="dsctobusqueda" placeholder="" style="width: 100%; text-align: right;">
														</div>
														<div class="col-md-1">
															<label for="">&nbsp;</label>
															<button type="button" id="btnAgregarProducto" name="btnAgregarProducto" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Agregar Producto </button>
														</div>
														
								            		</div>
								            	</div>
								            	<br>
								            	<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-12">
															<div class="table-responsive">
								            				<table id="tblDetalles" class="table table-bordered table-hover" style="width: 100%">
			                                                    <thead>
			                                                    <th style=''></th>
			                                                    <th style='display:none'></th>
			                                                    <th style='display:none'></th>
			                                                    <th>Producto</th>
			                                                    <th>Cant.</th>
																<th>IdUM</th>
																<th>U.M.</th>
			                                                    <th>P. Unit. S/IGV</th>
																<th>P. Unit.</th>
			                                                    <th>Dsto. (S/)</th>
																<th>Impuesto</th>
			                                                    <th>Valor Vta</th>
			                                                    <th></th>
			                                                    <th>Estado</th>
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
								            				<button type="button" id="btnGenerarDocumento" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Generar Documento </button>
															<div class="table-responsive">
								            				<table id="tblDocumentos" class="table table-bordered table-hover" style="width: 100%">
			                                                    <thead>
																	<tr>
																		<th style="display:none">Id</th>
																		<th>Tipo Doc.</th>
																		<th>Fecha Emisión</th>
																		<th>S/N</th>
																		<th>Moneda</th>
																		<th>Subtotal</th>
																		<th>Impuesto</th>
																		<th>Total</th>
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
					  <!-- /.box-body -->
					  
					</form>
				</div>
			</div>
		</div>
	</section>
		
	<div class="modal modal-default fade" id="modaldocumentoventa">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Selecciona Documento</h4>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label for="">Tipo Documento</label>
                                <select class="form-control" style="width: 100%;"
                                        id='cmbtipodocumentomodal' name="cmbtipodocumentomodal">
                                </select>                        
                            </div>
                            <div class="col-md-3">
                                <label for="">Serie</label>
                                <select class="form-control" style="width: 100%;" id='serie' name="serie" ></select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Numero</label>
                                <input type="text" class="form-control" id="nrodocumento" name="nrodocumento"
                                    placeholder="Numero" style="width: 100%">
                            </div>
                        </div>
						<div class="col-md-12">
							<div class="col-md-12">
                                <button type="button" id="btnGuardarVentaDocumento" name="btnGuardarVentaDocumento" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Guardar</button>
                            </div>
						</div>
                    </div>
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

			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			
			//$("#chkGenerarDocumento").iCheck();

			$('.select2').select2()
			InicializarTabla();
			InicializarTablaDetalles();
			InicializarTablaDocumentos();
			Listar();
			//CargarComboMoneda();
			//CargarComboTipoPago();
			//CargarComboEstadoOrden();
			//CargarComboTipoVenta();
			CargarComboProducto();
			//CargarComboEmpresa();
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
							"sWidth": "10%", "mDataProp": "FechaReg"
						}, {
							"sWidth": "10%", "mDataProp": "FechaCompra"
						}, {
							"sWidth": "40%", "mDataProp": "Proveedor"
						}, {
							"sWidth": "10%", "mDataProp": "Moneda"
						},{
							"sWidth": "10%", "mDataProp": "MS"
						},{
							"sWidth": "10%", "mDataProp": "Total"
						},{
							"sWidth": "10%", "mDataProp": "Estado"
						},{
							"sWidth": "10%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "targets": [6],
						    "className": "text-right",
						    "mRender": function (data, type, full) {
                            	return parseFloat(data).toFixed(2);
                        	}
						}]
				});
			}
			
			function InicializarTablaDocumentos() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var Table = $('#tblDocumentos').dataTable({
					"bInfo": false,
					"bFilter": false,
					"bPaginate": false,
					"bSort": false,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						}, {
							"sWidth": "10%", "mDataProp": "TipoDocumento"
						}, {
							"sWidth": "10%", "mDataProp": "Fecha"
						}, {
							"sWidth": "20%", "mDataProp": "Serie"
						}, {
							"sWidth": "10%", "mDataProp": "Moneda"
						},{
							"sWidth": "10%", "mDataProp": "Subtotal"
						},{
							"sWidth": "10%", "mDataProp": "Impuesto"
						},{
							"sWidth": "10%", "mDataProp": "Total"
						},{
							"sWidth": "10%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "targets": [5,6,7],
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
							"bVisible": true, "mDataProp": "Row"
						},{
							"bVisible": false, "mDataProp": "Id"
						},{
							"bVisible": false, "mDataProp": "IdProducto"
						},{
							"sWidth": "50%", "mDataProp": "Producto"
						},{
							"sWidth": "10%", "mDataProp": "Cantidad"
						},{
							"bVisible": false, "sWidth": "10%", "mDataProp": "IdUM"
						},{
							"sWidth": "10%", "mDataProp": "UnidadMedida"
						},{
							"sWidth": "5%", "mDataProp": "PrecioUnitarioSinIGV"
						},{
							"sWidth": "5%", "mDataProp": "PrecioUnitario"
						},{
							"sWidth": "5%", "mDataProp": "Descuento"
						},{
							"sWidth": "5%", "mDataProp": "IndImpuesto"
						},{
							"sWidth": "10%", "mDataProp": "ValorVenta"
						},{
							"sWidth": "10%", "mDataProp": "Acciones"
						},{
							"bVisible": false, "sWidth": "10%", "mDataProp": "Estado"
						}],
					'columnDefs':[
						{
						      "targets": [4,7,8,9,10,12,13],
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

			$('#idcliente').on('select2:select', function (e) {
				$("#idcuenta").empty();
				$("#idsubcuenta").empty();
				if($("#idcliente").val()!=""){
					buscarCuenta($("#idcliente").val());
				}else{
					$("#idcuenta").empty();
					$("#idsubcuenta").empty();
				}
			});

			$(document).on('change', '#idcuenta', function() {
				$("#idsubcuenta").empty();
				if($("#idcuenta").val()!=""){
					buscarSubCuenta($("#idcuenta").val());
				}
			    else{
					$("#idsubcuenta").empty();
				}
			});

			$(document).on('change', '#cmbtipodocumentomodal', function() {
				//if($("#cmbtipodocumentomodal").val()!=""){
					CargarSeries();
				//}
			});

			$(document).on('change', '#serie', function() {
				//if($("#cmbtipodocumentomodal").val()!=""){
					CargarUltimoCorrelativo();
				//}
			});

			$(document).on('change', '#indmaterialservicio', function() {
				if($("#indmaterialservicio").val()=="M"){
					CargarComboProducto();
				}else{
					CargarComboServicios();
				}
			});

			$('#nrodocumento').focusout(function() {			
				$('#nrodocumento').val(formatoDocumento($('#nrodocumento').val(),12));
			})

			function buscarCuenta(idtitutar){
				var $combo = $("#idcuenta");
				$combo.empty();
				$.post('../comercial/cuenta/ListarTitular',{"idtitular":idtitutar},
				function (data) {
					$combo.append("<option value=''>Seleccione</option>");
					$.each(data.lista, function (index, item) {
						$combo.append("<option value='" + item.id + "'>" + item.codigo + " / " + item.tipo + " / " + item.moneda + "</option>");
					});
					if(data.lista.length > 0){
						$("#idcuenta").val(data.lista[0].id);
						setTimeout(function(){
							buscarSubCuenta(data.lista[0].id);
						}, 50);
					}
				}, 'json');
			}

			function buscarSubCuenta(idcuenta){
				var $combo = $("#idsubcuenta");
				$combo.empty();
				$.post('../comercial/subcuenta/ListarCuenta',{"idcuenta":idcuenta},
				function (data) {
					$.each(data.lista, function (index, item) {
						$combo.append("<option value='" + item.id + "'>" + item.descripcion + "</option>");
					});
				}, 'json');
			}


			$("input[type='number']").click(function () {
			   $(this).select();
			});
			
			$("#btnNuevo").on("click", function(event) {
				$('#frmRegistro')[0].reset();
				$("#idcuenta").empty();
				$("#idsubcuenta").empty();
				$("#idmoneda").val({{ config('constants.moneda.soles') }});
				$("#idtipoorden").val({{ config('constants.tipocompra.compralogistica') }});
				$("#idestado").val({{ config('constants.estadocompra.generada') }});

				MostrarRegistro();
				$("#id").val("");
				$('#fecharegistro').datepicker({
                	format: 'yyyy-mm-dd'
	            }).attr('readonly', 'readonly');
	            $('#fecharegistro').datepicker("setDate", new Date());

	            $('#fecharecepcion').datepicker({
	                format: 'yyyy-mm-dd'
	            });
	            $('#fecharecepcion').datepicker("setDate", new Date());

	            $('#fechacompra').datepicker({
	                format: 'yyyy-mm-dd'
	            });
	            $('#fechacompra').datepicker("setDate", new Date());
	            $.post('../configuracion/tipocambio/Listar',{"fecha":$('#fecharegistro').val()},
                function (data) {
                    $.each(data.lista, function (index, item) {
                        $("#tipocambio").val(item.venta);
                    });
                }, 'json');
                $("#idcliente").val('').trigger('change');
                var oTableDetalles = $("#tblDetalles").dataTable();
				oTableDetalles.fnClearTable();
				var oTableDocumentos = $("#tblDocumentos").dataTable();
				oTableDocumentos.fnClearTable();
				$("#chkGenerarDocumento").iCheck('check');

                InicializarCantidades();
			});

			$("#btnGuardar").on("click", function(event) {
				if(validarGuardar()){
					if($("#chkGenerarDocumento").is(':checked')){
						CargarTipoDocumento();
						CargarSeries();
						$("#modaldocumentoventa").modal("show");
					}else{
						GuardarVenta();
					}
				}
			});

			$("#btnGenerarDocumento").on("click", function(event) {
				CargarTipoDocumento();
				CargarSeries();
				$("#modaldocumentoventa").modal("show");
			});

			$("#btnGuardarVentaDocumento").on("click", function(event) {
				if($("#id").val()==""){
					GuardarVenta();
				}else{
					GenerarDocumento();
				}
				
			});

			$("#btnBuscarPedido").on("click", function(event) {
				if($("#nropedido").val()!=""){
					BuscarPedidos();
				}else{
					bootbox.alert("Ingrese un código")
				}
			});

			$("#btnRefrescarEmpresas").on("click", function(event) {
				CargarComboEmpresa();
			});
			
			$("#fecha").change(function(){
				$.post('../configuracion/tipocambio/Listar',{"fecha":$('#fecha').val()},
                function (data) {
                    $.each(data.lista, function (index, item) {
                        $("#tipocambio").val(item.venta);
                    });
                }, 'json');
			});

			$("#btnListar").on("click", function(event) {
				Listar();
			});
			
			$('#btnAgregarProducto').click(function (e) {
				if(validarAgregarProducto()){
					if($("#idproductobusqueda").val()!=""){
						if($("#cantidadbusqueda").val()!="" && parseFloat($("#cantidadbusqueda").val())>0 ){
							if($("#preciobusqueda").val()!="" && parseFloat($("#preciobusqueda").val())>0 ){
								if($("#dsctobusqueda").val()!=""){
									var oTable = $("#tblDetalles").dataTable();
						            var Linea = oTable.fnGetData().length + 1 ;
						            var obj = {"Row": Linea 
						            		,"Id": ""
						            		,"IdProducto": $("#idproductobusqueda").val()
											,"Producto": $("#idproductobusqueda").select2('data')[0].text
											,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat($("#cantidadbusqueda").val()).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100px' >"
											,"IdUM": $("#idunidadmedida").val()
											,"UnidadMedida": $("#idunidadmedida option:selected").text()
											,"PrecioUnitarioSinIGV": "<input type='number' class='form-control2' value= '"+parseFloat($("#preciobusqueda").val()).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100px' >"
											,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat($("#preciobusqueda").val()).toFixed(2)+"' id='txtPrecioUnitIgv"+Linea+"' name='txtPrecioUnitIgv"+Linea+"' style='text-align: right; width: 100px' >"
											,"Descuento": "<input type='number' class='form-control2' value= '"+parseFloat($("#dsctobusqueda").val()).toFixed(2)+"' id='txtDescuento"+Linea+"' name='txtDescuento"+Linea+"' style='text-align: right; width: 100px' >"
											,"IndImpuesto": "<input type='checkbox' id='chkIgv"+Linea+"' name='chkIgv"+Linea+"' width: 100px' >"
											,"ValorVenta": "<input type='number' class='form-control2' value= '"+(parseFloat($("#cantidadbusqueda").val()) * parseFloat($("#preciobusqueda").val())-parseFloat($("#dsctobusqueda").val())).toFixed(4)+"' id='txtValorVenta"+Linea+"' name='txtValorVenta"+Linea+"' style='text-align: right; width: 150px' readonly='readonly'>"
											,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
															+"<a href='javascript:;' onclick='Quitar(0,"+Linea+")'>"
																+"<i class='ace-icon fa fa-times bigger-130'></i>"
															+"</a>&nbsp;"
														+"</div></center>"
											,"Estado": 1
											};
									oTable.fnAddData(obj);
									$("input[type='number']").click(function () {
									   $(this).select();
									});
									
									$("#txtCantidad"+Linea).keyup(function () {
								   		calcularValorLinea(Linea);
									});
									$("#txtPrecioUnit"+Linea).keyup(function () {
								   		calcularValorLinea(Linea);
									});
									$("#txtPrecioUnitIgv"+Linea).keyup(function () {
										calcularValorLinea(Linea);
									});
									$("#txtDescuento"+Linea).keyup(function () {
								   		calcularValorLinea(Linea);
									});
									$("#chkIgv"+Linea).change(function () {
										calcularPrecioSinIgv(Linea);
									});
									InicializarCantidades();
						        	calcularTotales();
								}else{
									bootbox.alert("Ingrese un descuento válido");
								}
							}else{
								bootbox.alert("Ingrese un Precio válido");
							}
						}else{
							bootbox.alert("Ingrese una cantidad válida");
						}
					}else{
						bootbox.alert("Seleccione un producto");
					}
				}
			});

		});
		
	
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
	        return estado;
	    }

		function validarGuardar(){
	        if($("#idcliente").val()==""){
	            alert("No ha indicado el Cliente");
	            return false;
			};
			if(!(parseFloat($("#tipocambio").val())>0)){
	            alert("No se ha especificado un Tipo de Cambio");
	            return false;
	        };
			if(!(parseFloat($("#idsubcuenta").val())>0)){
	            alert("No ha indicado la Cuenta de Cargo");
	            return false;
			};
			var c = 0;
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
			    if(data["Estado"]==1){
			    	c++;
			    }
			} );
			if(c==0){
	            alert("No hay detalles en la Orden de Venta");
	            return false;
			};
			if(!(parseFloat($("#total").val())>0)){
	            alert("No hay detalles en la Orden de Venta");
	            return false;
			};
	        return true;
	    }

		function InicializarCantidades(){
			$("#cantidadbusqueda").val(0);
			$("#preciobusqueda").val(0);
			$("#dsctobusqueda").val(0);
			$("#idproductobusqueda").val('').trigger('change');
		}
		
// ======================================================== GUARDAR VENTA =========================================================

		function ObtenerObjetoDocumento(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			//Detalles
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
				var indigv = 0;
				if( $("#chkIgv"+fila).is(':checked') )
				{
					indigv = 1;
				}else
				{
					indigv = 0;
				}
			    var obj = {
			    	"id": data["Id"]
			    	,"idtipomaterialservicio" : {{ config('constants.materialservicio.material') }}
			    	,"idmaterialservicio": data["IdProducto"]
			    	,"cantidad": $("#txtCantidad"+fila).val()
			    	,"preciounit": $("#txtPrecioUnit"+fila).val()
			    	,"preciounitigv": $("#txtPrecioUnitIgv"+fila).val()
			    	,"indigv": indigv
		        	,"activo": 1
			    }
		       	detalles[c] = obj;
		       	c++;
			});

			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"idtipodocumento": $("#cmbtipodocumentomodal").val()
				,"idclienteproveedor": $("#idcliente").val()
				,"idperiodo": 1
				,"idestado": $("#idestado").val()
				,"cuentacontable": ''
				,"idmoneda": $("#idmoneda").val()
				,"tipocambio": $("#tipocambio").val()
				,"idtipocompraventa": 0
				,"idmaterialservicio": {{ config('constants.materialservicio.material') }}
				,"serie": $("#serie").val()
				,"numero": $("#nrodocumento").val()
				,"fechaemision": $("#fecharegistro").val()
				,"fechavencimiento": $("#fecharegistro").val()
				,"glosa": $("#glosa").val()
				,"tasaimpuesto": {{ config('constants.generales.impuesto') }}
				,"nogravadas": 0
				,"subtotal": $("#subtotal").val()
				,"impuesto": $("#impuestovta").val()
				,"total": $("#total").val()
				,"saldo": $("#total").val()
				,"operador": 0
				,"indextorno": 0
				,"detalles": detalles
			};
			return obj;
		}

		function GuardarVenta(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			var objdocumento = null;
			
			if($("#chkGenerarDocumento").is(':checked')){
				objdocumento = ObtenerObjetoDocumento();
			}

			//Detalles
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
				var indigv = 0;
				if( $("#chkIgv"+fila).is(':checked') )
				{
					indigv = 1;
				}else
				{
					indigv = 0;
				}
			    var obj = {
			    	"id": data["Id"]
			    	,"idproducto": data["IdProducto"]
			    	,"nombreproducto": data["Producto"]
			    	,"descripcion": data["Producto"]
			    	,"idalmacen": ""
			    	,"cantidad": $("#txtCantidad"+fila).val()
			    	,"cantidadpendiente": $("#txtCantidad"+fila).val()
			    	,"precio_unit_sigv": $("#txtPrecioUnit"+fila).val()
		        	,"precio_unit_igv": $("#txtPrecioUnitIgv"+fila).val()
		        	,"valor_vta_sigv": $("#txtValorVenta"+fila).val()
		        	,"valor_vta_igv": $("#txtValorVenta"+fila).val()
					,"indigv": indigv
					,"idunidadmedida": data["IdUM"]
					,"unidadmedida": data["UnidadMedida"]
		        	,"dscto": $("#txtDescuento"+fila).val()
		        	,"activo": data["Estado"]
			    }
		       	detalles[c] = obj;
		       	c++;
			});

			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"idproveedor": $("#idcliente").val()
				,"fecharegistro": $("#fecharegistro").val()
				,"fechacompra": $("#fechacompra").val()
				,"fecharecepcion": $("#fecharecepcion").val()
				,"indmaterialservicio": $("#indmaterialservicio").val()
				,"idtipopago": $("#idtipopago").val()
				,"idmoneda": $("#idmoneda").val()
				,"idestado": $("#idestado").val()
				,"idcuenta": $("#idcuenta").val()
				,"idsubcuenta": $("#idsubcuenta").val()
				,"subtotal": $("#subtotal").val()
				,"impuestovta": $("#impuestovta").val()
				,"total": $("#total").val()
				,"tipocambio": $("#tipocambio").val()
				,"glosa": $("#glosa").val()
				,"detalles": detalles
				,"objdocumento": objdocumento
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../logistica/ordencompra/Guardar",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						if(data.success == true){
							$("#modaldocumentoventa").modal("hide");
							bootbox.alert(data.message);
							MostrarLista();
							Listar();
							$('#frmRegistro')[0].reset();
							resp = "ok";
						}
						if(data.success == "session"){
							bootbox.alert(data.message);
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

// ======================================================== FIN GUARDAR VENTA =========================================================

		function GenerarDocumento(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			var objdocumento = null;
			//if($("#chkGenerarDocumento").is(':checked')){
			objdocumento = ObtenerObjetoDocumento();
			//}
			
			//Detalles
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
				var indigv = 0;
				if( $("#chkIgv"+fila).is(':checked') )
				{
					indigv = 1;
				}else
				{
					indigv = 0;
				}
			    var obj = {
			    	"id": data["Id"]
			    	,"idproducto": data["IdProducto"]
			    	,"nombreproducto": data["Producto"]
			    	,"descripcion": data["Producto"]
			    	,"idalmacen": ""
			    	,"cantidad": $("#txtCantidad"+fila).val()
			    	,"cantidadpendiente": $("#txtCantidad"+fila).val()
			    	,"precio_unit_sigv": $("#txtPrecioUnit"+fila).val()
		        	,"precio_unit_igv": $("#txtPrecioUnitIgv"+fila).val()
		        	,"valor_vta_sigv": $("#txtValorVenta"+fila).val()
		        	,"valor_vta_igv": $("#txtValorVenta"+fila).val()
					,"indigv": indigv
					,"idunidadmedida": data["IdUM"]
					,"unidadmedida": data["UnidadMedida"]
		        	,"dscto": $("#txtDescuento"+fila).val()
		        	,"activo": data["Estado"]
			    }
		       	detalles[c] = obj;
		       	c++;
			});

			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"idproveedor": $("#idcliente").val()
				,"fecharegistro": $("#fecharegistro").val()
				,"fechacompra": $("#fechacompra").val()
				,"fecharecepcion": $("#fecharecepcion").val()
				,"indmaterialservicio": $("#indmaterialservicio").val()
				,"idtipopago": $("#idtipopago").val()
				,"idmoneda": $("#idmoneda").val()
				,"idestado": $("#idestado").val()
				,"idcuenta": $("#idcuenta").val()
				,"idsubcuenta": $("#idsubcuenta").val()
				,"subtotal": $("#subtotal").val()
				,"impuestovta": $("#impuestovta").val()
				,"total": $("#total").val()
				,"tipocambio": $("#tipocambio").val()
				,"glosa": $("#glosa").val()
				,"detalles": detalles
				,"objdocumento": objdocumento
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../logistica/ordencompra/GenerarDocumento",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						if(data.success == true){
							$("#modaldocumentoventa").modal("hide");
							bootbox.alert(data.message);
							MostrarLista();
							Listar();
							$('#frmRegistro')[0].reset();
							resp = "ok";
						}
						if(data.success == "session"){
							bootbox.alert(data.message);
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





		function Listar() {
			var form = $('#frmRegistro');
			var url = "../logistica/ordencompra/Listar";
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
									,"FechaReg": val["fecharegistro"]
									,"FechaCompra": val["fechacompra"]
									,"Proveedor": val["proveedor"]
									,"Moneda": val["moneda"]
									,"MS": val["indmaterialservicio"]
									,"Total": val["total"]
									,"Estado": val["estado"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' class='btn btn-primary btn-xs' onclick='EditarVenta(\"ordencompra/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Eliminar(\"ordencompra/Eliminar\","+val["id"]+")' class='red'>"
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
		
		function EditarVenta(url,id) {
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
					$("#idcuenta").empty();
					$("#idsubcuenta").empty();
				},
				success: function (data) {
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();
					var oTableDocumentos = $("#tblDocumentos").dataTable();
					oTableDocumentos.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#codigo").val(val["codigo"]);
							$("#idcliente").val(val["idproveedor"]).trigger('change');
							$('#fecharegistro').datepicker({
			                	format: 'yyyy-mm-dd'
				            }).attr('readonly', 'readonly');
				            $('#fecharegistro').datepicker("setDate", val["fecharegistro"]);
							$("#fecharecepcion").val(val["fecharecepcion"]);
							$("#fechacompra").val(val["fechacompra"]);
							$("#indmaterialservicio").val(val["indmaterialservicio"]);
					        //$("#idtipoorden").val(val["idtipoorden"]);
					        $("#idtipopago").val(val["idtipopago"]);
					        $("#idmoneda").val(val["idmoneda"]);
							$("#idestado").val(val["idestado"]);
							
							var $combo = $("#idcuenta");
							$combo.empty();
							$.post('../comercial/cuenta/ListarTitular',{"idtitular":val["idproveedor"]},
							function (data) {
								$combo.append("<option value=''>Seleccione</option>");
								$.each(data.lista, function (index, item) {
									$combo.append("<option value='" + item.id + "'>" + item.codigo + " / " + item.tipo + " / " + item.moneda + "</option>");
								});
								$("#idcuenta").val(val["idcuenta"]);
							}, 'json');
							
							var $combo2 = $("#idsubcuenta");
							$combo2.empty();
							$.post('../comercial/subcuenta/ListarCuenta',{"idcuenta":val["idcuenta"]},
							function (data) {
								$.each(data.lista, function (index, item) {
									$combo2.append("<option value='" + item.id + "'>" + item.descripcion + "</option>");
								});
								$("#idsubcuenta").val(val["idsubcuenta"]);
							}, 'json');


					        $("#tipocambio").val(val["tipocambio"]);
					        $("#subtotal").val(parseFloat(val["subtotal"]).toFixed(2));
					        $("#impuestovta").val(parseFloat(val["impuestovta"]).toFixed(2));
					        $("#total").val((parseFloat(val["total"]).toFixed(2)).toLocaleString('en'));
					        $("#totaldscto").val(parseFloat(val["totaldscto"]).toFixed(2));
					        $("#glosa").val(val["glosa"]);
					        var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetalles").dataTable();
					            var objdet = {"Row": Linea 
					            		,"Id": val2["id"]
					            		,"IdProducto": val2["idproducto"]
										,"Producto": val2["nombreproducto"]
										,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat(val2["cantidad"]).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100%' >"
										,"IdUM": val2["idunidadmedida"]
										,"UnidadMedida": val2["unidadmedida"]
										,"PrecioUnitarioSinIGV": "<input type='number' class='form-control2' value= '"+parseFloat(val2["precio_unit_sigv"]).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100%' >"
										,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat(val2["precio_unit_igv"]).toFixed(2)+"' id='txtPrecioUnitIgv"+Linea+"' name='txtPrecioUnitIgv"+Linea+"' style='text-align: right; width: 100px' >"
										,"Descuento": "<input type='number' class='form-control2' value= '"+parseFloat(val2["dscto"]).toFixed(2)+"' id='txtDescuento"+Linea+"' name='txtDescuento"+Linea+"' style='text-align: right; width: 100%' >"
										,"IndImpuesto": "<input type='checkbox' id='chkIgv"+Linea+"' name='chkIgv"+Linea+"' value= "+val2["indigv"]+" width: 100px' >"
										,"ValorVenta": "<input type='number' class='form-control2' value= '"+parseFloat(val2["valor_vta_igv"]).toFixed(4)+"' id='txtValorVenta"+Linea+"' name='txtValorVenta"+Linea+"' style='text-align: right; width: 100%' readonly='readonly'>"
										,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
														+"<a href='javascript:;' onclick='Quitar("+val2["id"]+","+Linea+")'>"
															+"<i class='ace-icon fa fa-times bigger-130'></i>"
														+"</a>&nbsp;"
													+"</div></center>"
										,"Estado": val["activo"]
										};
								oTableDetalles.fnAddData(objdet);
								Linea++;
					        });

					        $.each(data.documentos, function (key, val3) {
					        	var oTableDocumentos = $("#tblDocumentos").dataTable();
					            var objdet = {"Id": val3["id"]
					            		,"TipoDocumento": val3["tipodocumento"]
										,"Fecha": val3["fechaemision"]
										,"Serie": val3["serienumero"]
										,"Moneda": val3["moneda"]
										,"Subtotal": val3["subtotal"]
										,"Impuesto": val3["impuesto"]
										,"Total": val3["total"]
										,"Acciones":"<center>"
														+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Quitar("+val3["id"]+")'>"
															+"<i class='ace-icon fa fa-times bigger-130'></i>"
														+"</a>&nbsp;"
													+"</center>"
										};
								oTableDocumentos.fnAddData(objdet);
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
						$("#txtPrecioUnitIgv"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
						$("#txtDescuento"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
						$("#chkIgv"+Linea).change(function () {
							calcularPrecioSinIgv(Linea);
						});
					});
				} 
			});
			//=================== ********* ====================
		}

		function Quitar(iddetalle, linea){
			bootbox.confirm("¿Seguro que deseas eliminar el registro?", function(result) {
				if(result){
					if(iddetalle == 0){
						var oTableDetalles = $("#tblDetalles").dataTable();
		    			oTableDetalles.fnDeleteRow(linea-1);
		    			bootbox.alert("Detalle Eliminado");
					}else{
						var oTableDetalles = $("#tblDetalles").DataTable();
						var row = oTableDetalles.row( linea-1 );
			    		oTableDetalles.cell(row,10).data(0).draw();
					}
				}
				calcularTotales();
			});
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

        function CargarComboTipoPago() {
            var $combo = $("#idtipopago");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_PAGO"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboEstadoOrden() {
            var $combo = $("#idestado");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_COMPRA"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboTipoVenta() {
            var $combo = $("#idtipoorden");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_VENTA"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
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

        function CargarComboServicios() {
            var $combo = $("#idproductobusqueda");
            $combo.empty();
            $.post('../configuracion/servicio/Listar',
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboEmpresa() {
            var $combo = $("#idcliente");
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

		// CARGAR COMBOS
		function CargarTipoDocumento() {
            var $combo = $("#cmbtipodocumentomodal");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_DOCUMENTO"},
			function (data) {
				$.each(data.lista, function (index, item) {
					if(item.nombre=="BOLETA" || item.nombre=="FACTURA" || item.nombre=="DOCUMENTO INTERNO"){
						$combo.append("<option value='" + item.id + "'>" + item.nombre + "</option>");
					}
				});
			}, 'json');
        }

		function CargarSeries() {
            var $combo = $("#serie");
            $combo.empty();
            $.post('../configuracion/serie/Listar',{"idtipodocumento": $("#cmbtipodocumentomodal").val() ,"indcompraventa":"C"},
			function (data) {
				$.each(data.lista, function (index, item) {
					$combo.append("<option value='" + item.nroserie + "'>"
							+ item.nroserie + "</option>");
				});
				CargarUltimoCorrelativo();
			}, 'json');
        }

		function CargarUltimoCorrelativo() {
            $.post('../configuracion/serie/Listar',{"idtipodocumento": $("#cmbtipodocumentomodal").val() ,"indcompraventa":"C","serie":$("#serie").val()},
			function (data) {
				$.each(data.lista, function (index, item) {
					$("#nrodocumento").val(item.nrocorrelativo);
				});
			}, 'json');
        }


        function calcularValorLinea(item){
        	var cant = parseFloat($("#txtCantidad"+item).val());
        	var precio = parseFloat($("#txtPrecioUnitIgv"+item).val());
			//var precio = parseFloat($("#txtPrecioUnitIgv"+item).val());
        	var dscto = parseFloat($("#txtDescuento"+item).val());
        	$("#txtValorVenta"+item).val(((cant*precio)-dscto).toFixed(4));
			calcularPrecioSinIgv(item)
        	calcularTotales();
        }

		function calcularPrecioSinIgv(item){
			if( $("#chkIgv"+item).is(':checked') )
			{
				$("#txtPrecioUnit"+item).val(parseFloat($("#txtPrecioUnitIgv"+item).val() / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(2));
			}else
			{
				$("#txtPrecioUnit"+item).val(parseFloat($("#txtPrecioUnitIgv"+item).val()).toFixed(2));
			}
        	calcularTotales();
        }

        function calcularTotales(){
        	var oTable2 = $("#tblDetalles").DataTable();
        	var subtotal = parseFloat(0);
        	var totaligv = parseFloat(0);
        	var totaldscto = parseFloat(0);
        	var totalneto = parseFloat(0);
			var impuesto = parseFloat(0);
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
					impuesto = (parseFloat(totalneto) - parseFloat(subtotal)).toFixed(2);
				}
			});

			$("#subtotal").val(subtotal);
			$("#totaldscto").val(totaldscto);
			$("#impuestovta").val(impuesto);
			$("#total").val(totalneto);
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