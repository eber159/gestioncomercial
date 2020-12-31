<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordencompradocumento;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OrdencompradocumentoController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call ordencompradocumento_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_ordencompradocumento = new Ordencompradocumento;
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idordencompra = Input::get('idordencompra');
        $iddocumento = Input::get('iddocumento');
        $idtipodocumento = Input::get('idtipodocumento');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call ordencompradocumento_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idordencompra,$iddocumento,$idtipodocumento,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Ordencompradocumento = Ordencompradocumento::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idordencompra = Input::get('idordencompra');
        $iddocumento = Input::get('iddocumento');
        $idtipodocumento = Input::get('idtipodocumento');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call ordencompradocumento_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idordencompra,$iddocumento,$idtipodocumento,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($resultado > 0){
        DB::commit();
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  $mensaje
        ));
    }else{
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call ordencompradocumento_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call ordencompradocumento_iud(?,?,?,?,?,?,?,?,?)', array($id,'','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


