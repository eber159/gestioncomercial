<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordenpedido;
use App\Detallepedido;
use App\Item;
use App\Productoweb;
use App\Material;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use Exception;

class OrdenpedidoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    if(Input::get('idtrabajador')!=null){
        $idtrabajador = Input::get('idtrabajador');
        $filtro .= " AND tbl.idvendedor = ".$idtrabajador;
    }
    if(Input::get('nombreusuario')!=null){
        $nombreusuario = Input::get('nombreusuario');
        $filtro .= " AND tbl.created_by = '".$nombreusuario."'";
    }
    if(Input::get('idestado')!=null){
        $idestado = Input::get('idestado');
        $filtro .= " AND tbl.idestado = '".$idestado."'";
    }
    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
        $fechaini = Input::get('fechaini');
        $fechafin = Input::get('fechafin');
        $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
    }
    $resultado = DB::select('call ordenpedido_listar(?,?)', array('tbl.id desc ',$filtro));
    return Response::json(array('lista'=>$resultado,'filtro'=>$filtro));
}

Public Function Listar2()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    //$idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa;
    if(Input::get('idtrabajador')!=null){
        $idtrabajador = Input::get('idtrabajador');
        $filtro .= " AND tbl.idvendedor = ".$idtrabajador;
    }
    if(Input::get('nombreusuario')!=null){
        $nombreusuario = Input::get('nombreusuario');
        $filtro .= " AND tbl.created_by = '".$nombreusuario."'";
    }
    if(Input::get('idestado')!=null){
        $idestado = Input::get('idestado');
        $filtro .= " AND tbl.idestado = '".$idestado."'";
    }
    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
        $fechaini = Input::get('fechaini');
        $fechafin = Input::get('fechafin');
        $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
    }
    $resultado = DB::select('call ordenpedido_listar(?,?)', array('tbl.id desc ',$filtro));
    return Response::json(array('lista'=>$resultado,'filtro'=>$filtro));
}

Public Function ListarCodigo()
{
    $filtro = "";
    $codigo = Input::get('codigo');
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    $filtro .= " AND LTRIM(tbl.codigo) like '%".$codigo."'";
    $resultado = DB::select('call ordenpedido_listar(?,?)', array('',$filtro));
    $idpedido = "";

    if($resultado){
        if($resultado[0]->id > 0){
            $idpedido = $resultado[0]->id;
        }
    }

    $filtro = "";
    $filtrotabla = " AND tbl.idpedido = '".$idpedido."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $detalles = DB::select('call detallepedido_listar(?,?)', array('tbl.id',$filtro));

    return Response::json(array('obj' =>$resultado,'detalles'=>$detalles));

}

