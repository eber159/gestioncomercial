<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordenventadocumento;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class OrdenventadocumentoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    if(Input::get('idordenventa')!=null){
        $idordenventa = Input::get('idordenventa');
        $filtro .= " AND tbl.idordenventa = ".$idordenventa;
    }
    $resultado = DB::select('call ordenventadocumento_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_ordenventadocumento = new Ordenventadocumento;
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idordenventa = Input::get('idordenventa');
        $iddocumento = Input::get('iddocumento');
        $idtipodocumento = Input::get('idtipodocumento');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call ordenventadocumento_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idordenventa,$iddocumento,$idtipodocumento,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Ordenventadocumento = Ordenventadocumento::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idordenventa = Input::get('idordenventa');
        $iddocumento = Input::get('iddocumento');
        $idtipodocumento = Input::get('idtipodocumento');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call ordenventadocumento_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idordenventa,$iddocumento,$idtipodocumento,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call ordenventadocumento_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call ordenventadocumento_iud(?,?,?,?,?,?,?,?,?)', array($id,'','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


