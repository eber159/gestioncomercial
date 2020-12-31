@section('title-page')
	Sistema de Gestión Comercial | Inicio
@stop

@extends('intranet.plantilla_int_inicio')

@section('titulo-form')
	INICIO <small>Panel de Control</small>
@stop

@section('subtitulo-form')
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> SISTEMA INTEGRAL DE COMERCIALIZACIÓN</a></li>
		<li class="active"> v. 1.0</li>
	</ol>
@stop

@section('contenido')
	
<section class="content">


</section>
		
	
@stop

@section('stripts_especific')
	
	<script src="{{ URL::to('assets_int/funciones/generales/general_intranet.js')}}"></script>
	
	<script type="text/javascript">
		$(function () {
			
		});

	</script>	
@stop