public function Guardar(){
    try {
        $error = false;
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $codigopedido = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'PEDIDO'));
        $usuario = Session::get('nombreusuario');
        $limitecredito = 0;

        if($idempresa==""){
            throw new Exception("Su tiempo de sesi&oacute;n ha expirado, Por favor vuelva a logearse.");
        }
        
        DB::beginTransaction();
        //throw new Exception("Error aquii", 1);
        $obj_ordenpedido = new Ordenpedido;

        $mensaje='';
        $id = Input::get('id');
        if($id === ''){
            
            //$obj_ordenpedido = new Ordenpedido;
            $obj_ordenpedido->codigo = $codigopedido[0]->rpta;
            $obj_ordenpedido->idempresa = $idempresa;
            $obj_ordenpedido->idsede = $idsede;
            $obj_ordenpedido->fecha = Input::get('fecha');
            $obj_ordenpedido->idcliente = Input::get('idcliente');
            $obj_ordenpedido->nombrecliente = Input::get('nombrecliente');
            $obj_ordenpedido->idestado = Input::get('idestado');
            $obj_ordenpedido->total = Input::get('total');
            $obj_ordenpedido->idvendedor = Input::get('idvendedor');
            $obj_ordenpedido->glosa = Input::get('glosa');
            $obj_ordenpedido->idtipopago = Input::get('idtipopago');
            $obj_ordenpedido->activo = 1;
            $obj_ordenpedido->created_by = $usuario;
            $obj_ordenpedido->updated_by = $usuario;
            $obj_ordenpedido->save();
            if(!($obj_ordenpedido->id > 0)){
                throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                $error = true;
            }
            //$obj_ordenpedido->resultado = DB::select('call ordenpedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$codigo,$idempresa,$idsede,$fecha,$idcliente,$idestado,$total,$idvendedor,$glosa,$idtipopago,$activo,$usuario,'INS'));

            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle==""){
                    if($val["activo"]==1){
                        $obj_detallepedido = new Detallepedido;
                        $obj_detallepedido->idpedido = $obj_ordenpedido->id;
                        $obj_detallepedido->idproducto = $val['idproducto'];
                        $obj_detallepedido->nombreproducto = $val['nombreproducto'];
                        $obj_detallepedido->cantidad = $val['cantidad'];
                        $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                        $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                        $obj_detallepedido->pendiente = $val['cantidad'];
                        $obj_detallepedido->precio = $val['precio'];
                        $obj_detallepedido->valor_vta = $val['valor_vta'];
                        $obj_detallepedido->activo = 1;
                        $obj_detallepedido->created_by = $usuario;
                        $obj_detallepedido->updated_by = $usuario;
                        $obj_detallepedido->save();
                        //$resultado2 = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idpedido,$idproducto,$nombreproducto,$cantidad,$pendiente,$precio,$valor_vta,$idunidadmedida,$unidadmedida,$activo,$usuario,'INS'));
                        if(!($obj_detallepedido->id > 0)){
                            throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                            $error = true;
                        }
                    } 
                }
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_ordenpedido = Ordenpedido::find($id);

            if($obj_ordenpedido->idestado == Config::get('constants.estadopedido.atendido')){
                throw new Exception("El pedido ya ha sido atendido, no se puede modificar", 1);
                $error = true;
            }

            $obj_ordenpedido->fecha = Input::get('fecha');
            $obj_ordenpedido->idcliente = Input::get('idcliente');
            $obj_ordenpedido->nombrecliente = Input::get('nombrecliente');
            $obj_ordenpedido->idestado = Input::get('idestado');
            $obj_ordenpedido->total = Input::get('total');
            $obj_ordenpedido->idvendedor = Input::get('idvendedor');
            $obj_ordenpedido->glosa = Input::get('glosa');
            $obj_ordenpedido->idtipopago = Input::get('idtipopago');
            $obj_ordenpedido->activo = 1;
            $obj_ordenpedido->updated_by = $usuario;
            $obj_ordenpedido->save();
            if(!($obj_ordenpedido->id > 0)){
                throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                $error = true;
            }


            //$resultado = DB::select('call ordenpedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$codigo,$idempresa,$idsede,$fecha,$idcliente,$idestado,$total,$idvendedor,$glosa,$idtipopago,$activo,$usuario,'UPD'));
            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle==""){
                    if($val["activo"]==1){
                        $obj_detallepedido = new Detallepedido;
                        $obj_detallepedido->idpedido = $id;
                        $obj_detallepedido->idproducto = $val['idproducto'];
                        $obj_detallepedido->nombreproducto = $val['nombreproducto'];
                        $obj_detallepedido->cantidad = $val['cantidad'];
                        $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                        $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                        $obj_detallepedido->pendiente = $val['cantidad'];
                        $obj_detallepedido->precio = $val['precio'];
                        $obj_detallepedido->valor_vta = $val['valor_vta'];
                        $obj_detallepedido->activo = 1;
                        $obj_detallepedido->created_by = $usuario;
                        $obj_detallepedido->updated_by = $usuario;
                        $obj_detallepedido->save();
                        if(!($obj_detallepedido->id > 0)){
                            throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                            $error = true;
                        }
                        //$activo = 1;
                        //$resultado = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idpedido,$idproducto,$nombreproducto,$cantidad,$pendiente,$precio,$valor_vta,$idunidadmedida,$unidadmedida,$activo,$usuario,'INS'));
                    }  
                }
                else{
                    $obj_detallepedido = Detallepedido::find($iddetalle);
                    $obj_detallepedido->idproducto = $val['idproducto'];
                    $obj_detallepedido->nombreproducto = $val['nombreproducto'];
                    $obj_detallepedido->cantidad = $val['cantidad'];
                    $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                    $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                    $obj_detallepedido->pendiente = $val['cantidad'];
                    $obj_detallepedido->precio = $val['precio'];
                    $obj_detallepedido->valor_vta = $val['valor_vta'];
                    $obj_detallepedido->activo = $val["activo"];
                    $obj_detallepedido->updated_by = $usuario;                    
                    $obj_detallepedido->save();
                }
            }

            $mensaje = 'Registro Actualizado';
        }

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
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

