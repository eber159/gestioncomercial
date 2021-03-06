@extends('intranet.formatos.impresiones.plantillaA4')

@section('title-page')
	Formatos
@stop

@section('titulo-rep')
	Erp Web Pedidos
@stop

@section('sub-titulo-rep')
	HOJA DE PEDIDO / REQUERIMIENTO
@stop

@section('reporte')


	<table width="100%" style="padding:1px">
		<tr>
			<td style="width: 20%;font-size: 12px">CÓDIGO</td>
			<td style="text-align:left;font-size: 12px" valign="top">{{$pedido[0]->codigo}}</td>
			<td style="width: 10%;font-size: 12px">FECHA</td>
			<td style="text-align:left; width: 20%;font-size: 12px">{{$pedido[0]->fecha}}</td>
		</tr>
		<tr>
			<td style="width: 20%;font-size: 12px">RUC</td>
			<td style="text-align:left;font-size: 12px" valign="top">{{$pedido[0]->numerodocumento}}</td>
			<td style="width: 20%;font-size: 12px">N° FOLIO</td>
			<td style="width: 20%;font-size: 12px"></td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="width: 20%;font-size: 12px">CLIENTE</td>
			<td style="text-align:left;font-size: 12px" valign="top">{{$pedido[0]->cliente}}</td>
		</tr>
		<tr>
			<td style="width: 20%;font-size: 12px">DIRECCIÓN</td>
			<td style="text-align:left;font-size: 12px" valign="top">{{$pedido[0]->direccion1}}</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="width: 20%;font-size: 12px">VENDEDOR</td>
			<td style="text-align:left;font-size: 12px" valign="top">{{$pedido[0]->vendedor}}</td>
			<td style="width: 20%;font-size: 12px">TELÉFONO</td>
			<td style="width: 20%;font-size: 12px">{{$pedido[0]->telefono1}}</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="width: 20%;font-size: 12px">OBSERVACIONES</td>
			<td style="text-align:left;font-size: 12px" valign="top">{{$pedido[0]->glosa}}</td>
		</tr>
	</table>
	<br/>
	<table style="border: 0.5px solid black">
		<thead>	
			<tr>
				<th style="text-align:center;">CANT.</th>
				<th style="text-align:center;">CÓDIGO</th>
				<th style="text-align:center; width: 50%">DESCRIPCIÓN</th>
				<th style="text-align:center; width: 20%">PRECIO UNIT.</th>
				<th style="text-align:center; width: 20%">TOTAL</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($detalles as $item)
			<tr>
				<td>{{$item->cantidad }}</td>
				<td>{{$item->codigoproducto }}</td>
				<td>{{$item->nombreproducto }}</td>
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
