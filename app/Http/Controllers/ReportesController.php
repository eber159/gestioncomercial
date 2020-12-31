<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordenpedido;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;

class ReportesController extends BaseController {

	Public function ImpresionPedidos($usuario,$idpedido,$tiporeporte,$tamanio){
		$data = array();
		$pedido = DB::select('call rpt_ordenpedido(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idpedido));
		$detalles = DB::select('call rpt_detalleordenpedido(?,?)', array('',' AND tbl.idpedido='.$idpedido));	
		$info = DB::select('call informaciongeneral_listar(?,?)', array('',' AND tbl.activo = 1'));

		$ordenventa = null;
		$ordenventadocumento = null;
		$documento = null;

		$ordenventa = DB::table('ordenventa')->where('nropedido',$pedido[0]->codigo)->first();
		if($ordenventa){
			$ordenventadocumento = DB::table('ordenventadocumento')->where('idordenventa',$ordenventa->id)->first();
			if($ordenventadocumento){
				$documento = DB::table('documento')->where('id',$ordenventadocumento->iddocumento)->first();
				$tipodocumento = DB::table('categoria')->where('id',$documento->idtipodocumento)->first();
			}
		}
		
		

		if($tiporeporte == "pdf"){
			$data = array('usuario'=>$usuario,'pedido'=>$pedido, 'detalles'=>$detalles, 'info'=>$info, 'documento'=>$documento, 'tipodocumento'=>$tipodocumento);
			if($tamanio=="mini"){
				$customPaper = array(0,0,567.00,283.80);
				$pdf = PDF::loadView('intranet.formatos.impresiones.impresionpedidoMini',$data)->setPaper($customPaper, 'landscape');
			}else{
				$pdf = PDF::loadView('intranet.formatos.impresiones.impresionpedidoA4',$data);
			}
			
			
			return $pdf->stream('impresionpedidos.pdf',array('Attachment'=>0));
		}
	}	

	Public Function CuentasPorCobrar()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    $idsede = Session::get("idsede");
	    $filtro .= " AND DC.activo = 1 AND DC.idempresa = ".$idempresa." AND DC.idsede = ".$idsede;
	    if(Input::get('idcliente')!=null){
	        $idcliente = Input::get('idcliente');
	        $filtro .= " AND CLI.id = ".$idcliente;
	    }
	    if(Input::get('idtipodocumento')!=null){
	        $idtipodocumento = Input::get('idtipodocumento');
	        $filtro .= " AND TD.id = ".$idtipodocumento;
	    }
	    $resultado = DB::select('call rpt_cuentasporcobrar(?,?)', array(' ',$filtro));
	    return Response::json(array('lista'=>$resultado));
	}

