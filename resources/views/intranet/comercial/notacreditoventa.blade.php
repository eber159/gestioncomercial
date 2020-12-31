@section('title-page')
	ErpWeb | Gestión Nota Credito (Ventas)
@stop

@extends('plantilla_int')

@section('titulo-form')
	Gestión de Nota Credito (Ventas) <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Nota Credito (Ventas)</a></li>
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
                            <button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i
                                    class="fa fa-refresh"></i></button>
                            <button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-default btn-sm"><i class="fa fa-file"></i>
                                Nuevo </button>
                            <button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i
                                    class="fa fa-excel"></i> Exportar</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="Lista">
                            <div class="col-xs-12">
                                <div>
                                    <table id="tblDatos" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="display:none">Id</th>
                                                <th>FechaEmision</th>
                                                <th>SerieNumero</th>
                                                <th>Cliente</th>
                                                <th>Moneda</th>
                                                <th>DocumentoAfecta</th>
                                                <th>Subtotal</th>
                                                <th>Impuesto</th>
                                                <th>Total</th>
                                                <th>
                                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
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
                            <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm"
                                style="display:none"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm"
                                style="display:none"><i class="fa fa-times"></i> Cancelar</button>
                        </div>
                    </div>
                    <form role="form" id="frmRegistro">
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <label for="">DocumentoAfecta</label>
                                            <input type="text" class="form-control" id="documentoafecta" name="documentoafecta"
                                                placeholder="Documento Afecta" style="width: 100%" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <button type="button" id="btnAgregarDocumentoAsoc" name="btnAgregarDocumentoAsoc"
                                                class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">FechaEmision</label>
                                            <input type="text" class="form-control" id="fechaemision" name="fechaemision"
                                                placeholder="Fecha Emision" style="width: 100%">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">T.C.</label>
                                            <input type="number" class="form-control" id="tipocambio" name="tipocambio"
                                                placeholder="T.Cambio" style="width: 100%">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Serie</label>
                                            <input type="text" class="form-control" id="serie" name="serie" placeholder="Serie"
                                                style="width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Numero</label>
                                            <input type="text" class="form-control" id="numero" name="numero"
                                                placeholder="Numero" style="width: 100%">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Cliente</label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control select2" style="width: 100%;" id='idcliente'
                                                name="idcliente"></select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-info btn-flat"><i class="fa fa-refresh"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">MotivoEmision</label>
                                            <select class="form-control" id="idmotivoemision" name="idmotivoemision">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Moneda</label>
                                            <select class="form-control" id="idmoneda" name="idmoneda">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <select class="form-control" id="idestado" name="idestado">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha Vencimiento</label>
                                            <input type="text" class="form-control" id="fechavencimiento" name="fechavencimiento"
                                                placeholder="" style="width: 100%">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Cuenta Cargo</label>
                                            <select class="form-control" style="width: 100%;" id='idcuenta' name="idcuenta">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="">Sub Cuenta</label>
                                            <select class="form-control" style="width: 100%;" id='idsubcuenta' name="idsubcuenta">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Observaciones</label>
                                            <input type="text" class="form-control" id="glosa" name="glosa" placeholder="Observaciones"
                                                style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sub Total</label>
                                            <input type="number" class="form-control" id="subtotal" name="subtotal"
                                                placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Total IGV</label>
                                            <input type="number" class="form-control" id="impuestovta" name="impuestovta"
                                                placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Importe Total</label>
                                            <input type="number" class="form-control" id="total" name="total"
                                                placeholder="" style="width: 100%; text-align: right;" readonly="readonly">
                                        </div>
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
                                                    <div class="col-md-6">
                                                        <label for="">Material</label>
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control select2" style="width: 100%;"
                                                                id='pidmaterialservicio' name="pidmaterialservicio"></select>
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-info btn-flat"><i
                                                                        class="fa fa-refresh"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Cantidad</label>
                                                            <input type="number" class="form-control" id="pcantidad"
                                                                name="pcantidad" placeholder="Cantidad" style="width: 100%">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio</label>
                                                            <input type="number" class="form-control" id="ppreciounitigv"
                                                                name="ppreciounitigv" placeholder="Precio" style="width: 100%">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        &nbsp;
                                                        <div class="form-group">
                                                            <label for="">&nbsp;</label>
                                                            <button type="button" id="btnAgregarProducto" name="btnAgregarProducto"
                                                                class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                                                                Agregar Producto </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <table id="tblDetalles" class="table table-bordered table-hover"
                                                                style="width: 100%">
                                                                <thead>
                                                                    <th style=''></th>
                                                                    <th style='display:none'></th>
                                                                    <th style='display:none'></th>
                                                                    <th>Producto</th>
                                                                    <th>Cant.</th>
                                                                    <th>Costo</th>
                                                                    <th>P. Unitario</th>
                                                                    <th>Impuesto</th>
                                                                    <th>Importe</th>
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

    <div class="modal modal-default fade" id="modaldocumentoafecta">
        <div class="modal-dialog" style="width: 80%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Selecciona Documento</h4>
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <label for="">Tipo Documento</label>
                                <select class="form-control select2" style="width: 100%;"
                                        id='cmbtipodocumentomodal' name="cmbtipodocumentomodal">
                                </select>                        
                            </div>
                            <div class="col-md-3">
                                <label for="">Serie</label>
                                <input type="text" class="form-control" id="seriebusqueda" name="seriebusqueda"
                                    placeholder="Serie" style="width: 100%">
                            </div>
                            <div class="col-md-5">
                                <label for="">Numero</label>
                                <input type="text" class="form-control" id="numerobusqueda" name="numerobusqueda"
                                    placeholder="Numero" style="width: 100%">
                            </div>
                            <label for="">&nbsp;</label>
                            <div class="col-md-1">
                                <button type="button" id="btnlistardocumentoasoc" name="btnlistardocumentoasoc" class="btn btn-success btn-sm"><i
                                        class="fa fa-refresh"></i>Listar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <div>
                        <table id="tblDocumentoAsoc" class="table table-bordered table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="display:none">Id</th>
                                    <th>FechaEmision</th>
                                    <th>SerieNumero</th>
                                    <th>Cliente</th>
                                    <th>Moneda</th>
                                    <th>Sel</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	<script>
        //Variable iddocumentoasociado
        var iddocumentoasociado = '';
		$(function () {
			//inicializar controles
			$('.select2').select2()
			$('#fechaemision').datepicker({
	                format: 'yyyy-mm-dd'
	            });
			$('#fechavencimiento').datepicker({
	                format: 'yyyy-mm-dd'
	            });
			CargarComboMoneda();
			CargarComboEstadoDocumento();
			CargarComboCliente();
			CargarComboProducto();
			CargarComboMotivoEmision();
			InicializarTabla();
			InicializarTablaDetalles();
			InicializarTablaModal();
			Listar();
			//ListarModal();
			
			//NUEVO
			$("#btnNuevo").on("click", function(event) {
				MostrarRegistro();
				$('#frmRegistro')[0].reset();
				$("#id").val("");
	            $('#fechaemision').datepicker("setDate", new Date());
	            $('#fechavencimiento').datepicker("setDate", new Date());                   
				$('#tblDetalles').dataTable().fnClearTable();
				$("#pcantidad").val(0);
				$("#ppreciounitigv").val(0);
				$("#pidmaterialservicio").val('').trigger('change');
	            $.post('../configuracion/tipocambio/Listar',{"fecha":$('#fechaemision').val()},
                function (data) {
                    $.each(data.lista, function (index, item) {
                        $("#tipocambio").val(item.venta);
                    });
                }, 'json');
			});

			//GUARDAR
			$("#btnGuardar").on("click", function(event) {
				GuardarFacturaVenta();
			});

			//LISTAR
			$("#btnListar").on("click", function(event) {
				Listar();
			});
			
			//Agregar Producto
			$('#btnAgregarProducto').click(function (e) {
				if(validarAgregarProducto())
				{
					var oTable = $("#tblDetalles").dataTable();
					var Linea = oTable.fnGetData().length + 1 ;
					var obj = {"Row": Linea 
						      	,"Id": ""
						        ,"IdProducto": $("#pidmaterialservicio").val()
								,"Producto": $("#pidmaterialservicio").select2('data')[0].text
								,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat($("#pcantidad").val()).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100px' >"
								,"PrecioUnitarioSinIGV": "<input type='number' class='form-control2' value= '"+parseFloat($("#ppreciounitigv").val() / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100px' >"
								,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat($("#ppreciounitigv").val()).toFixed(2)+"' id='txtPrecioUnitIgv"+Linea+"' name='txtPrecioUnitIgv"+Linea+"' style='text-align: right; width: 100px' >"
								,"IndImpuesto": "<input type='checkbox' id='chkIgv"+Linea+"' name='chkIgv"+Linea+"' width: 100px' checked >"
								,"Importe": "<input type='number' class='form-control2' value= '"+(parseFloat($("#pcantidad").val()) * parseFloat($("#ppreciounitigv").val())).toFixed(4)+"' id='txtValorVentaIgv"+Linea+"' name='txtValorVentaIgv"+Linea+"' style='text-align: right; width: 150px' readonly='readonly'>"
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
						$("#txtPrecioUnitIgv"+Linea).keyup(function () {
					   		calcularValorLinea(Linea);
						});
						$("#chkIgv"+Linea).change(function () {
							calcularPrecioSinIgv(Linea);
						});
						InicializarCantidades();
			        	calcularTotales();
				}
			});
			
			$('#serie').focusout(function() {			
				$('#serie').val(formatoDocumento($('#serie').val(),4));
			})
			$('#numero').focusout(function() {			
				$('#numero').val(formatoDocumento($('#numero').val(),10));
			})
			$('#numero').on('input', function () { 
				this.value = this.value.replace(/[^0-9]/g,'');
			});

			$("input[type='number']").click(function () {
					   $(this).select();
			});
			
			//MODAL
			$("#btnAgregarDocumentoAsoc").on("click", function(event) {
				AgregarDocumentoAsociado();
			});

			//LISTAR MODAL
			$("#btnlistardocumentoasoc").on("click", function(event) {
				ListarModal();
			});

		//FIN ONREADY
		});
		
		function CargarComboMotivoEmision() 
		{
            var $combo = $("#idmotivoemision");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"MOTIVO_EMISION_NOTA_CREDITO"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function AgregarDocumentoAsociado()
		{
            if ( $("#id").val() != "" ) 
            {
                bootbox.alert("No se puede asociar documento la nota de credito ya esta registrada");
            }else
            {
                $('#modaldocumentoafecta').modal("show");
                CargarComboTipoDocumento();
            }
			            
		}

        function CargarComboTipoDocumento() 
        {
            var $combo = $("#cmbtipodocumentomodal");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_DOCUMENTO"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

		function calcularValorLinea(item)
		{
        	var cant = parseFloat($("#txtCantidad"+item).val());
        	var precio = parseFloat($("#txtPrecioUnitIgv"+item).val());
        	$("#txtValorVentaIgv"+item).val((cant*precio).toFixed(4));
			calcularPrecioSinIgv(item)
        	calcularTotales();
        }

		function calcularPrecioSinIgv(item){
			if( $("#chkIgv"+item).is(':checked') )
			{
				$("#txtPrecioUnit"+item).val(parseFloat($("#txtPrecioUnitIgv"+item).val() / (1 + {{ config('constants.generales.impuesto') }}) ).toFixed(2));
			}else
			{
				$("#txtPrecioUnit"+item).val(parseFloat($("#txtPrecioUnitIgv"+item).val()).toFixed(2));
			}
        	calcularTotales();
        }

		function formatoDocumento(texto,cantidad)
		{
			var ln = ""
			for (var i = 1 ;i<=cantidad-texto.length;i++){
				ln = ln + "0"
			}
			return ln + texto
		}
		
		//VALIDACIONES
		function validarAgregarProducto()
		{
			var resultado = true;
			var mensaje = "";
			var oTable2 = $("#tblDetalles").DataTable();
			oTable2.rows().eq(0).each( function ( index ) 
			{
			    var row = oTable2.row( index );
			    var data = row.data();
			    var fila = data["Row"];

			    var idprod = data["IdProducto"];

			    if(data["Estado"]==1)
			    {
			    	if($("#pidmaterialservicio").val()==idprod)
			    	{
				    	mensaje += "El producto ya existe en la lista <br>";
		            	resultado = false;
				    }
			    }
			});

			if($("#pidmaterialservicio").val()=="")
			{
				mensaje +="Seleccione un producto <br>";
				resultado = false;
			}

			console.log($("#pcantidad").val());
			if($("#pcantidad").val()=="" || parseFloat($("#pcantidad").val())<=0 )
			{
				mensaje +="Ingrese una cantidad válida <br>";
				resultado = false;
			}

			if($("#ppreciounitigv").val()=="" || parseFloat($("#ppreciounitigv").val())<=0 )
			{
				mensaje +="Ingrese un precio válido <br>";
				resultado = false;
			}

			if(resultado == false)
			{
				bootbox.alert(mensaje);
			}
	        return resultado;
	    }

	    //METODOS
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

	    function InicializarCantidades(){
			$("#pcantidad").val(0);
			$("#ppreciounitigv").val(0);
			$("#pidmaterialservicio").val('').trigger('change');
		}

		function calcularTotales()
		{
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
				   	var neto = parseFloat($("#txtValorVentaIgv"+fila).val());

				    subtotal = (parseFloat(subtotal) + (parseFloat(precio)*parseFloat(cantidad))).toFixed(2);
				    totalneto = (parseFloat(totalneto) + parseFloat(neto)).toFixed(2);
					impuesto = (parseFloat(totalneto) - parseFloat(subtotal)).toFixed(2);
				}
			});

			$("#subtotal").val(subtotal);
			$("#impuestovta").val(impuesto);
			$("#total").val(totalneto);
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

        function CargarComboEstadoDocumento() {
            var $combo = $("#idestado");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_DOCUMENTO"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }

        function CargarComboCliente() {
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

        function CargarComboProducto() {
            var $combo = $("#pidmaterialservicio");
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

        //GUARDAR
        function GuardarFacturaVenta(){
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
			    	,"idtipomaterialservicio" : {{ config('constants.materialservicio.material') }}
			    	,"idmaterialservicio": data["IdProducto"]
			    	,"cantidad": $("#txtCantidad"+fila).val()
			    	,"preciounit": $("#txtPrecioUnit"+fila).val()
			    	,"preciounitigv": $("#txtPrecioUnitIgv"+fila).val()
			    	,"indigv": $("#chkIgv"+fila).val()
		        	,"activo": data["Estado"]
			    }
		       	detalles[c] = obj;
		       	c++;
			});
			//DocumentoAsociado
			var DocumentoAsoc = {
			    	"id": ""
			    	,"iddocumento" : iddocumentoasociado
			    	,"iddocumentoasoc": $("#id").val()
			    }

			//Cabecera
			var obj = {
				"id": $("#id").val()
				,"idtipodocumento": {{ config('constants.tipodocumento.notacredito') }}
				,"idclienteproveedor": $("#idcliente").val()
				,"idperiodo": 1
				,"idestado": $("#idestado").val()
				,"cuentacontable": ''
				,"idmoneda": $("#idmoneda").val()
				,"tipocambio": $("#tipocambio").val()
				,"idtipocompraventa": 1
				,"idmaterialservicio": {{ config('constants.materialservicio.material') }}
				,"serie": $("#serie").val()
				,"numero": $("#numero").val()
				,"fechaemision": $("#fechaemision").val()
				,"fechavencimiento": $("#fechavencimiento").val()
				,"glosa": $("#glosa").val()
				,"tasaimpuesto": {{ config('constants.generales.impuesto') }}
				,"nogravadas": 0
				,"subtotal": $("#subtotal").val()
				,"impuesto": $("#impuestovta").val()
				,"total": $("#total").val()
				,"saldo": $("#total").val()
				,"operador": 1
				,"indextorno": 0
				,"detalles": detalles
				,"documentoasoc":DocumentoAsoc
			};

			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: obj,
				url: "../comercial/facturaventa/Guardar",
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

        //LISTAR

		function Listar() 
		{
			var url = "notacreditoventa/Listar";
			$.ajax({
				type: "POST",
				async: false,
				data: { "idtipodocumento":{{config('constants.tipodocumento.notacredito')}}, "idtipocompraventa": 1 },
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTable = $("#tblDatos").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') 
					{
						$.each(data.lista, function (key, val) 
						{
							var obj = {"Id": val["id"]
									,"FechaEmision": val["fechaemision"]
									,"SerieNumero": val["serie"]+' - '+val["numero"]
									,"Cliente": val["nombreclienteproveedor"]
									,"Moneda": val["nombremoneda"]
									,"DocumentoAfecta": val["documentoasociado"]
									,"Subtotal": val["subtotal"]
									,"Impuesto": val["impuesto"]
									,"Total": val["total"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='EditarNotaCredito(\"facturaventa/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"facturaventa/Eliminar\","+val["id"]+")' class='red'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</div></center>"};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}
		
		function EditarNotaCredito(url,id) {
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
							$("#idcliente").val(val["idclienteproveedor"]).trigger('change');
							$("#idestado").val(val["idestado"]);
							$("#idmoneda").val(val["idmoneda"]);
							$("#tipocambio").val(val["tipocambio"]);
							$("#serie").val(val["serie"]);
							$("#numero").val(val["numero"]);
				            $('#fechaemision').datepicker("setDate", val["fechaemision"]);
							$('#fechavencimiento').datepicker("setDate", val["fechavencimiento"]);
							$("#glosa").val(val["glosa"]);
							$("#subtotal").val(parseFloat(val["subtotal"]).toFixed(2));
					        $("#impuestovta").val(parseFloat(val["impuesto"]).toFixed(2));
							$("#total").val((parseFloat(val["total"]).toFixed(2)).toLocaleString('en'));
                            iddocumentoasociado = val["iddocumentoasociado"];
                            $("#documentoafecta").val(val["documentoasociado"]);
							var Linea = 1;
					        $.each(data.detalles, function (key, val2) {
					        	var oTableDetalles = $("#tblDetalles").dataTable();
					        	var objdet = {"Row": Linea 
									      	,"Id": val2["id"]
									        ,"IdProducto": val2["idmaterialservicio"]
											,"Producto": val2["nombrematerialservicio"]
											,"Cantidad": "<input type='number' class='form-control2' value= '"+parseFloat(val2["cantidad"]).toFixed(2)+"' id='txtCantidad"+Linea+"' name='txtCantidad"+Linea+"' style='text-align: right; width: 100px' >"
											,"PrecioUnitarioSinIGV": "<input type='number' class='form-control2' value= '"+parseFloat(val2["preciounitigv"]).toFixed(2)+"' id='txtPrecioUnit"+Linea+"' name='txtPrecioUnit"+Linea+"' style='text-align: right; width: 100px' >"
											,"PrecioUnitario": "<input type='number' class='form-control2' value= '"+parseFloat(val2["preciounitigv"]).toFixed(2)+"' id='txtPrecioUnitIgv"+Linea+"' name='txtPrecioUnitIgv"+Linea+"' style='text-align: right; width: 100px' >"
											,"IndImpuesto": "<input type='checkbox' id='chkIgv"+Linea+"' name='chkIgv"+Linea+"' value= "+val2["indigv"]+" width: 100px' >"
											,"Importe": "<input type='number' class='form-control2' value= '"+(parseFloat(val2["cantidad"]).toFixed(2)) * parseFloat(val2["preciounitigv"]).toFixed(2)+"' id='txtValorVentaIgv"+Linea+"' name='txtValorVentaIgv"+Linea+"' style='text-align: right; width: 150px' readonly='readonly'>"
											,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
															+"<a href='javascript:;' onclick='Quitar("+val2["id"]+","+Linea+")'>"
																+"<i class='ace-icon fa fa-times bigger-130'></i>"
															+"</a>&nbsp;"
														+"</div></center>"
											,"Estado": 1
											};
								oTableDetalles.fnAddData(objdet);
								console.log(objdet);
								Linea++;
							});
							MostrarRegistro();
						});
					}
				},
				complete: function(){
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

		function InicializarTabla() 
		{
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblDatos').dataTable({
				"info": false,
				"order": false,
				"search": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"bVisible": true, "sWidth": "5%", "mDataProp": "FechaEmision"
					}, {
						"sWidth": "13%", "mDataProp": "SerieNumero"
					},{
						"sWidth": "30%", "mDataProp": "Cliente"
					},{
						"sWidth": "3%", "mDataProp": "Moneda"
					},{
						"sWidth": "10%", "mDataProp": "DocumentoAfecta"
					},{
						"sWidth": "10%", "mDataProp": "Subtotal"
					},{
						"sWidth": "10%", "mDataProp": "Impuesto"
					},{
						"sWidth": "10%", "mDataProp": "Total"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function InicializarTablaDetalles() 
		{
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
							"sWidth": "40%", "mDataProp": "Producto"
						},{
							"sWidth": "10%", "mDataProp": "Cantidad"
						},{
							"sWidth": "10%", "mDataProp": "PrecioUnitarioSinIGV"
						},{
							"sWidth": "10%", "mDataProp": "PrecioUnitario"
						},{
							"sWidth": "10%", "mDataProp": "IndImpuesto"
						},{
							"sWidth": "10%", "mDataProp": "Importe"
						},{
							"sWidth": "10%", "mDataProp": "Acciones"
						},{
							"bVisible": false, "sWidth": "10%", "mDataProp": "Estado"
						}],
					/*'columnDefs':[
						{
						      "targets": [4,5,6,8],
						      "className": "text-right",
						}],*/
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

		function InicializarTablaModal() 
		{
			var Table = $('#tblDocumentoAsoc').dataTable({
				"info": false,
				"order": false,
				"search": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"bVisible": true, "sWidth": "5%", "mDataProp": "FechaEmision"
					}, {
						"sWidth": "13%", "mDataProp": "SerieNumero"
					},{
						"sWidth": "30%", "mDataProp": "Cliente"
					},{
						"sWidth": "3%", "mDataProp": "Moneda"
					},{
						"sWidth": "3%", "mDataProp": "Sel"
					}]
			});
		}

		//LISTAR MODAL

		function ListarModal() 
		{
			var url = "facturaventa/Listar";
			$.ajax({
				type: "POST",
				async: false,
				data: { "idtipodocumento":$("#cmbtipodocumentomodal").val()},
				url: url,
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					var oTable = $("#tblDocumentoAsoc").dataTable();
					oTable.fnClearTable();
					if (data !== null && typeof data === 'object') 
					{
						$.each(data.lista, function (key, val) 
						{
							var obj = 
									{
										"Id": val["id"]
										,"FechaEmision": val["fechaemision"]
										,"SerieNumero": val["serie"]+' - '+val["numero"]
										,"Cliente": val["nombreclienteproveedor"]
										,"Moneda": val["nombremoneda"]
										,"Sel":"<center><div class='hidden-sm hidden-xs action-buttons'>"
														+"<a href='javascript:;' onclick='SeleccionarDocAsociado("+val["id"]+")' class='blue'>"
															+"<i class='ace-icon fa fa-check-square-o'></i>"
														+"</a>"
													+"</div></center>"
									};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}

		function SeleccionarDocAsociado(id)
		{
			var oTable2 = $("#tblDocumentoAsoc").DataTable();
			oTable2.rows().eq(0).each( function ( index ) {

			    var row = oTable2.row( index );
			    var data = row.data();
				if(data["Id"]==id)
				{
					var serienumero = data["SerieNumero"];
					$("#documentoafecta").val(serienumero);
					iddocumentoasociado = data["Id"];
					$("#modaldocumentoafecta").modal("hide");
				}
			});
		}
		
	</script>
@stop