@section('title-page')
	Intranet | Gestión Perfiles
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Perfiles <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Perfiles</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('botonera')
	</br>
	<div class="col-md-12">
		<div class="box">
			<div class="box-footer">
				<button type="button" id="btnListar" name="btnListar" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
				<button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-default btn-sm"><i class="fa fa-file"></i> Nuevo </button>
				<button type="button" id="btnExportar" name="btnExportar" class="btn btn-success btn-sm"><i class="fa fa-excel"></i> Exportar</button>
				<button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-sm" style="display:none"><i class="fa fa-save"></i> Guardar</button>
				<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-danger btn-sm" style="display:none"><i class="fa fa-times"></i> Cancelar</button>
			</div>
		</div>
	</div>
@stop

@section('contenido')
	
	<section class="content">
		<div class="row" id="divLista">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Registrados</h3>
					</div>
					<div class="box-body">
						<div id="Lista">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table id="tblDatos" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th class="center">
													<label class="pos-rel">
														<input type="checkbox" class="ace" />
														<span class="lbl"></span>
													</label>
												</th>
												<th>Empresa</th>
												<th>Nombre</th>
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
		<div class="row" id="divRegistro" style="display:none">
			<div class="col-md-3">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Empresa</label>
									<select class="form-control" id="idempresa" name="idempresa"></select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" style="width: 100%">
								</div>
							</div>
						</div>
					  <!-- /.box-body -->
					  
					</form>
				</div>
			</div>

			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-header with-border">
					   <h3 class="box-title">Opciones asignadas</h3>
					   <div class="col-xs-6" style="display:inline-block; float: right">
							<button type="button" id="btnAsignar" name="btnAsignar" class="btn btn-default btn-sm btn-right" style="display: inline-block;width: 100%;align:right"><i class="fa fa-check"></i> Asignar Opciones </button>
						</div>
					</div>
					
					<div class="box-body">
						<div class="col-xs-12">
							<table id="tblDataObjetos" class="table table-bordered table-hover" style="width: 100%">
								<thead>
									<tr>
										<th style="display:none">Id</th>
										<th></th>
										<th>Nombre</th>
										<th>Título</th>
										<th>Propiedad</th>
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
	</section>
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			
			InicializarTabla();
			Listar();
			ListarObjetos();
			CargarEmpresas();

			$("#btnGuardar").on("click", function(event) {
				if(validar()){
					var form = $('#frmRegistro');
					var resp = Guardar(form,'perfil/Guardar');
					if(resp=="ok"){
						//MostrarMensajeConfirmacion(data.message);
						$('#frmRegistro')[0].reset();
						MostrarLista();
						Listar();
					}else{
						bootbox.alert("Ocurrió un error en el registro");
					}
				}
			});
			
			$("#btnListar").on("click", function(event) {
				Listar();
			});

			$("#btnAsignar").on("click", function(event) {
				AsignarObjetos();
			});
		});
		
		function validar(){
	        if($("#nombre").val()==""){
	            bootbox.alert("No ha indicado el nombre del perfil.");
	            return false;
	        }
	        return true;
	    }

		function Listar() {
			var form = $('#frmRegistro');
			var url = "perfil/Listar";
			var info = "";
			$.ajax({
				type: "POST",
				async: false,
				data: form.serialize(),
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
									,"Sel": ""
									,"Empresa": val["empresa"]
									,"Nombre": val["nombre"]
									,"Acciones":"<center>"
													+"<a href='javascript:;' onclick='EditarPerfil(\"perfil/Leer\","+val["id"]+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"perfil/Eliminar\","+val["id"]+")' class='btn btn-danger btn-xs'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</center>"};
							oTable.fnAddData(obj);
						});
					}
				}
			});
			//=================== ********* ====================
		}


		function ListarObjetos() {
            var form = $('#frmRegistro');
            $.ajax({
                type: "POST",
                async: true,
                data: {},
                url: "../seguridad/objeto/Listar",
                beforeSend: function () {
                    //$('#tblData').empty();
                    $("#tblDataObjetos > tbody").html("");
                },
                success: function (data) {
                    if (data.lista.length > 0) {
                        $.each(data.lista, function (i, item) {
                            if (item.nivel == 1) {
                                var fila = "";
                                fila += "<tr data-id='" + item.id + "' data-parent='" + item.idobjetopadre + "' data-level='" + item.nivel + "'>";
                                fila += "<td><input type='checkbox' class='minimal' value='" + item.id + "'/></td>";
                                fila += "<td data-column='name'>" + item.nombre + "</td>";
                                fila += "<td>" + item.titulo + "</td>";
                                fila += "<td>" + item.propiedad + "</td>";
                                fila += "</tr>";
                                $('#tblDataObjetos').append(fila);
                                $.each(data.lista, function (i, item2) {
                                    if (item2.nivel == 2 && item2.idobjetopadre == item.id) {
                                        var fila2 = "";
                                        fila2 += "<tr data-id='" + item2.id + "' data-parent='" + item2.idobjetopadre + "' data-level='" + item2.nivel + "'>";
                                        fila2 += "<td><input type='checkbox' class='minimal' value='" + item2.id + "'/></td>";
                                        fila2 += "<td data-column='name'>" + item2.nombre + "</td>";
                                        fila2 += "<td &nbsp;&nbsp;&nbsp; >" + item2.titulo + "</td>";
                                        fila2 += "<td>" + item2.propiedad + "</td>";
                                        fila2 += "</tr>";
                                        $('#tblDataObjetos').append(fila2);
                                        $.each(data.lista, function (i, item3) {
                                            if (item3.nivel == 3 && item3.idobjetopadre == item2.id) {
                                                var fila3 = "";
                                                fila3 += "<tr data-id='" + item3.id + "' data-parent='" + item3.idobjetopadre + "' data-level='" + item3.nivel + "'>";
                                                fila3 += "<td><input type='checkbox' class='minimal' value='" + item3.id + "'/></td>";
                                                fila3 += "<td data-column='name'>" + item3.nombre + "</td>";
                                                fila3 += "<td>	&nbsp;&nbsp;&nbsp;&nbsp;" + item3.titulo + "</td>";
                                                fila3 += "<td>" + item3.propiedad + "</td>";
                                                fila3 += "</tr>";
                                                $('#tblDataObjetos').append(fila3);
                                            }
                                        });
                                    }
                                });
                            }
                        });
                        //$("#divLista").html(tabla);
                    } else {
                        $("#divError").show();
                        $("#divLogin").show();
                        $("#divPerfil").hide();
                    }
                },
                error: function (errors) {
                    $('.before').hide();
                    $('.errors_form').html('');
                    $('.errors_form').html(errors);
                },
                complete: function () {
                    $(function () {
                        var $table = $('#tblDataObjetos'), rows = $table.find('tr');
                        rows.each(function (index, row) {
                            var $row = $(row), level = $row
                                    .data('level'), id = $row
                                    .data('id'), $columnName = $row
                                    .find('td[data-column="name"]'), children = $table
                                    .find('tr[data-parent="'
                                            + id + '"]');

                            if (children.length) {
                                var expander = $columnName.prepend('' + '<span class="treegrid-expander glyphicon glyphicon-chevron-right"></span>' + '');
                                children.hide();
                                expander.on('click', function (e) {
                                    var $target = $(e.target);
                                    if ($target.hasClass('glyphicon-chevron-right')) {
                                        $target.removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
                                        children.show();
                                    } else {
                                        $target.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
                                        reverseHide($table, $row);
                                    }
                                });
                            }

                            $columnName.prepend(''
                                    + '<span class="treegrid-indent" style="width:' + 15 * level + 'px"></span>'
                                    + '');
                        });

                        // Reverse hide all elements
                        reverseHide = function (table, element) {
                            var $element = $(element), id = $element
                                    .data('id'), children = table
                                    .find('tr[data-parent="' + id
                                            + '"]');

                            if (children.length) {
                                children.each(function (i, e) {
                                    reverseHide(table, e);
                                });

                                $element
                                        .find('.glyphicon-chevron-down')
                                        .removeClass(
                                                'glyphicon-chevron-down')
                                        .addClass(
                                                'glyphicon-chevron-right');

                                children.hide();
                            }
                        };
                    });

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck(
                            {
                                checkboxClass: 'icheckbox_minimal-blue',
                                radioClass: 'iradio_minimal-blue'
                            })
                }
            });
        }
		
		function InicializarTabla() {
			//var Table = $('#tblRecursos').dataTable().fnDestroy();
			var Table = $('#tblDatos').dataTable({
				"info": false,
				"order": false,
				"search": false,
				"aoColumns": [{
						"bVisible": false, "mDataProp": "Id"
					},{
						"bVisible": true, "sWidth": "5%", "mDataProp": "Sel"
					},{
						"sWidth": "40%", "mDataProp": "Empresa"
					},{
						"sWidth": "40%", "mDataProp": "Nombre"
					},{
						"sWidth": "25%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#nombre").val(val["nombre"]);
			$("#idempresa").val(val["idempresa"]);
		}
		
		function CargarEmpresas() {
            var $combo = $("#idempresa");
            $combo.empty();
            $.post('../configuracion/empresa/Listar', {"indsistema": "1"} ,
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>"
                                    + item.nombre + "</option>");
                        });
                    }, 'json');
        }
		

		function EditarPerfil(url,id) {
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
					$('#tblDataObjetos tbody td input[type=checkbox]').each(function () {
						//if ($(this).val() == val2["idobjeto"]) {
							$(this).iCheck('uncheck');
						//}
					});
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						$.each(data.obj, function (key, val) {
							$("#id").val(val["id"]);
							$("#nombre").val(val["nombre"]);
							$("#idempresa").val(val["idempresa"]);
					        $.each(data.objetos, function (key, val2) {
								$('#tblDataObjetos tbody td input[type=checkbox]').each(function () {
									if ($(this).val() == val2["idobjeto"]) {
										$(this).iCheck('check');
									}
								});
					        });
						});
						MostrarRegistro();
					}
				},
				complete: function(){
					
				} 
			});
			//=================== ********* ====================
		}
		
		function ObtenerItemPerfilObjeto() {
            var codigoperfil = $("#id").val();
            var arrayOpciones = [];
            var c = 0;
            $('#tblDataObjetos tbody td input[type=checkbox]').each(function () {
                if (this.checked) {
                    var id = $(this).val();
                    var obj = {"id": id};
                    arrayOpciones[c] = obj;
                    c++;
                }
            });
            var json = {
                "idperfil": codigoperfil,
                "objetos": arrayOpciones
            };
            return json;
        }
		

		function AsignarObjetos(form, url) {
			//var form = $('#frmRegistro');
			var resp = "";
			$.ajax({
				type: "POST",
				async: false,
				data: ObtenerItemPerfilObjeto(),
				url: "../seguridad/perfilobjeto/Guardar",
				dataType: "json",
				beforeSend: function (data) {
					
				},
				success: function (data) {
					if (data !== null && typeof data === 'object') {
						if(data.success == true){
							bootbox.alert(data.message);
						}
					}
					else
					{
						alert("Ocurrio un error en el registro");
						resp = "error";
					}
					EditarPerfil("../seguridad/perfil/Leer",$("#id").val());
				}
			});
			return resp;
		}

	</script>	
@stop