<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordenventaordensalida;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;


class OrdenventaordensalidaController extends BaseController {

Public Function Listar()
{


    $resultado = DB::select('call ordenventaordensalida_listar(?,?)', array('',' AND tbl.activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');

    $error = false;

    if($id === ''){
        $obj_ordenventaordensalida = new Ordenventaordensalida;
        $obj_ordenventaordensalida->idempresa = Session::get('idempresa');
        $obj_ordenventaordensalida->idsede = Session::get('idsede');
        $obj_ordenventaordensalida->idordenventa = Input::get('idordenventa');
        $obj_ordenventaordensalida->idordensalida = Input::get('idordensalida');
        $obj_ordenventaordensalida->activo = 1;
        $obj_ordenventaordensalida->created_by = Session::get('nombreusuario');
        $obj_ordenventaordensalida->updated_by = Session::get('nombreusuario');
        
        $obj_ordenventaordensalida->save();
        if(!($obj_ordenventaordensalida->id>0)){
        	$error = true;
        }

        $mensaje = 'Registro exitoso';
    }
    else{
        $Ordenventaordensalida = Ordenventaordensalida::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idordenventa = Input::get('idordenventa');
        $idordensalida = Input::get('idordensalida');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call ordenventaordensalida_iud(?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idordenventa,$idordensalida,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($error == false){
        DB::commit();
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	$mensaje
        ));
    }else{
    	return Response::json(array(
            'success' 		=> 	false,
            'message' 		=> 	"No se pudo completar el registro"
        ));
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call ordenventaordensalida_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call ordenventaordensalida_iud(?,?,?,?,?,?,?,?)', array($id,'','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


