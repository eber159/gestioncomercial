@section('title-page')
	ErpWeb | Reporte Alertas
@stop

@extends('plantilla_rpt')

@section('titulo-form')
	Reporte Alertas <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Reporte de Proveedores </a></li>
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
					  				<button type="button" id="btnBuscarMovimientos" name="btnBuscarMovimientos" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Refrescar Datos </button>
					  			</div>
					  		</div>
					  		</br>
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
									<table id="tblDatos" class="table table-bordered table-hover" style="width: 100%;">
										<thead>
											<th>Fecha Inicia</th>
											<th>Fecha Fin</th>
											<th>Referencia</th>
											<th>Cliente</th>
											<th>Descripción</th>
											<th>Vigencia</th>
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
	</section>
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			$('.select2').select2()
			InicializarTabla();
			InicializarFormulario();
			CargarComboEmpresa();
			CargarComboTipoDocumento();
			Listar();

			function InicializarTabla() {

				//var Table = $('#tblRecursos').dataTable().fnDestroy();
				/*
				var Table = $('#tblDatos').dataTable({
					"info": false,
					"order": false,
					"search": false,
					"bPaginate" : false,
					"bAutoWidth": false,
					"aoColumns": [{
							"sWidth": "5%", "mDataProp": "Codigo"
						}, {
							"sWidth": "7%", "mDataProp": "TipoDocumento"
						}, {
							"sWidth": "7%", "mDataProp": "NumeroDocumento"
						}, {
							"sWidth": "15%", "mDataProp": "Nombre"
						}, {
							"sWidth": "10%", "mDataProp": "TipoEmpresa"
						}, {
							"sWidth": "10%", "mDataProp": "Direccion1"
						},{
							"sWidth": "10%", "mDataProp": "Direccion2"
						},{
							"sWidth": "5%", "mDataProp": "Telefono1"
						},{
							"sWidth": "5%", "mDataProp": "Telefono2"
						},{
							"sWidth": "5%", "mDataProp": "Correo"
						}],
					"order": [[ 3, "asc" ]],
				});*/
				
				var Table = $('#tblDatos').DataTable( {
					"columns": [
		            	{ "data": 'FechaIni',"visible": true},
		            	{ "data": 'FechaFin'},
		            	{ "data": 'Referencia'},
		            	{ "data": 'Cliente'},
		            	{ "data": 'Descripcion'},
		            	{ "data": 'Vigencia'},
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

		function Listar() {
			var url = "../reportes/alertas";
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
							var obj = {
									"FechaIni": val["start"]
									,"FechaFin": val["end"]
									,"Cliente": val["cliente"]
									,"Descripcion": val["description"]
									,"Referencia": val["title"]
									,"Vigencia": val["vigente"]
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


	</script>	
@stop