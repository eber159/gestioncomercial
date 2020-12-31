@section('title-page')
	ErpWeb | Gestión Inventario
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Inventario<small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Inventario</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Stock Materiales</h3>
					  <div style="float: right;">
					  		<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Listar </button>
							<button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i class="fa fa-excel"></i> Exportar</button>
					  </div>
					</div>
					<div class="box-body">
							<div class="">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Almacen</label>
										<select class="form-control" style="width: 100%;" id='idalmacen' name="idalmacen" >
											</select>
									</div>
								</div>
							</div>
							<br>
							<div class="">
								<div class="col-md-12">
									<div class="table-responsive">
										<table id="tblDatos" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th style="display:none">IdMaterial</th>
													<th>CodMaterial</th>
													<th>Material</th>
													<th style="display:none">IdAlmacen</th>
													<th>Almacen</th>
													<th>Lote</th>
													<th>Stock</th>
													<th>Costo</th>
													<th>
														Visualizar Kardex
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
	</section>
		

	<div class="modal modal-default fade" id="modalkardex">
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">KARDEX</h4>
                </div>
                <div class="modal-body">
                	<div class='row'>
                		<div class="col-md-2">
							<label for="">Desde</label>
							<input type="text" class="form-control" id="fechaini" name="fechaini" placeholder="" style="width: 100%">
						</div>
						<div class="col-md-2">
							<label for="">Hasta</label>
							<input type="text" class="form-control" id="fechafin" name="fechafin" placeholder="" style="width: 100%">
						</div>
						<div class="col-md-2">
							<label for="">&nbsp;</label>
							<button type="button" id="btnReportarKardex" name="btnReportarKardex" class="btn btn-success btn-sm" style="width: 100%"><i class="fa fa-refresh"></i> Buscar</button>
						</div>

						<input type="hidden" id="idalmacenbus" name="idalmacenbus" placeholder="" style="width: 100%">
						<input type="hidden" id="idproductobus" name="idproductobus" placeholder="" style="width: 100%">

                	</div>
                	<br>
                    <div class='row'>
                    	<div class="col-md-12">
                    		<div class="table-responsive" id="divTabla">
								<table id="tblKardex" class="table table-bordered table-hover" style="width: 100%">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Almacén</th>
											<th>Ingreso</th>
											<th>Salida</th>
											<th>Costo</th>
											<th>Saldo</th>
											<th>Cod. I/S</th>
											<th>Observ.</th>
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
	
	<!--<script src="{{ URL::to('../resources/views/logistica/js/inventario.js')}}"></script>-->

	<script type="text/javascript">

		$(function () {

		  // inicializar controles
		  $('.select2').select2()

		  CargarComboAlmacen()
		  InicializarTabla()
		  //InicializarTablaDetalles()

		  // LISTAR
		  $('#btnListar').on('click', function (event) {
		    Listar()
		  })

		  $('#btnReportarKardex').on('click', function (event) {
		  	var idalmacen = $("#idalmacenbus").val();
		  	var idproducto = $("#idproductobus").val();
		    ListarKardexAlmacenProducto(idalmacen,idproducto);
		  })

		  $("input[type='number']").click(function () {
		    $(this).select()
		  })
		// FIN ONREADY
		})

		function ListarKardex(idalmacen,idproducto){
			$("#idalmacenbus").val(idalmacen);
			$("#idproductobus").val(idproducto);
		  	$('#fechaini').datepicker({
                format: 'yyyy-mm-dd'
            });
			$('#fechaini').datepicker("setDate", new Date());
			$('#fechafin').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#fechafin').datepicker("setDate", new Date());
			$("#modalkardex").modal("show");
			ListarKardexAlmacenProducto(idalmacen,idproducto);
		}

		//CARGAR COMBOS
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

		//LISTAR

		function Listar() 
		{
		  var url = 'inventario/Listar'
		  $.ajax({
		    type: 'POST',
		    async: false,
		    data: { 'idalmacen': $('#idalmacen').val() },
		    url: url,
		    dataType: 'json',
		    beforeSend: function (data) {},
		    success: function (data) {
		      var oTable = $('#tblDatos').dataTable()
		      oTable.fnClearTable()
		      if (data !== null && typeof data === 'object') {
		        $.each(data.lista, function (key, val) {
		          var obj = {
		            'IdMaterial': val['idmaterial'],
		            'CodMaterial': val['codmaterial'] ,
		            'Material': val['nombrematerial'],
		            'IdAlmacen': val['idalmacen'],
		            'Almacen': val['nombrealmacen'],
					'Lote': val['nrolote'],
		            'Stock': val['stock'],
		            'Costo': val['costo'],
		            'Acciones': "<center>"
		              + '<a href=\'javascript:;\' onclick=\'ListarKardex(' + val['idalmacen'] + ',' + val['idmaterial'] + ")' class='btn btn-primary btn-xs'>"
		              + "<i class='ace-icon fa fa-list bigger-130'></i>"
		              + '</a>'
		            + '</center>'}
		          oTable.fnAddData(obj)
		        })
		      }
		    }
		  })
		}

		function InicializarTabla () 
		{
		  // var Table = $('#tblRecursos').dataTable().fnDestroy()
		  var Table = $('#tblDatos').dataTable({
		    'info': false,
		    'order': false,
		    'search': false,
		    'aoColumns': [{
		      'bVisible': false, 'mDataProp': 'IdMaterial'
		    }, {
		      'bVisible': true, 'sWidth': '5%', 'mDataProp': 'CodMaterial'
		    }, {
		      'sWidth': '30%', 'mDataProp': 'Material'
		    }, {
		      'bVisible': false,'sWidth': '30%', 'mDataProp': 'IdAlmacen'
		    }, {
		      'sWidth': '20%', 'mDataProp': 'Almacen'
		    }, {
		      'sWidth': '20%', 'mDataProp': 'Lote'
		    }, {
		      'sWidth': '5%', 'mDataProp': 'Stock'
		    }, {
		      'sWidth': '5%', 'mDataProp': 'Costo'
		    }, {
		      'sWidth': '10%', 'mDataProp': 'Acciones'
		    }]
		  })
		}

		function InicializarTablaKardex () 
		{
		  // var Table = $('#tblRecursos').dataTable().fnDestroy()
		  var Table = $('#tblKardex').dataTable({
		    'info': false,
		    'order': false,
		    'search': false,
		    'aoColumns': [{
			      'mDataProp': 'IdMaterial'
			    }, {
			      'sWidth': '5%', 'mDataProp': 'Fecha'
			    }, {
			      'sWidth': '10%', 'mDataProp': 'Almacen'
			    }, {
			      'sWidth': '10%', 'mDataProp': 'Ingreso'
			    }, {
			      'sWidth': '10%', 'mDataProp': 'Salida'
			    }, {
			      'sWidth': '10%', 'mDataProp': 'Saldo'
			    }, {
			      'sWidth': '10%', 'mDataProp': 'Costo'
			    }, {
			      'sWidth': '20%', 'mDataProp': 'CodigoIngreso'
			    }, {
			      'sWidth': '10%', 'mDataProp': 'Glosa'
			    }],
			'columnDefs':[
				{
				    "targets": [2,3,4,5],
				    "className": "text-right",
				    "mRender": function (data, type, full) {
                    	return parseFloat(data).toFixed(2);
                	}
				}]
		  })
		}


		function ListarKardexAlmacenProducto(idalmacen, idproducto) {
			var url = "{{ URL::to('intranet/logistica/inventario/Kardex') }}";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: {"idalmacen":idalmacen,"idproducto":idproducto,"fechaini":$("#fechaini").val(),"fechafin":$("#fechafin").val()},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTable = $("#tblKardex").dataTable();
	                oTable.fnDestroy();
	                oTable.DataTable( {
	                    data: data.lista,
	                    "columns": [
	                                { "data": 'fecha', "width": "10%"},
	                                { "data": 'nombrealmacen', "width": "15%"},
	                                { "data": 'ingreso', "width": "8%", className: 'dt-body-right'},
	                                { "data": 'salida', "width": "8%", className: 'dt-body-right'},
	                                { "data": 'costo', "width": "8%", className: 'dt-body-right'},
	                                { "data": 'saldo', "width": "8%", className: 'dt-body-right'},
	                                { "data": 'codigo', "width": "20%"},
	                                { "data": 'glosa', "width": "30%"},
	                            ],
	                    "dom": 'Bfrtip',
	                    "buttons": [
	                        'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
	                    ] ,
	                    "paging": false,
	                    "order": [[ 0, "asc" ]],
	                    "autoWidth": false,
	                    "info": true,
	                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
	                    "language": {
				            "decimal": ",",
				            "thousands": "."
				        }
	                } );
					$("#divCargando").hide();
				},
				finally: function (){
					$("#divCargando").hide();
				}
			});
			//=================== ********* ====================
		}



	</script>
	
@stop