public function CambiarEstado(){
    
    try {
        $error = false;
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $usuario = Session::get('nombreusuario');
        $limitecredito = 0;
        
        //BUSCAR SU CUENTA DE TIPO CLIENTE
        /*
        $filtro = "";
        $idempresa = Session::get("idempresa");
        $idsede = Session::get("idsede");
        $idcliente = Input::get('idcliente');
        $filtro .= " AND tbl.activo = 1 AND tbl.idempr = ".$idempresa." AND tbl.idsede = ".$idsede." AND tbl.idtitular = ".$idcliente." AND tbl.idestadocuenta = ".Config::get('constants.estadocuenta.activa')." AND tbl.idtipocuenta = ".Config::get('constants.tipocuenta.cliente');
        $cuenta = DB::select('call cuenta_listar(?,?)', array(' ',$filtro));
        */
        //_________________________________________________________________________


        DB::beginTransaction();

        $mensaje='';
        $id = Input::get('id');

        $obj_ordenpedido = new Ordenpedido;
        $obj_ordenpedido = Ordenpedido::find($id);

        //extraer datos de la cuenta
        /*
        if(Input::get('idtipopago') == Config::get('constants.tipopago.credito')){
            if($cuenta){
                $limitecredito = $cuenta[0]->limitecredito;
                $saldo = $cuenta[0]->saldo;
                $saldo = $saldo + $obj_ordenpedido->total;
                if($saldo > $limitecredito){
                    throw new Exception("El límite de crédito excede al pedido que está realizando", 1);
                    $error = true;
                }
            }else{
                throw new Exception("El Cliente no tiene una cuentad en el Sistema", 1);
                $error = true;
            }
        }
        */

        $obj_ordenpedido->idestado = Input::get('idestado');
        $obj_ordenpedido->updated_by = $usuario;
        $obj_ordenpedido->save();
        if(!($obj_ordenpedido->id > 0)){
            throw new Exception("Ocurrio un error en la operación", 1);
            $error = true;
        }

        if($obj_ordenpedido->idestado == Config::get('constants.estadopedido.aprobado')){
            $mensaje = "Orden de pedido Aprobada";
        }

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
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

public function RechazarPedido(){
    
    try {
        $error = false;
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $usuario = Session::get('nombreusuario');

        DB::beginTransaction();

        $mensaje='';
        $id = Input::get('id');

        $obj_ordenpedido = new Ordenpedido;
        $obj_ordenpedido = Ordenpedido::find($id);
        $obj_ordenpedido->idestado = Input::get('idestado');
        $obj_ordenpedido->updated_by = $usuario;
        $obj_ordenpedido->save();
        if(!($obj_ordenpedido->id > 0)){
            throw new Exception("Ocurrió un error en la operación", 1);
            $error = true;
        }
        $mensaje = "Orden de pedido Rechazada";
        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
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
    $sql = "";
    $resultado = DB::select('call ordenpedido_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));

    $filtro = "";
    $filtrotabla = " AND tbl.idpedido = '".$id."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $detalles = DB::select('call detallepedido_listar(?,?)', array('tbl.id',$filtro));

    return Response::json(array('obj' =>$resultado,'detalles'=>$detalles));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = Session::get("nombreusuario");
    $resultado = DB::select('call ordenpedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

public function AgregarFormaPago(){
    
    try {
        $error = false;
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $usuario = Session::get('nombreusuario');

        DB::beginTransaction();

        $mensaje='';
        $id = Input::get('id');

        $obj_ordenpedido = new Ordenpedido;
        $obj_ordenpedido = Ordenpedido::find($id);
        $obj_ordenpedido->formapago = Input::get('formapago');
        $obj_ordenpedido->updated_by = $usuario;
        $obj_ordenpedido->save();
        if(!($obj_ordenpedido->id > 0)){
            throw new Exception("Ocurrió un error en la operación", 1);
            $error = true;
        }
        $mensaje = "Pago agregado";
        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
        }
    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll",
            'linea'         => $e->getLine()
        ));   
    }
}


    
public function GuardarExterno(){
    
    try {
        $error = false;
        $idempresa = 1;
        $idsede = 1;
        $codigopedido = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'PEDIDO'));
        $usuario = "USUARIO EXTERNO";
        $limitecredito = 0;
        
        DB::beginTransaction();
        //throw new Exception("Error aquii", 1);
        $obj_ordenpedido = new Ordenpedido;

        $mensaje='';
        $id = Input::get('id');
        if($id === ''){
            
            //$obj_ordenpedido = new Ordenpedido;
            $obj_ordenpedido->codigo = $codigopedido[0]->rpta;
            $obj_ordenpedido->idempresa = $idempresa;
            $obj_ordenpedido->idsede = $idsede;
            $obj_ordenpedido->fecha = Input::get('fecha');
            $obj_ordenpedido->idcliente = Input::get('idcliente');
            $obj_ordenpedido->nombrecliente = Input::get('nombrecliente');
            $obj_ordenpedido->idestado = Input::get('idestado');
            $obj_ordenpedido->total = Input::get('total');
            $obj_ordenpedido->idvendedor = Input::get('idvendedor');
            $obj_ordenpedido->glosa = Input::get('glosa');
            $obj_ordenpedido->idtipopago = Input::get('idtipopago');
            $obj_ordenpedido->activo = 1;
            $obj_ordenpedido->created_by = $usuario;
            $obj_ordenpedido->updated_by = $usuario;
            $obj_ordenpedido->save();
            if(!($obj_ordenpedido->id > 0)){
                throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                $error = true;
            }
            //$obj_ordenpedido->resultado = DB::select('call ordenpedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$codigo,$idempresa,$idsede,$fecha,$idcliente,$idestado,$total,$idvendedor,$glosa,$idtipopago,$activo,$usuario,'INS'));

            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle==""){
                    if($val["activo"]==1){
                        $obj_detallepedido = new Detallepedido;
                        $obj_detallepedido->idpedido = $obj_ordenpedido->id;
                        $obj_detallepedido->idproducto = $val['idproducto'];
                        $obj_detallepedido->nombreproducto = $val['nombreproducto'];
                        $obj_detallepedido->cantidad = $val['cantidad'];
                        $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                        $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                        $obj_detallepedido->pendiente = $val['cantidad'];
                        $obj_detallepedido->precio = $val['precio'];
                        $obj_detallepedido->valor_vta = $val['valor_vta'];
                        $obj_detallepedido->activo = 1;
                        $obj_detallepedido->created_by = $usuario;
                        $obj_detallepedido->updated_by = $usuario;
                        $obj_detallepedido->save();
                        //$resultado2 = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idpedido,$idproducto,$nombreproducto,$cantidad,$pendiente,$precio,$valor_vta,$idunidadmedida,$unidadmedida,$activo,$usuario,'INS'));
                        if(!($obj_detallepedido->id > 0)){
                            throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                            $error = true;
                        }
                    } 
                }
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_ordenpedido = Ordenpedido::find($id);

            if($obj_ordenpedido->idestado == Config::get('constants.estadopedido.atendido')){
                throw new Exception("El pedido ya ha sido atendido, no se puede modificar", 1);
                $error = true;
            }

            $obj_ordenpedido->fecha = Input::get('fecha');
            $obj_ordenpedido->idcliente = Input::get('idcliente');
            $obj_ordenpedido->nombrecliente = Input::get('nombrecliente');
            $obj_ordenpedido->idestado = Input::get('idestado');
            $obj_ordenpedido->total = Input::get('total');
            $obj_ordenpedido->idvendedor = Input::get('idvendedor');
            $obj_ordenpedido->glosa = Input::get('glosa');
            $obj_ordenpedido->idtipopago = Input::get('idtipopago');
            $obj_ordenpedido->activo = 1;
            $obj_ordenpedido->updated_by = $usuario;
            $obj_ordenpedido->save();
            if(!($obj_ordenpedido->id > 0)){
                throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                $error = true;
            }


            //$resultado = DB::select('call ordenpedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$codigo,$idempresa,$idsede,$fecha,$idcliente,$idestado,$total,$idvendedor,$glosa,$idtipopago,$activo,$usuario,'UPD'));
            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle==""){
                    if($val["activo"]==1){
                        $obj_detallepedido = new Detallepedido;
                        $obj_detallepedido->idpedido = $id;
                        $obj_detallepedido->idproducto = $val['idproducto'];
                        $obj_detallepedido->nombreproducto = $val['nombreproducto'];
                        $obj_detallepedido->cantidad = $val['cantidad'];
                        $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                        $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                        $obj_detallepedido->pendiente = $val['cantidad'];
                        $obj_detallepedido->precio = $val['precio'];
                        $obj_detallepedido->valor_vta = $val['valor_vta'];
                        $obj_detallepedido->activo = 1;
                        $obj_detallepedido->created_by = $usuario;
                        $obj_detallepedido->updated_by = $usuario;
                        $obj_detallepedido->save();
                        if(!($obj_detallepedido->id > 0)){
                            throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                            $error = true;
                        }
                        //$activo = 1;
                        //$resultado = DB::select('call detallepedido_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idpedido,$idproducto,$nombreproducto,$cantidad,$pendiente,$precio,$valor_vta,$idunidadmedida,$unidadmedida,$activo,$usuario,'INS'));
                    }  
                }
                else{
                    $obj_detallepedido = Detallepedido::find($iddetalle);
                    $obj_detallepedido->idproducto = $val['idproducto'];
                    $obj_detallepedido->nombreproducto = $val['nombreproducto'];
                    $obj_detallepedido->cantidad = $val['cantidad'];
                    $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                    $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                    $obj_detallepedido->pendiente = $val['cantidad'];
                    $obj_detallepedido->precio = $val['precio'];
                    $obj_detallepedido->valor_vta = $val['valor_vta'];
                    $obj_detallepedido->activo = $val["activo"];
                    $obj_detallepedido->updated_by = $usuario;                    
                    $obj_detallepedido->save();
                }
            }

            $mensaje = 'Registro Actualizado';
        }

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
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



    
public function GuardarPedidoWeb(){
    try {
        $error = false;
        $idempresa = 1;
        $idsede = 1;
        $codigopedido = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'PEDIDO'));
        $usuario = Session::get('nombreusuario');
        $limitecredito = 0;
        
        $obj_ordenpedido = new Ordenpedido;
        $total = 0;

        $productoscarrito = array();
        if(Session::get('carrito')){
            $productoscarrito = Session::get('carrito');
            if(count($productoscarrito) <= 0){
                throw new Exception("No hay detalles en el carrito de Compras. Agregue nuevamente.", 1);
            }else{
                foreach ($productoscarrito as $key => $value) {
                    $total = $total + (double) $value["valor_vta"];
                }
            }    
        }else{
            throw new Exception("No hay sesiones.", 1);
        }
        
        $nombrecliente = "";
        if(Input::get('nombrecliente')!=""){
            $nombrecliente = Input::get('nombrecliente');
        }else{
            $nombrecliente = session::get('nombretrabajador');
        }

        DB::beginTransaction();


        $obj_ordenpedido->codigo = $codigopedido[0]->rpta;
        $obj_ordenpedido->idempresa = $idempresa;
        $obj_ordenpedido->idsede = $idsede;
        $obj_ordenpedido->fecha = date('Y-m-d H:i:s');
        $obj_ordenpedido->idcliente = 0;
        $obj_ordenpedido->nombrecliente = $nombrecliente;
        $obj_ordenpedido->idestado = Config::get('constants.estadopedido.generado');
        $obj_ordenpedido->total = $total;
        $obj_ordenpedido->idvendedor = 0;
        $obj_ordenpedido->glosa = 'PEDIDO GENERADO DESDE LA WEB';
        $obj_ordenpedido->idtipopago = Config::get('constants.tipopago.contado') ;
        $obj_ordenpedido->activo = 1;
        $obj_ordenpedido->created_by = $usuario;
        $obj_ordenpedido->updated_by = $usuario;
        $obj_ordenpedido->save();
        if(!($obj_ordenpedido->id > 0)){
            throw new Exception("Ocurrio un error en el registro de Pedido", 1);
            $error = true;
        }

        foreach ($productoscarrito as $key => $val){
            $iddetalle = $val["id"];
            if($iddetalle==""){
                
                $idproducto=$val['idproducto'];
                $nombreproducto=$val['nombreproducto'];

                //buscar el producto asociado
                /*
                $productoweb = Productoweb::find($val['idproducto']);
                $producto = Material::find($productoweb->idproductoasociado);
                if($producto){
                    //throw new Exception("Error procesando el pedido, comuníquese con la empresa.", 1);
                    $idproducto = $producto->id;
                    $nombreproducto = $producto->nombre;
                }
                */

                $obj_detallepedido = new Detallepedido;
                $obj_detallepedido->idpedido = $obj_ordenpedido->id;
                $obj_detallepedido->idproducto = $idproducto;
                $obj_detallepedido->nombreproducto = $nombreproducto;
                $obj_detallepedido->cantidad = $val['cantidad'];
                $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                $obj_detallepedido->pendiente = $val['cantidad'];
                $obj_detallepedido->precio = $val['precio'];
                $obj_detallepedido->valor_vta = $val['valor_vta'];
                $obj_detallepedido->activo = 1;
                $obj_detallepedido->created_by = $usuario;
                $obj_detallepedido->updated_by = $usuario;
                $obj_detallepedido->save();

                if(!($obj_detallepedido->id > 0)){
                    throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                    $error = true;
                }
            }
        }
    
        if($error == false){

            $mensaje = 'Registro exitoso';
            $items = array();
            Session::put('carrito',$items);

            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
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


public function AgregarPedidoWeb(){
    try {
        $error = false;
        $idempresa = 1;
        $idsede = 1;
        $usuario = Session::get('nombreusuario');
        
        $obj_ordenpedido = new Ordenpedido;
        $total = 0;

        $productoscarrito = array();
        if(Session::get('carrito')){
            $productoscarrito = Session::get('carrito');
            if(count($productoscarrito) <= 0){
                throw new Exception("No hay detalles en el carrito de Compras. Agregue nuevamente.", 1);
            }else{
                foreach ($productoscarrito as $key => $value) {
                    $total = $total + (double) $value["valor_vta"];
                }
            }    
        }else{
            throw new Exception("No hay sesiones.", 1);
        }
        
        DB::beginTransaction();

        $idpedido = Input::get("idpedido");
        $OrdenPedido = Ordenpedido::find($idpedido);
        $detalles = DB::table('detallepedido')->where('idpedido',$idpedido)->where('activo',1)->get();

        $total = 0;
        if(!($OrdenPedido)){
            throw new Exception("Error al buscar el pedido.", 1);
        }

        foreach ($productoscarrito as $key => $val){
            $iddetalle = $val["id"];
            if($iddetalle==""){
                
                $idproducto=$val['idproducto'];
                $nombreproducto=$val['nombreproducto'];

                //buscar el producto asociado
                /*
                $productoweb = Productoweb::find($val['idproducto']);
                $producto = Material::find($productoweb->idproductoasociado);
                if($producto){
                    //throw new Exception("Error procesando el pedido, comuníquese con la empresa.", 1);
                    $idproducto = $producto->id;
                    $nombreproducto = $producto->nombre;
                }
                */

                $existe = false;

                foreach ($detalles as $det){

                    //throw new Exception($idproducto." //// ".$det->idproducto, 1);

                    if( (int) ( $idproducto ) == (int) ( $det->idproducto ) ){
                        //Si existe se añade la cantidad
                        $DetallePedido = Detallepedido::find($det->id);
                        $cantidad = $DetallePedido->cantidad + (int) $det->cantidad;
                        $valorventa = $cantidad * (double) $det->precio;
                        $DetallePedido->cantidad = $cantidad;
                        $DetallePedido->valor_vta = $valorventa;
                        $DetallePedido->save();
                        $existe = true;
                        $total = $total + $valorventa;
                    }
                }

                if($existe==false){
                    //Si no existe el detalle lo agrega
                    $obj_detallepedido = new Detallepedido;
                    $obj_detallepedido->idpedido = $OrdenPedido->id;
                    $obj_detallepedido->idproducto = $idproducto;
                    $obj_detallepedido->nombreproducto = $nombreproducto;
                    $obj_detallepedido->cantidad = $val['cantidad'];
                    $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                    $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                    $obj_detallepedido->pendiente = $val['cantidad'];
                    $obj_detallepedido->precio = $val['precio'];
                    $obj_detallepedido->valor_vta = $val['valor_vta'];
                    $obj_detallepedido->activo = 1;
                    $obj_detallepedido->created_by = $usuario;
                    $obj_detallepedido->updated_by = $usuario;
                    $obj_detallepedido->save();
                    $total = $total + $val['valor_vta'];
                }

                /*
                if(!($obj_detallepedido->id > 0)){
                    throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                    $error = true;
                }
                */

            }
        }


        //recalcular totales
        $totalpedido = $OrdenPedido->total;
        $OrdenPedido->total = $totalpedido + $total;
        $OrdenPedido->save();
    
        if($error == false){

            $mensaje = 'Registro exitoso';
            $items = array();
            Session::put('carrito',$items);

            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
        }

    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll",
            'linea'         => $e->getLine()
        ));
    }
}





