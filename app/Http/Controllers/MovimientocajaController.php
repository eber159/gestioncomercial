<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Movimientocaja;
use App\Detallecuenta;
use App\Detallecuentapago;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Config;
use Session;

class MovimientocajaController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    $resultado = DB::select('call movimientocaja_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

Public Function ListarReporte()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $idcajabanco = Input::get('idcajabanco');
    $fechaini = Input::get('fechaini');
    $fechafin = Input::get('fechafin');
    
    $resultado = DB::select('call movimientocaja_reporte(?,?,?,?,?)', array($idempresa,$idsede,$idcajabanco,$fechaini,$fechafin));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    $error = false;
    if($id === ''){
        $obj_movimientocaja = new Movimientocaja;
        $obj_movimientocaja->idempresa =Session::get('idempresa');
        $obj_movimientocaja->idsede = Session::get('idsede');
        $obj_movimientocaja->fechamovimiento = Input::get('fechamovimiento');
        $obj_movimientocaja->fechaoperacion = Input::get('fechaoperacion');
        $obj_movimientocaja->idtipomovimiento = Input::get('idtipomovimiento');
        $obj_movimientocaja->idestadomovimiento = Input::get('idestadomovimiento');
        $obj_movimientocaja->idemprafecta = Input::get('idemprafecta');
        $obj_movimientocaja->idsubcuenta = Input::get('idsubcuenta');
        $obj_movimientocaja->idcajabanco = Input::get('idcajabanco');
        $obj_movimientocaja->nroctactble = Input::get('nroctactble');
        $obj_movimientocaja->idmediopago = Input::get('idmediopago');
        $obj_movimientocaja->fechacheque = Input::get('fechacheque');
        $obj_movimientocaja->nrovoucher = Input::get('nrovoucher');
        $obj_movimientocaja->idmoneda = Input::get('idmoneda');
        $obj_movimientocaja->tipocambio = Input::get('tipocambio');
        $obj_movimientocaja->debe_mn = Input::get('debe_mn');
        $obj_movimientocaja->haber_mn = Input::get('haber_mn');
        $obj_movimientocaja->debe_me = Input::get('debe_me');
        $obj_movimientocaja->haber_me = Input::get('haber_me');
        $obj_movimientocaja->iddetalleextorno = Input::get('iddetalleextorno');
        $obj_movimientocaja->glosa = Input::get('glosa');
        $obj_movimientocaja->referencia = Input::get('referencia');
        $obj_movimientocaja->tiporeferencia = Input::get('tiporeferencia');
        $obj_movimientocaja->idmovimientoorigendestino = Input::get('idmovimientoorigendestino');
        $obj_movimientocaja->activo = 1;
        $obj_movimientocaja->created_by = Session::get('nombreusuario');
        $obj_movimientocaja->updated_by = Session::get('nombreusuario');
        $obj_movimientocaja->save();
        if(!($obj_movimientocaja->id > 0)){
            $error = true;
        }

        foreach(Input::get('detalles') as $obj=>$val)
        {
            $id = "";
            //GUARDARMOS EL DETALLE EN LA CUENTA CORRIENTE
            $objdetallecuenta = new Detallecuenta;
            $objdetallecuenta->idempr = Session::get('idempresa');
            $objdetallecuenta->idsede = Session::get('idsede');
            $objdetallecuenta->tipocambio = Input::get('tipocambio');
            $objdetallecuenta->idsubcuenta = Input::get('idsubcuenta');
            $objdetallecuenta->fecha = date('Y-m-d H:i:s');
            $objdetallecuenta->fechapago = date('Y-m-d H:i:s');
            $objdetallecuenta->glosa = Input::get('glosa');
            $concepto = "";
            if(Input::get('idtipomovimiento')==Config::get('constants.tipomovimientocaja.ingreso')){
                $concepto = Config::get('constants.conceptos.cobrocaja');    
            }
            if(Input::get('idtipomovimiento')==Config::get('constants.tipomovimientocaja.egreso')){
                $concepto = Config::get('constants.conceptos.pagocaja');    
            }
            $objdetallecuenta->idconcepto = $concepto;
            $importesoles = 0;
            $importedolares = 0;
            if($val["idmoneda"]==Config::get('constants.moneda.soles')){
                $importesoles = $val["importe"];
                $importedolares = $val["importe"] / Input::get('tipocambio');
            }else{
                $importesoles = $val["importe"] * Input::get('tipocambio');
                $importedolares = $val["importe"];
            }
            $objdetallecuenta->importemn = $importesoles;
            $objdetallecuenta->importeme = $importedolares;
            $objdetallecuenta->saldo = 0;
            $objdetallecuenta->indcargoabono = $val["indcargoabono"];
            $objdetallecuenta->tiporeferencia = 'movimientocaja';
            $objdetallecuenta->referencia = $obj_movimientocaja->id;
            $objdetallecuenta->activo = 1;
            $objdetallecuenta->created_by = Session::get('nombreusuario');
            $objdetallecuenta->updated_by = Session::get('nombreusuario');
            $objdetallecuenta->save();

            if(!($objdetallecuenta->id > 0)){
                $error = true;
            }

            //Salda el movimiento seleccionado
            $detallecuentapago = new Detallecuentapago;
            $detallecuentapago->idempresa = Session::get("idempresa");
            $detallecuentapago->idsede = Session::get("idsede");
            $detallecuentapago->iddetallecuenta = $objdetallecuenta->id;
            $detallecuentapago->iddetallecuenta_asoc = $val["id"];
            $detallecuentapago->pago = $val["importe"];
            $detallecuentapago->fechapago = date('Y-m-d H:i:s');
            $detallecuentapago->activo = 1;
            $detallecuentapago->created_by = Session::get('nombreusuario');
            $detallecuentapago->updated_by = Session::get('nombreusuario');
            $detallecuentapago->save();

            if(!($detallecuentapago->id > 0)){
                $error = true;
            }

            //SE AUTOPAGA
            $detallecuentapago = new Detallecuentapago;
            $detallecuentapago->idempresa = Session::get("idempresa");
            $detallecuentapago->idsede = Session::get("idsede");
            $detallecuentapago->iddetallecuenta = $objdetallecuenta->id;
            $detallecuentapago->iddetallecuenta_asoc = $objdetallecuenta->id;
            $detallecuentapago->pago = $val["importe"];
            $detallecuentapago->fechapago = date('Y-m-d H:i:s');
            $detallecuentapago->activo = 1;
            $detallecuentapago->created_by = Session::get('nombreusuario');
            $detallecuentapago->updated_by = Session::get('nombreusuario');
            $detallecuentapago->save();

            if(!($detallecuentapago->id > 0)){
                $error = true;
            }

        }

        $mensaje = 'Registro exitoso';
    }
    else{
        $Movimientocaja = Movimientocaja::find($id);
        $idempresa =Session::get('idempresa');
        $idsede = Session::get('idsede');
        $fechamovimiento = Input::get('fechamovimiento');
        $fechaoperacion = Input::get('fechaoperacion');
        $idtipomovimiento = Input::get('idtipomovimiento');
        $idestadomovimiento = Input::get('idestadomovimiento');
        $idemprafecta = Input::get('idemprafecta');
        $idsubcuenta = Input::get('idsubcuenta');
        $idcajabanco = Input::get('idcajabanco');
        $nroctactble = Input::get('nroctactble');
        $idmediopago = Input::get('idmediopago');
        $fechacheque = Input::get('fechacheque');
        $nrovoucher = Input::get('nrovoucher');
        $tipocambio = Input::get('tipocambio');
        $debe_mn = Input::get('debe_mn');
        $haber_mn = Input::get('haber_mn');
        $debe_me = Input::get('debe_me');
        $haber_me = Input::get('haber_me');
        $iddetalleextorno = Input::get('iddetalleextorno');
        $glosa = Input::get('glosa');
        $referencia = Input::get('referencia');
        $tiporeferencia = Input::get('tiporeferencia');
        $idmovimientoorigendestino = Input::get('idmovimientoorigendestino');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call movimientocaja_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$fechamovimiento,$fechaoperacion,$idtipomovimiento,$idestadomovimiento,$idemprafecta,$idsubcuenta,$idcajabanco,$nroctactble,$idmediopago,$fechacheque,$nrovoucher,$tipocambio,$debe_mn,$haber_mn,$debe_me,$haber_me,$iddetalleextorno,$glosa,$referencia,$tiporeferencia,$idmovimientoorigendestino,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($error == false){
        DB::commit();
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  $mensaje
        ));
    }else{
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  "Ocurrió un error en el registro"
        ));
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call movimientocaja_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call movimientocaja_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


