<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Cuentaampliacion;
use App\Cuenta;
use App\Subcuenta;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Config;
use Session;

class CuentaampliacionController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempr = ".$idempresa." AND tbl.idsede = ".$idsede;
    $resultado = DB::select('call cuentaampliacion_listar(?,?)', array(' ',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    $idempresa = Session::get('idempresa');
    $idsede = Session::get('idsede');

    try {
        if($id === ''){
            $obj_cuentaampliacion = new Cuentaampliacion;
            $obj_cuentaampliacion->idempr = $idempresa;
            $obj_cuentaampliacion->idsede = $idsede;
            $obj_cuentaampliacion->idcuenta = Input::get('idcuenta');
            $obj_cuentaampliacion->monto = Input::get('monto');
            $obj_cuentaampliacion->fecha = Input::get('fecha');
            $obj_cuentaampliacion->observacion = Input::get('observacion');
            $obj_cuentaampliacion->activo = 1;
            $obj_cuentaampliacion->created_by = Session::get('nombreusuario');
            $obj_cuentaampliacion->save();

            //buscar cuenta y añadir crédito
            $obj_cuenta = Cuenta::find(Input::get('idcuenta'));
            $obj_cuenta->limitecredito = $obj_cuenta->limitecredito + Input::get('monto');
            $obj_cuenta->save();        
            $mensaje = 'Registro exitoso';

        }
        else{
            $obj_cuentaampliacion = Cuentaampliacion::find($id);
            $obj_cuentaampliacion->idcuenta = Input::get('idcuenta');
            $obj_cuentaampliacion->monto = Input::get('idcuenta');
            $obj_cuentaampliacion->fecha = Input::get('idcuenta');
            $obj_cuentaampliacion->activo = 1;
            $obj_cuentaampliacion->updated_by = Session::get('nombreusuario');
            $obj_cuentaampliacion->save();
            $mensaje = 'Registro Actualizado';
        }

        if($obj_cuentaampliacion->id > 0){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje
            ));
        }else{
            DB::rollBack();
        }

    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll"
        ));
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call cuentaampliacion_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';

    try {
        $obj_cuentaampliacion = Cuentaampliacion::find($id);
        //buscar cuenta y disminuir crédito
        $obj_cuenta = Cuenta::find($obj_cuentaampliacion->idcuenta);
        $obj_cuenta->limitecredito = $obj_cuenta->limitecredito - $obj_cuentaampliacion->monto;
        $obj_cuenta->save();       

        //$resultado = DB::select('update cuentaampliacion set activo = 0 where id = ?', array($id));
        $obj_cuentaampliacion->activo = 0;
        $obj_cuentaampliacion->save();

        if($obj_cuentaampliacion){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  'Registro Eliminado'
            ));
        }   
    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll"
        ));
    }

}


}