//==================================================================================================================
public function fn_GuardarPedidoWeb($nombrecliente){
    try {
        $error = false;
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $codigopedido = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'PEDIDO'));
        $usuario = Session::get('nombreusuario');
        $limitecredito = 0;
        
        $obj_ordenpedido = new Ordenpedido;
        $total = 0;

        $productoscarrito = array();
        if(Session::get('carrito')){
            $productoscarrito = Session::get('carrito');
            if(count($productoscarrito) <= 0){
                throw new Exception("No hay detalles en el carrito de Compras. Agregue nuevamente.", 1);
            }else{
                foreach ($productoscarrito as $key => $value) {
                    $total = $total + (double) $value["valor_vta"];
                }
            }    
        }else{
            throw new Exception("No hay sesiones.", 1);
        }
        
        if($nombrecliente!=""){
            $nombrecliente = $nombrecliente;
        }else{
            $nombrecliente = session::get('nombretrabajador');
        }

        //DB::beginTransaction();


        $obj_ordenpedido->codigo = $codigopedido[0]->rpta;
        $obj_ordenpedido->idempresa = $idempresa;
        $obj_ordenpedido->idsede = $idsede;
        $obj_ordenpedido->fecha = date('Y-m-d H:i:s');
        $obj_ordenpedido->idcliente = 0;
        $obj_ordenpedido->nombrecliente = $nombrecliente;
        $obj_ordenpedido->idestado = Config::get('constants.estadopedido.generado');
        $obj_ordenpedido->total = $total;
        $obj_ordenpedido->idvendedor = 0;
        $obj_ordenpedido->glosa = 'PEDIDO GENERADO DESDE LA WEB';
        $obj_ordenpedido->idtipopago = Config::get('constants.tipopago.contado') ;
        $obj_ordenpedido->activo = 1;
        $obj_ordenpedido->created_by = $usuario;
        $obj_ordenpedido->updated_by = $usuario;
        $obj_ordenpedido->save();
        if(!($obj_ordenpedido->id > 0)){
            throw new Exception("Ocurrio un error en el registro de Pedido", 1);
            $error = true;
        }

        foreach ($productoscarrito as $key => $val){
            $iddetalle = $val["id"];
            if($iddetalle==""){
                
                $idproducto=$val['idproducto'];
                $nombreproducto=$val['nombreproducto'];

                //buscar el producto asociado
                /*
                $productoweb = Productoweb::find($val['idproducto']);
                $producto = Material::find($productoweb->idproductoasociado);
                if($producto){
                    //throw new Exception("Error procesando el pedido, comuníquese con la empresa.", 1);
                    $idproducto = $producto->id;
                    $nombreproducto = $producto->nombre;
                }
                */

                $obj_detallepedido = new Detallepedido;
                $obj_detallepedido->idpedido = $obj_ordenpedido->id;
                $obj_detallepedido->idproducto = $idproducto;
                $obj_detallepedido->nombreproducto = $nombreproducto;
                $obj_detallepedido->cantidad = $val['cantidad'];
                $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                $obj_detallepedido->pendiente = $val['cantidad'];
                $obj_detallepedido->precio = $val['precio'];
                $obj_detallepedido->valor_vta = $val['valor_vta'];
                $obj_detallepedido->activo = 1;
                $obj_detallepedido->created_by = $usuario;
                $obj_detallepedido->updated_by = $usuario;
                $obj_detallepedido->save();

                if(!($obj_detallepedido->id > 0)){
                    throw new Exception("Ocurrió un error en el registro de Pedido", 1);
                    $error = true;
                }
            }
        }
        
        if($error == false){
            return $obj_ordenpedido;
        }else{
            return null;
        }

    } catch (Exception $e) {
        throw $e;
    }
}


