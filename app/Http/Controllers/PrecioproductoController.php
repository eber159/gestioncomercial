<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Precioproducto;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;

class PrecioproductoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa;
    if(Input::get('idproducto')!=null){
        $idproducto = Input::get('idproducto');
        $filtro .= " AND tbl.idproducto = ".$idproducto;
    }
    $resultado = DB::select('call precioproducto_listar(?,?)', array('tbl.id asc',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');

    $obj_precioproducto = new Precioproducto;
    if($id != ''){
        $obj_precioproducto = Precioproducto::find($id);
    }
    $obj_precioproducto->idempresa =Session::get('idempresa');
    $obj_precioproducto->idsede = Session::get('idsede');
    $obj_precioproducto->idproducto = Input::get('idproducto');
    $obj_precioproducto->preciomenor = Input::get('preciomenor');
    $obj_precioproducto->preciomayor = Input::get('preciomayor');
    $obj_precioproducto->preciodistrib = Input::get('preciodistrib');
    $obj_precioproducto->preciocaja = Input::get('preciocaja');
    $obj_precioproducto->preciofactura = Input::get('preciofactura');
    $obj_precioproducto->preciooferta = Input::get('preciooferta');
    $obj_precioproducto->activo = 1;
    $obj_precioproducto->created_by = Session::get("nombreusuario");
    $obj_precioproducto->updated_by = Session::get("nombreusuario");
    $obj_precioproducto->save();

    if($id === ''){
        $mensaje = 'Registro exitoso';
    }
    else{
        $mensaje = 'Registro Actualizado';
    }

    if($obj_precioproducto->id > 0){
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
    $resultado = DB::select('call precioproducto_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call precioproducto_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


