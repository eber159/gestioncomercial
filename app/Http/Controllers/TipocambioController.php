<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Tipocambio;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class TipocambioController extends BaseController {

Public Function Listar()
{
    $filtro = "";

    $fecha = Input::get('fecha');
    /*
    if($fecha!=null){
        $fecha = " AND fecha = '".$fecha."'";
    }*/
   
    $filtro .= " AND tbl.activo = 1 ";
    $resultado = DB::select('call tipocambio_listar(?,?)', array(' tbl.fecha desc ',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_tipocambio = new Tipocambio;
        $fecha = Input::get('fecha');
        $compra = Input::get('compra');
        $venta = Input::get('venta');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call tipocambio_iud(?,?,?,?,?,?,?)', array($id,$fecha,$compra,$venta,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Tipocambio = Tipocambio::find($id);
        $fecha = Input::get('fecha');
        $compra = Input::get('compra');
        $venta = Input::get('venta');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call tipocambio_iud(?,?,?,?,?,?,?)', array($id,$fecha,$compra,$venta,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call tipocambio_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call tipocambio_iud(?,?,?,?,?,?,?)', array($id,'','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


