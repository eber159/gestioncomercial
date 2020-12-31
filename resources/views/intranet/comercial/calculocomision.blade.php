@section('title-page')
	ErpWeb | Gestión Comisiones
@stop

@extends('plantilla_int')

@section('titulo-form')
	Cálculo de Comisiones <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Comisiones</a></li>
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
					  		<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Listar Ventas</button>
					  	</div>
					  	<div>
					  		<div class="col-md-12">
								<div class="col-md-2">
									<label for="">Desde</label>
									<input type="text" class="form-control" id="fechaini" name="fechaini" placeholder="" style="width: 100%">
								</div>
								<div class="col-md-2">
									<label for="">Hasta</label>
									<input type="text" class="form-control" id="fechafin" name="fechafin" placeholder="" style="width: 100%">
								</div>
								<div class="col-md-4">
									<label for="">Vendedor</label>
									<select class="form-control" style="width: 100%;" id='idvendedor' name="idvendedor" ></select>
								</div>
							</div>
				  		</div>
					</div>
					<div class="box-body">
						<div id="Lista">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table id="tblDatos" class="table table-bordered table-hover" >
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th style="display:none">IdOrdenVenta</th>
												<th>Venta</th>
												<th>Fecha</th>
												<th>Colocación</th>
												<th>Despacho</th>
												<th>Exceso</th>
												<th>POS</th>
												<th>Transferencia</th>
												<th>Flete</th>
												<th>TOTAL</th>
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
						<div style="float: right;">
							<button type="button" id="btnCalcularComisiones" name="btnGuardar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Calcular Comisiones</button>
					  		<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
							<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
					  	</div>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-12">
										<label for="">Venta</label>
										<input type="hidden" class="form-control" id="idordenventa" name="idordenventa" placeholder="ID" style="width: 30%">
										<div class="input-group input-group-sm">
							                <input type="text" class="form-control" style="width: 100%;" id='codigoventa' name="codigoventa" />
						                    <span class="input-group-btn">
						                      <button type="button" id="btnBuscarPedido" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
						                    </span>
							             </div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="col-md-8">
										<div class="form-group">
											<label for="">Vendedor</label>
											<select class="form-control" id="idvendedorventa" name="idvendedorventa" disabled="true">
												<option value=""></option>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total Colocación</label>
											<input type="number" class="form-control" id="totalcolocacion" name="totalcolocacion" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total Despacho</label>
											<input type="number" class="form-control" id="totaldespacho" name="totaldespacho" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total Exceso</label>
											<input type="number" class="form-control" id="totalexceso" name="totalexceso" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total POS</label>
											<input type="number" class="form-control" id="totalpos" name="totalpos" placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total Transferencia</label>
											<input type="number" class="form-control" id="totaltransferencia" name="totaltransferencia" placeholder="" style="width: 100%; text-align: right;" value="0.00">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total Flete</label>
											<input type="number" class="form-control" id="totalflete" name="totalflete" placeholder="" style="width: 100%; text-align: right;" value="0.00">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label for="">Total Comisión</label>
											<input type="number" class="form-control" id="totalcomision" name="totalcomision" placeholder="" style="width: 100%; text-align: right;" value="0.00" readonly="readonly">
										</div>
									</div>


								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
							            <ul class="nav nav-tabs">
							              <li class="active"><a href="#tab_1" data-toggle="tab">Detalles</a> </li>
							            </ul>
							            <div class="tab-content">
								            <div class="tab-pane active" id="tab_1">
								            	<br>
								            	<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-12">
															<div class="table-responsive">
								            				<table id="tblDetalles" class="table table-bordered table-hover" style="width: 100%">
			                                                    <thead>
			                                                    	<tr style="background-color: #887c7c; color: white">
														                <th colspan="2">Name</th>
														                <th colspan="4">Datos de la venta</th>
														                <th colspan="5">Datos de Comisión</th>
														            </tr>
			                                                    	<tr style="background-color: #f1e4e4">
			                                                    		<th style=''></th>
					                                                    <th style=''></th>
					                                                    <th>Producto</th>
					                                                    <th>Cant.</th>
					                                                    <th>Precio Vta.</th>
					                                                    <th>Precion Min.</th>
					                                                    <th>Colocaciónn</th>
																		<th>Despacho</th>
																		<th>Exceso</th>
					                                                    <th>(-)POS</th>
					                                                    <th>Total</th>
					                                                    <th></th>
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
                    <h4 class="modal-title">Generar Documento</h4>
                </div>
                <div class="modal-body">
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
                                <label for="">Dirección</label>
                                <select class="form-control" style="width: 100%;" id='direccionfactura' name="direccionfactura" >
                                	<option value="">Seleccione</option>
                                </select>
                            </div>
						</div>
                    </div>
                    <div class='row'>
                    	<br/>
                    	<div class="col-md-12">
                    		<div class="col-md-4">
                    			<input type="checkbox" style="width: 100%;" id='chkGenerarPago' name="chkGenerarPago" /> Generar Cobro Automático
                    		</div>
                    	</div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label for="">Caja / Banco</label>
                                <select class="form-control" style="width: 100%;"
                                        id='idcajabanco' name="idcajabanco">
                                </select>                        
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                    	<br/>
                    	<div class="col-md-12">
                    		<div class="col-md-4">
                    			<input type="checkbox" style="width: 100%;" id='chkGenerarSalida' name="chkGenerarSalida" /> Generar Despacho
                    		</div>
                    	</div>
                    	<div class="col-md-12">
							<div class="col-md-12">
                                <label for="">Almacén</label>
                                <select class="form-control" style="width: 100%;" id='idalmacen' name="idalmacen" >
                                	<option value="">Seleccione</option>
                                </select>
                            </div>
						</div>
                    </div>
                </div>
                <div class="modal-footer">
                	<button type="button" id="btnGuardarVentaDocumento" name="btnGuardarVentaDocumento" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Guardar</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>


    <div class="modal modal-default fade" id="modalsalidas">
        <div class="modal-dialog" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">GENERAR ORDEN SALIDA</h4>
                </div>
                <div class="modal-body">
                	<div class="row">
                		<div class="col-md-12">
							<div class="col-md-12">
                                <label for="">Almacén</label>
                                <select class="form-control" style="width: 100%;" id='idalmacensalida' name="idalmacensalida" >
                                	<option value="">Seleccione</option>
                                </select>
                            </div>
						</div>
                	</div>

                    <div class='row'>
                    	<div class="col-md-12">
                    		<div class="table-responsive">
	            				<table id="tblDetallesOS" class="table table-bordered table-hover" style="width: 100%">
                                    <thead>
                                    <th style=''></th>
                                    <th style='display:none'></th>
                                    <th style='display:none'></th>
                                    <th>Producto</th>
                                    <th>IdUM</th>
									<th>U.M.</th>
                                    <th>Cantidad</th>
                                    <th>Costo</th>
                                    <th>Acciones</th>
                                    <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
							</div>
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
                	<button type="button" id="btnGuardarSalida" name="btnGuardarSalida" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Guardar Salida</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

	<div class="modal modal-default fade" id="modal-precios">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Precios Configurados</h4>
				</div>

				<div class="modal-body">
					<div class="">
						<div id="divPrincipal">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal-default fade" id="modalimagen">
        <div class="modal-dialog">
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

    <div class="modal modal-default fade" id="modalstock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">STOCK RESTANTE</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                    	<div class="col-md-12">
                    		<div class="table-responsive" id="divTabla">
								<table id="tblStock" class="table table-bordered table-hover" style="width: 100%">
									<thead>
										<tr>
											<th style="display:none">Id</th>
											<th>Almacén</th>
											<th>Stock</th>
											<th>Costo</th>
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

			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			
			//$("#chkGenerarDocumento").iCheck();
			var fechainicial = RestarDias(new Date(), 7);
			
			$('#fechaini').datepicker({
                format: 'yyyy-mm-dd'
            });
			$('#fechaini').datepicker("setDate",fechainicial);
			$('#fechafin').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechafin').datepicker("setDate", new Date());


			$('.select2').select2()
			CargarTrabajadores();
			CargarTrabajadores2();
			InicializarTabla();
			InicializarTablaDetalles();
			Listar();
	
			function InicializarTabla() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var Table = $('#tblDatos').dataTable({
					"info": false,
					"order": false,
					"search": false,
					"processing": true,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						},{
							"bVisible": false, "mDataProp": "IdOrdenVenta"
						}, {
							"sWidth": "10%", "mDataProp": "Venta"
						}, {
							"sWidth": "10%", "mDataProp": "Fecha"
						}, {
							"sWidth": "10%", "mDataProp": "Colocacion"
						}, {
							"sWidth": "10%", "mDataProp": "Despacho"
						},{
							"sWidth": "10%", "mDataProp": "Exceso"
						},{
							"sWidth": "10%", "mDataProp": "POS"
						},{
							"sWidth": "10%", "mDataProp": "Transferencia"
						},{
							"sWidth": "10%", "mDataProp": "Flete"
						},{
							"sWidth": "10%", "mDataProp": "Total"
						},{
							"sWidth": "20%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "targets": [4,5,6,7,8,9,10],
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
							"bVisible": false, "mDataProp": "IdProducto"
						},{
							"sWidth": "30%", "mDataProp": "Producto"
						},{
							"sWidth": "10%", "mDataProp": "Cantidad"
						},{
							"sWidth": "10%", "mDataProp": "PrecioVenta"
						},{
							"sWidth": "10%", "mDataProp": "PrecioMin"
						},{
							"sWidth": "10%", "mDataProp": "Colocacion"
						},{
							"sWidth": "10%", "mDataProp": "Despacho"
						},{
							"sWidth": "10%", "mDataProp": "Exceso"
						},{
							"sWidth": "10%", "mDataProp": "POS"
						},{
							"sWidth": "10%", "mDataProp": "Total"
						},{
							"bVisible": false, "sWidth": "10%", "mDataProp": "Estado"
						}],
					'columnDefs':[
						{
						      "targets": [3,4,5,6,7,8,9,10],
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


			function InicializarTablaStock() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var Table = $('#tblStock').dataTable({
					"info": false,
					"bFilter": false,
					"bInfo": false,
					"bOrder": false,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						},{
							"sWidth": "30%", "mDataProp": "Almacen"
						},{
							"sWidth": "10%", "mDataProp": "Stock"
						},{
							"sWidth": "10%", "mDataProp": "Costo"
						}]
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

			$('#nrodocumento').focusout(function() {			
				$('#nrodocumento').val(formatoDocumento($('#nrodocumento').val(),12));
			})

			$("input[type='number']").click(function () {
			   $(this).select();
			});
			
			$("#btnCalcularComisiones").on("click", function(event) {
				//$('#frmRegistro')[0].reset();
                var oTableDetalles = $("#tblDetalles").dataTable();
				oTableDetalles.fnClearTable();
				CalcularComisiones();
                //InicializarCantidades();
			});

			$("#btnGuardar").on("click", function(event) {
				if(validarGuardar()){
					GuardarVenta();
				}
			});

			$("#btnGenerarDocumento").on("click", function(event) {
				CargarTipoDocumento();
				CargarSeries();
				$("#modaldocumentoventa").modal("show");
			});

			$("#btnGenerarDespacho").on("click", function(event) {
				if($("#id").val()!=""){
					CargarComboAlmacenSalidas();
					CargarSalidas($("#id").val());
					$("#modalsalidas").modal("show");
				}else{
					bootbox.alert("Primero debe Registrar la Orden de Venta");
				}
				
			});


			$("#btnGuardarVentaDocumento").on("click", function(event) {
				if($("#id").val()==""){
					GuardarVenta();
				}else{
					GenerarDocumento();
				}
				
			});

			$("#btnGuardarSalida").on("click", function(event) {
				if($("#id").val()==""){
					bootbox.alert("Primero debe Guardar la Orden de Venta");
				}else{
					GenerarOrdenSalida();
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

			$("#btnConsultarPrecios").on("click", function(event) {
				if($("#idproductobusqueda").val()!=""){
					console.log($("#idproductobusqueda").val());
					consultarPrecios($("#idproductobusqueda").val());
				}else{
					alert("Seleccione un producto");
				}
				
			});
			
			$("#btnVerImagen").on("click", function(event) {
				if($("#idproductobusqueda").val()!=""){
					VerImagen($("#idproductobusqueda").val());
				}else{
					alert("Seleccione un producto");
				}
				
			});

			$("#btnVerStock").on("click", function(event) {
				if($("#idproductobusqueda").val()!=""){
					ListarStock($("#idproductobusqueda").val());
				}else{
					alert("Seleccione un producto");
				}
				
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



			$("#totaltransferencia").keyup(function () {
				calcularTotales();
			});

			$("#totalflete").keyup(function () {
				calcularTotales();
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
	        if($("#idordenventa").val()==""){
	            alert("No ha seleccionado una Venta");
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
			if(!(parseFloat($("#totalcomision").val())>0)){
	            alert("El Total es 0");
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

		function GuardarVenta(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			var objdocumento = null;
			var objmovimientocaja = null;
			var objordensalida = null;

			//Detalles
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];

			    var obj = {
			    	"id": data["Id"]
			    	,"idproducto": data["IdProducto"]
			    	,"colocacion": data["Colocacion"]
			    	,"despacho": data["Despacho"]
			    	,"exceso": data["Exceso"]
			    	,"pos": data["POS"]
			    	,"transferencia": 0
		        	,"activo": data["Estado"]
			    }
		       	detalles[c] = obj;
		       	c++;
			});

			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"idordenventa": $("#idordenventa").val()
				,"codigoventa": $("#codigoventa").val()
				,"totalcolocacion": $("#totalcolocacion").val()
				,"totaldespacho": $("#totaldespacho").val()
				,"totalexceso": $("#totalexceso").val()
				,"totalpos": $("#totalpos").val()
				,"totaltransferencia": $("#totaltransferencia").val()
				,"totalflete": $("#totalflete").val()
				,"detalles": detalles
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../comercial/comision/Guardar",
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
						}else{
							bootbox.alert(data.message);
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
				,"idcliente": $("#idcliente").val()
				,"fecha": $("#fecha").val()
				,"fechaentrega": $("#fechaentrega").val()
				,"fechapago": $("#fechapago").val()
				,"indmaterialservicio": $("#indmaterialservicio").val()
				,"idtipoorden": $("#idtipoorden").val()
				,"idmodulosistema": ''
				,"idtipopago": $("#idtipopago").val()
				,"idmoneda": $("#idmoneda").val()
				,"idestado": $("#idestado").val()
				,"idcuenta": $("#idcuenta").val()
				,"idsubcuenta": $("#idsubcuenta").val()
				,"idmovimiento": $("#idmovimiento").val()
				,"tipocambio": $("#tipocambio").val()
				,"subtotal": parseFloat($("#subtotal").val()).toFixed(2)
				,"impuestovta": parseFloat($("#impuestovta").val()).toFixed(2)
				,"total": parseFloat($("#total").val()).toFixed(2)
				,"totaldscto": parseFloat($("#totaldscto").val()).toFixed(2)
				,"glosa": $("#glosa").val()
				,"idvendedor": $("#idvendedor").val()
				,"nropedido": $("#nropedido").val()
				,"detalles": detalles
				,"objdocumento": objdocumento
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../comercial/ordenventa/GenerarDocumento",
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
						}else{
							bootbox.alert(data.message);
						}
						/*
						if(data.success == "session"){
							bootbox.alert(data.message);
						}
						*/
					}
					else
					{
						alert("Ocurrio un error en el registro");
						resp = "error";
					}
				},
				error: function (data){
					bootbox.alert(data.message);
				}
			});
			return resp;
		}


		function Listar() {
			var form = $('#frmRegistro');
			var url = "../comercial/comision/ListarVentas";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"fechaini":$("#fechaini").val(),"fechafin":$("#fechafin").val(), "idvendedor": $("#idvendedor").val()},
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
									,"IdOrdenVenta": val["idordenventa"]
									,"Fecha": val["fecha"]
									,"Venta": val["codigoventa"]
									,"Colocacion": val["totalcolocacion"]
									,"Despacho": val["totaldespacho"]
									,"Exceso": val["totalexceso"]
									,"POS": val["totalpos"]
									,"Transferencia": val["totaltransferencia"]
									,"Flete": val["totalflete"]
									,"Total": val["totalcomision"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' class='btn btn-default btn-xs' onclick='EditarVenta("+val["idordenventa"]+","+val["id"]+",\""+val['codigoventa']+"\","+val["idvendedor"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i> Editar"
													+"</a>&nbsp;"
												+"</div></center>"};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}

		function EditarVenta(idordenventa,idcomision,codigoventa,idvendedor){
			$("#idordenventa").val(idordenventa);
			$("#codigoventa").val(codigoventa);
			$("#idvendedorventa").val(idvendedor);

			var oTableDetalles = $("#tblDetalles").dataTable();
			oTableDetalles.fnClearTable();

			$("#totalcolocacion").val(0);	
			$("#totaldespacho").val(0);
			$("#totalexceso").val(0);
			$("#totalpos").val(0);
			$("#totaltransferencia").val(0);
			$("#totalflete").val(0);
			$("#totalcomision").val(0);

			MostrarRegistro();
			if(idcomision==null){
				//Editar(idcomision);
			}else{
				//No carga nada.
			}
		}


		function Editar(idcomision) {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "{{ URL::to('comercial/comision/Leer') }}",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();
					
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#idordenventa").val(val["idordenventa"]);
							$("#codigoventa").val(val["codigoventa"]);
							$("#totalcolocacion").val(val["totalcolocacion"]);
							$("#totaldespacho").val(val["totaldespacho"]);
							$("#totalexceso").val(val["totalexceso"]);
							$("#totalpos").val(val["totalpos"]);
							$("#totaltransferencia").val(val["totaltransferencia"]);
							$("#totalflete").val(val["totalflete"]);
					        $("#idvendedor").val(val["idvendedor"]);

					        var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetalles").dataTable();

								var objdet = {"Id": val2["id"]
					            		,"IdProducto": val2["idproducto"]
										,"Producto": val2["nombreproducto"]
										,"Cantidad": parseFloat(val["cantidadproducto"]).toFixed(2)
										,"PrecioVenta": parseFloat(val["precio_vta"]).toFixed(2)
										,"PrecioMin": parseFloat(val["precio_min"]).toFixed(2)
										,"Colocacion": parseFloat(val["colocacion"]).toFixed(2)
										,"Despacho": parseFloat(val["despacho"]).toFixed(2)
										,"Exceso": parseFloat(val["comision_exceso"]).toFixed(2)
										,"POS": parseFloat(val["dscto_pos"]).toFixed(2)
										,"Total": parseFloat(val["totalcomision"]).toFixed(2)
										,"Estado": 1
									};
								oTableDetalles.fnAddData(objdet);
								Linea++;
					        });

							//MostrarRegistro();
						});
					}
				},
				complete: function(){

				} 
			});
			//=================== ********* ====================
		}

		
		function CalcularComisiones() {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idordenventa":$("#idordenventa").val()},
				url: "{{ URL::to('comercial/comision/CalcularComision') }}",
				dataType: "json",
				beforeSend: function (data) {
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();

					$("#totalcolocacion").val(0);	
					$("#totaldespacho").val(0);
					$("#totalexceso").val(0);
					$("#totalpos").val(0);
					$("#totaltransferencia").val(0);
					$("#totalflete").val(0);
					$("#totalcomision").val(0);
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						var Linea = 1;
						$.each(data.obj, function (key, val) {
							var oTableDetalles = $("#tblDetalles").dataTable();
					            var objdet = {"Id": ""
					            		,"IdProducto": val["idproducto"]
										,"Producto": val["nombreproducto"]
										,"Cantidad": parseFloat(val["cantidadproducto"]).toFixed(2)
										,"PrecioVenta": parseFloat(val["precio_vta"]).toFixed(2)
										,"PrecioMin": parseFloat(val["precio_min"]).toFixed(2)
										,"Colocacion": parseFloat(val["colocacion"]).toFixed(2)
										,"Despacho": parseFloat(val["despacho"]).toFixed(2)
										,"Exceso": parseFloat(val["comision_exceso"]).toFixed(2)
										,"POS": parseFloat(val["dscto_pos"]).toFixed(2)
										,"Total": parseFloat(val["totalcomision"]).toFixed(2)
										,"Estado": 1
									};
							oTableDetalles.fnAddData(objdet);
							Linea++;
						});
						
					}
				},
				complete: function(){
					calcularTotales();
				} 
			});
			//=================== ********* ====================
		}

		function EliminarVenta(url,id) {
			bootbox.confirm("¿Seguro que deseas eliminar la venta?", function(result) {
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
								if(data.success == true){
									bootbox.alert(data.message);
									Listar();
								}else{
									bootbox.alert(data.message);
									//Listar();
								}
								
							}
						}
					});
				}
			});
			//=================== ********* ====================
		}


		function AnularVenta(url,id) {
			bootbox.confirm("Al realizar esta acción, reviertes todas las operaciones generadas. ¿Seguro que deseas anular la venta?", function(result) {
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
								if(data.success == true){
									bootbox.alert(data.message);
									Listar();
								}else{
									bootbox.alert(data.message);
									//Listar();
								}
								
							}
						}
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

      	
      	function CargarTrabajadores2() {
            var $combo = $("#idvendedorventa");
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
				$("#txtPrecioUnit"+item).val(parseFloat($("#txtPrecioUnitIgv"+item).val() / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(4));
			}else
			{
				$("#txtPrecioUnit"+item).val(parseFloat($("#txtPrecioUnitIgv"+item).val()).toFixed(4));
			}
        	calcularTotales();
        }

        function calcularTotales(){
        	var oTable2 = $("#tblDetalles").DataTable();
        	var totalcolocacion = parseFloat(0);
        	var totaldespacho = parseFloat(0);
        	var totalexceso = parseFloat(0);
        	var totalpos = parseFloat(0);
        	var totalcomision = parseFloat(0);
        	var totaltransferencia = parseFloat($("#totaltransferencia").val()).toFixed(2);
        	var totalflete = parseFloat($("#totalflete").val()).toFixed(2);
        	//var totalp
			//var impuesto = parseFloat(0);

			oTable2.rows().eq(0).each( function ( index ) {

			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
			    if(data["Estado"]==1){
			    	console.log(data["Colocacion"]);
			    	console.log(data["Despacho"]);

					var colocacion = data["Colocacion"];
					var despacho = data["Despacho"];
					var exceso = data["Exceso"];
					var pos = data["POS"];

				    totalcolocacion = (parseFloat(totalcolocacion) + parseFloat(colocacion)).toFixed(4);
				    totaldespacho = (parseFloat(totaldespacho) + parseFloat(despacho)).toFixed(4);
				    totalexceso = (parseFloat(totalexceso) + parseFloat(exceso)).toFixed(4);
					totalpos = (parseFloat(totalpos) + parseFloat(pos)).toFixed(4);
				}
			});

			$("#totalcolocacion").val(totalcolocacion);
			$("#totaldespacho").val(totaldespacho);
			$("#totalexceso").val(totalexceso);
			$("#totalpos").val(totalpos);

			totalcomision = parseFloat(totalcolocacion) + parseFloat(totaldespacho) + parseFloat(totalexceso) - parseFloat(totalpos) - parseFloat(totaltransferencia) - parseFloat(totalflete);

			$("#totalcomision").val(parseFloat(totalcomision).toFixed(2));

        }

		function formatoDocumento(texto,cantidad)
		{
			var ln = ""
			for (var i = 1 ;i<=cantidad-texto.length;i++){
				ln = ln + "0"
			}
			return ln + texto
		}

        //PEDIDOS
        function BuscarPedidos() {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			//$('#frmRegistro')[0].reset();
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"codigo":$("#nropedido").val()},
				url: "../comercial/ordenpedido/ListarCodigo",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();
					$("#glosa").val("");
					if (data !== null && typeof data === 'object') {
						if(data.obj.length > 0){
							$.each(data.obj, function (key, val) {
								if(val["idestado"]!={{ config('constants.estadopedido.atendido') }}){
									if(val["idestado"]=={{ config('constants.estadopedido.aprobado') }}
										|| val["idestado"]=={{ config('constants.estadopedido.atendidoparcial') }}){
										$("#nropedido").val(val["codigo"]);
										$("#glosa").val("CLIENTE: "+val["cliente"]);
										$('#fecha').datepicker("setDate", val["fecha"]);
										$("#idvendedor").val(val["idvendedor"]);
										$("#idcliente").val(val["idcliente"]).trigger('change');;
										$("#idtipopago").val(val["idtipopago"]);
										$("#total").val((parseFloat(val["total"]).toFixed(2)).toLocaleString('en'));

										var $combo = $("#idcuenta");
										$combo.empty();
										$.post('../comercial/cuenta/ListarTitular',{"idtitular":val["idcliente"]},
										function (data) {
											$combo.append("<option value=''>Seleccione</option>");
											$.each(data.lista, function (index, item) {
												$combo.append("<option value='" + item.id + "'>" + item.codigo + " - " + item.moneda + "</option>");
											});
											//$("#idcuenta").val(val["idcuenta"]);
										}, 'json');
										
										var $combo2 = $("#idsubcuenta");
										$combo2.empty();
										$.post('../comercial/subcuenta/ListarCuenta',{"idcuenta":val["idcuenta"]},
										function (data) {
											$.each(data.lista, function (index, item) {
												$combo2.append("<option value='" + item.id + "'>" + item.descripcion + "</option>");
											});
											//$("#idsubcuenta").val(val["idsubcuenta"]);
										}, 'json');

										var Linea = 1;
										$.each(data.detalles, function (key, val2) {
											if(val2["pendiente"]>0){
												var oTableDetalles = $("#tblDetalles").dataTable();
												var objdet = {"Row": Linea 
														,"Id": ""
														,"IdProducto": val2["idproducto"]
														,"Producto": val2["nombreproducto"]
														,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat(val2["pendiente"]).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100px' >"
														,"IdUM": val2["idunidadmedida"]
														,"UnidadMedida": val2["unidadmedida"]
														,"PrecioUnitarioSinIGV": "<input type='number' class='form-control2' value= '"+parseFloat(val2["precio"]).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100px' >"
														,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat(val2["precio"]).toFixed(2)+"' id='txtPrecioUnitIgv"+Linea+"' name='txtPrecioUnitIgv"+Linea+"' style='text-align: right; width: 100px' >"
														,"Descuento": "<input type='number' class='form-control2' value= '"+parseFloat(0).toFixed(2)+"' id='txtDescuento"+Linea+"' name='txtDescuento"+Linea+"' style='text-align: right; width: 100px' >"
														,"IndImpuesto": "<input type='checkbox' id='chkIgv"+Linea+"' name='chkIgv"+Linea+"' value= "+val2["indigv"]+" width: 100px' >"
														,"ValorVenta": "<input type='number' class='form-control2' value= '"+parseFloat(val2["valor_vta"]).toFixed(4)+"' id='txtValorVenta"+Linea+"' name='txtValorVenta"+Linea+"' style='text-align: right; width: 150px' readonly='readonly'>"
														,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
																		+"<a href='javascript:;' onclick='Quitar(0,"+Linea+")'>"
																			+"<i class='ace-icon fa fa-times bigger-130'></i>"
																		+"</a>&nbsp;"
																	+"</div></center>"
														,"Estado": 1
														};
												oTableDetalles.fnAddData(objdet);
												Linea++;
											}
										});
									}
									else{
										bootbox.alert("El Pedido debe estar APROBADO");
									}
								}else{
									bootbox.alert("El Pedido seleccionado ya ha sido ATENDIDO");
								}
								
							});
						}else{
							bootbox.alert("Pedido no econtrado!");
						}
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

					var oTableDetalles = $("#tblDetalles").DataTable();
					oTableDetalles.rows().eq(0).each( function ( index ) {
					    var row = oTableDetalles.row( index );
					    var data = row.data();
					    var Linea = data["Row"];
						$("#chkIgv"+Linea).prop( "checked", true );
						calcularPrecioSinIgv(Linea);
					});

					calcularTotales();
				} 
			});
			//=================== ********* ====================
		}

		function CargarSalidas(id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			$('#frmRegistro')[0].reset();
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "../comercial/ordenventa/Leer",
				dataType: "json",
				beforeSend: function (data) {

				},
				success: function (data) {
					var oTableDetalles = $("#tblDetallesOS").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							
					        var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetallesOS").dataTable();
								var objdet =
					            {
					              'Row': Linea,
					              'Id': val2['id'],
					              'IdMaterial': val2['idproducto'],
					              'Material': val2['nombreproducto'],
					              'IdAlmacen': "",
					              'Almacen': "",
					              "IdUM": val2["idunidadmedida"],
					              "UnidadMedida": val2["unidadmedida"],
					              'Cantidad': "<input type='number' class='form-control2' value= '" + parseFloat(val2['cantidad']).toFixed(2) + "' id='txtCantidadSalida" + Linea + "' name='txtCantidadSalida" + Linea + "' style='text-align: right; width: 100px' >",
					              'Costo': "<input type='number' class='form-control2' value= '" + parseFloat(val2['precio_unit_igv']).toFixed(2) + "' id='txtCostoSalida" + Linea + "' name='txtCostoSalida" + Linea + "' style='text-align: right; width: 100px' >",
					              'Acciones': "<center>"
					                + "<a href='javascript:;' class='btn btn-danger btn-xs' onclick='QuitarDetalleOS(" + val2['id'] + ',' + Linea + ")'>"
					                + "<i class='ace-icon fa fa-times bigger-130'></i>"
					                + '</a>&nbsp;'
					                + '</center>',
					              'Estado': 1
					            }	
								oTableDetalles.fnAddData(objdet);
								Linea++;
					        });

						});
					}
				},
				complete: function(){
					$("input[type='number']").click(function () {
					   $(this).select();
					});
				} 
			});
			//=================== ********* ====================
		}

		function consultarPrecios(idproducto) {
			var info = "";
			$.ajax({
			type: "POST",
			async: false,
			data: {"idproducto":idproducto},
			url: "../configuracion/precioproducto/Listar",
			dataType: "json",
			beforeSend: function (data) {
				$("#divError").hide();
			},
			success: function (data) {
				//var oTablePrecios = $("#tblPrecios").dataTable();
				//oTablePrecios.fnClearTable();
				if (data !== null && typeof data === 'object') {
					if (data.lista.length >  0) {
						$("#modal-precios").modal("show");
						$.each(data.lista, function (key, val) {

							var divPrecios = "";
							divPrecios += "<div>";
							divPrecios += "<div class='row'><div class='col-md-12' style='background-color: white; text-color:white'><button class='btn btn-success' onclick='seleccionarPrecio("+parseFloat(val["preciomenor"])+")' style='width:100%' >Precio Unitario <span class='btn btn-primary btn-xs'>"+ parseFloat(val["preciomenor"])+"</span></button></div></div>";
							divPrecios += "<div class='row'><div class='col-md-12' style='background-color: white; text-color:white'><button class='btn btn-success' onclick='seleccionarPrecio("+parseFloat(val["preciomayor"])+")' style='width:100%'>Precio x Mayor <span class='btn btn-primary btn-xs'>"+parseFloat(val["preciomayor"])+"</span></button></div></div>";
							divPrecios += "<div class='row'><div class='col-md-12'><button class='btn btn-success' onclick='seleccionarPrecio("+parseFloat(val["preciodistrib"])+")' style='width:100%'>Precio Distribuidor <span class='btn btn-primary btn-xs'>"+parseFloat(val["preciodistrib"])+"</span></button></div></div>";
							divPrecios += "<div class='row'><div class='col-md-12'><button class='btn btn-success' onclick='seleccionarPrecio("+parseFloat(val["preciocaja"])+")' style='width:100%'>Precio x Caja <span class='btn btn-primary btn-xs'>"+parseFloat(val["preciocaja"])+"</span></button></div></div>";
							divPrecios += "<div class='row'><div class='col-md-12'><button class='btn btn-success' onclick='seleccionarPrecio("+parseFloat(val["preciofactura"])+")' style='width:100%'>Precio Factura <span class='btn btn-primary btn-xs'>"+parseFloat(val["preciofactura"])+"</span></button></div></div>";
							divPrecios += "<div class='row'><div class='col-md-12'><button class='btn btn-success' onclick='seleccionarPrecio("+parseFloat(val["preciooferta"])+")' style='width:100%'>Precio Oferta <span class='btn btn-primary btn-xs'>"+parseFloat(val["preciooferta"])+"</span></button></div></div>";
							divPrecios += "</div>";

							$("#divPrincipal").html(divPrecios);
							console.log(divPrecios);
							/*
							var oTablePrecios = $("#tblPrecios").dataTable();
							var objdet = {"Id": val2["id"]
								,"Empresa":  val2["empresa"]
								,"Sede":  val2["sede"]
								,"Trabajador": val2["nombretrabajador"]
								,"Nombre": val2["nombreperfil"]
								,"Acciones":"<a class='btn btn-success btn-sm' href='#' onclick='Acceder("+val["id"]+","+val2["idperfil"]+","+val2["idempresa"]+","+val2["idsede"]+","+val2["idtrabajador"]+")' style='width: 100%'>"
									+"<i class='fa fa-check'></i> Acceder"
									+"</a>"
								,"Estado": val["activo"]
							};
							oTablePrecios.fnAddData(objdet);
							*/
						});
					}else{
						alert("El producto no tiene precios configurados");
					}
				}
			},
			complete: function(){
				
			}
			});
		//=================== ********* ====================
		}

		function seleccionarPrecio(precio){
			$("#preciobusqueda").val(precio);
			$("#modal-precios").modal("hide");
			$("#cliente").focus();
		}

		function VerImagen(id) {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "../configuracion/material/Leer",
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

		function ListarStock(idproducto) 
		{
		  var url = '../logistica/inventario/Listar'
		  $.ajax({
		    type: 'POST',
		    async: false,
		    data: { 'idproducto': idproducto },
		    url: url,
		    dataType: 'json',
		    beforeSend: function (data) {
		    	$("#modalstock").modal("show")
		    },
		    success: function (data) {
		      var oTable = $('#tblStock').dataTable()
		      oTable.fnClearTable()
		      if (data !== null && typeof data === 'object') {
		      	var tabla = "<table class='table table-bordered table-striped dataTable'>";
		      	tabla += "<thead>";
		      	tabla += "	<tr>";
		      	tabla += "		<th>Almacen</th>";
		      	tabla += "		<th>Stock</th>";
		      	tabla += "		<th>Costo</th>";
		      	tabla += "	</tr>";
		      	tabla += "<thead>";
		        $.each(data.lista, function (key, val) {
		          tabla += "<tr>";
		          	tabla += "		<td>"+val["nombrealmacen"]+"</td>";
		      		tabla += "		<td>"+val["stock"]+"</td>";
		      		tabla += "		<td>"+val["costo"]+"</td>";
		          tabla += "</tr>";
		        })
		        tabla += "</table>";
		        $("#divTabla").html(tabla);
		      }
		    }
		  })
		}

	</script>	
@stop