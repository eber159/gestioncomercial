@section('title-page')
	ErpWeb | Gestión Pedido
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Mis Pedidos Generados <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="{{ URL::to('productos/0') }}"><i class="fa fa-globe"></i> IR A LA TIENDA</a></li>
		<li><a href="#"><i class="fa fa-dashboard"></i> Mis Pedidos</a></li>
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
							</div>
				  		</div>
					</div>
					<div class="box-body">
						<div id="Lista">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table id="tblDatos" class="table table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th>Fecha</th>
												<th>Código</th>
												<th>Estado</th>
												<th>Cliente</th>
												<th>Monto (S/)</th>
												<th>Vendedor</th>
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

			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Medios de Pago</h3>
					</div>
					<div class="box-body">
						<p> {!! $info->formapago !!} </p>
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
							<div class="form-group" style="display: inline-block; width: 25%">
								<input type="text" class="form-control" id="fecha" name="fecha" placeholder="" style="width: 100%">
							</div>
							&nbsp;
					  	</div>
					  	
						<div style="float: right;">
							<button type="button" id="btnImprimir" name="btnImprimir" class="btn btn-default btn-sm" ><i class="fa fa-print"></i> Imprimir</button>
							<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
					  	</div>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Cliente</label>
											<div style="display: none">
												<select class="form-control select2" style="width: 100%;" id='idcliente' name="idcliente" >
													<option value="">SELECCIONE</option>
													@foreach ($clientes as $c)
														<option value="{{ $c->id }}">{{ $c->nombre }}</option>
													@endforeach
												</select>	
											</div>
											<input type="text" class="form-control" id="nombrecliente" name="nombrecliente" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Tipo Pago</label>
											<select class="form-control" id="idtipopago" name="idtipopago">
												@foreach ($tipospago as $t)
													<option value="{{ $t->id }}">{{ $t->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div><br/>
								<div class="col-md-12">
									<legend></legend>
								</div>
								


								<div class="col-md-4">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Total Neto</label>
											<input type="number" class="form-control" id="total" name="total" placeholder="" style="width: 100%; text-align: center; font-size: 16px" readonly="readonly">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="display: none">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Estado</label>
											<select class="form-control" style="width: 100%;" id='idestado' name="idestado" ></select>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="table-responsive">
										<table id="tblDetalles" class="table table-bordered table-hover" style="width: 100%">
	                                        <thead>
	                                        <th style=''></th>
	                                        <th style='display:none'></th>
	                                        <th style='display:none'></th>
											<th></th>
	                                        <th>Producto</th>
	                                        <th>Cant.</th>
											<th>IdUM</th>
											<th>U.M.</th>
	                                        <th>P. Unit. (S/)</th>
	                                        <th>Valor Vta. (S/)</th>
	                                        <th>Estado</th>
	                                        </thead>
	                                        <tbody>

	                                        </tbody>
	                                    </table>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Observaciones</label>
											<input type="text" class="form-control" id="glosa" name="glosa" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Vendedor</label>
											<input type="text" readonly="readonly" class="form-control" id="nombrevendedor" name="nombrevendedor" value="{{Session::get('nombretrabajador')}}" placeholder="" style="width: 100%">
											<input type="hidden" class="form-control" id="idvendedor" name="idvendedor" value="{{Session::get('idtrabajador')}}" placeholder="" style="width: 100%">
										</div>
									</div>
								</div>
							</div>
						
						
					  <!-- /.box-body -->
					  
					</form>
				</div>
				<div class="overlay" style="display:none" id="divCargaRegistro" >
					<div style="position: absolute;left: 42%; top: 44%">PROCESANDO INFORMACIÓN</div><i class="fa fa-refresh fa-spin"></i> 
				</div>
			</div>
		</div>
	</section>

    <div class="modal modal-default fade" id="modalproducto">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">BUSCAR PRODUCTO</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                    	<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<input type="radio" id="chkCodigoProducto" name="chkTipoConsulta" class="minimal"/> Código
									<input type="radio" id="chkNombreProducto" name="chkTipoConsulta" class="minimal"/> Nombre
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12" id="divCodigoProducto">
								<label for="">Código Producto</label>
								<div class="input-group input-group-sm" id="divCodigo">
					                <input type="text" class="form-control" style="width: 100%;" id='codproductobusqueda' name="codproductobusqueda" />
				                    <span class="input-group-btn">
				                      <button type="button" id="btnBuscarPorCodigo" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
				                    </span>
					             </div>
							</div>

							<div class="col-md-12" style="display:none" id="divNombreProducto">
								<label for="">Nombre Producto </label>
								<div class="input-group input-group-sm" id="divNombre">
					               	<select class="form-control select2" style="width: 100%;" id='idproductobusqueda' name="idproductobusqueda" >
					               		@foreach ($productos as $p)
					               			@if($p->codigo != '')
					               				<option value="{{ $p->id }}">[{{ $p->codigo }}] {{ $p->nombre }}</option>
					               			@else
					               				<option value="{{ $p->id }}">{{ $p->nombre }}</option>
					               			@endif
										@endforeach
					               	</select>
				                    <span class="input-group-btn">
				                      	<button type="button" id="btnActualizarListaProducto" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
				                    </span>
					             </div>
							</div>
							<hr />
							<div class="col-md-12">
								<div class="form-group">
									<label for="">&nbsp;</label>
									<div class="input-group input-group-sm" id="divNombre">
										<input type="text" class="form-control" style="width: 100%;display: none" id='idproductosel' name="idproductosel" />
					        			<input type="text" class="form-control" style="width: 100%;" id='nombreproductosel' name="nombreproductosel" />
										<span class="input-group-btn">
											<button type="button" id="btnVerStock" class="btn btn-default btn-default">STOCK</button>
											<button type="button" id="btnVerImagen" class="btn btn-default btn-flat"><i class="fa fa-image"></i> Ver Producto</button>
										</span>
									</div>
								</div>
							</div>
							
						</div>
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Cantidad</label>
									<input type="number" class="form-control" id="cantidadbusqueda" name="cantidadbusqueda" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Precio</label>
									<input type="number" class="form-control" id="preciobusqueda" name="preciobusqueda" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Total</label>
									<input type="number" class="form-control" id="subtotalbusqueda" name="subtotalbusqueda" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
								</div>
							</div>
							<div class="col-md-4" style="display: none">
								<div class="form-group">
									<label for="">Stock</label>
									<input type="number" class="form-control" id="stockbusqueda" name="stockbusqueda" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
								</div>
							</div>
						</div>

						
						<div class="col-md-4" style="display: none">
							
								<div class="form-group">
									<label for="">Unidad Medida</label>
									<select id="idunidadmedida" class="form-control">
									</select>
								</div>
							
						</div>
                    </div>
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
        <div class="modal-dialog" style="">
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
        <div class="modal-dialog" style="">
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

    <div class="modal modal-default fade" id="modaldocumentoventa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Aprobar Venta</h4>
                </div>
                <div class="modal-body">
                	<div class='row'>
                    	<div class="col-md-12">
							<div class="col-md-6">
                                <label for="">Código Pedido</label>
                                <input type="text" class="form-control" id="nropedido2" name="nropedido2"
                                    placeholder="Numero" style="width: 100%" disabled="disabled">
                                <input type="hidden" class="form-control" id="idvendedor2" name="idvendedor2"
                                    placeholder="Numero" style="width: 100%">
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha</label>
                                <input type="text" class="form-control" id="fechasalida" name="fechasalida" placeholder="" style="width: 100%" disabled="disabled">
                            </div>
						</div>
                    </div>
                    <div class='row' id="divDatosDocumento">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <label for="">Tipo Documento</label>
                                <select class="form-control" style="width: 100%;"
                                        id='cmbtipodocumentomodal' name="cmbtipodocumentomodal">
                                </select>                        
                            </div>
                            <div class="col-md-3">
                                <label for="">Serie</label>
                                <select class="form-control" style="width: 100%;" id='serie' name="serie" ></select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Numero</label>
                                <input type="text" class="form-control" id="nrodocumento" name="nrodocumento"
                                    placeholder="Numero" style="width: 100%">
                            </div>
                        </div>
                        <div class="col-md-12" style="display: none;">
							<div class="col-md-12">
                                <label for="">Dirección</label>
                                <select class="form-control" style="width: 100%;" id='direccionfactura' name="direccionfactura" >
                                	<option value="">Seleccione</option>
                                </select>
                            </div>
						</div>
                    </div>
                    <div class='row' id="divDatosVenta">
                    	<div class="col-md-12">
							<div class="col-md-12">
								<label for="">Total Pedido</label>
								<input type="number" class="form-control" id="importetotal" name="importetotal" placeholder="" style="width: 100%; text-align: center;font-size: 16px" disabled="disabled">
							</div>
						</div>
                    	<div class="col-md-12">
							<div class="col-md-12">
								<label for="">Importe Pago</label>
								<input type="number" class="form-control" id="importepago" name="importepago" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-12">
								<label for="">Vuelto</label>
								<input type="number" class="form-control" id="importevuelto" name="importevuelto" placeholder="" style="width: 100%; text-align: center;font-size: 16px">
							</div>
						</div>
                    </div>
                    <div class='row' id="divDatosSalida">
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
                                    <th style='display:none'>IdUM</th>
									<th>U.M.</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
							</div>
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
                	<button type="button" id="btnGuardarVentaDocumento" name="btnGuardarVentaDocumento" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Guardar</button>
                    <button type="button" id="btnGuardarDespachoPedido" name="btnGuardarVentaDocumento" class="btn btn-success btn-sm"><i
                                        class="fa fa-save"></i>Despachar</button>
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

			var fechainicial = RestarDias(new Date(), 0);
			
			$('#fechaini').datepicker({
                format: 'yyyy-mm-dd'
            });
			$('#fechaini').datepicker("setDate",fechainicial);
			$('#fechafin').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechafin').datepicker("setDate", new Date());


			$(window).keydown(function(event){
			    if(event.keyCode == 13) {
			      event.preventDefault();
			      return false;
			    }
		  	});

			$('.select2').select2();
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass   : 'iradio_minimal-blue'
			})

			InicializarTabla();
			InicializarTablaDetalles();
			InicializarTablaStock();
			InicializarTablaDetallesSalidas();
			Listar();
			CargarComboEstado();
			CargarComboUnidadMedida();
			//CargarComboProducto();
			
			//Nuevo();

			$("#idproductobusqueda:input").attr('disabled', true);
	   		$("#codproductobusqueda:input").removeAttr('disabled');
	   		$("#idproductobusqueda").val("").trigger('change');

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
							"sWidth": "10%", "mDataProp": "Fecha"
						}, {
							"sWidth": "10%", "mDataProp": "Codigo"
						}, {
							"sWidth": "30%", "mDataProp": "Cliente"
						},{
							"sWidth": "10%", "mDataProp": "Total"
						},{
							"sWidth": "20%", "mDataProp": "Trabajador"
						},{
							"sWidth": "10%", "mDataProp": "Estado"
						},{
							"sWidth": "10%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "targets": [4],
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
							"bVisible": false, "mDataProp": "Row"
						},{
							"bVisible": false, "mDataProp": "Id"
						},{
							"bVisible": false, "mDataProp": "IdProducto"
						},{
							"sWidth": "5%", "mDataProp": "Acciones"
						},{
							"sWidth": "40%", "mDataProp": "Producto"
						},{
							"sWidth": "10%", "mDataProp": "Cantidad"
						},{
							"bVisible": false, "sWidth": "10%", "mDataProp": "IdUM"
						},{
							"sWidth": "10%", "mDataProp": "UnidadMedida"
						},{
							"sWidth": "10%", "mDataProp": "PrecioUnitario"
						},{
							"sWidth": "10%", "mDataProp": "ValorVenta"
						},{
							"bVisible": false, "sWidth": "10%", "mDataProp": "Estado"
						}],
					'columnDefs':[
						{
						      "targets": [5,8,9],
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

			function InicializarTablaPrecios() {
				var Table = $('#tblPrecios').dataTable({
					"info": false,
					"order": false,
					"bFilter": false,
					"bPaginate": false,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						},{
							"sWidth": "50%", "mDataProp": "Empresa"
						},{
							"sWidth": "50%", "mDataProp": "Sede"
						}]
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

			function InicializarTablaDetallesSalidas () {
				var Table = $('#tblDetallesOS').dataTable({
				    'info': false,
				    'bFilter': false,
				    'bPaginate': false,
				    'bSort': false,
				    'aoColumns': [{
				      'bVisible': true, 'mDataProp': 'Row'
				    }, {
				      'bVisible': false, 'mDataProp': 'Id'
				    }, {
				      'bVisible': false, 'mDataProp': 'IdMaterial'
				    }, {
				      'sWidth': '40%', 'mDataProp': 'Material'
				    },{
				      "bVisible": false, "sWidth": "10%", "mDataProp": "IdUM"
				    },{
				      "sWidth": "10%", "mDataProp": "UnidadMedida"
				    }, {
				      'sWidth': '10%', 'mDataProp': 'Cantidad'
				    }, {
				      'sWidth': '10%', 'mDataProp': 'Precio'
				    },{
				      'sWidth': '10%', 'mDataProp': 'Total'
				    }]
				})
			}

			$("input[type='number']").click(function () {
			   $(this).select();
			});
			/*
			$("input[name='chkTipoConsulta']").click(function () {
			   if($("input[id=chkCodigoProducto]:checked").val()){
			   		$("#idproductobusqueda:input").attr('disabled', true);
			   		$("#codproductobusqueda:input").removeAttr('disabled');
			   		$("#idproductobusqueda").val("").trigger('change');
			   		$("#codproductobusqueda").focus();
			   }
			   if($("input[id=chkNompreProducto]:checked").val()){
			   		$("#codproductobusqueda:input").attr('disabled', true);
			   		$("#idproductobusqueda:input").removeAttr('disabled');
			   		$("#codproductobusqueda").val("");
			   		$("#idproductobusqueda").focus();
			   }
			   $("#idproductosel").val("");
			   $("#nombreproductosel").val("");
			});
			*/
			$('input[name="chkTipoConsulta"]').on('ifClicked', function (event) {
				if(this.id=="chkCodigoProducto"){
			   		$("#idproductobusqueda:input").attr('disabled', true);
			   		$("#codproductobusqueda:input").removeAttr('disabled');
			   		$("#idproductobusqueda").val("").trigger('change');
			   		$("#codproductobusqueda").focus();
					$("#divCodigoProducto").show();
					$("#divNombreProducto").hide();
			   }
			   if(this.id=="chkNombreProducto"){
			   		$("#codproductobusqueda:input").attr('disabled', true);
			   		$("#idproductobusqueda:input").removeAttr('disabled');
			   		$("#codproductobusqueda").val("");
			   		$("#idproductobusqueda").focus();
					$("#divCodigoProducto").hide();
					$("#divNombreProducto").show();
			   }
			   $("#idproductosel").val("");
			   $("#nombreproductosel").val("");
			});

			$("#btnNuevo").on("click", function(event) {
				Nuevo();
			});
	
			$("#btnGuardar").on("click", function(event) {
				GuardarVenta();
			});

			$("#btnConsultarPrecios").on("click", function(event) {
				if($("#idproductosel").val()!=""){
					consultarPrecios($("#idproductosel").val());
				}else{
					alert("Seleccione un producto");
				}
				
			});

			$("#btnVerImagen").on("click", function(event) {
				if($("#idproductosel").val()!=""){
					VerImagen($("#idproductosel").val());
				}else{
					alert("Seleccione un producto");
				}
				
			});

			$("#btnVerStock").on("click", function(event) {
				if($("#idproductosel").val()!=""){
					ListarStock($("#idproductosel").val());
				}else{
					alert("Seleccione un producto");
				}
				
			});


			$("#btnBuscarPorCodigo").on("click", function(event) {
				BuscarxCodigo();
			});

			$(document).on('keyup', '#codproductobusqueda', function (e) {
				e.preventDefault(e);
				console.log("aqui");
				if($("#codproductobusqueda").val()!=""){
					if (e.which === 13) {
				    	BuscarxCodigo();
				    }
				}
			});
			
			$("#fecha").change(function(){
				/*
				$.post('../configuracion/tipocambio/Listar',{"fecha":$('#fecha').val()},
                function (data) {
                    $.each(data.lista, function (index, item) {
                        $("#tipocambio").val(item.venta);
                    });
                }, 'json');
                */
			});

			$("#btnListar").on("click", function(event) {
				Listar();
			});
			$("#btnActualizarListaProducto").on("click", function(event) {
				$("#idproductobusqueda").empty();
				$("#idproductosel").val("");
			    $("#nombreproductosel").val("");
			});

			$('#btnAgregarProducto').click(function (e) {
				e.preventDefault();
				InicializarCantidades();
				$("#modalproducto").modal("show");
			});

			$('#btnAgregar').click(function (e) {
				e.preventDefault();
				AgregarProducto();
			});

			$('#idproductobusqueda').on('select2:select', function (e) {
			    var data = e.params.data;
			    $("#idproductosel").val(data.id);
			    $("#nombreproductosel").val(data.text);
			    $("#cantidadbusqueda").focus();
			    ObtenerPrecioProducto(data.id);
			});
			/*
			$(document).on('keyup', '.select2-search__field', function (e) {
				//if ($(this).attr('search')=="1") {
					if (e.which === 13) {
				    	if($(this).val()!=""){
				    		var $combo = $("#idproductobusqueda");
				    	 	$combo.empty();
				    		var c = 1;
				            //$combo.empty();
				            $.post('../configuracion/material/ListarFiltros',{"tipo":"nombre","filtro":$(this).val()},
			                    function (data) {
			                        $combo.append("<option value=''>Seleccione</option>");
			                        $.each(data.lista, function (index, item) {
			                        	var RutaImagen = "<center><img src=\"{{config('constants.rutapublica.url')}}"+item.imagen+"\" width='300px' ></center>";
			                            $combo.append("<option value='" + item.id + "'>" + item.codigo + " - " + item.nombre + " " +RutaImagen+"</option>");
			                            console.log();
			                            if(c==data.lista.length){
			                            	setTimeout(function(){$("#idproductosel").focus(); }, 100);
			                            	$(".select2").siblings('select').select2('close');		
			                            	setTimeout(function(){$("#idproductobusqueda").focus(); }, 500);
			                            }
			                            c++;
			                        });
			                    }, 'json');	
				            
				    	}
				    	var texto1 = $(this).val();
						$(this).val(texto1 + "s").trigger('keyup-change');
	                    $(this).val(texto1).trigger('keyup-change');				
				    }

				    if (e.keyCode === 113) {
	                    $(this).val("");
	                    $("#idproductobusqueda").empty();
	                    var texto = $(this).val();
	                    $(".select2").siblings('select').select2('close');
	                }
				//}
			    
			});
			$(".select2-search__field").eq(0).attr('search', '1');
	
			$(document).on('focus', '.select2', function (e) {
				if (e.originalEvent) {
			    	$(this).siblings('select').select2('open');
				} 
			});
			*/


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

			$("#btnGuardarVentaDocumento").on("click", function(event) {
				if(validarGuardarVenta()){
					GuardarVentaFinal();	
				}
			});

			$("#btnGuardarDespachoPedido").on("click", function(event) {
				//if(validarGuardarVenta()){
					GenerarOrdenSalida();	
				//}
			});


			$("#importepago").bind('keyup', function () {
			    var vuelto = 0;
			    vuelto = parseFloat($("#importepago").val() - $("#importetotal").val()).toFixed(2);
			    $("#importevuelto").val(vuelto);
			});

			$("#preciobusqueda").bind('keyup', function () {
			    var subtotal = 0;
			    subtotal = parseFloat($("#preciobusqueda").val()  * $("#cantidadbusqueda").val()).toFixed(2);
			    $("#subtotalbusqueda").val(subtotal);
			});

			$("#cantidadbusqueda").bind('keyup', function () {
			    var subtotal = 0;
			    subtotal = parseFloat( Number ($("#preciobusqueda").val())  * Number ($("#cantidadbusqueda").val()) ).toFixed(2);
			    $("#subtotalbusqueda").val(subtotal);
			});

			$("#subtotalbusqueda").bind('keyup', function () {
			    var cantidad = 0;
			    cantidad = parseFloat($("#subtotalbusqueda").val()  / $("#preciobusqueda").val()).toFixed(2);
			    $("#cantidadbusqueda").val(cantidad);
			});

			$("#btnImprimir").on("click", function(event) {
				if( $("#id").val()!='' ){
					window.open("impresionpedido/"+"{{ Session::get('nombreusuario') }}"+"/"+$("#id").val()+"/pdf");
				}else{
					bootbox.alert("Primero debe registrar el pedido");
				}
			});

		});


		function formatoDocumento(texto,cantidad)
		{
			var ln = ""
			for (var i = 1 ;i<=cantidad-texto.length;i++){
				ln = ln + "0"
			}
			return ln + texto
		}

		function AgregarProducto(){
			if(validarAgregarProducto()){
				if($("#idproductobusqueda").val()!=""){
					if($("#cantidadbusqueda").val()!="" && parseFloat($("#cantidadbusqueda").val())>0 ){
						if($("#preciobusqueda").val()!="" && parseFloat($("#preciobusqueda").val())>0 ){
							if($("#stockbusqueda").val() >= parseFloat($("#cantidadbusqueda").val()) ){
								var oTable = $("#tblDetalles").dataTable();
					            var Linea = oTable.fnGetData().length + 1 ;
					            var obj = {"Row": Linea 
					            		,"Id": ""
										,"Acciones":"<center>"
														+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Quitar(0,"+Linea+")'>"
															+"<i class='ace-icon fa fa-times bigger-130'></i>"
														+"</a>&nbsp;"
													+"</center>"
					            		,"IdProducto": $("#idproductosel").val()
										,"Producto": $("#nombreproductosel").val()
										,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat($("#cantidadbusqueda").val()).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100%; font-size:14px' >"
										,"IdUM": $("#idunidadmedida").val()
										,"UnidadMedida": $("#idunidadmedida option:selected").text()
										,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat($("#preciobusqueda").val()).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100%; font-size:14px' >"
										,"ValorVenta": "<input type='number' class='form-control2' value= '"+(parseFloat($("#cantidadbusqueda").val()) * parseFloat($("#preciobusqueda").val())).toFixed(4)+"' id='txtValorVenta"+Linea+"' name='txtValorVenta"+Linea+"' style='text-align: right; width: 100%; font-size:14px' readonly='readonly'>"
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
								InicializarCantidades();
					        	calcularTotales();
					        	$("#codproductobusqueda").val("");
					        	$("#idproductosel").val("");
					        	$("#nombreproductosel").val("");

					        	if($("input[id=chkCodigoProducto]:checked").val()){
					        		$("#codproductobusqueda").focus();
					        	}
					        	if($("input[id=chkNompreProducto]:checked").val()){
					        		$("#idproductobusqueda").empty();
                    				var texto = $(this).val();
                    				$(".select2").siblings('select').select2('close');
                    				$("#idproductobusqueda").focus();
					        	}
					        	$("#modalproducto").modal("hide");
					        }else{
								bootbox.alert("El producto no cuenta con stock");
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
		}
		
		function Nuevo(){
			$('#frmRegistro')[0].reset();
			MostrarRegistro();
			$("#id").val("");
			$("#idproductobusqueda").val('').trigger('change');
			$('#fecha').datepicker({
				format: 'yyyy-mm-dd'
			}).attr('readonly', 'readonly');
			$('#fecha').datepicker("setDate", new Date());
			//var oTableDetalles = $("#tblDetalles").dataTable();
			//oTableDetalles.fnClearTable();

			InicializarCantidades();
			//$("#chkCodigoProducto:input").prop('checked', true);
			//$("#chkCodigoProducto").iCheck('check');
			$("#chkNombreProducto").iCheck('check');
			$("#codproductobusqueda:input").attr('disabled', true);
	   		$("#idproductobusqueda:input").removeAttr('disabled');
	   		$("#codproductobusqueda").val("");
	   		$("#idproductobusqueda").focus();
			$("#divCodigoProducto").hide();
			$("#divNombreProducto").show();
			$("#codproductobusqueda").focus();
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
			
	        if($("#idunidadmedida").val()==""){
	            bootbox.alert("Especifique la unidad de medida");
	            estado = false;
	        }
	        
	        return estado;
	    }

		function InicializarCantidades(){
			$("#cantidadbusqueda").val(0);
			$("#preciobusqueda").val(0);
			$("#dsctobusqueda").val(0);
			$("#subtotalbusqueda").val(0);
			$("#stockbusqueda").val(0);
			$("#idproductobusqueda").val('').trigger('change');
		}

		function validarGuardarPedido(){
			var cont = 0;
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    cont = cont + 1;
			});
			
			if(cont==0){
				bootbox.alert("No hay detalles en el Pedido");
	            return false;
			}

	        if($("#nombrecliente").val()==""){
	            bootbox.alert("Seleccione un cliente");
	            return false;
	        }
	        
	        if($("#idtipopago").val()==""){
	            bootbox.alert("Seleccione un tipo de pago");
	            return false;
	        }

	        return true;
	    }

		function GuardarVenta(){
			if(validarGuardarPedido()){
				$("#divCargaRegistro").show();
				//Obtener Objetos
				var detalles = [];
				var c = 0;
				//Detalles
				var oTable2 = $("#tblDetalles").DataTable();
				oTable2.rows().eq(0).each( function ( index ) {
				    var row = oTable2.row( index );
				    var data = row.data();
				    var fila = data["Row"];
				    var obj = {
				    	"id": data["Id"]
				    	,"idproducto": data["IdProducto"]
				    	,"nombreproducto": data["Producto"]
				    	,"cantidad": $("#txtCantidad"+fila).val()
						,"idunidadmedida": data["IdUM"]
						,"unidadmedida": data["UnidadMedida"]
				    	,"precio": $("#txtPrecioUnit"+fila).val()
			        	,"valor_vta": $("#txtValorVenta"+fila).val()
			        	,"activo": data["Estado"]
				    }
			       	detalles[c] = obj;
			       	c++;
				});

				//Cabecera
				var obj = {
					"id": $("#id").val()
					,"codigo": $("#codigo").val()
					,"idcliente": $("#idcliente").val()
					,"nombrecliente": $("#nombrecliente").val()
					,"fecha": $("#fecha").val()
					,"idestado": $("#idestado").val()
					,"total": $("#total").val()
					,"idvendedor": $("#idvendedor").val()
					,"glosa": $("#glosa").val()
					,"idtipopago": $("#idtipopago").val()
					,"detalles": detalles
				};

				var resp = "";
				$.ajax({
					type: "POST",
					async: false,
					data: obj,
					url: "../comercial/ordenpedido/Guardar",
					dataType: "json",
					beforeSend: function (data) {
						
					},
					success: function (data) {
						if(data.success == true){
							//bootbox.alert("CÓDIGO GENERADO: " + data.resultadocodigo);
							$('#frmRegistro')[0].reset();
							$("#idcliente").val('').trigger("change");
							var oTableDetalles = $("#tblDetalles").dataTable();
							oTableDetalles.fnClearTable();
							resp = "ok";
							MostrarLista();
							Listar();
						}else{
							bootbox.alert(data.message);
							console.log(data.message);
						}
						if(data.success == "session"){
							bootbox.alert(data.message);
						}

						$("#divCargaRegistro").hide();
					},
					error: function (data) {
						bootbox.alert(data.message);
						onsole.log(data.message);
						$("#divCargaRegistro").hide();
					}
				});
				return resp;
			}
		}


		function Listar() {
			var form = $('#frmRegistro');
			var url = "../comercial/ordenpedido/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: { "nombreusuario": "{{ Session::get('nombreusuario') }}", "fechaini":$("#fechaini").val(),"fechafin":$("#fechafin").val() },
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#divCargando").show();
				},
				success: function (data) {

					

					var oTable = $("#tblDatos").dataTable();
	                oTable.fnDestroy();
	                oTable.DataTable( {
	                    data: data.lista,
	                    "columns": [
	                                { "data": 'id', "width": "5%", "visible": false},
	                                { "data": 'created_at', "width": "8%"},
	                                { "data": null, "width": "10%",
	                                	"render": function (data, type, row) {
											return "<a href='#' onclick='EditarVenta(\"ordenpedido/Leer\","+row.id+")'><span class='label label-primary' style='font-size:10px;'>"+row.codigo+"</span></a>"
	                                	}
	                            	},
	                            	{ "data": null, "width": "10%",
	                                	"render": function (data, type, row) {
	                                		if(row.idestado == {{config('constants.estadopedido.generado')}}){
												return "<span class='label label-default'>GENERADO</span>"
											}
											if(row.idestado == {{config('constants.estadopedido.aprobado')}}){
												return "<span class='label label-primary'>APROBADO</span>"
											}
											if(row.idestado == {{config('constants.estadopedido.rechazado')}}){
												return "<span class='label label-danger'>RECHAZADO</span>"
											}

											if(row.idtipopago == {{config('constants.tipopago.contado')}}){
												if(row.idestado == {{config('constants.estadopedido.atendido')}}){
													return "<span class='label label-success'>EXTRACCIÓN</span>"
												}
												if(row.idestado == {{config('constants.estadopedido.despachado')}}){
													return "<span class='label label-success'>DESPACHADO</span>"
												}
												if(row.idestado == {{config('constants.estadopedido.transito')}}){
													return "<span class='label label-success'>EN DESPACHO</span>"
												}
											}else{
												if(row.idestado == {{config('constants.estadopedido.atendido')}}){
													return "<span class='label label-warning'>EXTRACCIÓN</span>"
												}
												if(row.idestado == {{config('constants.estadopedido.despachado')}}){
													return "<span class='label label-warning'>DESPACHADO</span>"
												}
												if(row.idestado == {{config('constants.estadopedido.transito')}}){
													return "<span class='label label-warning'>EN DESPACHO</span>"
												}
											}

											if(row.idestado == {{config('constants.estadopedido.liquidado')}}){
												return "<span class='label label-success'>LIQUIDADO</span>"
											}
											
	                                	}
	                            	},
	                                { "data": 'nombrecliente', "width": "20%"},
	                                { "data": 'total', "width": "10%", className: 'dt-body-right'},
	                                { "data": 'trabajador', "width": "20%"},

	                                { "data": null,
	                                        "searchable": true,
	                                        "orderable":true,
	                                        "render": function (data, type, row) {
	                                        	return "<a class='btn btn-primary btn-xs' href='javascript:;' onclick='EditarVenta(\"ordenpedido/Leer\","+row.id+")' class='blue' title='Editar Pedido'>"
																+"<i class='ace-icon fa fa-search bigger-130'></i>"
															+"</a>&nbsp;"
														+"</div>"
	                                    	},"width": "25%"
	                                },
	                            ],
	                    "dom": 'Bfrtip',
	                    "buttons": [
	                        'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
	                    ] ,
	                    "paging": true,
	                    "order": [[ 0, "desc" ]],
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
		

		function AprobarPedido(id){
			CargarTipoDocumento();
			CargarComboAlmacenSalidas();
			CargarPedidos(id);
			$('#fechasalida').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechasalida').datepicker("setDate", new Date());
            $('#importepago').val(0);
            $('#importevuelto').val(0);

            $("#divDatosDocumento").css("display","block");
            $("#divDatosVenta").css("display","block");
            $("#divDatosSalida").css("display","none");
            $("#btnGuardarVentaDocumento").css("display","block");
            $("#btnGuardarDespachoPedido").css("display","none");
			$("#modaldocumentoventa").modal("show");
		}

		function DespacharPedido(id){
			CargarComboAlmacenSalidas();
			CargarPedidos(id);
			$('#fechasalida').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechasalida').datepicker("setDate", new Date());
            $('#importepago').val(0);
            $('#importevuelto').val(0);

            $("#divDatosDocumento").css("display","none");
            $("#divDatosVenta").css("display","none");
            $("#divDatosSalida").css("display","block");
            $("#btnGuardarVentaDocumento").css("display","none");
            $("#btnGuardarDespachoPedido").css("display","block");
			$("#modaldocumentoventa").modal("show");
		}


		function RechazarPedido(id,idcliente){
			var estadopedido = "{{ config('constants.estadopedido.rechazado') }}";
			bootbox.confirm("¿Seguro que deseas Rechazar el pedido?", function(result) {
				if(result){
					$.ajax({
						type: "POST",
						async: false,
						data: {"id":id,"idestado": estadopedido,"idcliente":idcliente},
						url: "../comercial/ordenpedido/RechazarPedido",
						dataType: "json",
						beforeSend: function (data) {
							
						},
						success: function (data) {
							if(data.success == true){
								//bootbox.alert("PEDIDO APROBADO");
								Listar();
							}else{
								bootbox.alert(data.message);
								console.log(data.message);
							}
							if(data.success == "session"){
								bootbox.alert(data.message);
							}
						},
						error: function (data) {
							bootbox.alert(data.message);
							onsole.log(data.message);
						}
					});
				}
			});
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
					
				},
				success: function (data) {
					var oTableDetalles = $("#tblDetalles").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#codigo").val(val["codigo"]);
							$("#cliente").val(val["cliente"]);
							$('#fecha').datepicker({
								format: 'yyyy-mm-dd'
							}).attr('readonly', 'readonly');
				            $('#fecha').datepicker("setDate", val["fecha"]);
					        $("#idestado").val(val["idestado"]);
					        $("#idvendedor").val(val["idvendedor"]);
					        $("#idcliente").val(val["idcliente"]).trigger('change');
					        $("#nombrecliente").val(val["nombrecliente"]);
					        $("#idtipopago").val(val["idtipopago"]);
					        $("#total").val((parseFloat(val["total"]).toFixed(2)).toLocaleString('en'));
					        var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetalles").dataTable();
					            var objdet = {"Row": Linea 
					            		,"Id": val2["id"]
										,"Acciones":"<center>"
														+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='Quitar("+val2["id"]+","+Linea+")'>"
															+"<i class='ace-icon fa fa-times bigger-130'></i>"
														+"</a>&nbsp;"
													+"</center>"
					            		,"IdProducto": val2["idproducto"]
										,"Producto": val2["nombreproducto"]
										,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat(val2["cantidad"]).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100%; font-size:14px' >"
										,"IdUM": val2["idunidadmedida"]
										,"UnidadMedida": val2["unidadmedida"]
										,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat(val2["precio"]).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100%; font-size:14px' >"
										,"ValorVenta": "<input type='number' class='form-control2' value= '"+parseFloat(val2["valor_vta"]).toFixed(4)+"' id='txtValorVenta"+Linea+"' name='txtValorVenta"+Linea+"' style='text-align: right; width: 100%; font-size:14px' readonly='readonly'>"
										,"Estado": val["activo"]
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

        function CargarComboEstado() {
            var $combo = $("#idestado");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_PEDIDO"},
                    function (data) {
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

        function calcularValorLinea(item){
        	var cant = parseFloat($("#txtCantidad"+item).val());
        	var precio = parseFloat($("#txtPrecioUnit"+item).val());
        	$("#txtValorVenta"+item).val(((cant*precio)).toFixed(4));
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
				   	var neto = parseFloat($("#txtValorVenta"+fila).val());
				    totalneto = (parseFloat(totalneto) + parseFloat(neto)).toFixed(2);
				}
			});
			$("#total").val(totalneto);
        }


        //Buscar Producto

        function BuscarxCodigo() {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"tipo":"codbarras","filtro":$("#codproductobusqueda").val()},
				url: "../configuracion/material/ListarFiltros",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							$("#idproductosel").val(val["id"]);
							$("#nombreproductosel").val(val["nombre"]);
							$("#cliente").focus();
							$("#preciobusqueda").val(val["precioventa"]);
						});
					}
				}
			});
			//=================== ********* ====================
		}

		function CargarComboProductoNombre(val) {
            var $combo = $("#idproductobusqueda");
            $combo.empty();
            $.post('../configuracion/material/ListarFiltros',{"tipo":"nombre","filtro":val},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }
		

		function CargarComboUnidadMedida(val) {
            var $combo = $("#idunidadmedida");
            $combo.empty();
            $.post('../configuracion/unidadmedida/Listar',
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
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
		          /*
		          var obj = {
		            'Id': val['id'],
		            'Almacen': val['nombrealmacen'] ,
		            'Stock': val['stock'],
		            'Costo': val['costo']
		            }
		          oTable.fnAddData(obj)
		          */
		        })
		        tabla += "</table>";
		        $("#divTabla").html(tabla);
		      }
		    }
		  })
		}





		//APROBAR PEDIDO =======================================================================================================================

		// CARGAR COMBOS
		function CargarTipoDocumento() {
            var $combo = $("#cmbtipodocumentomodal");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_DOCUMENTO"},
			function (data) {
				$.each(data.lista, function (index, item) {
					if(item.nombre=="DOCUMENTO INTERNO"){
						$combo.append("<option value='" + item.id + "'>" + item.nombre + "</option>");
					}
				});
				$("#cmbtipodocumentomodal").val("{{ config('constants.tipodocumento.documentointerno') }}");
				CargarSeries();
			}, 'json');
        }

		function CargarSeries() {
            var $combo = $("#serie");
            $combo.empty();
            $.post('../configuracion/serie/Listar',{"idtipodocumento": $("#cmbtipodocumentomodal").val() ,"indcompraventa":"V"},
			function (data) {
				$.each(data.lista, function (index, item) {
					$combo.append("<option value='" + item.nroserie + "'>"
							+ item.nroserie + "</option>");
				});
				CargarUltimoCorrelativo();
			}, 'json');
        }

        function CargarUltimoCorrelativo() {
            $.post('../configuracion/serie/ListarCorrelativo',{"idtipodocumento": $("#cmbtipodocumentomodal").val() ,"indcompraventa":"V","serie":$("#serie").val()},
			function (data) {
				$.each(data.lista, function (index, item) {
					$("#nrodocumento").val(item.nrocorrelativo);
				});
			}, 'json');
        }

        function CargarComboAlmacenSalidas() {
		  var $combo = $('#idalmacensalida')
		  $combo.empty()
		  $.post('../logistica/almacen/Listar',
		    function (data) {
		      $.each(data.lista, function (index, item) {
		        $combo.append("<option value='" + item.id + "'>"
		          + item.nombre + '</option>')
		      })
		    }, 'json')
		}


		function CargarPedidos(id) {
			//$("#id").val(id);
			//var form  = $("#frmRegistro");
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":id},
				url: "../comercial/ordenpedido/Leer",
				dataType: "json",
				beforeSend: function (data) {

				},
				success: function (data) {
					var oTableDetalles = $("#tblDetallesOS").dataTable();
					oTableDetalles.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#importetotal").val(val["total"]);
							$("#nropedido2").val(val["codigo"]);
							$("#idvendedor2").val(val["idvendedor"]);
					        var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetallesOS").dataTable();
								var objdet =
					            {
					              'Row': Linea,
					              'Id': val2['id'],
					              'IdMaterial': val2['idproducto'],
					              'Material': val2['nombreproducto'],
					              "IdUM": val2["idunidadmedida"],
					              "UnidadMedida": val2["unidadmedida"],
					              'Cantidad': "<input type='number' class='form-control2' value= '" + parseFloat(val2['cantidad']).toFixed(2) + "' id='txtCantidadSalida" + Linea + "' name='txtCantidadSalida" + Linea + "' style='text-align: right; width: 100px' >",
					              'Precio': "<input type='number' class='form-control2' value= '" + parseFloat(val2['precio']).toFixed(2) + "' id='txtPrecioSalida" + Linea + "' name='txtPrecioSalida" + Linea + "' style='text-align: right; width: 100px' >",
					              'Total': "<input type='number' class='form-control2' value= '" + parseFloat(val2['valor_vta']).toFixed(2) + "' id='txtTotalSalida" + Linea + "' name='txtTotalSalida" + Linea + "' style='text-align: right; width: 100px' >"
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



		function ObtenerObjetoDocumento(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;

			var idempresa = "{{Session::get('idempresa')}}";
			var subtotal = 0;
			var impuestototal = 0;
			var total = 0;

			//Detalles
			var oTable2 = $("#tblDetallesOS").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
				var indigv = 0;
				
				var cantidad = Number ($("#txtCantidadSalida"+fila).val() );
				var precio = Number ($("#txtPrecioSalida"+fila).val() );
				var valor_vta_igv = Number ( $("#txtTotalSalida"+fila).val() );
				var preciosigv = 0;
				var valor_vta_sigv = 0;
				var impuesto = 0;

				preciosigv = parseFloat( Number (precio) / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(4);
				valor_vta_sigv = parseFloat(Number (preciosigv) * Number (cantidad)).toFixed(4);
				impuesto = parseFloat(Number (valor_vta_igv) - Number (valor_vta_sigv)).toFixed(4);

			    var obj = {
			    	"id": ""
			    	,"idtipomaterialservicio" : {{ config('constants.materialservicio.material') }}
			    	,"idmaterialservicio": data["IdMaterial"]
			    	,"cantidad": cantidad
			    	,"preciounit": preciosigv
			    	,"preciounitigv": precio
			    	,"indigv": 1
		        	,"activo": 1
			    }
		       	detalles[c] = obj;

		       	subtotal = subtotal + parseFloat(valor_vta_sigv);
		       	impuestototal = impuestototal + parseFloat(impuesto);
		       	total = total + parseFloat(valor_vta_igv);

		       	c++;
			});

			//Cabecera
			var obj = {
				"id": 0
				,"idtipodocumento": $("#cmbtipodocumentomodal").val()
				,"idclienteproveedor": idempresa
				,"idperiodo": 1
				,"idestado": {{ config('constants.estadodocumento.generado') }}
				,"cuentacontable": ''
				,"idmoneda": {{ config('constants.moneda.soles') }}
				,"tipocambio": 3.5
				,"idtipocompraventa": 1
				,"idmaterialservicio": {{ config('constants.materialservicio.material') }}
				,"serie": $("#serie").val()
				,"numero": $("#nrodocumento").val()
				,"fechaemision": $("#fechasalida").val()
				,"fechavencimiento": $("#fechasalida").val()
				,"glosa": "DOCUMENTO AUTOGENERADO "
				,"tasaimpuesto": {{ config('constants.generales.impuesto') }}
				,"nogravadas": 0
				,"subtotal": subtotal
				,"impuesto": impuestototal
				,"total": total
				,"saldo": total
				,"operador": 1
				,"indextorno": 0
				,"direcciondestino":""
				,"detalles": detalles
			};
			return obj;
		}

		function ObtenerObjetoOrdenSalida(){
			//Obtener Objetos
			var detalles = []
			var c = 0
			 // Detalles
			var idempresa = "{{Session::get('idempresa')}}";
			var subtotal = 0;
			var impuestototal = 0;
			var total = 0;

			var oTable2 = $('#tblDetallesOS').DataTable()
			oTable2.rows().eq(0).each(function (index) {
				var row = oTable2.row(index);
			    var data = row.data();
			    var fila = data['Row'];

			    var cantidad = Number ($("#txtCantidadSalida"+fila).val() );
				var precio = Number ($("#txtPrecioSalida"+fila).val() );
				var valor_vta_igv = Number ( $("#txtTotalSalida"+fila).val() );
				var preciosigv = 0;
				var valor_vta_sigv = 0;
				var impuesto = 0;

				preciosigv = parseFloat( Number (precio) / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(4);
				valor_vta_sigv = parseFloat(Number (preciosigv) * Number (cantidad)).toFixed(4);
				impuesto = parseFloat(Number (valor_vta_igv) - Number (valor_vta_sigv)).toFixed(4);

			    var obj = {
			      'id': "",
			      'idmaterial': data['IdMaterial'],
			      'cantidad': cantidad,
			      'idlote': {{config('constants.generales.lotedefecto')}} ,
			      'costoorigen' : precio,
			      'costo' : precio,
			      'idalmacen' : $('#idalmacensalida').val(), 
			      "idunidadmedida": data["IdUM"],
			      'activo': 1
			    }
			    detalles[c] = obj;

			    subtotal = subtotal + parseFloat(valor_vta_sigv);
		       	impuestototal = impuestototal + parseFloat(impuesto);
		       	total = total + parseFloat(valor_vta_igv);

			    c++;
			})

			//Cabecera
			var obj = {
			    'id': "",
			    'idempresapropietario': idempresa,
			    'idempresaadministra': idempresa,
			    'fechaorden': $('#fechasalida').val(),
			    'idtipo': {{config('constants.tipoordeningresosalida.salida')}}, //categoria tipo orden ingreso
			    'idestado': {{config('constants.estadooios.terminado')}},
			    'idmovimientoinventario': {{config('constants.movimientoinventario.salidaventas')}},
			    'codigooperacion': '',
			    'idmodulo': '',
			    'glosa':  "SALIDA POR DESPACHO INMEDIATO",
			    'detalles': detalles
			 }
			return obj;
		}


		function validarGuardarVenta(){
			if(!(parseFloat($("#importepago").val())>0)){
	            alert("No se ha especificado un importe a pagar");
	            return false;
	        };
	        if(parseFloat($("#importepago").val()) < parseFloat($("#importetotal").val()) ){
	            alert("El importe de pago es menor al monto del Pedido");
	            return false;
	        };
	        return true;
	    }


		function GuardarVentaFinal(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			var objdocumento = null;
			var objmovimientocaja = null;
			var objordensalida = null;

			objdocumento = ObtenerObjetoDocumento();
			//objordensalida = ObtenerObjetoOrdenSalida();

			var idempresa = "{{Session::get('idempresa')}}";
			var subtotal = 0;
			var impuestototal = 0;
			var total = 0;

			//Detalles
			var oTable2 = $("#tblDetallesOS").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
				
			    var cantidad = Number ($("#txtCantidadSalida"+fila).val() );
				var precio = Number ($("#txtPrecioSalida"+fila).val() );
				var valor_vta_igv = Number ( $("#txtTotalSalida"+fila).val() );
				var preciosigv = 0;
				var valor_vta_sigv = 0;
				var impuesto = 0;

				preciosigv = parseFloat( Number (precio) / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(4);
				valor_vta_sigv = parseFloat(Number (preciosigv) * Number (cantidad)).toFixed(4);
				impuesto = parseFloat(Number (valor_vta_igv) - Number (valor_vta_sigv)).toFixed(4);

			    var obj = {
			    	"id": ""
			    	,"idproducto": data["IdMaterial"]
			    	,"nombreproducto": data["Material"]
			    	,"descripcion": data["Material"]
			    	,"idalmacen": ""
			    	,"cantidad": cantidad
			    	,"cantidadpendiente": cantidad
			    	,"precio_unit_sigv": preciosigv
		        	,"precio_unit_igv": precio
		        	,"valor_vta_sigv": valor_vta_sigv
		        	,"valor_vta_igv": valor_vta_igv
					,"indigv": 1
					,"idunidadmedida": data["IdUM"]
					,"unidadmedida": data["UnidadMedida"]
		        	,"dscto": 0
		        	,"activo": 1
			    }
		       	detalles[c] = obj;

		       	subtotal = subtotal + parseFloat(valor_vta_sigv);
		       	impuestototal = impuestototal + parseFloat(impuesto);
		       	total = total + parseFloat(valor_vta_igv);

		       	c++;
			});

			//Cabecera
			var obj = {
				"id": ""
				,"idcliente": idempresa
				,"fecha": $("#fechasalida").val()
				,"fechaentrega": $("#fechasalida").val()
				,"fechapago": $("#fechasalida").val()
				,"indmaterialservicio": "M"
				,"idtipoorden": {{ config('constants.tipoventa.comercial') }}
				,"idmodulosistema": ''
				,"idtipopago": {{ config('constants.tipopago.contado') }}
				,"idmoneda": {{ config('constants.moneda.soles') }}
				,"idestado": {{ config('constants.estadoventa.generada') }}
				,"idcuenta": 0
				,"idsubcuenta": 0
				,"idmovimiento": 0
				,"tipocambio": 3.5
				,"subtotal": subtotal
				,"impuestovta": impuestototal
				,"total": total
				,"totaldscto": 0
				,"glosa": "VENTA AUTOGENERADA"
				,"idvendedor": $("#idvendedor2").val()
				,"nropedido": $("#nropedido2").val()
				,'idmediopago': {{ config('constants.mediopagocaja.efectivo') }}
				,"detalles": detalles
				,"objdocumento": objdocumento
				,"objmovimientocaja": objmovimientocaja
				,"objordensalida": objordensalida
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../comercial/ordenventa/Guardar",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						if(data.success == true){
							$("#modaldocumentoventa").modal("hide");
							bootbox.alert(data.message);
							//MostrarLista();
							Listar();
							//$('#frmRegistro')[0].reset();
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

		function GenerarOrdenSalida(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			var objordensalida = null;
			var idempresa = "{{Session::get('idempresa')}}";

			objordensalida = ObtenerObjetoOrdenSalida();

			var subtotal = 0;
			var impuestototal = 0;
			var total = 0;

			//Detalles
			var oTable2 = $("#tblDetallesOS").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];
				
			    var cantidad = Number ($("#txtCantidadSalida"+fila).val() );
				var precio = Number ($("#txtPrecioSalida"+fila).val() );
				var valor_vta_igv = Number ( $("#txtTotalSalida"+fila).val() );
				var preciosigv = 0;
				var valor_vta_sigv = 0;
				var impuesto = 0;

				preciosigv = parseFloat( Number (precio) / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(4);
				valor_vta_sigv = parseFloat(Number (preciosigv) * Number (cantidad)).toFixed(4);
				impuesto = parseFloat(Number (valor_vta_igv) - Number (valor_vta_sigv)).toFixed(4);

			    var obj = {
			    	"id": ""
			    	,"idproducto": data["IdMaterial"]
			    	,"nombreproducto": data["Material"]
			    	,"descripcion": data["Material"]
			    	,"idalmacen": ""
			    	,"cantidad": cantidad
			    	,"cantidadpendiente": cantidad
			    	,"precio_unit_sigv": preciosigv
		        	,"precio_unit_igv": precio
		        	,"valor_vta_sigv": valor_vta_sigv
		        	,"valor_vta_igv": valor_vta_igv
					,"indigv": 1
					,"idunidadmedida": data["IdUM"]
					,"unidadmedida": data["UnidadMedida"]
		        	,"dscto": 0
		        	,"activo": 1
			    }
		       	detalles[c] = obj;

		       	subtotal = subtotal + parseFloat(valor_vta_sigv);
		       	impuestototal = impuestototal + parseFloat(impuesto);
		       	total = total + parseFloat(valor_vta_igv);

		       	c++;
			});

			//Cabecera
			var obj = {
				"id": ""
				,"idcliente": idempresa
				,"fecha": $("#fechasalida").val()
				,"fechaentrega": $("#fechasalida").val()
				,"fechapago": $("#fechasalida").val()
				,"indmaterialservicio": "M"
				,"idtipoorden": {{ config('constants.tipoventa.comercial') }}
				,"idmodulosistema": ''
				,"idtipopago": {{ config('constants.tipopago.contado') }}
				,"idmoneda": {{ config('constants.moneda.soles') }}
				,"idestado": {{ config('constants.estadoventa.generada') }}
				,"tipocambio": 3.5
				,"subtotal": subtotal
				,"impuestovta": impuestototal
				,"total": total
				,"totaldscto": 0
				,"glosa": "VENTA AUTOGENERADA"
				,"idvendedor": $("#idvendedor2").val()
				,"nropedido": $("#nropedido2").val()
				,'idmediopago': {{ config('constants.mediopagocaja.efectivo') }}
				,"detalles": detalles
				,"objordensalida": objordensalida
			};



			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../comercial/ordenventa/GenerarOrdenSalida",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						if(data.success == true){
							$("#modaldocumentoventa").modal("hide");
							bootbox.alert(data.message);
							//MostrarLista();
							Listar();
							//$('#frmRegistro')[0].reset();
							resp = "ok";
						}else{
							bootbox.alert(data.message);
						}
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




		function ObtenerPrecioProducto(idproducto) {
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"id":idproducto},
				url: "{{ URL::to('intranet/configuracion/material/Leer') }}",
				dataType: "json",
				beforeSend: function (data) {
					$("#preciobusqueda").val(0);
					$("#stockbusqueda").val(0);
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#preciobusqueda").val(val["precioventa"]);
							$("#stockbusqueda").val(val["stock"]);
						});
					}else{
						$("#preciobusqueda").val(0);
						$("#stockbusqueda").val(0);
					}
				},
				complete: function(){
				} 
			});
			//=================== ********* ====================
		}



	</script>	
@stop
