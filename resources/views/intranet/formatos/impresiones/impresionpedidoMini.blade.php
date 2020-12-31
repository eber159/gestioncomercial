@extends('intranet.formatos.impresiones.plantillaMini')

@section('title-page')
	Formatos
@stop

@section('titulo-rep')
	{!!  $info[0]->datosimpresion !!}
@stop

@section('sub-titulo-rep')
	@if($documento != null)
		<div style="padding: 3px; background-color: #999; color: white">
			{{ $tipodocumento->nombre }}<br>
			{{ $documento->serie }}-{{ $documento->numero }}
		</div>  
	@endif
@stop

@section('reporte')


	<table width="100%" style="padding:1px">
		<tr>
			<td style="width: 20%;font-size: 10px">N° PEDIDO: </td>
			<td style="text-align:left;font-size: 10px" valign="top">{{$pedido[0]->codigo}}</td>
			<td style="width: 10%;font-size: 10px">FECHA: </td>
			<td style="text-align:left; width: 20%;font-size: 10px">{{$pedido[0]->fecha}}</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="width: 20%;font-size: 10px">OBSERVACIONES: </td>
			<td style="text-align:left;font-size: 10px" valign="top">{{$pedido[0]->glosa}}</td>
		</tr>
	</table>
	<br/>
	<table style="border: 0px solid black">
		<thead>	
			<tr>
				<th style="text-align:center;">CANT.</th>
				<th style="text-align:center; width: 50%">DESCRIPCIÓN</th>
				<th style="text-align:center; width: 20%">PRECIO UNIT.</th>
				<th style="text-align:center; width: 20%">TOTAL</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($detalles as $item)
			<tr>
				<td>{{$item->cantidad }}</td>
				<td>{{$item->nombre }}</td>
				<td style="text-align:right;">{{number_format($item->precio,2) }}</td>
				<td style="text-align:right">{{number_format($item->valor_vta,2) }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<br/>
	<table>
		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td style="text-align:right; font-weight: bold; width: 20%">SUB TOTAL</td>
				<td style="text-align:right">{{number_format($pedido[0]->subtotal,2) }}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td style="text-align:right; font-weight: bold; width: 20%">IGV (18%)</td>
				<td style="text-align:right">{{number_format($pedido[0]->igv,2) }}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td style="text-align:right; font-weight: bold; width: 20%">TOTAL</td>
				<td style="text-align:right">{{number_format($pedido[0]->total,2) }}</td>
			</tr>
		</tbody>
	</table>
	

@stop
