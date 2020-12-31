<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Perfilusuario;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use Session;

class PerfilusuarioController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro .= " AND tbl.activo = 1 ";
    if(Input::get('idusuario')!=null){
        $idusuario = Input::get('idusuario');
        $filtro .= " AND tbl.idusuario = ".$idusuario;
    }
    $resultado = DB::select('call perfilusuario_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_perfilusuario = new Perfilusuario;
        $idperfil = Input::get('idperfil');
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idusuario = Input::get('idusuario');
        $idtrabajador = Input::get('idtrabajador');
        $activo = 1;
        $usuario = Session::get("nombreusuario");
        $resultado = DB::select('call perfilusuario_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idperfil,$idusuario,$idtrabajador,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Perfilusuario = Perfilusuario::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idperfil = Input::get('idperfil');
        $idusuario = Input::get('idusuario');
        $idtrabajador = Input::get('idtrabajador');
        $activo = 1;
        $usuario = Session::get("nombreusuario");
        $resultado = DB::select('call perfilusuario_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idperfil,$idusuario,$idtrabajador,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($resultado[0]->rpta > 0){
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
    $resultado = DB::select('call perfilusuario_listar(?,?)', array('',' AND tbl.activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call perfilusuario_iud(?,?,?,?,?,?,?,?,?)', array($id,'','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


