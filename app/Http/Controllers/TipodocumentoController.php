<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Tipodocumento;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class TipodocumentoController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call sp_tipodocumento_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_tipodocumento = new Tipodocumento;
        $nombre = Input::get('nombre');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call sp_tipodocumento(?,?,?,?,?)', array($id,$nombre,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Tipodocumento = Tipodocumento::find($id);
        $nombre = Input::get('nombre');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call sp_tipodocumento(?,?,?,?,?)', array($id,$nombre,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call sp_tipodocumento_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call sp_tipodocumento(?,?,?,?,?)', array($id,'','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


