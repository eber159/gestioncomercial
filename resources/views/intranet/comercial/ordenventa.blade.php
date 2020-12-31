@section('title-page')
	ErpWeb | Gestión Venta
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Registro de Ventas <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="{{ URL::to('productos/0') }}"><i class="fa fa-globe"></i> IR A LA TIENDA</a></li>
		<li><a href="#"><i class="fa fa-dashboard"></i> Ventas</a></li>
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
									<table id="tblDatos" class="table table-bordered table-hover" >
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th>Fecha</th>
												<th>Codigo</th>
												<th>Cliente</th>
												<th>Moneda</th>
												<th>Monto (S/)</th>
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
								<input type="text" class="form-control" id="fecha" name="fecha" placeholder="" style="width: 100%">
							</div>
							&nbsp;
							<label for="">T.C.</label>
							<div class="form-group" style="display: inline-block; width: 10%">
								<input type="number" class="form-control" id="tipocambio" name="tipocambio" placeholder="" style="width: 100%; text-align: right;">
							</div>
							&nbsp;
							<label for="">Tipo Venta</label>
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
										<label for="">Pedido</label>
										<div class="input-group input-group-sm">
							                <input type="text" class="form-control" style="width: 100%;" id='nropedido' name="nropedido" />
						                    <span class="input-group-btn">
						                      <button type="button" id="btnBuscarPedido" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
						                    </span>
							             </div>
									</div>

									<div class="col-md-6">
										<label for="">&nbsp;</label>
										<div class="input-group input-group-sm">
							                <input type="checkbox" style="width: 100%;" id='chkGenerarDocumento' name="chkGenerarDocumento" /> Generar Documento
							             </div>
									</div>

									<div class="col-md-12">
										<label for="">Cliente</label>
										<div class="input-group input-group-sm">
							                <select class="form-control select2" style="width: 100%;" id='idcliente' name="idcliente" >
							                	@foreach ($clientes as $c)
													<option value="{{ $c->id }}">{{ $c->nombre }}</option>
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
											<label for="">Fecha Entrega</label>
											<input type="text" class="form-control" id="fechaentrega" name="fechaentrega" placeholder="" style="width: 100%">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="col-md-4">
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
											<label for="">Medio Pago</label>
											<select class="form-control" id="idmediopago" name="idmediopago">
												@foreach ($mediopago as $m)
													<option value="{{ $m->id }}">{{ $m->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Fecha Pago</label>
											<input type="text" class="form-control" id="fechapago" name="fechapago" placeholder="" style="width: 100%">
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
							              <li class="active"><a href="#tab_1" data-toggle="tab">Productos</a> </li>
										  <li class=""><a href="#tab_2" data-toggle="tab">Documentos</a> </li>
										  <li class=""><a href="#tab_3" data-toggle="tab">Despachos</a> </li>
							            </ul>
							            <div class="tab-content">
								            <div class="tab-pane active" id="tab_1">
								            	<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-6">
										            		<label for="">Producto</label>
										            		<div class="input-group input-group-sm" id="divNombre">
											            		<select class="form-control select2" style="width: 100%;" id='idproductobusqueda' name="idproducto" >
																	<option value="">SELECCIONE</option>
																	@foreach ($productos as $p)
																		<option value="{{ $p->id }}">{{ $p->nombre }}</option>
																	@endforeach
																</select>
										            			<span class="input-group-btn">
																	<button type="button" id="btnConsultarPrecios" class="btn btn-info btn-flat"><i class="fa fa-search"></i>Precios</button>
																	<button type="button" id="btnVerStock" class="btn btn-default btn-default">STOCK</button>
																	<button type="button" id="btnVerImagen" class="btn btn-default btn-flat"><i class="fa fa-image"></i></button>
																</span>

										            		</div>
										            	</div>
														<div class="col-md-2">
										            		<label for="">Unidad Medida</label>
										            		<select class="form-control" style="width: 100%;" id='idunidadmedida' name="idunidadmedida" >
																<option value="">SELECCIONE</option>
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
															<button type="button" id="btnAgregarProducto" name="btnAgregarProducto" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Agregar </button>
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
																<th style='display:none'>IdUM</th>
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
											<div class="tab-pane" id="tab_3">
												<div class="row">
								            		<div class="col-md-12">
								            			<div class="col-md-12">
								            				<button type="button" id="btnGenerarDespacho" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Generar Despacho </button>
															<div class="table-responsive">
								            				<table id="tblOrdenes" class="table table-bordered table-hover" style="width: 100%">
			                                                    <thead>
																	<tr>
																		<th style="display:none">Id</th>
																		<th>Código</th>
																		<th>Fecha</th>
																		<th>Movimiento</th>
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
			InicializarTabla();
			InicializarTablaDetalles();
			InicializarTablaDocumentos();
			InicializarTablaOrdenes();
			InicializarTablaDetallesSalidas();
			Listar();
			//CargarComboMoneda();
			//CargarComboTipoPago();
			//CargarComboEstadoOrden();
			//CargarComboTipoVenta();
			//CargarComboProducto();
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
							"sWidth": "10%", "mDataProp": "Fecha"
						}, {
							"sWidth": "10%", "mDataProp": "Codigo"
						}, {
							"sWidth": "30%", "mDataProp": "Cliente"
						}, {
							"sWidth": "10%", "mDataProp": "Moneda"
						},{
							"sWidth": "10%", "mDataProp": "Total"
						},{
							"sWidth": "5%", "mDataProp": "Estado"
						},{
							"sWidth": "25%", "mDataProp": "Acciones"
						}],
					'columnDefs':[
						{
						    "targets": [5],
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

			function InicializarTablaOrdenes() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var Table = $('#tblOrdenes').dataTable({
					"bInfo": false,
					"bFilter": false,
					"bPaginate": false,
					"bSort": false,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						}, {
							"sWidth": "10%", "mDataProp": "Codigo"
						}, {
							"sWidth": "10%", "mDataProp": "Fecha"
						}, {
							"sWidth": "20%", "mDataProp": "Movimiento"
						},{
							"sWidth": "10%", "mDataProp": "Total"
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
				      'sWidth': '10%', 'mDataProp': 'Costo'
				    }, {
				      'sWidth': '10%', 'mDataProp': 'Acciones'
				    }, {
				      'bVisible': false, 'sWidth': '10%', 'mDataProp': 'Estado'
				    }]
				})
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

			function buscarCuenta(idtitutar){
				var $combo = $("#idcuenta");
				$combo.empty();
				$.post('../comercial/cuenta/ListarTitular',{"idtitular":idtitutar},
				function (data) {
					$.each(data.lista, function (index, item) {
						$combo.append("<option value='" + item.id + "'>" + item.codigo + " - " + item.moneda + "</option>");
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
				$("#idtipoorden").val({{ config('constants.tipoventa.comercial') }});
				$("#idestado").val({{ config('constants.estadoventa.generada') }});

				MostrarRegistro();
				$("#id").val("");
				$('#fecha').datepicker({
                	format: 'yyyy-mm-dd'
	            }).attr('readonly', 'readonly');
	            $('#fecha').datepicker("setDate", new Date());

	            $('#fechaentrega').datepicker({
	                format: 'yyyy-mm-dd'
	            });
	            $('#fechaentrega').datepicker("setDate", new Date());

	            $('#fechapago').datepicker({
	                format: 'yyyy-mm-dd'
	            });
	            $('#fechapago').datepicker("setDate", new Date());
	            $.post('../configuracion/tipocambio/Listar',{"fecha":$('#fecha').val()},
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
				$("#chkGenerarPago").iCheck('check');
				$("#chkGenerarSalida").iCheck('check');
                InicializarCantidades();
			});

			$("#btnGuardar").on("click", function(event) {
				if(validarGuardar()){
					if($("#chkGenerarDocumento").is(':checked')){
						CargarTipoDocumento();
						CargarSeries();
						CagarDatosCliente();
						CargarComboCajas();
						CargarComboAlmacen();
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
				,"idtipocompraventa": 1
				,"idmaterialservicio": {{ config('constants.materialservicio.material') }}
				,"serie": $("#serie").val()
				,"numero": $("#nrodocumento").val()
				,"fechaemision": $("#fecha").val()
				,"fechavencimiento": $("#fechapago").val()
				,"glosa": $("#glosa").val()
				,"tasaimpuesto": {{ config('constants.generales.impuesto') }}
				,"nogravadas": 0
				,"subtotal": $("#subtotal").val()
				,"impuesto": $("#impuestovta").val()
				,"total": $("#total").val()
				,"saldo": $("#total").val()
				,"operador": 1
				,"indextorno": 0
				,"direcciondestino":$("#direccionfactura").val()
				,"detalles": detalles
			};
			return obj;
		}

		function ObtenerObjetoMovimientoCaja(){
			//Cabecera
			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"fechamovimiento" : $("#fecha").val()
				,"fechaoperacion" : $("#fecha").val()
				,"idtipomovimiento" : {{ config('constants.tipomovimientocaja.ingreso') }}
				,"idestadomovimiento" : {{ config('constants.estadomovimientocaja.confirmado') }}
				,"idemprafecta" : $("#idcliente").val()
				,"idsubcuenta" : $("#idsubcuenta").val()
				,"idcajabanco" : $("#idcajabanco").val()
				,"nroctactble" : ""
				,"idmediopago" : {{ config('constants.mediopagocaja.efectivo') }}
				,"fechacheque" : "01/01/1901"
				,"nrovoucher" : ""
				,"idmoneda" : $("#idmoneda").val()
				,"tipocambio" : $("#tipocambio").val()
				,"debe_mn" : $("#total").val()
				,"haber_mn" : 0
				,"debe_me" : ($("#total").val()*$("#tipocambio").val())
				,"haber_me" : 0
				,"iddetalleextorno" : ""
				,"glosa" : "COBRO AUTOMÁTICO"
				,"referencia" : ""
				,"tiporeferencia" : ""
				,"idmovimientoorigendestino" : ""
			};
			return obj;
		}


		function ObtenerObjetoOrdenSalida(){
			//Obtener Objetos
			var detalles = []
			var c = 0
			 // Detalles
			var idempresa = "{{Session::get('idempresa')}}";

			var oTable2 = $('#tblDetalles').DataTable()
			oTable2.rows().eq(0).each(function (index) {
				var row = oTable2.row(index)
			    var data = row.data()
			    var fila = data['Row']
			    var obj = {
			      'id': data['Id'],
			      'idmaterial': data['IdProducto'],
			      'cantidad': $('#txtCantidad' + fila).val(),
			      'idlote': {{config('constants.generales.lotedefecto')}} ,
			      'costoorigen' : $('#txtPrecioUnitIgv' + fila).val(),
			      'costo' : $('#txtPrecioUnitIgv' + fila).val(),
			      'idalmacen' : $('#idalmacen').val(), 
			      "idunidadmedida": data["IdUM"],
			      'activo': 1
			    }
			    detalles[c] = obj
			    c++
			})

			//Cabecera
			var obj = {
			    'id': $('#id').val(),
			    'idempresapropietario': idempresa,
			    'idempresaadministra': idempresa,
			    'fechaorden': $('#fecha').val(),
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


		function GuardarVenta(){
			//Obtener Objetos
			var detalles = [];
			var c = 0;
			var objdocumento = null;
			var objmovimientocaja = null;
			var objordensalida = null;

			if($("#chkGenerarDocumento").is(':checked')){
				objdocumento = ObtenerObjetoDocumento();
			}
			if($("#chkGenerarPago").is(':checked')){
				objmovimientocaja = ObtenerObjetoMovimientoCaja();
			}
			if($("#chkGenerarSalida").is(':checked')){
				objordensalida = ObtenerObjetoOrdenSalida();
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
				,"subtotal": $("#subtotal").val()
				,"impuestovta": $("#impuestovta").val()
				,"total": $("#total").val()
				,"totaldscto": $("#totaldscto").val()
				,"glosa": $("#glosa").val()
				,"idvendedor": $("#idvendedor").val()
				,"nropedido": $("#nropedido").val()
				,'idmediopago': $("#idmediopago").val()
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


		function GenerarOrdenSalida(){
			//Obtener Objetos
			var detalles_salida = [];
			var detalles_venta = [];
			var c1 = 0;
			var c2 = 0;
			var objdocumento = null;
			
			var idempresa = "{{Session::get('idempresa')}}";

			var oTableDet = $('#tblDetallesOS').DataTable()
			oTableDet.rows().eq(0).each(function (index) {
				var row = oTableDet.row(index);
			    var data = row.data();
			    var fila = data['Row'];
			    console.log(data['Row']);
			    var obj = {
			      'id': "",
			      'idmaterial': data['IdMaterial'],
			      'cantidad': $('#txtCantidadSalida' + fila).val(),
			      'idlote': {{config('constants.generales.lotedefecto')}} ,
			      'costoorigen' : $('#txtCostoSalida' + fila).val(),
			      'costo' : $('#txtCostoSalida' + fila).val(),
			      'idalmacen' : $('#idalmacensalida').val(), 
			      "idunidadmedida": data["IdUM"],
			      'activo': 1
			    }
			    detalles_salida[c1] = obj;
			    c1++;
			});

			//Cabecera
			var objordensalida = {
			    'id': $('#id').val(),
			    'idempresapropietario': idempresa,
			    'idempresaadministra': idempresa,
			    'fechaorden': $('#fecha').val(),
			    'idtipo': {{config('constants.tipoordeningresosalida.salida')}}, //categoria tipo orden ingreso
			    'idestado': {{config('constants.estadooios.terminado')}},
			    'idmovimientoinventario': {{config('constants.movimientoinventario.salidaventas')}},
			    'codigooperacion': '',
			    'idmodulo': '',
			    'glosa':  "SALIDA POR DESPACHO POSTERIOR A VENTA",
			    'detalles': detalles_salida
			 };

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
		       	detalles_venta[c2] = obj;
		       	c2++;
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
				,"subtotal": $("#subtotal").val()
				,"impuestovta": $("#impuestovta").val()
				,"total": $("#total").val()
				,"totaldscto": $("#totaldscto").val()
				,"glosa": $("#glosa").val()
				,"idvendedor": $("#idvendedor").val()
				,"nropedido": $("#nropedido").val()
				,"detalles": detalles_venta
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
							$("#modalsalidas").modal("hide");
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
			var url = "../comercial/ordenventa/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"fechaini":$("#fechaini").val(),"fechafin":$("#fechafin").val()},
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
									,"Fecha": val["created_at"]
									,"Codigo": val["codigo"]
									,"Cliente": val["nombrecliente"]
									,"Moneda": val["moneda"]
									,"Total": val["total"]
									,"Estado": val["estado"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' class='btn btn-default btn-xs' onclick='EditarVenta(\"ordenventa/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i> Editar"
													+"</a>&nbsp;"
													+"<a href='javascript:;' class='btn btn-warning btn-xs' onclick='AnularVenta(\"ordenventa/Anular\","+val["id"]+")' class='red'>"
														+"<i class='ace-icon fa fa-ban bigger-130'></i> Anular"
													+"</a>"
													+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='EliminarVenta(\"ordenventa/Eliminar\","+val["id"]+")' class='red'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i> Eliminar"
													+"</a>"
												+"</div></center>"};
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
					var oTableOrdenes = $("#tblOrdenes").dataTable();
					oTableOrdenes.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#codigo").val(val["codigo"]);
							$("#idcliente").val(val["idcliente"]).trigger('change');
							$('#fecha').datepicker({
			                	format: 'yyyy-mm-dd'
				            }).attr('readonly', 'readonly');
				            $('#fecha').datepicker("setDate", val["fecha"]);
							$("#fechaentrega").val(val["fechaentrega"]);
							$("#fechapago").val(val["fechapago"]);
							$("#indmaterialservicio").val(val["indmaterialservicio"]);
					        $("#idtipoorden").val(val["idtipoorden"]);
					        $("#idtipopago").val(val["idtipopago"]);
					        $("#idmoneda").val(val["idmoneda"]);
							$("#idestado").val(val["idestado"]);
							$("#idmediopago").val(val["idmediopago"]);
							
							var $combo = $("#idcuenta");
							$combo.empty();
							$.post('../comercial/cuenta/ListarTitular',{"idtitular":val["idcliente"]},
							function (data) {
								$combo.append("<option value=''>Seleccione</option>");
								$.each(data.lista, function (index, item) {
									$combo.append("<option value='" + item.id + "'>" + item.codigo + " - " + item.moneda + "</option>");
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
					        $("#idvendedor").val(val["idvendedor"]);
					        $("#nropedido").val(val["nropedido"]);
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
					        });

					         $.each(data.ordenessalida, function (key, val3) {
					        	var oTableOrdenes = $("#tblOrdenes").dataTable();
					            var objdet = {"Id": val3["id"]
					            		,"Codigo": val3["codigo"]
										,"Fecha": val3["fechaorden"]
										,"Movimiento": val3["movimiento"]
										,"Total": (parseFloat(val["total"]).toFixed(2)).toLocaleString('en')
										,"Acciones":"<center>"
														+"<a href='javascript:;' class='btn btn-danger btn-xs' onclick='QuitarOS("+val3["id"]+")'>"
															+"<i class='ace-icon fa fa-times bigger-130'></i>"
														+"</a>&nbsp;"
													+"</center>"
										};
								oTableOrdenes.fnAddData(objdet);
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
            $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_VENTA"},
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

        function CargarComboCajas($tipo) {
            var $combo = $("#idcajabanco");
            $combo.empty();
            $.post('../tesoreria/cajabanco/Listar',{"indcajabanco":$tipo},
                    function (data) {
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

        function CagarDatosCliente() {
        	var $combo = $("#direccionfactura");
            $combo.empty();
            $.post('../configuracion/empresa/Leer',{"id": $("#idcliente").val()},
			function (data) {
				$.each(data.obj, function (index, item) {
					$combo.append("<option value=''>Seleccione</option>");
					if(item.direccion1!="" && item.direccion1!=null){
						$combo.append("<option value='" + item.direccion1 + "'>" + item.direccion1 + "</option>");
					}
					if(item.direccion2!="" && item.direccion2!=null){
						$combo.append("<option value='" + item.direccion2 + "'>" + item.direccion2 + "</option>");
					}
					console.log(item);
				});
			}, 'json');
        }


        function CargarComboAlmacen() {
		  var $combo = $('#idalmacen')
		  $combo.empty()
		  $.post('../logistica/almacen/Listar',
		    function (data) {
		      $combo.append("<option value=''>Seleccione</option>")
		      $.each(data.lista, function (index, item) {
		        $combo.append("<option value='" + item.id + "'>"
		          + item.nombre + '</option>')
		      })
		    }, 'json')
		}

		function CargarComboAlmacenSalidas() {
		  var $combo = $('#idalmacensalida')
		  $combo.empty()
		  $.post('../logistica/almacen/Listar',
		    function (data) {
		      $combo.append("<option value=''>Seleccione</option>")
		      $.each(data.lista, function (index, item) {
		        $combo.append("<option value='" + item.id + "'>"
		          + item.nombre + '</option>')
		      })
		    }, 'json')
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

				    subtotal = (parseFloat(subtotal) + (parseFloat(precio)*parseFloat(cantidad))).toFixed(4);
				    totalneto = (parseFloat(totalneto) + parseFloat(neto)).toFixed(4);
				    totaldscto = (parseFloat(totaldscto) + parseFloat(dscto)).toFixed(4);
					impuesto = (parseFloat(totalneto) - parseFloat(subtotal)).toFixed(4);
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