public function fn_AgregarPedidoWeb($idpedido,$talla){
    try {
        $error = false;
        $idempresa = 1;
        $idsede = 1;
        $usuario = Session::get('nombreusuario');
        
        $obj_ordenpedido = new Ordenpedido;
        $total = 0;

        $productoscarrito = array();
        if(Session::get('carrito')){
            $productoscarrito = Session::get('carrito');
            if(count($productoscarrito) <= 0){
                throw new Exception("No hay detalles en el carrito de Compras. Agregue nuevamente.", 1);
            }else{
                foreach ($productoscarrito as $key => $value) {
                    $total = $total + (double) $value["valor_vta"];
                }
            }    
        }else{
            throw new Exception("No hay sesiones.", 1);
        }
        
        //DB::beginTransaction();

        $OrdenPedido = Ordenpedido::find($idpedido);
        $detalles = DB::table('detallepedido')->where('idpedido',$idpedido)->where('activo',1)->get();

        $total = 0;
        if(!($OrdenPedido)){
            throw new Exception("Error al buscar el pedido.", 1);
        }

        foreach ($productoscarrito as $key => $val){
            $iddetalle = $val["id"];

            if($iddetalle==""){
                
                $idproducto=$val['idproducto'];
                $nombreproducto=$val['nombreproducto'];

                //buscar el producto asociado
                $productoweb = Productoweb::find($val['idproducto']);

                /*
                $producto = Material::find($productoweb->idproductoasociado);
                $material = new Material();

                if($talla=="" || $talla==null){
                    //busca el producto asociado para sacar el código y colocarlo en el carrito (así luego ya no buscarlo)
                    $productosistema = DB::table('material')->where('activo', 1)->where('id',$producto->idproductoasociado)->first();
                    $material = $productosistema;
                }else{
                    $productosistema = DB::table('material')->where('activo', 1)->where('id',$producto->idproductoasociado)->first();
                    if($productosistema){
                        //encontrar el producto adecuado combinado con la talla
                        $productosistema2 = DB::table('material')->where('activo', 1)->where('idproductoasociado',$productosistema->id)->where('tamanio',$talla)->first();
                        $material = $productosistema2;
                    }
                }


                if($material){
                    //throw new Exception("Error procesando el pedido, comuníquese con la empresa.", 1);
                    $idproducto = $material->id;
                    $nombreproducto = $material->nombre;
                }
                */

                $existe = false;

                foreach ($detalles as $det){
                    if($idproducto == $det->idproducto){
                        //Si existe se añade la cantidad
                        $DetallePedido = Detallepedido::find($det->id);
                        $cantidad = (int) $DetallePedido->cantidad + (int) $val['cantidad'];
                        $valorventa = $cantidad * (double) $det->precio;
                        $DetallePedido->cantidad = $cantidad;
                        $DetallePedido->valor_vta = $valorventa;
                        //throw new Exception($DetallePedido->cantidad);
                        $DetallePedido->save();
                        $existe = true;
                        $total = $total + $valorventa;
                    }
                }

                if($existe==false){
                    //Si no existe el detalle lo agrega
                    $obj_detallepedido = new Detallepedido;
                    $obj_detallepedido->idpedido = $OrdenPedido->id;
                    $obj_detallepedido->idproducto = $idproducto;
                    $obj_detallepedido->nombreproducto = $nombreproducto;
                    $obj_detallepedido->cantidad = $val['cantidad'];
                    $obj_detallepedido->idunidadmedida = $val['idunidadmedida'];
                    $obj_detallepedido->unidadmedida = $val['unidadmedida'];
                    $obj_detallepedido->pendiente = $val['cantidad'];
                    $obj_detallepedido->precio = $val['precio'];
                    $obj_detallepedido->valor_vta = $val['valor_vta'];
                    $obj_detallepedido->activo = 1;
                    $obj_detallepedido->created_by = $usuario;
                    $obj_detallepedido->updated_by = $usuario;
                    $obj_detallepedido->save();
                    $total = $total + $val['valor_vta'];
                }

            }
        }


        //recalcular totales
        $totalpedido = $OrdenPedido->total;
        $OrdenPedido->total = $totalpedido + $total;
        $OrdenPedido->save();
    
        if($error == false){
            return $OrdenPedido;
        }else{
            return null;
        }

    } catch (Exception $e) {
        throw $e;
    }
}


