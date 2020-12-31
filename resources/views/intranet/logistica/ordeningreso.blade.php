@section('title-page')
	ErpWeb | Gestión Orden Ingreso
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Orden Ingreso <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Orden Ingreso</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('contenido')
	
	<style>
	    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
	        font-family: "Helvetica", "Helvetica", sans-serif;
	        padding-top: 1px;
	        padding-bottom: 1px;
	        padding-left: 5px;
	        padding-right: 5px;
	        line-height: 1.42857143;
	        vertical-align: top;
	        border-top: 1px solid #ddd;
	        font-weight: normal;
	        font-size: 12px;
	    }
    </style>

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
												<th>Codigo</th>
												<th>Fecha</th>
												<th>Propietario</th>
												<th style='display:none'>Administra</th>
												<th>Estado</th>
												<th>Movimiento</th>
												<th>Glosa</th>
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
					  <h3 class="box-title">Datos Principales</h3>
					  <div style="float: right; display:inline-block">
					  		<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
							<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
					   </div>
					</div>
					<form role="form" id="frmRegistro" >
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Codigo</label>
										<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo Autogenerable" style="width: 100%">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Estado</label>
										<select class="form-control" id="idestado" name="idestado" disabled="disabled">
											<option value=""></option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Fecha</label>
										<input type="text" class="form-control" id="fechaorden" name="fechaorden" style="width: 100%">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label for="">Movimiento</label>
										<div class="input-group input-group-sm">
											<select class="form-control select2" style="width: 100%;" id='idmovimientoinventario' name="idmovimientoinventario" ></select>
											<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Propietario</label>
										<div class="input-group input-group-sm">
											<select class="form-control select2" style="width: 100%;" id='idempresapropietario' name="idempresapropietario" ></select>
											<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-6" style="display: none">
									<div class="form-group">
										<label for="">Administra</label>
										<div class="input-group input-group-sm">
											<select class="form-control select2" style="width: 100%;" id='idempresaadministra' name="idempresaadministra" ></select>
											<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Observaciones</label>
										<input type="text" class="form-control" id="glosa" name="glosa" placeholder="Observaciones" style="width: 100%">
									</div>
								</div>
							</div>

							
							<div class="row">
								<div class="col-md-12">
									<div class="nav-tabs-custom">
							            <ul class="nav nav-tabs">
							              <li class="active"><a href="#tab_1" data-toggle="tab">Productos</a> </li>
							            </ul>
							            <div class="tab-content">
							            <div class="tab-pane active" id="tab_1">
							            	<div class="row">
												<div class="col-md-4">
													<label for="">Material</label>
													<div class="input-group input-group-sm">
										                <select class="form-control select2" style="width: 100%;" id='pidmaterial' name="pidmaterial" ></select>
									                    <span class="input-group-btn">
									                      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
									                    </span>
										             </div>
												</div>
												<div class="col-md-4">
													<label for="">Almacen</label>
													<div class="input-group input-group-sm">
										                <select class="form-control select2" style="width: 100%;" id='pidalmacen' name="pidalmacen" ></select>
									                    <span class="input-group-btn">
									                      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
									                    </span>
										             </div>
												</div>
												<div class="col-md-4">
													<label for="">Unid. Medida</label>
													<select class="form-control" style="width: 100%;" id='pidunidadmedida' name="pidunidadmedida" >
														@foreach ($unidades as $u)
															<option value="{{ $u->id }}">{{ $u->nombre }}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label for="">Cantidad</label>
														<input type="number" class="form-control" id="pcantidad" name="pcantidad" placeholder="Cantidad" style="width: 100%">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label for="">Costo</label>
														<input type="number" class="form-control" id="pcosto" name="pcosto" placeholder="Costo" style="width: 100%">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label for="">Fecha Venc.</label>
														<input type="text" class="form-control" id="fechavencimiento" name="fechavencimiento" placeholder="Fecha" style="width: 100%">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label for="">Nro. Lote</label>
														<input type="text" class="form-control" id="nrolote" name="nrolote" placeholder="Lote" style="width: 100%">
													</div>
												</div>

												<div class="col-md-2">
												&nbsp;
													<div class="form-group">
														<label for="">&nbsp;</label>
														<button type="button" id="btnAgregarProducto" name="btnAgregarProducto" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Agregar Producto </button>
													</div>
												</div>
											</div>

											<div class="row">
								            	<div class="col-md-12">
								            		<div class="col-md-12">
								            			<table id="tblDetalles" class="table table-bordered table-hover" style="width: 100%">
			                                                <thead>
			                                                <th style=''></th>
			                                                <th style='display:none'></th>
			                                                <th style='display:none'></th>
			                                                <th>Producto</th>
			                                                <th style='display:none'></th>
			                                                <th>Almacen</th>
															<th>Fecha Vence</th>
															<th>Nro. Lote</th>
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
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>

	<script>
		var Boleta ={{ config('constants.tipodocumento.boleta') }};
		var Factura ={{ config('constants.tipodocumento.factura') }};
		var lotedefecto = {{config('constants.generales.lotedefecto')}};
		var tipoingreso = {{config('constants.tipoordeningresosalida.ingreso')}};
		var estadooiosterminado = {{config('constants.estadooios.terminado')}};
		var estadooiosgenerado = {{config('constants.estadooios.generado')}};
		var idempresa = "{{ Session::get('idempresa') }}";
	</script>

	<!--<script src="{{ URL::to('../resources/views/logistica/js/ordeningreso.js')}}"></script>-->


	<script type="text/javascript">

		$(function () {		// inicializar controles
		  $('.select2').select2()
		  $('#fechaorden').datepicker({
		    format: 'yyyy-mm-dd'
		  })

		  $('#fechavencimiento').datepicker({
		    format: 'yyyy-mm-dd'
		  })

		  CargarComboEstado()
		  CargarComboMovimientoInventario()
		  CargarComboPropietario()
		  CargarComboAdministrador()
		  CargarComboProducto()
		  CargarComboAlmacen()
		  InicializarTabla()
		  InicializarTablaDetalles()
		  Listar()

		  // NUEVO
		  $('#btnNuevo').on('click', function (event) {
		    MostrarRegistro()
		    $('#frmRegistro')[0].reset()
		    $('#id').val('')
		    $('#fechaorden').datepicker('setDate', new Date())
			$('#fechavencimiento').datepicker('setDate', new Date())
		    $('#idestado').val(estadooiosgenerado).trigger('change')
		    $('#idmovimientoinventario').val('').trigger('change')
		    $('#idempresapropietario').val(idempresa).trigger('change')
		    $('#idempresaadministra').val(idempresa).trigger('change')
		    $('#tblDetalles').dataTable().fnClearTable()
		    $('#pcantidad').val(0)
		    $('#pcosto').val(0)
		    $('#pidmaterial').val('').trigger('change')
		    $('#pidalmacen').val('').trigger('change')
		  })

		  // GUARDAR
		  $('#btnGuardar').on('click', function (event) {
		    GuardarIngreso()
		  })

		  // LISTAR
		  $('#btnListar').on('click', function (event) {
		    Listar()
		  })

		  // Agregar Producto
		  $('#btnAgregarProducto').click(function (e) {
		    if (validarAgregarProducto()) {
		      var oTable = $('#tblDetalles').dataTable()
		      var Linea = oTable.fnGetData().length + 1
		      var obj = {
		        'Row': Linea,
		        'Id': '',
		        'IdMaterial': $('#pidmaterial').val(),
		        'Material': $('#pidmaterial').select2('data')[0].text,
		        'IdAlmacen': $('#pidalmacen').val(),
		        'Almacen': $('#pidalmacen').select2('data')[0].text,
				'FechaVence': $('#fechavencimiento').val(),
				'NroLote': $('#nrolote').val(),
		        "IdUM": $("#pidunidadmedida").val(),
		        "UnidadMedida": $("#pidunidadmedida option:selected").text(),
		        'Cantidad': "<input type='number' class='form-control2' value= '" + parseFloat($('#pcantidad').val()).toFixed(2) + "' id='txtCantidad" + Linea + "' name='txtCantidad" + Linea + "' style='text-align: right; width: 100px' >",
		        'Costo': "<input type='number' class='form-control2' value= '" + parseFloat($('#pcosto').val()).toFixed(2) + "' id='txtCosto" + Linea + "' name='txtCosto" + Linea + "' style='text-align: right; width: 100px' >",
		        'Acciones': "<center>" + "<a href='javascript:;' onclick='Quitar(0," + Linea + ")'>" + "<i class='ace-icon fa fa-times bigger-130'></i>" + '</a>&nbsp;' + '</center>',
		        'Estado': 1
		      }
		      oTable.fnAddData(obj)
		      $("input[type='number']").click(function () {
		        $(this).select()
		      })
		      InicializarCantidades()
		    }
		  })

		  $("input[type='number']").click(function () {
		    $(this).select()
		  })
		// FIN ONREADY
		})

		// VALIDACIONES
		function validarAgregarProducto () {
		  var resultado = true
		  var mensaje = ''
		  var oTable2 = $('#tblDetalles').DataTable()
		  oTable2.rows().eq(0).each(function (index) {
		    var row = oTable2.row(index)
		    var data = row.data()
		    var fila = data['Row']

		    var idprod = data['IdMaterial']

		    if (data['Estado'] == 1) {
		      if ($('#pidmaterial').val() == idprod) {
		        mensaje += 'El producto ya existe en la lista <br>'
		        resultado = false
		      }
		    }
		  })

		  if ($('#pidmaterial').val() == '') {
		    mensaje += 'Seleccione un material <br>'
		    resultado = false
		  }

		  console.log($('#pcantidad').val())
		  if ($('#pcantidad').val() == '' || parseFloat($('#pcantidad').val()) <= 0) {
		    mensaje += 'Ingrese una cantidad válida <br>'
		    resultado = false
		  }

		  if (resultado == false) {
		    bootbox.alert(mensaje)
		  }
		  return resultado
		}

		// METODOS
		function Quitar (iddetalle, linea) {
		  bootbox.confirm('¿Seguro que deseas eliminar el registro?', function (result) {
		    if (result) {
		      if (iddetalle == 0) {
		        var oTableDetalles = $('#tblDetalles').dataTable()
		        oTableDetalles.fnDeleteRow(linea - 1)
		        bootbox.alert('Detalle Eliminado')
		      }else {
		        var oTableDetalles = $('#tblDetalles').DataTable()
		        var row = oTableDetalles.row(linea - 1)
		        oTableDetalles.cell(row, 10).data(0).draw()
		      }
		    }
		  })
		}

		function InicializarCantidades () {
		  $('#pcantidad').val(0)
		  $('#pcosto').val(0)
		  $('#pidmaterial').val('').trigger('change')
		  $('#pidalmacen').val('').trigger('change')
		}

		// CARGAR COMBOS

		function CargarComboEstado() {
		  var $combo = $("#idestado");
		  $combo.empty();
		  $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_ORDEN_INGRESO_SALIDA"},
		          function (data) 
		          {
		            $.each(data.lista, function (index, item) {
		            $combo.append("<option value='" + item.id + "'>"
		            + item.nombre + "</option>");
		                        });
		          }, 'json');
		}

		function CargarComboMovimientoInventario() 
		{
		  var $combo = $("#idmovimientoinventario");
		  $combo.empty();
		  $.post('../configuracion/categoria/Listar',{"grupo":"MOVIMIENTO_INVENTARIO", "abreviatura":"I"},
		          function (data) 
		          {
		            $.each(data.lista, function (index, item) {
		            $combo.append("<option value='" + item.id + "'>"
		            + item.nombre + "</option>");
		                        });
		          }, 'json');
		}



		function CargarComboPropietario() {
		  var $combo = $('#idempresapropietario')
		  $combo.empty()
		  $.post('../configuracion/empresa/Listar',
		    function (data) {
		      $combo.append("<option value=''>Seleccione</option>")
		      $.each(data.lista, function (index, item) {
		        $combo.append("<option value='" + item.id + "'>"
		          + item.nombre + '</option>')
		      })
		    }, 'json')
		}

		function CargarComboAdministrador() {
		  var $combo = $('#idempresaadministra')
		  $combo.empty()
		  $.post('../configuracion/empresa/Listar',
		    function (data) {
		      $combo.append("<option value=''>Seleccione</option>")
		      $.each(data.lista, function (index, item) {
		        $combo.append("<option value='" + item.id + "'>"
		          + item.nombre + '</option>')
		      })
		    }, 'json')
		}

		function CargarComboProducto() {
		  var $combo = $('#pidmaterial')
		  $combo.empty()
		  $.post('../configuracion/material/Listar',{"indstock":"1"},
		    function (data) {
		      $combo.append("<option value=''>Seleccione</option>")
		      $.each(data.lista, function (index, item) {
		        $combo.append("<option value='" + item.id + "'>"
		          + item.nombre + '</option>')
		      })
		    }, 'json')
		}

		function CargarComboAlmacen() {
		  var $combo = $('#pidalmacen')
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

		// GUARDAR
		function GuardarIngreso() {
		  // Obtener Objetos
		  var detalles = []
		  var c = 0
		  // Detalles
		  var oTable2 = $('#tblDetalles').DataTable()
		  oTable2.rows().eq(0).each(function (index) {
		    var row = oTable2.row(index)
		    var data = row.data()
		    var fila = data['Row']
		    var obj = {
		      'id': data['Id'],
		      'idmaterial': data['IdMaterial'],
		      'cantidad': $('#txtCantidad' + fila).val(),
		      'idlote': lotedefecto ,
			  'fechavencimiento': data['FechaVence'],
			  'nrolote': data['NroLote'],
		      'costoorigen' : $('#txtCosto' + fila).val(),
		      'costo' : $('#txtCosto' + fila).val(),
		      'idalmacen' : data['IdAlmacen'], 
		      "idunidadmedida": data["IdUM"],
		      'activo': data['Estado']
		    }
		    detalles[c] = obj
		    c++
		  })

		  // Cabecera
		  var obj = {
		    'id': $('#id').val(),
		    'idempresapropietario': $('#idempresapropietario').val(),
		    'idempresaadministra': $('#idempresaadministra').val(),
		    'fechaorden': $('#fechaorden').val(),
		    'idtipo': tipoingreso, //categoria tipo orden ingreso
		    'idestado': $('#idestado').val(),
		    'idmovimientoinventario': $('#idmovimientoinventario').val(),
		    'codigooperacion': '',
		    'idmodulo': '',
		    'glosa':  $('#glosa').val(),
		    'detalles': detalles
		  }

		  var resp = ''
		  $.ajax({
		    type: 'POST',
		    async: false,
		    data: obj,
		    url: '../logistica/ordeningresosalida/Guardar',
		    dataType: 'json',
		    beforeSend: function (data) {},
		    success: function (data) {
		      if (data !== null && typeof data === 'object') {
		        if (data.success == true) {
		          bootbox.alert(data.message)
		          MostrarLista()
		          Listar()
		          $('#frmRegistro')[0].reset()
		          resp = 'ok'
		        }else{
		        	bootbox.alert(data.message);
		        }
		      }else {
		        alert('Ocurrio un error en el registro')
		        resp = 'error'
		      }
		    }
		  })
		  return resp
		}

		// LISTAR

		function Listar() {
		  var url = 'ordeningresosalida/Listar'
		  $.ajax({
		    type: 'POST',
		    async: false,
		    data: { 'idtipo': tipoingreso },
		    url: url,
		    dataType: 'json',
		    beforeSend: function (data) {},
		    success: function (data) {
		      var oTable = $('#tblDatos').dataTable()
		      oTable.fnClearTable()
		      if (data !== null && typeof data === 'object') {
		        $.each(data.lista, function (key, val) {

		        	  var estado = "";
		        	  var accionestado = "";
		        	  if(val["nombreestado"]=="GENERADO"){
		        	  	estado = "<span class='label label-default'>GENERADO</span>";
		        	  	accionestado = '<a href=\'javascript:;\' onclick=\'EditarIngreso("ordeningresosalida/Leer","True",' + val['id'] + ")' class='btn btn-xs btn-success'>"
			              + "<i class='ace-icon fa fa-send bigger-130'></i> Ejecutar"
			              + '</a>&nbsp;';
		        	  }
		        	  if(val["nombreestado"]=="TERMINADO"){
		        	  	estado = "<span class='label label-success'>TERMINADO</span>";
		        	  	accionestado = '';
		        	  }

			          var obj = {
			            'Id': val['id'],
			            'Codigo': val['codigo'] ,
			            'Fecha': val['fechaorden'],
			            'Propietario': val['nombreempresapropietario'],
			            'Administra': val['nombreempresaadministra'],
			            'Estado': estado,
			            'Movimiento': val['nombremovimientoinventario'],
			            'Glosa': val['glosa'],
			            'Acciones': "<center>"
			              + '<a href=\'javascript:;\' onclick=\'EditarIngreso("ordeningresosalida/Leer","False",' + val['id'] + ")' class='btn btn-xs btn-primary'>"
			              + "<i class='ace-icon fa fa-pencil bigger-130'></i> Editar "
			              + '</a>&nbsp;'
			              + accionestado
			              + '<a href=\'javascript:;\' onclick=\'Eliminar("ordeningresosalida/Eliminar",' + val['id'] + ")' class='btn btn-xs btn-danger'>"
			              + "<i class='ace-icon fa fa-times bigger-130'></i> Eliminar"
			              + '</a>'
			            + '</center>'}
			          oTable.fnAddData(obj)
		        })
		      }
		    }
		  })
		// =================== ********* ====================
		}

		function EditarIngreso (url,ejecutar,id) {
		  $('#frmRegistro')[0].reset()
		  var info = ''
		  $.ajax({
		    type: 'POST',
		    async: false,
		    data: {'id': id},
		    url: url,
		    dataType: 'json',
		    beforeSend: function (data) {},
		    success: function (data) {
		      var oTableDetalles = $('#tblDetalles').dataTable()
		      oTableDetalles.fnClearTable()
		      if (data !== null && typeof data === 'object') {
		        $.each(data.obj, function (key, val) {
		          $('#id').val(val['id'])
		          $('#codigo').val(val['codigo'])
		          $('#idempresapropietario').val(val['idempresapropietario']).trigger('change')
		          $('#idempresaadministra').val(val['idempresaadministra']).trigger('change')
		          $('#idmovimientoinventario').val(val['idmovimientoinventario']).trigger('change')
		          $('#fechaorden').datepicker('setDate', val['fechaorden'])
		          $('#idestado').val(val['idestado']).trigger('change')
		          if (ejecutar == "True")
		          {
		            console.log(ejecutar);
		            $('#idestado').val(estadooiosterminado).trigger('change')
		          }

		          if( val["idestado"]==estadooiosterminado ){
		          	$("#btnGuardar").css("display", "none");
		          }
		          if( val["idestado"]==estadooiosgenerado ){
		          	$("#btnGuardar").css("display", "inline-block");
		          }

		          $('#glosa').val(val['glosa'])
		          var Linea = 1
		          $.each(data.detalles, function (key, val2) {
		            var oTableDetalles = $('#tblDetalles').dataTable()
		            var objdet =
		            {
		              'Row': Linea,
		              'Id': val2['id'],
		              'IdMaterial': val2['idmaterial'],
		              'Material': val2['nombrematerial'],
		              'IdAlmacen': val2['idalmacen'],
		              'Almacen': val2['nombrealmacen'],
					  'FechaVence': val2['fechavencimiento'],
		              'NroLote': val2['nrolote'],
		              "IdUM": val2["idunidadmedida"],
		              "UnidadMedida": val2["unidadmedida"],
		              'Cantidad': "<input type='number' class='form-control2' value= '" + parseFloat(val2['cantidad']).toFixed(2) + "' id='txtCantidad" + Linea + "' name='txtCantidad" + Linea + "' style='text-align: right; width: 100px' >",
		              'Costo': "<input type='number' class='form-control2' value= '" + parseFloat(val2['costo']).toFixed(2) + "' id='txtCosto" + Linea + "' name='txtCosto" + Linea + "' style='text-align: right; width: 100px' >",
		              'Acciones': "<center>"
		                + "<a href='javascript:;' onclick='Quitar(" + val2['id'] + ',' + Linea + ")'>"
		                + "<i class='ace-icon fa fa-times bigger-130'></i>"
		                + '</a>&nbsp;'
		                + '</center>',
		              'Estado': 1
		            }
		            oTableDetalles.fnAddData(objdet)
		            Linea++
		          })
		          MostrarRegistro()
		        })
		      }
		    },
		    complete: function () {

		    }
		  })
		// =================== ********* ====================
		}

		function InicializarTabla () {
		  // var Table = $('#tblRecursos').dataTable().fnDestroy()
		  var Table = $('#tblDatos').dataTable({
		    'info': false,
		    'order': false,
		    'search': false,
		    'aoColumns': [{
		      'bVisible': false, 'mDataProp': 'Id'
		    }, {
		      'bVisible': true, 'sWidth': '5%', 'mDataProp': 'Codigo'
		    }, {
		      'sWidth': '5%', 'mDataProp': 'Fecha'
		    }, {
		      'sWidth': '20%', 'mDataProp': 'Propietario'
		    }, {
		      'bVisible': false, 'sWidth': '20%', 'mDataProp': 'Administra'
		    }, {
		      'sWidth': '10%', 'mDataProp': 'Estado'
		    }, {
		      'sWidth': '20%', 'mDataProp': 'Movimiento'
		    }, {
		      "bVisible": false, 'sWidth': '20%', 'mDataProp': 'Glosa'
		    }, {
		      'sWidth': '20%', 'mDataProp': 'Acciones'
		    }]
		  })
		}

		function InicializarTablaDetalles () {
		  var Table = $('#tblDetalles').dataTable({
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
		    }, {
		      'bVisible': false, 'mDataProp': 'IdAlmacen'
		    }, {
		      'sWidth': '40%', 'mDataProp': 'Almacen'
		    },{
		      'sWidth': '10%', 'mDataProp': 'FechaVence'
		    },{
		      'sWidth': '10%', 'mDataProp': 'NroLote'
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

	</script>
	
@stop