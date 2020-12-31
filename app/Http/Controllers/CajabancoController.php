<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Cajabanco;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class CajabancoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro .= " AND tbl.activo = 1";
    /*
    if(Input::get('indcajabanco')!=null){
        $indcajabanco = Input::get('indcajabanco');
        $filtro .= " AND tbl.indcajabanco = '".$indcajabanco."'";
    }*/
    $resultado = DB::select('call cajabanco_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_cajabanco = new Cajabanco;
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idmoneda = Input::get('idmoneda');
        $idemprbanco = Input::get('idemprbanco');
        $nombre = Input::get('nombre');
        $cci = Input::get('cci');
        $indcajabanco = Input::get('indcajabanco');
        $nrocta = Input::get('nrocta');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call cajabanco_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idmoneda,$idemprbanco,$nombre,$cci,$indcajabanco,$nrocta,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Cajabanco = Cajabanco::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idmoneda = Input::get('idmoneda');
        $idemprbanco = Input::get('idemprbanco');
        $nombre = Input::get('nombre');
        $cci = Input::get('cci');
        $indcajabanco = Input::get('indcajabanco');
        $nrocta = Input::get('nrocta');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call cajabanco_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idmoneda,$idemprbanco,$nombre,$cci,$indcajabanco,$nrocta,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call cajabanco_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call cajabanco_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


