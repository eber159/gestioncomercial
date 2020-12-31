@section('title-page')
	ErpWeb | Reporte Pedidos
@stop

@extends('intranet.plantilla_rpt')

@section('titulo-form')
	Reporte de Pedidos <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Cuentas por Cobrar</a></li>
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
									<label for="">Desde</label>
									<input type="text" class="form-control" id="fechaini" name="fechaini" placeholder="" style="width: 100%">
								</div>
								<div class="col-md-2">
									<label for="">Hasta</label>
									<input type="text" class="form-control" id="fechafin" name="fechafin" placeholder="" style="width: 100%">
								</div>
								<div class="col-md-6">
									<label for="">Cliente</label>
									<select class="form-control select2" style="width: 100%;" id='idclientefiltro' name="idclientefiltro" ></select>
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
												<th>Código</th>
												<th>Cliente</th>
												<th>Fecha</th>
												<th>Estado</th>
												<th>Total</th>
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
		

	<div class="modal modal-default fade" id="divDetalles">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Detalles del Pedido</h4>
          </div>
          <div class="modal-body">
          		<div class="row">
          			<div class="col-xs-12">
						<div class="table-responsive">
							<table id="tblDetalles" class="table table-bordered table-hover" width="100%">
								<thead>
									<tr>
										<th>Producto</th>
										<th>Cant.</th>
										<th>Total</th>
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
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			$('.select2').select2()
			InicializarTabla();
			InicializarTablaDetalles();
			CargarComboEmpresa();

			$('#fechaini').datepicker({
                format: 'yyyy-mm-dd'
            });
			$('#fechaini').datepicker("setDate", new Date());
			$('#fechafin').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechafin').datepicker("setDate", new Date());

            Listar();

			function InicializarTabla() {
				var Table = $('#tblDatos').DataTable( {
					"columns": [
		            	{ "data": 'Id',"visible": false},
		            	{ "data": 'Codigo', 'width':'10%'},
		            	{ "data": 'Cliente', 'width':'40%'},
		            	{ "data": 'Fecha', 'width':'10%'},
		            	{ "data": 'Estado', 'width':'15%'},
		            	{ "data": 'Total', 'width':'10%'}
		            	],
			        dom: 'Bfrtip',
			        buttons: [
			            'copy', 'csv', 'excel', 'pdf', 'print'
			        ] ,
			        paginate: false,
			        "order": [[ 1, "desc" ]]
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

			$("#btnGuardar").on("click", function(event) {
				GuardarCuenta();
			});

			$("#btnListar").on("click", function(event) {
				Listar();
			});
			


			
		});

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
			var url = "../reportes/pedidos";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idcliente": $("#idclientefiltro").val(),"fechaini":$("#fechaini").val(),"fechafin":$("#fechafin").val()},
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
									,"Codigo": "<a href='#' class='btn btn-xs btn-primary' onclick='ListarDetalles("+val["id"]+")'>" + val["codigo"] + "</a>" 
									,"Cliente": val["cliente"]
									,"Fecha": val["fecha"]
									,"Estado": val["estado"]
									,"Total": val["total"]
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