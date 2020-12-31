<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordencompra;
use App\Detallecompra;
use App\Documento;
use App\Detalledocumento;
use App\Detallecuenta;
use App\Serie;
use App\Ordencompradocumento;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Config;
use Session;

class OrdencompraController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    $resultado = DB::select('call ordencompra_listar(?,?)', array(' tbl.id desc ',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $error = false;
    $id = Input::get('id');
    if($id === ''){

        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $usuario = Session::get('nombreusuario');
        $fecha = Input::get('fecharegistro');
        $fechapago = Input::get('fechacompra');

        $obj_ordencompra = new Ordencompra;
        $obj_ordencompra->idempresa = $idempresa;
        $obj_ordencompra->idsede = $idsede;
        $obj_ordencompra->idproveedor = Input::get('idproveedor');
        $obj_ordencompra->fecharegistro = Input::get('fecharegistro');
        $obj_ordencompra->fechacompra = Input::get('fechacompra');
        $obj_ordencompra->fecharecepcion = Input::get('fecharecepcion');
        $obj_ordencompra->indmaterialservicio = Input::get('indmaterialservicio');
        $obj_ordencompra->idtipopago = Input::get('idtipopago');
        $obj_ordencompra->idmoneda = Input::get('idmoneda');
        $obj_ordencompra->idestado = Input::get('idestado');
        $obj_ordencompra->idcuenta = Input::get('idcuenta');
        $obj_ordencompra->idsubcuenta = Input::get('idsubcuenta');
        $obj_ordencompra->subtotal = Input::get('subtotal');
        $obj_ordencompra->impuestovta = Input::get('impuestovta');
        $obj_ordencompra->total = Input::get('total');
        $obj_ordencompra->tipocambio = Input::get('tipocambio');
        $obj_ordencompra->glosa = Input::get('glosa');
        $obj_ordencompra->activo = 1;
        $obj_ordencompra->created_by = $usuario;
        $obj_ordencompra->updated_by = $usuario;
        $obj_ordencompra->save();

        $obj_ordencompra->save();
        if(!($obj_ordencompra->id > 0)){
            $error = true;
        }
        $mensaje = 'Registro exitoso';

        foreach(Input::get('detalles') as $obj=>$val)
        {
            $iddetalle = $val["id"];
            if($iddetalle==""){
                if($val["activo"]==1){
                    $obj_detallematerial = new Detallecompra();
                    $obj_detallematerial->idempresa = $idempresa;
                    $obj_detallematerial->idsede = $idsede;
                    $obj_detallematerial->idtabla = $obj_ordencompra->id;
                    $obj_detallematerial->idproducto = $val["idproducto"];
                    $obj_detallematerial->nombreproducto = $val["nombreproducto"];
                    $obj_detallematerial->descripcion = $val["descripcion"];
                    $obj_detallematerial->idalmacen = $val["idalmacen"];
                    $obj_detallematerial->cantidad = $val["cantidad"];
                    $obj_detallematerial->cantidadpendiente = $val["cantidadpendiente"];
                    $obj_detallematerial->precio_unit_sigv = $val["precio_unit_sigv"];
                    $obj_detallematerial->precio_unit_igv = $val["precio_unit_igv"];
                    $obj_detallematerial->valor_vta_sigv = $val["valor_vta_sigv"];
                    $obj_detallematerial->valor_vta_igv = $val["valor_vta_igv"];
                    $obj_detallematerial->dscto = $val["dscto"];
                    $obj_detallematerial->indigv = $val["indigv"];
                    $obj_detallematerial->idunidadmedida = $val["idunidadmedida"];
                    $obj_detallematerial->unidadmedida = $val["unidadmedida"];
                    $obj_detallematerial->activo = 1;
                    $obj_detallematerial->created_by = $usuario;
                    $obj_detallematerial->updated_by = $usuario;
                    $obj_detallematerial->save();
                    if(!($obj_detallematerial->id > 0)){
                        $error = true;
                    }
                } 
            }
        }



        // ========================== SI HAY UN DOCUMENTO ASOCIADO DEBE GENERAR EL DOCUMENTO Y SU PROVISIÓN ========================
        $objdocumento = Input::get("objdocumento");
        if($objdocumento!=null){
            $idmoneda = $objdocumento['idmoneda'];
            $total = $objdocumento['total'];
            $tipocambio = $objdocumento['tipocambio'];

            $obj_documento = new Documento;
            $obj_documento->idempresa = $idempresa;
            $obj_documento->idsede = $idsede;
            $obj_documento->idtipodocumento = $objdocumento['idtipodocumento'];
            $obj_documento->idclienteproveedor = $objdocumento['idclienteproveedor'];
            $obj_documento->idperiodo = $objdocumento['idperiodo'];
            $obj_documento->idestado = $objdocumento['idestado'];
            $obj_documento->cuentacontable = $objdocumento['cuentacontable'];
            $obj_documento->idmoneda = $objdocumento['idmoneda'];
            $obj_documento->tipocambio = $objdocumento['tipocambio'];
            $obj_documento->idtipocompraventa = $objdocumento['idtipocompraventa'];
            $obj_documento->idmaterialservicio = $objdocumento['idmaterialservicio'];
            $obj_documento->serie = $objdocumento['serie'];
            $obj_documento->numero = $objdocumento['numero'];
            $obj_documento->fechaemision = $objdocumento['fechaemision'];
            $obj_documento->fechavencimiento = $objdocumento['fechavencimiento'];
            $obj_documento->tasaimpuesto = $objdocumento['tasaimpuesto'];
            $obj_documento->nogravadas = $objdocumento['nogravadas'];
            $obj_documento->subtotal = $objdocumento['subtotal'];
            $obj_documento->impuesto = $objdocumento['impuesto'];
            $obj_documento->total = $objdocumento['total'];
            $obj_documento->saldo = $objdocumento['saldo'];
            $obj_documento->operador = $objdocumento['operador'];
            $obj_documento->indextorno = $objdocumento['indextorno'];
            $obj_documento->idmotivotraslado = "";
            $obj_documento->idempresaemisor = "";
            $obj_documento->idempresatransporte = "";
            $obj_documento->idempresachofer = "";
            $obj_documento->iddireccionorigen = "";
            $obj_documento->iddirecciondestino = "";
            $obj_documento->idvehiculotracto = "";
            $obj_documento->idvehiculocarreta = "";
            $obj_documento->idmotivoemision = "";
            $obj_documento->glosa = $objdocumento['glosa'];
            $obj_documento->activo = 1;
            $obj_documento->created_by = $usuario;
            $obj_documento->created_at = date('Y-m-d H:i:s');
            $obj_documento->updated_by = $usuario;
            $obj_documento->updated_at = date('Y-m-d H:i:s');
            $obj_documento->save();
            if(!($obj_documento->id > 0)){
                $error = true;
            }

            //actualizar correlativo de la serie si es documento interno
            if($objdocumento['idtipodocumento']==Config::get('constants.tipodocumento.documentointerno')){
                $correlativo = DB::table('serie')->where('idtipodocumento',$objdocumento['idtipodocumento'])
                                            ->where('nroserie',$objdocumento['serie'])
                                            ->where('idempresa',$idempresa)
                                            ->first();
                $correlativo = Serie::find($correlativo->id);
                $correlativo->nrocorrelativo = $objdocumento['numero'];
                $correlativo->updated_by = $usuario;
                $correlativo->updated_at = date('Y-m-d H:i:s');
                $correlativo->save();
            }
            

            foreach($objdocumento["detalles"] as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle=="")
                {
                    if($val["activo"]==1)
                    {
                        $obj_detalledocumento = new Detalledocumento();
                        $obj_detalledocumento->idempresa = $idempresa;
                        $obj_detalledocumento->idsede = $idsede;
                        $obj_detalledocumento->iddocumento = $obj_documento->id;
                        $obj_detalledocumento->idtipomaterialservicio = $val['idtipomaterialservicio'];
                        $obj_detalledocumento->idmaterialservicio = $val['idmaterialservicio'];
                        $obj_detalledocumento->cantidad = $val['cantidad'];
                        $obj_detalledocumento->preciounit = $val['preciounit'];
                        $obj_detalledocumento->preciounitigv = $val['preciounitigv'];
                        $obj_detalledocumento->indigv = $val['indigv'];
                        $obj_detalledocumento->activo = 1;
                        $obj_detalledocumento->created_by = $usuario;
                        $obj_detalledocumento->created_at = date('Y-m-d H:i:s');
                        $obj_detalledocumento->updated_by = $usuario;
                        $obj_detalledocumento->updated_at = date('Y-m-d H:i:s');
                        $obj_detalledocumento->save();
                        if(!($obj_detalledocumento->id > 0)){
                            $error = true;
                        }
                    }
                }
            }

            //------------- ASOCIACIÓN CON EL DOCUMENTO ------------
            $objocdocumento = new Ordencompradocumento;
            $objocdocumento->idempresa = $idempresa;
            $objocdocumento->idsede = $idsede;
            $objocdocumento->idordencompra = $obj_ordencompra->id;
            $objocdocumento->iddocumento = $obj_documento->id;
            $objocdocumento->idtipodocumento = $objdocumento['idtipodocumento'];
            $objocdocumento->activo = 1;
            $objocdocumento->created_by = $usuario;
            $objocdocumento->updated_by = $usuario;
            $objocdocumento->save();
            if(!($objocdocumento->id > 0)){
                $error = true;
            }

            //GUARDARMOS EL DETALLE EN LA CUENTA CORRIENTE
            $obj_detallecuenta = new Detallecuenta();
            $obj_detallecuenta->idempr = $idempresa;
            $obj_detallecuenta->idsede = $idsede;
            $obj_detallecuenta->fecha = $fecha;
            $obj_detallecuenta->fechapago = $fechapago;
            $obj_detallecuenta->tipocambio = Input::get('tipocambio');
            $obj_detallecuenta->glosa = Input::get('glosa');
            $obj_detallecuenta->idsubcuenta = Input::get('idsubcuenta');
            $concepto = "";
            $concepto = Config::get('constants.conceptos.compralogistica');
            $obj_detallecuenta->idconcepto = $concepto;
            $importesoles = 0;
            $importedolares = 0;
            if($idmoneda==Config::get('constants.moneda.soles')){
                $importesoles = $total;
                $importedolares = $total / $tipocambio;
            }else{
                $importesoles = $total * $tipocambio;
                $importedolares = $total;
            }
            $obj_detallecuenta->importemn = $importesoles;
            $obj_detallecuenta->importeme = $importedolares;
            $saldo = 0;
            if($idmoneda==Config::get('constants.moneda.soles')){
                $obj_detallecuenta->saldo = $importesoles;
            }else{
                $obj_detallecuenta->saldo = $importedolares;
            }
            $obj_detallecuenta->indcargoabono = "A";
            $obj_detallecuenta->tiporeferencia = 'documento'; //DEBE CAMBIARSE AL DOCUMENTO
            $obj_detallecuenta->referencia = $obj_documento->id; //DEBE CAMBIARSE AL DOCUMENTO
            $obj_detallecuenta->activo = 1;
            $obj_detallecuenta->created_by = $usuario;
            $obj_detallecuenta->created_at = date('Y-m-d H:i:s');
            $obj_detallecuenta->updated_by = $usuario;
            $obj_detallecuenta->updated_at = date('Y-m-d H:i:s');
            $obj_detallecuenta->save();
            if(!($obj_detallecuenta->id > 0)){
                $error = true;
            }
        }

    }
    else{
        $Ordencompra = Ordencompra::find($id);
        $idempresa = Input::get('idempresa');
        $idsede = Input::get('idsede');
        $idproveedor = Input::get('idproveedor');
        $fecharegistro = Input::get('fecharegistro');
        $fechacompra = Input::get('fechacompra');
        $fecharecepcion = Input::get('fecharecepcion');
        $indmaterialservicio = Input::get('indmaterialservicio');
        $idtipopago = Input::get('idtipopago');
        $idmoneda = Input::get('idmoneda');
        $idestado = Input::get('idestado');
        $idcuenta = Input::get('idcuenta');
        $idsubcuenta = Input::get('idsubcuenta');
        $subtotal = Input::get('subtotal');
        $impuestovta = Input::get('impuestovta');
        $total = Input::get('total');
        $tipocambio = Input::get('tipocambio');
        $glosa = Input::get('glosa');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call ordencompra_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idproveedor,$fecharegistro,$fechacompra,$fecharecepcion,$indmaterialservicio,$idtipopago,$idmoneda,$idestado,$idcuenta,$idsubcuenta,$subtotal,$impuestovta,$total,$tipocambio,$glosa,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($error == false){
        DB::commit();
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  $mensaje
        ));
    }else{
        DB::rollBack();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  "Ocurrió un error en el registro"
        ));
    }
}


