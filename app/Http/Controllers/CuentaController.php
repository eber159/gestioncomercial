<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Cuenta;
use App\Subcuenta;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Config;
use Session;

class CuentaController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempr = ".$idempresa." AND tbl.idsede = ".$idsede;
    $resultado = DB::select('call cuenta_listar(?,?)', array(' ',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    $codigo = "";
    $idempresa = Session::get('idempresa');
    $idsede = Session::get('idsede');

    if($id === ''){
        $obj_cuenta = new Cuenta;

        $codigo = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'CUENTA'));

        $obj_cuenta->codigo = Input::get('codigo');
        $obj_cuenta->idempr = $idempresa;
        $obj_cuenta->idsede = $idsede;
        $obj_cuenta->codigo = $codigo[0]->rpta;
        $obj_cuenta->idtitular = Input::get('idtitular');
        $obj_cuenta->idtipocuenta = Input::get('idtipocuenta');
        $obj_cuenta->idestadocuenta = Input::get('idestadocuenta');
        $obj_cuenta->idmoneda = Input::get('idmoneda');
        $obj_cuenta->fecha = Input::get('fecha');
        $obj_cuenta->idvendedor = Input::get('idvendedor');
        $obj_cuenta->limitecredito = Input::get('limitecredito');
        $obj_cuenta->activo = 1;
        $obj_cuenta->created_by = Session::get('nombreusuario');
        $obj_cuenta->updated_by = Session::get('nombreusuario');
        $obj_cuenta->save();

        $idcuenta = $obj_cuenta->id;

        $obj_subcuenta = new Subcuenta;
        $obj_subcuenta->idempr = $idempresa;
        $obj_subcuenta->idsede = $idsede;
        $obj_subcuenta->idcuenta = $idcuenta;
        $obj_subcuenta->fecha = date('Y-m-d H:i:s');
        $obj_subcuenta->descripcion = 'CHICLAYO';
        $obj_subcuenta->limitecredito = 999999999;
        $obj_subcuenta->activo = 1;
        $obj_subcuenta->created_by = Session::get('nombreusuario');
        $obj_subcuenta->save();

        $mensaje = 'Registro exitoso';

    }
    else{
        $obj_cuenta = Cuenta::find($id);
        $obj_cuenta->codigo = Input::get('codigo');
        //$obj_cuenta->idempr =Session::get('idempresa');
        //$obj_cuenta->idsede = Session::get('idsede');
        $obj_cuenta->idtitular = Input::get('idtitular');
        $obj_cuenta->idtipocuenta = Input::get('idtipocuenta');
        $obj_cuenta->idestadocuenta = Input::get('idestadocuenta');
        $obj_cuenta->idmoneda = Input::get('idmoneda');
        $obj_cuenta->fecha = Input::get('fecha');
        $obj_cuenta->idvendedor = Input::get('idvendedor');
        $obj_cuenta->limitecredito = Input::get('limitecredito');
        $obj_cuenta->activo = 1;
        $obj_cuenta->created_by = Session::get('nombreusuario');
        $obj_cuenta->updated_by = Session::get('nombreusuario');
        $obj_cuenta->save();
        //$resultado = DB::select('call cuenta_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$codigo,$idempr,$idsede,$idtitular,$idtipocuenta,$idestadocuenta,$idmoneda,$fecha,$idvendedor,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($obj_cuenta->id > 0){
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
    $resultado = DB::select('call cuenta_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    $filtro = "";
    $filtrotabla = " AND c.id = '".$id."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $detalles = DB::select('call detallecuenta_listar(?,?)', array('tbl.id',$filtro));
    return Response::json(array('obj' =>$resultado,"detalles"=>$detalles));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call cuenta_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

Public Function ListarTitular()
{
    $idtitular = Input::get('idtitular');
    $resultado = DB::select('call cuenta_listar(?,?)', array(''," AND tbl.activo = 1 AND tbl.idtitular = ".$idtitular));
    /*
    $var = "";
    $id = 0;
    foreach($resultado as $obj=>$val)
    {
        $filtro = "AND tbl.activo = 1 AND tbl.idcuenta = ".$val->id;
        $detalles = DB::select('call subcuenta_listar(?,?)', array('',$filtro));
        $val->detalles = $detalles;
    }
    return Response::json(array('lista'=>$resultado));
    */
    return Response::json(array('lista'=>$resultado));
}

}
