<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Detallepedido;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DetallepedidoController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call detallepedido_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_detallepedido = new Detallepedido;
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idpedido = Input::get('idpedido');
        $idproducto = Input::get('idproducto');
        $nombreproducto = Input::get('nombreproducto');
        $cantidad = Input::get('cantidad');
        $precio = Input::get('precio');
        $valor_vta = Input::get('valor_vta');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idpedido,$idproducto,$nombreproducto,$cantidad,$precio,$valor_vta,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Detallepedido = Detallepedido::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idpedido = Input::get('idpedido');
        $idproducto = Input::get('idproducto');
        $nombreproducto = Input::get('nombreproducto');
        $cantidad = Input::get('cantidad');
        $precio = Input::get('precio');
        $valor_vta = Input::get('valor_vta');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idpedido,$idproducto,$nombreproducto,$cantidad,$precio,$valor_vta,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call detallepedido_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


