<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Objeto;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ObjetoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro .= " AND tbl.activo = 1 ";
    if(Input::get('nivel')!=null){
        $nivel = Input::get('nivel');
        $filtro .= " AND tbl.nivel = ".$nivel;
    }
    $resultado = DB::select('call objeto_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_objeto = new Objeto;
        $nombre = Input::get('nombre');
        $titulo = Input::get('titulo');
        $idobjetopadre = Input::get('idobjetopadre');
        $nivel = Input::get('nivel');
        $idtipoobjeto = Input::get('idtipoobjeto');
        $nroorden = Input::get('nroorden');
        $propiedad = Input::get('propiedad');
        $icono = Input::get('icono');
        $parametros = Input::get('parametros');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call objeto_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$nombre,$titulo,$idobjetopadre,$nivel,$idtipoobjeto,$nroorden,$propiedad,$icono,$parametros,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Objeto = Objeto::find($id);
        $nombre = Input::get('nombre');
        $titulo = Input::get('titulo');
        $idobjetopadre = Input::get('idobjetopadre');
        $nivel = Input::get('nivel');
        $idtipoobjeto = Input::get('idtipoobjeto');
        $nroorden = Input::get('nroorden');
        $propiedad = Input::get('propiedad');
        $icono = Input::get('icono');
        $parametros = Input::get('parametros');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call objeto_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$nombre,$titulo,$idobjetopadre,$nivel,$idtipoobjeto,$nroorden,$propiedad,$icono,$parametros,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call objeto_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call objeto_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