public function AgregarPedidoWebVendedor(){
    try {

        DB::beginTransaction(); 

        //Guardar los productos en una sesión
        $detalles = array();
        $idproducto = Input::get("idproducto");
        $cantidad = Input::get("cantidad");
        $talla = Input::get("talla");
        $detallepedido = new Detallepedido();

        //Obtener los datos del producto para agregarlo
        $producto = Productoweb::find($idproducto);


        $material = new Material();

        if($talla=="" || $talla==null){
            //busca el producto asociado para sacar el código y colocarlo en el carrito (así luego ya no buscarlo)
            $productosistema = DB::table('material')->where('activo', 1)->where('id',$producto->idproductoasociado)->first();
            $material = $productosistema;
        }else{
            $productosistema = DB::table('material')->where('activo', 1)->where('id',$producto->idproductoasociado)->first();
            if($productosistema){
                //encontrar el producto adecuado combinado con la talla
                $productosistema2 = DB::table('material')->where('activo', 1)->where('idproductoasociado',$productosistema->id)->where('tamanio',$talla)->first();
                $material = $productosistema2;
            }
        }


        if($producto){
            //Agregar los datos al detalle pedido
            $detallepedido = new detallepedido();
            $detallepedido->idproducto = $material->id;
            $detallepedido->nombreproducto = $material->nombre;
            $detallepedido->cantidad = $cantidad;
            $detallepedido->pendiente = $cantidad;
            $detallepedido->precio = $producto->precio;
            $detallepedido->valor_vta = $producto->precio * $cantidad;
            $detallepedido->idunidadmedida = 1;
            $detallepedido->unidadmedida = "UNIDAD";

        }

        //Si la sesión ya existe
        if(Session::get('carrito')){
            //Buscar si el producto ya está en la lista para agregar la cantidad
            $productoscarrito = Session::get('carrito');

            $existe = false;
            foreach ($productoscarrito as $key => $value) {
                if($existe==false){
                    if($value["idproducto"]==$idproducto){
                        $nuevacantidad = (int) ($value["cantidad"]) + (int) ($cantidad);
                        $value["cantidad"] = $nuevacantidad;
                        $value["prendiente"] = $nuevacantidad;
                        $value["valor_vta"] = $nuevacantidad * $producto->precio;
                        $existe = true;
                    }
                }
            }
            if($existe==false){
                array_push($productoscarrito, $detallepedido);
            }
            Session::put('carrito', $productoscarrito);
        }else{
            array_push($detalles, $detallepedido);
            Session::put('carrito', $detalles);
        }

        $Pedido = new Ordenpedido();

        if(Input::get('idpedido')==""){
            $Pedido = self::fn_GuardarPedidoWeb(Input::get('nombrecliente'));

            $items = array();
            Session::put('carrito',$items);

            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  "Pedido Registrado"
            ));
        }else{
            $Pedido = self::fn_AgregarPedidoWeb(Input::get('idpedido'),$talla);
            DB::commit();

            $items = array();
            Session::put('carrito',$items);

            return Response::json(array(
                'success'       =>  true,
                'message'       =>  "Pedido Actualizado"
            ));
        }

    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll",
            'linea'         => $e->getLine()
        ));
    }
}


/*
    try {
        

        //Recorrer los detalles de la session carrito
        


        $mensaje='';
        $id = Input::get('id');
        if($id === ''){
            
            //$obj_ordenpedido = new Ordenpedido;
            

            
            

        }

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenpedido->id,
                'resultadocodigo' => $obj_ordenpedido->codigo
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
        }
    } catch (Exception $e) {
        
    }
    */


}


