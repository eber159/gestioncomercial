@section('title-page')
	Intranet | Gestión Opciones
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Opciones <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Opciones</a></li>
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
									<table id="tblData" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="display:none">Id</th>
												<th></th>
												<th>Nombre</th>
												<th>Título</th>
												<th>Propiedad</th>
												<th>Nivel</th>
												<th>Orden</th>
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
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos Principales</h3>
					</div>
					<form role="form" id="frmRegistro">
						<input type="hidden" class="form-control" id="id" name="id" placeholder="ID" style="width: 30%">
						<div class="box-body">
							<div class="col-md-12">
								<div class="form-group">
									<label>Nombre</label>
									<input type="text" path="nombre" name="nombre" id="nombre" class="form-control" />
								</div>
								<div class="form-group">
									<label>Título</label>
									<input name="titulo" class="form-control" id="titulo" />
								</div>
								<div class="form-group">
									<label>Nivel</label>
									<select name="nivel" id="nivel" class="form-control input-sm">
										<option value="">Seleccione</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								</div>
								<div class="form-group">
									<label>Objeto Padre</label>
									<select path="idobjetopadre" name="idobjetopadre" id="idobjetopadre" class="form-control input-sm">
										<option value="0">Seleccionar<option>
									</select>
								</div>
								<div class="form-group">
									<label class="">Tipo Objeto</label>
									<select path="idtipoobjeto" name="idtipoobjeto" id="idtipoobjeto" class="form-control input-sm">
										<option value="0">Seleccionar</option>
									</select>
								</div>
								<div class="form-group">
									<label class="">N° Orden</label>
									<input path="nroorden" name="nroorden" id="nroorden" class="form-control" />
								</div>
								<div class="form-group">
									<label class="">Propiedad</label>
									<input path="propiedad" name="propiedad" id="propiedad" class="form-control" />
								</div>
								<div class="form-group">
									<label class="">Ruta Imagen</label>
									<input path="rutaimagen" name="rutaimagen" id="rutaimagen" class="form-control" />
								</div>
								<div class="form-group">
									<label class="">Icono</label>
									<input path="icono" name="icono" class="form-control" id="icono" />
								</div>
								<div class="form-group">
									<label class="">Parámetros</label>
									<input path="parametros" name="parametros" id="parametros" class="form-control" />
								</div>
							</div>
						</div>
					  
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
			
			//InicializarTabla();
			Listar();
			CargarComboTipoMenu();


			$("#btnGuardar").on("click", function(event) {
				if(validar()){
					var form = $('#frmRegistro');
					var resp = Guardar(form,'objeto/Guardar');
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

			$(document).on('change', '#nivel', function() {
				CargarComboObjetos();
			});
			
		});
		
		function validar(){
	        if($("#nombre").val()==""){
	            bootbox.alert("No ha indicado el nombre de la opción.");
	            return false;
			}
			if($("#nivel").val()==""){
	            bootbox.alert("No ha indicado el nivel de la opción.");
	            return false;
	        }
	        return true;
	    }
		
		/*
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
									,"Nombre": val["nombre"]
									,"Acciones":"<center><div class='hidden-sm hidden-xs action-buttons'>"
													+"<a href='javascript:;' onclick='Editar(\"objeto/Leer\","+val["id"]+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"objeto/Eliminar\","+val["id"]+")' class='red'>"
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
		*/
		function Listar() {
            var form = $('#frmRegistro');
            $.ajax({
                type: "POST",
                async: true,
                data: form.serialize(),
                url: "../seguridad/objeto/Listar",
                beforeSend: function () {
                    //$('#tblData').empty();
                    $("#tblData > tbody").html("");
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
                                fila += "<td>" + item.nivel + "</td>";
								fila += "<td>" + item.nroorden + "</td>";
								fila += "<td><center>"
													+"<a href='javascript:;' onclick='Editar(\"objeto/Leer\","+item.id+")' class='btn btn-default btn-xs'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"objeto/Eliminar\","+item.id+")' class='btn btn-danger btn-xs'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</center></td>";
                                fila += "</tr>";
                                $('#tblData').append(fila);
                                $.each(data.lista, function (i, item2) {
                                    if (item2.nivel == 2 && item2.idobjetopadre == item.id) {
                                        var fila2 = "";
                                        fila2 += "<tr data-id='" + item2.id + "' data-parent='" + item2.idobjetopadre + "' data-level='" + item2.nivel + "'>";
                                        fila2 += "<td><input type='checkbox' class='minimal' value='" + item2.id + "'/></td>";
                                        fila2 += "<td data-column='name'>" + item2.nombre + "</td>";
                                        fila2 += "<td &nbsp;&nbsp;&nbsp; >" + item2.titulo + "</td>";
                                        fila2 += "<td>" + item2.propiedad + "</td>";
                                        fila2 += "<td>" + item2.nivel + "</td>";
										fila2 += "<td>" + item2.nroorden + "</td>";
										fila2 += "<td><center>"
													+"<a href='javascript:;' onclick='Editar(\"objeto/Leer\","+item2.id+")' class='blue'>"
														+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
													+"</a>&nbsp;"
													+"<a href='javascript:;' onclick='Eliminar(\"objeto/Eliminar\","+item2.id+")' class='red'>"
														+"<i class='ace-icon fa fa-times bigger-130'></i>"
													+"</a>"
												+"</center></td>";
                                        fila2 += "</tr>";
                                        $('#tblData').append(fila2);
                                        $.each(data.lista, function (i, item3) {
                                            if (item3.nivel == 3 && item3.idobjetopadre == item2.id) {
                                                var fila3 = "";
                                                fila3 += "<tr data-id='" + item3.id + "' data-parent='" + item3.idobjetopadre + "' data-level='" + item3.nivel + "'>";
                                                fila3 += "<td><input type='checkbox' class='minimal' value='" + item3.id + "'/></td>";
                                                fila3 += "<td data-column='name'>" + item3.nombre + "</td>";
                                                fila3 += "<td>	&nbsp;&nbsp;&nbsp;&nbsp;" + item3.titulo + "</td>";
                                                fila3 += "<td>" + item3.propiedad + "</td>";
                                                fila3 += "<td>" + item3.nivel + "</td>";
												fila3 += "<td>" + item3.nroorden + "</td>";
												fila3 += "<td><center>"
															+"<a href='javascript:;' onclick='Editar(\"objeto/Leer\","+item3.id+")' class='blue'>"
																+"<i class='ace-icon fa fa-pencil bigger-130'></i>"
															+"</a>&nbsp;"
															+"<a href='javascript:;' onclick='Eliminar(\"objeto/Eliminar\","+item3.id+")' class='red'>"
																+"<i class='ace-icon fa fa-times bigger-130'></i>"
															+"</a>"
														+"</center></td>";
                                                fila3 += "</tr>";
                                                $('#tblData').append(fila3);
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
                        var $table = $('#tblData'), rows = $table.find('tr');
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
						"sWidth": "40%", "mDataProp": "Nombre"
					},{
						"sWidth": "10%", "mDataProp": "Acciones"
					}]
			});
		}

		function CargarDatos(val){
			$("#id").val(val["id"]);
			$("#nombre").val(val["nombre"]);
			$("#titulo").val(val["titulo"]);
			$("#idobjetopadre").val(val["idobjetopadre"]);
			$("#nivel").val(val["nivel"]);
			$("#idtipoobjeto").val(val["idtipoobjeto"]);
			$("#nroorden").val(val["nroorden"]);
			$("#propiedad").val(val["propiedad"]);
			$("#icono").val(val["icono"]);
			$("#parametros").val(val["parametros"]);
		}
		
		function CargarComboTipoMenu() {
            var $combo = $("#idtipoobjeto");
            $combo.empty();
            $.post('../configuracion/categoria/Listar',{"grupo":"TIPO_OBJETO_MENU"},
                    function (data) {
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>" + item.nombre + "</option>");
                        });
                    }, 'json');
		}
		
		function CargarComboObjetos() {
			var nivel = 1;
			if($("#nivel").val()=="1"){
				nivel = 0;
			}
			if($("#nivel").val()=="2"){
				nivel = 1;
			}
			if($("#nivel").val()=="3"){
				nivel = 2;
			}
            var $combo = $("#idobjetopadre");
            $combo.empty();
            $.post('../seguridad/objeto/Listar',{"nivel":nivel},
                    function (data) {
                        $combo.append("<option value=''>Seleccione</option>");
                        $.each(data.lista, function (index, item) {
                            $combo.append("<option value='" + item.id + "'>" + item.nombre + "</option>");
                        });
                    }, 'json');
        }

	</script>	
@stop