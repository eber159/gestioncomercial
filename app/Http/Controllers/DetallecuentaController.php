<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Detallecuenta;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DetallecuentaController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call detallecuenta_listar(?,?)', array('',' AND activo = 1 group by tbl.id '));
    return Response::json(array('lista'=>$resultado));
}


Public Function ListarxTitular()
{
    $fechaini = Input::get('fechaini');
    $fechafin = Input::get('fechafin');
    $filtro = "";
    $filtro = "AND tbl.activo = 1 ";
    if(Input::get('idtitular')!=null){
        $idtitular = Input::get('idtitular');
        $filtro .= " AND c.idtitular = ".$idtitular;        
    }
    if(Input::get('indcargoabono')!=null){
        $indcargoabono = Input::get('indcargoabono');
        $filtro .= " AND tbl.indcargoabono = ".$indcargoabono;        
    }
    $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
    $resultado = DB::select('call detallecuenta_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

Public Function ListarCaja()
{
    $fechaini = Input::get('fechaini');
    $fechafin = Input::get('fechafin');
    $filtro = "";
    $filtro = "AND tbl.activo = 1 ";
    if(Input::get('idtitular')!=null){
        $idtitular = Input::get('idtitular');
        $filtro .= " AND c.idtitular = ".$idtitular;        
    }
    if(Input::get('indcargoabono')!=null){
        $indcargoabono = Input::get('indcargoabono');
        $filtro .= " AND tbl.indcargoabono = '".$indcargoabono."' ";        
    }
    $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
    $resultado = DB::select('call detallecuenta_listar_caja(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_detallecuenta = new Detallecuenta;
        $idempr = Input::get('idempr');
        $idsede = Input::get('idsede');
        $idsubcuenta = Input::get('idsubcuenta');
        $idconcepto = Input::get('idconcepto');
        $tipocambio = Input::get('tipocambio');
        $importemn = Input::get('importemn');
        $importeme = Input::get('importeme');
        $saldo = Input::get('saldo');
        $fecha = Input::get('fecha');
        $fechapago = Input::get('fechapago');
        $indcargoabono = Input::get('indcargoabono');
        $glosa = Input::get('glosa');
        $tiporeferencia = Input::get('tiporeferencia');
        $referencia = Input::get('referencia');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallecuenta_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempr,$idsede,$idsubcuenta,$idconcepto,$tipocambio,$importemn,$importeme,$saldo,$fecha,$fechapago,$indcargoabono,$glosa,$tiporeferencia,$referencia,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Detallecuenta = Detallecuenta::find($id);
        $idempr = Input::get('idempr');
        $idsede = Input::get('idsede');
        $idsubcuenta = Input::get('idsubcuenta');
        $idconcepto = Input::get('idconcepto');
        $tipocambio = Input::get('tipocambio');
        $importemn = Input::get('importemn');
        $importeme = Input::get('importeme');
        $saldo = Input::get('saldo');
        $fecha = Input::get('fecha');
        $fechapago = Input::get('fechapago');
        $indcargoabono = Input::get('indcargoabono');
        $glosa = Input::get('glosa');
        $tiporeferencia = Input::get('tiporeferencia');
        $referencia = Input::get('referencia');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallecuenta_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempr,$idsede,$idsubcuenta,$idconcepto,$tipocambio,$importemn,$importeme,$saldo,$fecha,$fechapago,$indcargoabono,$glosa,$tiporeferencia,$referencia,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($resultado > 0){
        DB::commit();
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	$mensaje
        ));
    }else{
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call detallecuenta_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call detallecuenta_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


