<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Mensaje;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;

class MensajeController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    $resultado = DB::select('call mensaje_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}


public function Guardar(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $error = false;
	
	   $ruta = "";
	   $filename = "";
        if($id === ''){
            $obj_mensaje = new Mensaje;
            $obj_mensaje->idempresa = 1;
            $obj_mensaje->nombres = Input::get('nombres');
            $obj_mensaje->numero = Input::get('numero');
            $obj_mensaje->correo = Input::get('correo');
            $obj_mensaje->asunto = Input::get('asunto');
            $obj_mensaje->mensaje = Input::get('mensaje');
            $obj_mensaje->activo = 1;
            $usuario = 'usuarioWeb';
            $obj_mensaje->created_by = $usuario;
            $obj_mensaje->updated_by = $usuario;
            $obj_mensaje->save();

            if(!($obj_mensaje->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_mensaje = Mensaje::find($id);
            $obj_mensaje->nombres = Input::get('nombres');
            $obj_mensaje->numero = Input::get('numero');
            $obj_mensaje->correo = Input::get('correo');
            $obj_mensaje->asunto = Input::get('asunto');
            $obj_mensaje->mensaje = Input::get('mensaje');
            $obj_mensaje->activo = 1;
            $usuario = 'usuarioWeb';
            $obj_mensaje->created_by = $usuario;
            $obj_mensaje->updated_by = $usuario;
            $obj_mensaje->save();

            if(!($obj_mensaje->id > 0)){
                $error = true;
            }
	    $mensaje = 'Registro exitoso';
        }
        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje
            ));
        }else{
            throw new Exception("Ocurrió un error al registrar la operación", 1);
        }
        
        //return self::Error();
    } catch (Exception $e) {
        DB::rollBack();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage()
        ));
    }
    
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call mensaje_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Mensaje::find($id);
    $obj_item->activo = 0;
    $usuario = Session::get("nombreusuario");
    $obj_item->updated_by = $usuario;
    $obj_item->save();

    if($obj_item){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}


}


