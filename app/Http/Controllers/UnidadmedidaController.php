<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Unidadmedida;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class UnidadmedidaController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call unidadmedida_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_unidadmedida = new Unidadmedida;
        $idempresa = 1;
        $idsede = 1;
        $codigo = Input::get('codigo');
        $nombre = Input::get('nombre');
        $abreviatura = Input::get('abreviatura');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call unidadmedida_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$codigo,$nombre,$abreviatura,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Unidadmedida = Unidadmedida::find($id);
        $idempresa = 1;
        $idsede = 1;
        $codigo = Input::get('codigo');
        $nombre = Input::get('nombre');
        $abreviatura = Input::get('abreviatura');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call unidadmedida_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$codigo,$nombre,$abreviatura,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call unidadmedida_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call unidadmedida_iud(?,?,?,?,?,?,?,?,?)', array($id,'','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


