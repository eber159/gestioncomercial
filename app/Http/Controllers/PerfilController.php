<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Perfil;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class PerfilController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    if((Input::get("idempresa")!=null)){
        $idempresa = Input::get("idempresa");
        $filtro .= " AND tbl.idempresa = ".$idempresa;    
    }
    $resultado = DB::select('call perfil_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id == ''){
        $obj_perfil = new Perfil;
        $idempresa = Input::get('idempresa');
        $nombre = Input::get('nombre');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call perfil_iud(?,?,?,?,?,?)', array($id,$idempresa,$nombre,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Perfil = Perfil::find($id);
        $idempresa = Input::get('idempresa');
        $nombre = Input::get('nombre');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call perfil_iud(?,?,?,?,?,?)', array($id,$idempresa,$nombre,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call perfil_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));

    $filtro = "";
    $filtro .= " AND tbl.activo = 1 ";
    $filtro .= " AND tbl.idperfil = ".$id;
    $objetos = DB::select('call perfilobjeto_listar(?,?)', array('',$filtro));

    return Response::json(array('obj' =>$resultado,'objetos'=>$objetos));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call perfil_iud(?,?,?,?,?,?)', array($id,'','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


