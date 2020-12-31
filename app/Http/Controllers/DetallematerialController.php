<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Detallematerial;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DetallematerialController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call detallematerial_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_detallematerial = new Detallematerial;
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idtabla = Input::get('idtabla');
        $idproducto = Input::get('idproducto');
        $nombreproducto = Input::get('nombreproducto');
        $descripcion = Input::get('descripcion');
        $idalmacen = Input::get('idalmacen');
        $cantidad = Input::get('cantidad');
        $cantidadpendiente = Input::get('cantidadpendiente');
        $precio_unit_sigv = Input::get('precio_unit_sigv');
        $precio_unit_igv = Input::get('precio_unit_igv');
        $valor_vta_sigv = Input::get('valor_vta_sigv');
        $valor_vta_igv = Input::get('valor_vta_igv');
        $dscto = Input::get('dscto');
        $indigv = Input::get('indigv');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallematerial_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idtabla,$idproducto,$nombreproducto,$descripcion,$idalmacen,$cantidad,$cantidadpendiente,$precio_unit_sigv,$precio_unit_igv,$valor_vta_sigv,$valor_vta_igv,$dscto,$indigv,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Detallematerial = Detallematerial::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idtabla = Input::get('idtabla');
        $idproducto = Input::get('idproducto');
        $nombreproducto = Input::get('nombreproducto');
        $descripcion = Input::get('descripcion');
        $idalmacen = Input::get('idalmacen');
        $cantidad = Input::get('cantidad');
        $cantidadpendiente = Input::get('cantidadpendiente');
        $precio_unit_sigv = Input::get('precio_unit_sigv');
        $precio_unit_igv = Input::get('precio_unit_igv');
        $valor_vta_sigv = Input::get('valor_vta_sigv');
        $valor_vta_igv = Input::get('valor_vta_igv');
        $dscto = Input::get('dscto');
        $indigv = Input::get('indigv');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallematerial_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idtabla,$idproducto,$nombreproducto,$descripcion,$idalmacen,$cantidad,$cantidadpendiente,$precio_unit_sigv,$precio_unit_igv,$valor_vta_sigv,$valor_vta_igv,$dscto,$indigv,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call detallematerial_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call detallematerial_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