public function GenerarDocumento(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    $error = false;
    $obj_ordencompra = new Ordencompra;
    $activo = 1;
    //if($id === ''){

    $idempresa = Session::get('idempresa');
    $idsede = Session::get('idsede');
    $usuario = Session::get('nombreusuario');
    $idtipoorden = Input::get('idtipoorden');
    $fecha = Input::get('fecha');
    $fechapago = Input::get('fechapago');

        // ========================== SI HAY UN DOCUMENTO ASOCIADO DEBE GENERAR EL DOCUMENTO Y SU PROVISIÓN ========================
        $objdocumento = Input::get("objdocumento");
        if($objdocumento!=null){
            $idmoneda = $objdocumento['idmoneda'];
            $total = $objdocumento['total'];
            $tipocambio = $objdocumento['tipocambio'];

            $obj_documento = new Documento;
            $obj_documento->idempresa = $idempresa;
            $obj_documento->idsede = $idsede;
            $obj_documento->idtipodocumento = $objdocumento['idtipodocumento'];
            $obj_documento->idclienteproveedor = $objdocumento['idclienteproveedor'];
            $obj_documento->idperiodo = $objdocumento['idperiodo'];
            $obj_documento->idestado = $objdocumento['idestado'];
            $obj_documento->cuentacontable = $objdocumento['cuentacontable'];
            $obj_documento->idmoneda = $objdocumento['idmoneda'];
            $obj_documento->tipocambio = $objdocumento['tipocambio'];
            $obj_documento->idtipocompraventa = $objdocumento['idtipocompraventa'];
            $obj_documento->idmaterialservicio = $objdocumento['idmaterialservicio'];
            $obj_documento->serie = $objdocumento['serie'];
            $obj_documento->numero = $objdocumento['numero'];
            $obj_documento->fechaemision = $objdocumento['fechaemision'];
            $obj_documento->fechavencimiento = $objdocumento['fechavencimiento'];
            $obj_documento->tasaimpuesto = $objdocumento['tasaimpuesto'];
            $obj_documento->nogravadas = $objdocumento['nogravadas'];
            $obj_documento->subtotal = $objdocumento['subtotal'];
            $obj_documento->impuesto = $objdocumento['impuesto'];
            $obj_documento->total = $objdocumento['total'];
            $obj_documento->saldo = $objdocumento['saldo'];
            $obj_documento->operador = $objdocumento['operador'];
            $obj_documento->indextorno = $objdocumento['indextorno'];
            $obj_documento->idmotivotraslado = "";
            $obj_documento->idempresaemisor = "";
            $obj_documento->idempresatransporte = "";
            $obj_documento->idempresachofer = "";
            $obj_documento->iddireccionorigen = "";
            $obj_documento->iddirecciondestino = "";
            $obj_documento->idvehiculotracto = "";
            $obj_documento->idvehiculocarreta = "";
            $obj_documento->idmotivoemision = "";
            $obj_documento->glosa = $objdocumento['glosa'];
            $obj_documento->activo = 1;
            $obj_documento->created_by = $usuario;
            $obj_documento->created_at = date('Y-m-d H:i:s');
            $obj_documento->updated_by = $usuario;
            $obj_documento->updated_at = date('Y-m-d H:i:s');
            $obj_documento->save();
            if(!($obj_documento->id > 0)){
                $error = true;
            }

            //actualizar correlativo de la serie
            if($idtipodocumento==Config::get('constants.tipodocumento.documentointerno')){
                $correlativo = DB::table('serie')->where('idtipodocumento',$objdocumento['idtipodocumento'])
                                            ->where('nroserie',$objdocumento['serie'])
                                            ->where('idempresa',$idempresa)
                                            ->first();
                $correlativo = Serie::find($correlativo->id);
                $correlativo->nrocorrelativo = $objdocumento['numero'];
                $correlativo->updated_by = $usuario;
                $correlativo->updated_at = date('Y-m-d H:i:s');
                $correlativo->save();
            }
            

            foreach($objdocumento["detalles"] as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle=="")
                {
                    if($val["activo"]==1)
                    {
                        $obj_detalledocumento = new Detalledocumento();
                        $obj_detalledocumento->idempresa = $idempresa;
                        $obj_detalledocumento->idsede = $idsede;
                        $obj_detalledocumento->iddocumento = $obj_documento->id;
                        $obj_detalledocumento->idtipomaterialservicio = $val['idtipomaterialservicio'];
                        $obj_detalledocumento->idmaterialservicio = $val['idmaterialservicio'];
                        $obj_detalledocumento->cantidad = $val['cantidad'];
                        $obj_detalledocumento->preciounit = $val['preciounit'];
                        $obj_detalledocumento->preciounitigv = $val['preciounitigv'];
                        $obj_detalledocumento->indigv = $val['indigv'];
                        $obj_detalledocumento->activo = 1;
                        $obj_detalledocumento->created_by = $usuario;
                        $obj_detalledocumento->created_at = date('Y-m-d H:i:s');
                        $obj_detalledocumento->updated_by = $usuario;
                        $obj_detalledocumento->updated_at = date('Y-m-d H:i:s');
                        $obj_detalledocumento->save();
                        if(!($obj_detalledocumento->id > 0)){
                            $error = true;
                        }
                    }
                }
            }

            //------------- ASOCIACIÓN CON EL DOCUMENTO ------------
            $objovdocumento = new Ordencompradocumento;
            $objovdocumento->idempresa = $idempresa;
            $objovdocumento->idsede = $idsede;
            $objovdocumento->idordencompra = $id;
            $objovdocumento->iddocumento = $obj_documento->id;
            $objovdocumento->idtipodocumento = $objdocumento['idtipodocumento'];
            $objovdocumento->activo = 1;
            $objovdocumento->created_by = $usuario;
            $objovdocumento->updated_by = $usuario;
            $objovdocumento->save();
            if(!($objovdocumento->id > 0)){
                $error = true;
            }

            //GUARDARMOS EL DETALLE EN LA CUENTA CORRIENTE
            $obj_detallecuenta = new Detallecuenta();
            $obj_detallecuenta->idempr = $idempresa;
            $obj_detallecuenta->idsede = $idsede;
            $obj_detallecuenta->fecha = $fecha;
            $obj_detallecuenta->fechapago = $fechapago;
            $obj_detallecuenta->tipocambio = Input::get('tipocambio');
            $obj_detallecuenta->glosa = Input::get('glosa');
            $obj_detallecuenta->idsubcuenta = Input::get('idsubcuenta');
            $concepto = "";
            if($idtipoorden==Config::get('constants.tipocompra.compralogistica')){
                $concepto = Config::get('constants.conceptos.compralogistica');
            }
            $obj_detallecuenta->idconcepto = $concepto;
            $importesoles = 0;
            $importedolares = 0;
            if($idmoneda==Config::get('constants.moneda.soles')){
                $importesoles = $total;
                $importedolares = $total / $tipocambio;
            }else{
                $importesoles = $total * $tipocambio;
                $importedolares = $total;
            }
            $obj_detallecuenta->importemn = $importesoles;
            $obj_detallecuenta->importeme = $importedolares;
            $saldo = 0;
            if($idmoneda==Config::get('constants.moneda.soles')){
                $obj_detallecuenta->saldo = $importesoles;
            }else{
                $obj_detallecuenta->saldo = $importedolares;
            }
            $obj_detallecuenta->indcargoabono = "A";
            $obj_detallecuenta->tiporeferencia = 'documento'; //DEBE CAMBIARSE AL DOCUMENTO
            $obj_detallecuenta->referencia = $obj_documento->id; //DEBE CAMBIARSE AL DOCUMENTO
            $obj_detallecuenta->activo = 1;
            $obj_detallecuenta->created_by = $usuario;
            $obj_detallecuenta->created_at = date('Y-m-d H:i:s');
            $obj_detallecuenta->updated_by = $usuario;
            $obj_detallecuenta->updated_at = date('Y-m-d H:i:s');
            $obj_detallecuenta->save();
            if(!($obj_detallecuenta->id > 0)){
                $error = true;
            }
        }
        
    if($error==false){
        $mensaje = 'Registro exitoso';
    }else{
        $mensaje = 'Ocurrió un error';
    }
    

    if($error == false){
        DB::commit();
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  $mensaje,
            'resultado'     => $id
        ));
    }else{
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  "Ocurrió un error en el registro",
            'resultado'     => 0
        ));
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call ordencompra_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    $filtro = "";
    $filtrotabla = " AND tbl.idtabla = '".$id."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $detalles = DB::select('call detallecompra_listar(?,?)', array('tbl.id',$filtro));

    $filtro2 = "";
    //$filtro2 .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    $filtro2 .= " AND tbl.idordencompra = ".$id;
    $documentos = DB::select('call ordencompradocumento_listar(?,?)', array('tbl.id',$filtro2));
    return Response::json(array('obj' =>$resultado,'detalles'=>$detalles,'documentos'=>$documentos));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call ordencompra_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


