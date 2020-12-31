@section('title-page')
	ErpWeb | Alerta de Ventas
@stop

@extends('plantilla_rpt')

@section('titulo-form')
	Rerporte Alerta de Ventas <small>Clientes que no tienen ventas en determinados días</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Alerta</a></li>
		<li class="active">Reportes</li>
	</ol>
@stop

@section('contenido')
	<style type="text/css">
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                font-size: 14px;
            }
	</style>
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  	<div style="float:;">
					  		<div class="col-md-12">
					  			<div class="col-md-12">
					  				<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Recargar Reporte </button>
					  			</div>
							</div>
					  	</div>
					  	<div>
							<div class="col-md-12">
								<div class="col-md-2">
									En más de <input type="number" class="form-control" id="dias" name="dias" placeholder="" style="width: 100%"> días
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
												<th>Número Doc.</th>
												<th>Cliente</th>
												<th>Fecha Ultima Venta</th>
												<th>Días Transcurridos</th>
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
	</section>

	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			$('.select2').select2()
			InicializarTabla();
			//InicializarTablaDetalles();
			//CargarComboEmpresa();

			$("#dias").val(30);

            Listar();

			function InicializarTabla() {
				var Table = $('#tblDatos').DataTable( {
					"columns": [
		            	{ "data": 'NumeroDoc', 'width':'15%'},
		            	{ "data": 'Cliente', 'width':'40%'},
		            	{ "data": 'Fecha', 'width':'10%'},
		            	{ "data": 'Dias', 'width':'10%'}
		            	],
			        dom: 'Bfrtip',
			        buttons: [
			            'copy', 'csv', 'excel', 'pdf', 'print'
			        ] ,
			        paginate: false,
			        "order": [[ 3, "asc" ]]
			    } );

			}
			
			function InicializarTablaDetalles() {
				var Table = $('#tblDetalles').DataTable( {
					"columns": [
		            	{ "data": 'Producto', 'width':'40%'},
		            	{ "data": 'Cantidad', 'width':'20%'},
		            	{ "data": 'Total', 'width':'10%'}
		            	],
			        dom: 'Bfrtip',
			        buttons: [],
			        info: false,
			        paginate: false,
			        "order": [[ 0, "asc" ]]
			    } );
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


			$("#btnListar").on("click", function(event) {
				Listar();
			});
			


			
		});


		function Listar() {
			var form = $('#frmRegistro');
			var url = "../reportes/alertaventas";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"dias": $("#dias").val()},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTable = $("#tblDatos").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"NumeroDoc": val["numerodocumento"]
									,"Cliente": val["cliente"]
									,"Fecha": val["fecha"]
									,"Dias": val["dias"]
							};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}

		function ListarDetalles(id) {
			var url = "../reportes/detallepedido";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idpedido": id},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					$("#divDetalles").modal("show");
				},
				success: function (data) {
					var oTable2 = $("#tblDetalles").dataTable();
					oTable2.fnClearTable();
					if (data !== null && typeof data === 'object') {
						$.each(data.lista, function (key, val) {
							var obj = {"Producto": val["nombreproducto"]
									,"Cantidad": val["cantidad"]
									,"Total": val["valor_vta"]
							};
							oTable2.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}


		// CARGAR COMBOS


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


	</script>	
@stop