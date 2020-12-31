@section('title-page')
	ErpWeb | Estado de Cuenta
@stop

@extends('plantilla_rpt')

@section('titulo-form')
	Reporte de Cuentas por Cobrar <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Cuentas por Cobrar</a></li>
		<li class="active">Reportes</li>
	</ol>
@stop

@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  	<div style="float: right;">
					  		<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
							
					  	</div>
					  	<div>
					  		<div class="col-md-5">
								<label for="">Cliente</label>
								<div class="input-group input-group-sm">
					                <select class="form-control select2" style="width: 100%;" id='idclientefiltro' name="idclientefiltro" ></select>
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
				                    </span>
					             </div>
							</div>
							<div class="col-md-5">
								<label for="">Tipo Documento</label>
								<div class="input-group input-group-sm">
					                <select class="form-control" style="width: 100%;" id='idtipodocumentofiltro' name="idtipodocumentofiltro" ></select>
					             </div>
							</div>
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
												<th>Cliente</th>
												<th>Teléfono</th>
												<th>Dirección</th>
												<th>Zona</th>
												<th>Tipo Doc.</th>
												<th>N° Doc.</th>
												<th>Fecha Emisión</th>
												<th>Fecha Venc.</th>
												<th>Sub Total</th>
												<th>Igv</th>
												<th>Total</th>
												<th>Saldo</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
										<tfoot>
								            <tr>
								                <th colspan="9" style="text-align:right">Total por Cobrar:</th>
								                <th></th>
								            </tr>
								        </tfoot>
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
											<input type="text" class="form-control" id="txtSaldocuenta" name="txtSaldocuenta" />
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
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			$('.select2').select2()
			InicializarTabla();
			InicializarTablaDetalles();
			Listar();
			CargarComboEmpresa();
			CargarComboTipoDocumento();


			function InicializarTabla() {
				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				/*
				var Table = $('#tblDatos').dataTable({
					"info": false,
					"order": false,
					"search": false,
					"processing": true,
					"bPaginate" : false,
					"aoColumns": [{
							"bVisible": false, "mDataProp": "Id"
						}, {
							"sWidth": "30%", "mDataProp": "Cliente"
						}, {
							"sWidth": "5%", "mDataProp": "Telefono"
						}, {
							"sWidth": "30%", "mDataProp": "Direccion"
						}, {
							"sWidth": "10%", "mDataProp": "Zona"
						}, {
							"sWidth": "5%", "mDataProp": "TipoDoc"
						}, {
							"sWidth": "15%", "mDataProp": "NroDoc"
						}, {
							"sWidth": "10%", "mDataProp": "FechaEmision"
						}, {
							"sWidth": "10%", "mDataProp": "FechaVence"
						}, {
							"sWidth": "10%", "mDataProp": "SubTotal"
						}, {
							"sWidth": "10%", "mDataProp": "Igv"
						}, {
							"sWidth": "10%", "mDataProp": "Total"
						}, {
							"sWidth": "15%", "mDataProp": "Saldo"
						}],
					"order": [[ 1, "asc" ]],
					'columnDefs':[
						{
							"targets": [9,10,11,12],
						    "className": "text-right",
						    "mRender": function (data, type, full) {
                            	return parseFloat(data).toFixed(2);
                        	}
						}],
					'footerCallback': function ( row, data, start, end, display ) {
			            var api = this.api(), data;
			 
			            // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
			 
			            // Total over all pages
			            total = api
			                .column( 12 )
			                .data()
			                .reduce( function (a, b) {
			                    return (parseFloat(a) + parseFloat(b)).toFixed(2);
			                }, 0 );
			 
			            // Total over this page
			            pageTotal = api
			                .column( 12, { page: 'current'} )
			                .data()
			                .reduce( function (a, b) {
			                    return intVal(a) + intVal(b);
			                }, 0 );
			 
			            // Update footer
			            $( api.column( 9 ).footer() ).html(
			                //'S/ '+pageTotal +' ( $'+ total +' total)'
			                'S/ '+total
			            );
			        }
				});
				*/
				var Table = $('#tblDatos').DataTable( {
					"columns": [
		            	{ "data": 'Id',"visible": false},
		            	{ "data": 'Cliente'},
		            	{ "data": 'Telefono'},
		            	{ "data": 'Direccion'},
		            	{ "data": 'Zona'},
		            	{ "data": 'TipoDoc'},
		            	{ "data": 'NroDoc'},
		            	{ "data": 'FechaEmision'},
		            	{ "data": 'FechaVence'},
		            	{ "data": 'SubTotal'},
		            	{ "data": 'Igv'},
		            	{ "data": 'Total'},
		            	{ "data": 'Saldo'},
		            	],
			        dom: 'Bfrtip',
			        buttons: [
			            'copy', 'csv', 'excel', 'pdf', 'print'
			        ] ,
			        paginate: false,
			    } );

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

			$("input[type='number']").click(function () {
			   $(this).select();
			});
			
			$("#btnNuevo").on("click", function(event) {
				$('#frmRegistro')[0].reset();
				MostrarRegistro();
				$("#id").val("");
				$('#fecha').datepicker({
                	format: 'yyyy-mm-dd'
	            }).attr('readonly', 'readonly');
	            $('#fecha').datepicker("setDate", new Date());
                $("#idestadocuenta").val({{ config('constants.estadocuenta.activo') }});
                $("#idtitular").val('').trigger('change');
                var oTableDetalles = $("#tblDetalles").dataTable();
				oTableDetalles.fnClearTable();
                InicializarCantidades();
			});

			$("#btnGuardar").on("click", function(event) {
				GuardarCuenta();
			});

			$("#btnExportar").on("click", function(event) {
				ExportarPDF();
			});

			$("#btnListar").on("click", function(event) {
				Listar();
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

		function Listar() {
			var form = $('#frmRegistro');
			var url = "../reportes/cuentasporcobrar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idcliente": $("#idclientefiltro").val(), "idtipodocumento":$("#idtipodocumentofiltro").val()},
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
									,"Cliente": val["nombrecliente"]
									,"Direccion": val["direccion"]
									,"Zona": val["zona"]
									,"Telefono": val["telefono1"]
									,"TipoDoc": val["tipodocumento"]
									,"NroDoc": val["nrodocumento"]
									,"FechaEmision": val["fechaemision"]
									,"FechaVence": val["fechavencimiento"]
									,"SubTotal": val["subtotal"]
									,"Igv": val["igv"]
									,"Total": val["total"]
									,"Saldo": val["saldo"]
							};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}

		function ExportarPDF() {
			var form = $('#frmRegistro');
			var idclientefiltro = $("#idclientefiltro").val();
			var idtipodocumentofiltro = $("#idtipodocumentofiltro").val()
			var usuario = "{{ Session::get('nombreusuario') }}";
			var url = "../reportes/cuentasporcobrarexp";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idcliente": idclientefiltro, "idtipodocumento":idtipodocumentofiltro, "tiporeporte":"pdf","usuario":usuario},
				//data: {},
				url: url,
				dataType : 'text',
            	contentType : 'application/pdf',
				beforeSend: function (data) {
					
				},
				success: function (data, status, xhr) {
					var filename = "";
			        var disposition = xhr.getResponseHeader('Content-Disposition');
			        if (disposition && disposition.indexOf('attachment') !== -1) {
			            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
			            var matches = filenameRegex.exec(disposition);
			            if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
			        }

			        var type = xhr.getResponseHeader('Content-Type');
			        var blob = new Blob([data], { type: type });

			        if (typeof window.navigator.msSaveBlob !== 'undefined') {
			            // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
			            window.navigator.msSaveBlob(blob, filename);
			        } else {
			            var URL = window.URL || window.webkitURL;
			            var downloadUrl = URL.createObjectURL(blob);

			            if (filename) {
			                // use HTML5 a[download] attribute to specify filename
			                var a = document.createElement("a");
			                // safari doesn't support this yet
			                if (typeof a.download === 'undefined') {
			                    window.location = downloadUrl;
			                } else {
			                    a.href = downloadUrl;
			                    a.download = filename;
			                    document.body.appendChild(a);
			                    a.click();
			                }
			            } else {
			                window.location = downloadUrl;
			            }

			            setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
			        }
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

        function CargarComboTipoDocumento() {
            var $combo = $("#idtipodocumentofiltro");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_DOCUMENTO"},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboEmpresa() {
            var $combo = $("#idclientefiltro");
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