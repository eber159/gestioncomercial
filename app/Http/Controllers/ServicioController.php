<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Servicio;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;

class ServicioController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call servicio_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_servicio = new Servicio;
        $obj_servicio->idempresa = Session::get('idempresa');
        $obj_servicio->idsede = Session::get('idsede');
        $obj_servicio->nombre = Input::get('nombre');
        $obj_servicio->descripcion = Input::get('descripcion');
        $obj_servicio->activo = 1;
        $obj_servicio->created_by = Session::get('nombreusuario');
        $obj_servicio->updated_by = Session::get('nombreusuario');
        $obj_servicio->save();

        $mensaje = 'Registro exitoso';
    }
    else{
        $obj_servicio = Servicio::find($id);
        $obj_servicio->nombre = Input::get('nombre');
        $obj_servicio->descripcion = Input::get('descripcion');
        $obj_servicio->activo = 1;
        $obj_servicio->updated_by = Session::get('nombreusuario');
        $obj_servicio->save();

        $mensaje = 'Registro Actualizado';
    }

    if($obj_servicio->id > 0){
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
    $resultado = DB::select('call servicio_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call servicio_iud(?,?,?,?,?,?,?,?)', array($id,'','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


