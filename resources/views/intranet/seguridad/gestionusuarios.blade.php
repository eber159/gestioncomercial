@section('title-page')
	Camila | Gestión usuarios
@stop

@extends('intranet.plantilla_int')

@section('titulo-form')
	Gestión de Usuarios <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Usuarios</a></li>
		<li class="active">Gestión</li>
	</ol>
@stop

@section('botonera')
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
						<div id="Lista"></div>
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
					<form role="form">
						<div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tipo Documento</label>
									<select class="form-control" id="idtipodoc" name="idtipodoc" >
										<option value="1">DNI</option>
										<option value="2">RUC</option>
										<option value="3">Carnet de extranjería</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">N° Documento</label>
									<input type="text" class="form-control" id="nro_doc" name="nro_doc" placeholder="Ingrese Nombres" style="width: 100%">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Nombres</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombres" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Apellido Paterno</label>
									<input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" placeholder="Ingrese apellido paterno">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Apellido Materno</label>
									<input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" placeholder="Ingrese apellido materno">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Correo electrónico</label>
									<input type="text" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" style="width: 100%">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Dirección</label>
									<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección" style="width: 100%">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Teléfono Móvil</label>
									<input type="text" class="form-control" id="telefono_movil" name="telefono_movil" placeholder="">
								</div>
							</div><div class="col-md-6">
								<div class="form-group">
									<label for="">Télefono Fijo</label>
									<input type="text" class="form-control" id="telefono" name="telefono" placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Sexo</label>
									<select class="form-control" id="sexo" name="sexo" >
										<option value="M">Masculino</option>
										<option value="F">Femenino</option>
										<option value="N">No especificado</option>
									</select>
								</div>
							</div><div class="col-md-6">
								<div class="form-group">
									<label for="">Fecha Nacimiento</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
										<input id="fecha_nac" name="fecha_nac" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask />
									</div>
								</div>
							</div>
						</div>
					  <!-- /.box-body -->
					  
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Datos de Usuario</h3>
					</div>
					<form role="form" id="frmRegistro">
						<div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Nombre de Usuario</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Usuario">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
							</div>
							<div class="col-md-12">
								<div class="box-footer">
									<button type="button" id="btnRegistrar" name="btnRegistrar" class="btn btn-primary">Registro</button>
									<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-primary">Cancelar</button>
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
			$('#fecha_nac').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		});
	</script>	
@stop