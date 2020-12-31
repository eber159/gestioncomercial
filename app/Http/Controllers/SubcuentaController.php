<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Subcuenta;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class SubcuentaController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call subcuenta_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_subcuenta = new Subcuenta;
        $idempr = Input::get('idempr');
        $idsede = Input::get('idsede');
        $idcuenta = Input::get('idcuenta');
        $fecha = Input::get('fecha');
        $descripcion = Input::get('descripcion');
        $limitecredito = Input::get('limitecredito');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call subcuenta_iud(?,?,?,?,?,?,?,?,?,?)', array($id,$idempr,$idsede,$idcuenta,$fecha,$descripcion,$limitecredito,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Subcuenta = Subcuenta::find($id);
        $idempr = Input::get('idempr');
        $idsede = Input::get('idsede');
        $idcuenta = Input::get('idcuenta');
        $fecha = Input::get('fecha');
        $descripcion = Input::get('descripcion');
        $limitecredito = Input::get('limitecredito');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call subcuenta_iud(?,?,?,?,?,?,?,?,?,?)', array($id,$idempr,$idsede,$idcuenta,$fecha,$descripcion,$limitecredito,$activo,$usuario,'UPD'));
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
    $resultado = DB::select('call subcuenta_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call subcuenta_iud(?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

Public Function ListarCuenta()
{
    $idcuenta = Input::get('idcuenta');
    $resultado = DB::select('call subcuenta_listar(?,?)', array(''," AND tbl.activo = 1 AND tbl.idcuenta = ".$idcuenta));
    return Response::json(array('lista'=>$resultado));
}

}