	Public Function Pedidos()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    $idsede = Session::get("idsede");
	    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
	    if(Input::get('idcliente')!=null){
	        $idcliente = Input::get('idcliente');
	        $filtro .= " AND tbl.idcliente = ".$idcliente;
	    }
	    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
	        $fechaini = Input::get('fechaini');
	        $fechafin = Input::get('fechafin');
	        $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
	    }
	    $idusuario = Session::get("nombreusuario");
	    $filtro .= " AND tbl.created_by = '".$idusuario."'";
	    $consulta = "select tbl.*,cli.nombre as cliente
  								,concat(p.apellidopaterno,'' '',p.apellidomaterno,'' '',p.nombres) vendedor, est.nombre as estado,
								tp.nombre as tipopago,cli.numerodocumento,cli.direccion1,
								tbl.total / (1+0.18) as subtotal,
								(tbl.total - (tbl.total / (1+0.18))) as igv ,
								tbl.total,
								tbl.glosa,
								GROUP_CONCAT(ov.codigo) ventas,
								cli.telefono1
								from ordenpedido tbl
								left join categoria est on est.id = tbl.idestado
								left join trabajador t on t.id = tbl.idvendedor
								left join persona p on p.id = t.idpersona
								left join categoria tp on tp.id = tbl.idtipopago
								left join empresa cli on cli.id = tbl.idcliente
								left join (select codigo,nropedido 
												from ordenventa ov
												where ov.activo = 1) ov on ov.nropedido = tbl.codigo
								WHERE tbl.activo = 1 ".$filtro." group by tbl.id order by id asc";

	    $resultado = DB::select($consulta);
	    return Response::json(array('lista'=>$resultado,'consulta'=>$consulta));
	}

	Public Function DetallePedidos()
	{
	    $filtro = "";
	    $idpedido = Input::get("idpedido");
	    $filtro .= " AND tbl.activo = 1 AND tbl.idpedido = ".$idpedido;

	    $consulta = "select * from detallepedido tbl WHERE 1 = 1 ".$filtro;

	    $resultado = DB::select($consulta);
	    return Response::json(array('lista'=>$resultado,'consulta'=>$consulta));
	}

	Public Function Ventas()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    $idsede = Session::get("idsede");
	    $filtro .= " AND ov.activo = 1 AND ov.idempresa = ".$idempresa." AND ov.idsede = ".$idsede;
	    if(Input::get('idcliente')!=null){
	        $idcliente = Input::get('idcliente');
	        $filtro .= " AND ov.idcliente = ".$idcliente;
	    }
	    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
	        $fechaini = Input::get('fechaini');
	        $fechafin = Input::get('fechafin');
	        $filtro .= " AND ov.fecha between '".$fechaini."' and '".$fechafin."' ";
	    }

	    $resultado = DB::select('call rpt_ordenventa(?,?)', array(' ',$filtro));
	    return Response::json(array('lista'=>$resultado));
	}

	Public Function VentasCantidad()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    $idsede = Session::get("idsede");
	    $filtro .= " AND dc.idempresa = ".$idempresa." AND dc.idsede = ".$idsede;
	    if(Input::get('idcliente')!=null){
	        $idcliente = Input::get('idcliente');
	        $filtro .= " AND dc.idclienteproveedor = ".$idcliente;
	    }
	    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
	        $fechaini = Input::get('fechaini');
	        $fechafin = Input::get('fechafin');
	        $filtro .= " AND dc.fechaemision between '".$fechaini."' and '".$fechafin."' ";
	    }

	    $resultado = DB::select('call rpt_ventas_cantidad(?,?)', array(' ',$filtro));
	    return Response::json(array('lista'=>$resultado));
	}

	Public Function MovimientosCaja()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    $idsede = Session::get("idsede");
	    $idcajabanco = Input::get('idcajabanco');
	    $fechaini = Input::get('fechaini');
	    $fechafin = Input::get('fechafin');
	    
	    $resultado = DB::select('call movimientocaja_reporte(?,?,?,?,?)', array($idempresa,$idsede,$idcajabanco,$fechaini,$fechafin));
	    return Response::json(array('lista'=>$resultado));
	}

	Public Function Alertas()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    $filtro .= " AND e.activo = 1 AND e.idempresa = ".$idempresa;
	    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
	        $fechaini = Input::get('fechaini');
	        $fechafin = Input::get('fechafin');
	        $filtro .= " AND e.start between '".$fechaini."' and '".$fechafin."' ";
	    }

	    
	    $resultado = DB::select('call rpt_eventos(?,?)', array(' ',$filtro));
	    return Response::json(array('lista'=>$resultado));
	}


	Public Function AlertaVentas()
	{
	    $filtro = "";
	    $idempresa = Session::get("idempresa");
	    //$idsede = Session::get("idsede");
	    $dias = Input::get("dias");
	    $filtro .= " AND e.activo = 1 AND c.idempr = ".$idempresa." AND e.indcliente = 1 AND TIMESTAMPDIFF(day,ventas.fecha,now()) > ".$dias;

	    $consulta = "SELECT e.id,e.numerodocumento, e.nombre as cliente, ventas.id, ventas.fecha,TIMESTAMPDIFF(day,ventas.fecha,now()) dias
					FROM empresa e 
					INNER JOIN cuenta c ON c.idtitular = e.id
					LEFT JOIN (	SELECT ov.idcliente, ov.id, ov.fecha 
								  	FROM ordenventa ov 
								  	INNER JOIN (SELECT max(fecha) fecha,idcliente
									  			FROM ordenventa 
												WHERE activo = 1 GROUP BY idcliente) ov2 ON ov2.idcliente = ov.idcliente AND ov2.fecha = ov.fecha
								  	WHERE ov.activo = 1
								 ) ventas ON ventas.idcliente = e.id
					WHERE 1 = 1 ".$filtro." ORDER BY TIMESTAMPDIFF(day,ventas.fecha,now()) DESC";

	    $resultado = DB::select($consulta);
	    return Response::json(array('lista'=>$resultado,'consulta'=>$consulta));
	}	

	/*
	Public function CuentasPorCobrar_Exportar(){
		$data = array();

		$filtro = "";
	    $idempresa = Session::get("idempresa");
	    $idsede = Session::get("idsede");
	    $filtro .= " AND DC.activo = 1 AND DC.idempresa = ".$idempresa." AND DC.idsede = ".$idsede;
	    $usuario = Input::get('usuario');
	    if(Input::get('idcliente')!=null){
	        $idcliente = Input::get('idcliente');
	        $filtro .= " AND CLI.id = ".$idcliente;
	    }
	    if(Input::get('idtipodocumento')!=null){
	        $idtipodocumento = Input::get('idtipodocumento');
	        $filtro .= " AND TD.id = ".$idtipodocumento;
	    }
	    $detalles = DB::select('call rpt_cuentasporcobrar(?,?)', array(' ',$filtro));

		if(Input::get('tiporeporte') == "pdf"){
			$data = array('usuario'=>$usuario,'detalles'=>$detalles);
			$pdf = PDF::loadView('formatos.reportes.cuentasporcobrar',$data);
			return $pdf->stream('cuentasporcobrar.pdf',array('Attachment'=>0));
			//return Response::json(array('lista'=>$detalles));
		}
		if(Input::get('tiporeporte') == "xlsx"){
			//armar reporte en excel
			$resultado = DB::select('SELECT p.nrodoc as DNI, concat(p.apellidopat,\' \',p.apellidomat,\' \',p.nombres) as Alumno, DATE_FORMAT(i.fecha,"%d/%m/%Y") as Fecha,
										(case when m.descripcion is null then \'\' else m.descripcion end) as Modalidad, 
										(case when e.descripcion is null then \'\' else e.descripcion end) as Estado,
										concat(a.nombre,\' - \',es.nombre) as Admision
								FROM ingreso i
								LEFT JOIN persona p on p.id = i.idalumno
								LEFT JOIN modalidad m on m.id = i.idmodalidad
								LEFT JOIN estadoingreso e on e.id = i.idestadoingreso
								LEFT JOIN admision a on a.id = i.idadmision
								LEFT JOIN escuela es on es.id = a.idescuela
								WHERE 
									 i.vigencia = 1 AND a.id = ?
								GROUP BY i.id ORDER BY p.apellidopat asc', array($idadmision));	
	
			Excel::create('IngresosxAdmision', function($excel) use($resultado) {
				$excel->sheet('Ingresos', function($sheet) use($resultado) {
					$sheet->fromArray(json_decode(json_encode($resultado), true), null, "A5");
					$sheet->mergeCells('A2:F2');
					$sheet->mergeCells('A3:F3');
					$sheet->cells('A5:F5', function($cells)
					{
					 $cells->setBackground('#C9C9C9');
					 $cells->setFontColor('#000000');
					 $cells->setAlignment('center');
					 $cells->setValignment('center');
					});
					$sheet->cells('A2:A3', function($cells)
					{
					 $cells->setAlignment('center');
					 $cells->setValignment('center');
					});
					$sheet->row(2, array('REPORTE DE INGRESOS POR ADMISION'));
					$sheet->row(3, array($resultado[0]->Admision));
				});
			})->export('xlsx');
			
		}
	}	
	*/
	
}
