@section('title-page')
	ErpWeb | Movimientos de Caja / Bancos
@stop

@extends('plantilla_rpt')

@section('titulo-form')
	Reporte de Movimientos de Caja / Bancos <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Movimientos Caja / Bancos</a></li>
		<li class="active">Reportes</li>
	</ol>
@stop

@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  	<div>
					  		<div class="col-md-12">
					  			<div class="col-md-12">
					  				<button type="button" id="btnBuscarMovimientos" name="btnBuscarMovimientos" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
									<a type="button" id="btnExportar" name="btnExportar" class="btn btn-danger btn-sm"><i class="fa fa-excel"></i> PDF</a>
									<button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i class="fa fa-excel"></i> XLS</button>
					  			</div>
					  		</div>
					  		</br>
					  	</div>
					  	<div>
					  		<div class="col-md-12">
								<div class="col-md-6">
									<label for="">Caja/Banco</label>
									<select class="form-control select2" style="width: 100%;" id='idcajabanco' name="idcajabanco" ></select>
								</div>
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
									<table id="tblDatos" class="table table-bordered table-hover">
										<thead>
										<th></th>
										<th>Fecha Mov.</th>
										<th>Fecha Op.</th>
										<th>Afecta</th>
										<th>Glosa</th>
										<th>Ingreso</th>
										<th>Egreso</th>
										<th>Saldo</th>
										<th>Descripción</th>
										<th>Medio Pago</th>
										<th>N° Voucher</th>
										</thead>
										<tbody>

										</tbody>
										<tfoot>
								            <tr>
								            	<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<!--
								                <th colspan="5" style="text-align:right">Total</th>
								                <th></th>
								                -->
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
			InicializarFormulario();
			CargarComboEmpresa();
			CargarComboTipoDocumento();
			CargarComboCajas("C");

			function InicializarTabla() {

				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				var groupColumn = 9;
				var Table = $('#tblDatos').dataTable({
					"info": false,
					"order": false,
					"search": false,
					"processing": true,
					"bPaginate" : false,
					"aoColumns": [{
							"sWidth": "5%", "mDataProp": "Id"
						}, {
							"sWidth": "8%", "mDataProp": "FechaMov"
						}, {
							"sWidth": "8%", "mDataProp": "FechaOp"
						}, {
							"sWidth": "20%", "mDataProp": "Afecta"
						}, {
							"sWidth": "20%", "mDataProp": "Glosa"
						},{
							"sWidth": "10%", "mDataProp": "Ingreso"
						},{
							"sWidth": "10%", "mDataProp": "Egreso"
						},{
							"sWidth": "10%", "mDataProp": "Saldo"
						},{
							"sWidth": "10%", "mDataProp": "Descripcion"
						},{
							"sWidth": "15%", "mDataProp": "MedioPago"
						},{
							"sWidth": "7%", "mDataProp": "NroVoucher"
						}],
					"order": [[ 0, "asc" ]],
					'columnDefs':[
						{
							"targets": [5,6,7],
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
			            totalingreso = api.column( 5 )
			                .data()
			                .reduce( function (a, b) {
			                    return (parseFloat(a) + parseFloat(b)).toFixed(2);
			                }, 0 );
			 			// Total over all pages
			            totalegreso = api.column( 6 )
			                .data()
			                .reduce( function (a, b) {
			                    return (parseFloat(a) + parseFloat(b)).toFixed(2);
			                }, 0 );


			            // Total over this page

			            // Update footer
			            $( api.column( 5 ).footer() ).html(
			                //'S/ '+pageTotal +' ( $'+ total +' total)'
			                'S/ '+totalingreso
			            );
			            $( api.column( 6 ).footer() ).html(
			                //'S/ '+pageTotal +' ( $'+ total +' total)'
			                'S/ '+totalegreso
			            );
			        },
			        'drawCallback': function ( settings ) {
			            var api = this.api();
			            var rows = api.rows( {page:'current'} ).nodes();
			            var last=null;
			 			
			            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
			                if ( last !== group ) {
			                    $(rows).eq( i ).before(
			                        '<tr class="subgroup"><td colspan="12">'+group+'</td></tr>'
			                    );
			 
			                    last = group;
			                }
			            } );
			            /*
			            api.column(3, {page:'current'} ).data().each( function ( group, i ) {
			                if ( last !== group ) {
			                    $(rows).eq( i ).before(
			                        '<tr class="subgroup"><td colspan="6">'+group+'</td></tr>'
			                    );
			 
			                    last = group;
			                }
			            } );
						*/
			        }
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

			$("#btnBuscarMovimientos").on("click", function(event) {
				Listar();
			});
			
			

		});
		
	
		function InicializarFormulario(){
			$('#fechaini').datepicker({
                format: 'yyyy-mm-dd'
            });
			$('#fechaini').datepicker("setDate", new Date());
			$('#fechafin').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechafin').datepicker("setDate", new Date());
		}

		function CargarComboCajas($tipo) {
            var $combo = $("#idcajabanco");
            $combo.empty();
            $.post('../tesoreria/cajabanco/Listar',{"indcajabanco":$tipo},
                    function (data) {
                    	//$combo.append("<option value=''>TODOS</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
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
			var url = "../reportes/movimientoscaja";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idcajabanco":$("#idcajabanco").val(),"fechaini":$("#fechaini").val(),"fechafin":$("#fechafin").val()},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTable = $("#tblDatos").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						console.log("aqui");
						$.each(data.lista, function (key, val) {
							console.log("aqui");
							var obj = {"Id": val["id"]
									,"FechaMov": val["fechamovimiento"]
									,"FechaOp": val["fechaoperacion"]
									,"Afecta": val["afecta"]
									,"Glosa": val["glosa"]
									,"Ingreso": val["ingreso"]
									,"Egreso": val["egreso"]
									,"Saldo": val["saldo"]
									,"Descripcion": val["descripcion"]
									,"MedioPago": val["mediopago"]
									,"NroVoucher": val["nrovoucher"]
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