<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Detallecuentapago;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DetallecuentapagoController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call detallecuentapago_listar(?,?)', array('',' AND activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_detallecuentapago = new Detallecuentapago;
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $iddetallecuenta = Input::get('iddetallecuenta');
        $iddetallecuenta_asoc = Input::get('iddetallecuenta_asoc');
        $fechapago = Input::get('fechapago');
        $pago = Input::get('pago');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallecuentapago_iud(?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$iddetallecuenta,$iddetallecuenta_asoc,$fechapago,$pago,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Detallecuentapago = Detallecuentapago::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $iddetallecuenta = Input::get('iddetallecuenta');
        $iddetallecuenta_asoc = Input::get('iddetallecuenta_asoc');
        $fechapago = Input::get('fechapago');
        $pago = Input::get('pago');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call detallecuentapago_iud(?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$iddetallecuenta,$iddetallecuenta_asoc,$fechapago,$pago,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($resultado > 0){
        DB::commit();
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	$mensaje
        ));
    }else{
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call detallecuentapago_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call detallecuentapago_iud(?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


