<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use App\Ordenventa;
use App\Detallematerial;
use App\Documento;
use App\Detalledocumento;
use App\Detallepedido;
use App\Detallecuenta;
use App\Serie;
use App\Ordenpedido;
use App\Ordenventadocumento;
use App\Ordeningresosalida;
use App\Detalleingresosalida;
use App\Registroinventario;
use App\Inventarioalmacen;
use App\Movimientocaja;
use App\Detallecuentapago;
use App\Ordenventaordensalida;
use App\Empresa;
use App\Persona;
use App\Material;

use App\TPersona;
use App\TVenta;
use App\TCatalogo;
use App\TEmpresa;
use App\TDetalleventa;
use App\TItems;
use App\TIdentificacion;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Config;
use Session;
use Exception;

class OrdenventaController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
        $fechaini = Input::get('fechaini');
        $fechafin = Input::get('fechafin');
        $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
    }
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    $resultado = DB::select('call ordenventa_listar(?,?)', array(' tbl.id desc ',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    
    $idempresa = Session::get('idempresa');
    $idsede = Session::get('idsede');
    $usuario = Session::get('nombreusuario');
    $idtipoorden = Input::get('idtipoorden');
    $fecha = Input::get('fecha');
    $fechapago = Input::get('fechapago');

    if($idempresa==""){
        throw new Exception("Su tiempo de sesi&oacute;n ha expirado, Por favor vuelva a logearse.");
    }

    $obj_ordenventa = new Ordenventa;
    $codigoventa = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'VENTA'));
    $codigosalida = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'SALIDA'));

    DB::beginTransaction();

    try {
        $mensaje='';
        $id = Input::get('id');
        $error = false;
        $obj_ordenventa = new Ordenventa;
        $activo = 1;

        $inddevolucion = '1';

        if($id === ''){
            $obj_ordenventa->codigo = $codigoventa[0]->rpta;
            $obj_ordenventa->idempresa = $idempresa;
            $obj_ordenventa->idsede = $idsede;
            $obj_ordenventa->idcliente = Input::get('idcliente');
            $obj_ordenventa->fecha = Input::get('fecha');
            $obj_ordenventa->fechaentrega = Input::get('fechaentrega');
            $obj_ordenventa->fechapago = Input::get('fechapago');
            $obj_ordenventa->indmaterialservicio = Input::get('indmaterialservicio');
            $obj_ordenventa->idtipoorden = Input::get('idtipoorden');
            $obj_ordenventa->idmodulosistema = Input::get('idmodulosistema');
            $obj_ordenventa->idtipopago = Input::get('idtipopago');
            $obj_ordenventa->idmoneda = Input::get('idmoneda');
            $obj_ordenventa->idestado = Input::get('idestado');
            $obj_ordenventa->idcuenta = Input::get('idcuenta');
            $obj_ordenventa->idsubcuenta = Input::get('idsubcuenta');
            $obj_ordenventa->idmovimiento = Input::get('idmovimiento');
            $obj_ordenventa->tipocambio = Input::get('tipocambio');
            $obj_ordenventa->subtotal = Input::get('subtotal');
            $obj_ordenventa->impuestovta = Input::get('impuestovta');
            $obj_ordenventa->total = Input::get('total');
            $obj_ordenventa->totaldscto = Input::get('totaldscto');
            $obj_ordenventa->glosa = Input::get('glosa');
            $obj_ordenventa->idvendedor = Input::get('idvendedor');
            $obj_ordenventa->nropedido = Input::get('nropedido');
            $obj_ordenventa->importepago = Input::get('importepago');
            $obj_ordenventa->importevuelto = Input::get('importevuelto');
            $obj_ordenventa->activo = 1;
            $obj_ordenventa->created_by = $usuario;
            $obj_ordenventa->created_at = date('Y-m-d H:i:s');
            $obj_ordenventa->updated_by = $usuario;
            $obj_ordenventa->updated_at = date('Y-m-d H:i:s');
            $detalles = Input::get('detalles');

            $obj_ordenventa->save();
            if(!($obj_ordenventa->id > 0)){
                $error = true;
            }

            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle==""){
                    if($val["activo"]==1){
                        $obj_detallematerial = new Detallematerial();
                        $obj_detallematerial->idempresa = $idempresa;
                        $obj_detallematerial->idsede = $idsede;
                        $obj_detallematerial->idtabla = $obj_ordenventa->id;
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
                        $obj_detallematerial->created_at = date('Y-m-d H:i:s');
                        $obj_detallematerial->updated_by = $usuario;
                        $obj_detallematerial->updated_at = date('Y-m-d H:i:s');
                        $obj_detallematerial->save();
                        if(!($obj_detallematerial->id > 0)){
                            $error = true;
                        }

                        //actualizar atendidos
                        if(Input::get('nropedido')!=""){
                            $objdetallepedido = new Detallepedido();
                            $pedido = DB::table('ordenpedido')->where('codigo',Input::get('nropedido'))->where('idempresa',$idempresa)->first();
                            $pedido = Ordenpedido::find($pedido->id);

                            $detallepedidos = DB::table('detallepedido')->where('idpedido',$pedido->id)->get();
                            foreach ($detallepedidos as $det) {
                                if($det->idproducto==$val["idproducto"]){
                                    $objdetallepedido = Detallepedido::find($det->id);
                                    $objdetallepedido->pendiente = $objdetallepedido->pendiente - $val["cantidad"];
                                    $objdetallepedido->updated_by = $usuario;
                                    $objdetallepedido->updated_at = date('Y-m-d H:i:s');
                                    $objdetallepedido->save();
                                }
                            }
                            //actualizar el estado del pedido
                            $detallepedidos = DB::table('detallepedido')->where('idpedido',$pedido->id)->get();
                            $estadopedido = Config::get('constants.estadopedido.generado');
                            foreach ($detallepedidos as $det) {
                                if($det->pendiente>0){
                                    $estadopedido = Config::get('constants.estadopedido.atendidoparcial');
                                    break;
                                }else{
                                    $estadopedido = Config::get('constants.estadopedido.atendido');
                                }
                            }
                            $pedido->idestado = $estadopedido;
                            $pedido->updated_by = $usuario;
                            $pedido->updated_at = date('Y-m-d H:i:s');
                            $pedido->save();
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
                $obj_documento->iddirecciondestino = $objdocumento['direcciondestino'];
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
                $correlativo = DB::table('serie')->where('idtipodocumento',$objdocumento['idtipodocumento'])
                                                ->where('nroserie',$objdocumento['serie'])
                                                ->where('idempresa',$idempresa)
                                                ->first();
                $correlativo = Serie::find($correlativo->id);
                $correlativo->nrocorrelativo = $objdocumento['numero'];
                $correlativo->updated_by = $usuario;
                $correlativo->updated_at = date('Y-m-d H:i:s');
                $correlativo->save();

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
                $objovdocumento = new Ordenventadocumento;
                $objovdocumento->idempresa = $idempresa;
                $objovdocumento->idsede = $idsede;
                $objovdocumento->idordenventa = $obj_ordenventa->id;
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
                /*
                $obj_detallecuenta = new Detallecuenta();
                $obj_detallecuenta->idempr = $idempresa;
                $obj_detallecuenta->idsede = $idsede;
                $obj_detallecuenta->fecha = $fecha;
                $obj_detallecuenta->fechapago = $fechapago;
                $obj_detallecuenta->tipocambio = Input::get('tipocambio');
                $obj_detallecuenta->glosa = Input::get('glosa');
                $obj_detallecuenta->idsubcuenta = Input::get('idsubcuenta');
                $concepto = "";
                if($idtipoorden==Config::get('constants.tipoventa.comercial')){
                    $concepto = Config::get('constants.conceptos.ventacomercial');
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
                $obj_detallecuenta->indcargoabono = "C";
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
                */


                //GENERAR DOCUMENTO DE FACTURACION
                self::GenerarDatosFacturacion($objdocumento);


            }


            $objmovimientocaja = Input::get("objmovimientocaja");
            if($objmovimientocaja!=null){
                $obj_movimientocaja = new Movimientocaja;
                $obj_movimientocaja->idempresa =Session::get('idempresa');
                $obj_movimientocaja->idsede = Session::get('idsede');
                $obj_movimientocaja->fechamovimiento = $objmovimientocaja['fechamovimiento'];
                $obj_movimientocaja->fechaoperacion = $objmovimientocaja['fechaoperacion'];
                $obj_movimientocaja->idtipomovimiento = $objmovimientocaja['idtipomovimiento'];
                $obj_movimientocaja->idestadomovimiento =$objmovimientocaja['idestadomovimiento'];
                $obj_movimientocaja->idemprafecta = $objmovimientocaja['idemprafecta'];
                $obj_movimientocaja->idsubcuenta = $objmovimientocaja['idsubcuenta'];
                $obj_movimientocaja->idcajabanco = $objmovimientocaja['idcajabanco'];
                $obj_movimientocaja->nroctactble = $objmovimientocaja['nroctactble'];
                $obj_movimientocaja->idmediopago = $objmovimientocaja['idmediopago'];
                $obj_movimientocaja->fechacheque = $objmovimientocaja['fechacheque'];
                $obj_movimientocaja->nrovoucher = $objmovimientocaja['nrovoucher'];
                $obj_movimientocaja->idmoneda = $objmovimientocaja['idmoneda'];
                $obj_movimientocaja->tipocambio = $objmovimientocaja['tipocambio'];
                $obj_movimientocaja->debe_mn = $objmovimientocaja['debe_mn'];
                $obj_movimientocaja->haber_mn = $objmovimientocaja['haber_mn'];
                $obj_movimientocaja->debe_me = $objmovimientocaja['debe_me'];
                $obj_movimientocaja->haber_me = $objmovimientocaja['haber_me'];
                $obj_movimientocaja->iddetalleextorno = $objmovimientocaja['iddetalleextorno'];
                $obj_movimientocaja->glosa = $objmovimientocaja['glosa'];
                $obj_movimientocaja->referencia = $objmovimientocaja['referencia'];
                $obj_movimientocaja->tiporeferencia = $objmovimientocaja['tiporeferencia'];
                $obj_movimientocaja->idmovimientoorigendestino = $objmovimientocaja['idmovimientoorigendestino'];
                $obj_movimientocaja->activo = 1;
                $obj_movimientocaja->created_by = Session::get('nombreusuario');
                $obj_movimientocaja->updated_by = Session::get('nombreusuario');
                $obj_movimientocaja->save();
                if(!($obj_movimientocaja->id > 0)){
                    $error = true;
                }

                $objdetallecuentamov = new Detallecuenta;
                $objdetallecuentamov->idempr = Session::get('idempresa');
                $objdetallecuentamov->idsede = Session::get('idsede');
                $objdetallecuentamov->tipocambio = Input::get('tipocambio');
                $objdetallecuentamov->idsubcuenta = Input::get('idsubcuenta');
                $objdetallecuentamov->fecha = date('Y-m-d H:i:s');
                $objdetallecuentamov->fechapago = date('Y-m-d H:i:s');
                $objdetallecuentamov->glosa = Input::get('glosa');
                $concepto = "";
                $concepto = Config::get('constants.conceptos.cobrocaja');
                $objdetallecuentamov->idconcepto = $concepto;
                $importesoles = 0;
                $importedolares = 0;
                if($objmovimientocaja["idmoneda"]==Config::get('constants.moneda.soles')){
                    $importesoles = $objmovimientocaja['debe_mn'];
                    $importedolares = $objmovimientocaja['debe_mn'] / Input::get('tipocambio');
                }else{
                    $importesoles = $objmovimientocaja['debe_mn'] * Input::get('tipocambio');
                    $importedolares = $objmovimientocaja['debe_mn'];
                }
                $objdetallecuentamov->importemn = $importesoles;
                $objdetallecuentamov->importeme = $importedolares;
                $objdetallecuentamov->saldo = 0;
                $objdetallecuentamov->indcargoabono = "A";
                $objdetallecuentamov->tiporeferencia = 'movimientocaja';
                $objdetallecuentamov->referencia = $obj_movimientocaja->id;
                $objdetallecuentamov->activo = 1;
                $objdetallecuentamov->created_by = Session::get('nombreusuario');
                $objdetallecuentamov->updated_by = Session::get('nombreusuario');
                $objdetallecuentamov->save();

                if(!($objdetallecuentamov->id > 0)){
                    $error = true;
                }

                //Salda el movimiento seleccionado
                $detallecuentapago = new Detallecuentapago;
                $detallecuentapago->idempresa = Session::get("idempresa");
                $detallecuentapago->idsede = Session::get("idsede");
                $detallecuentapago->iddetallecuenta = $objdetallecuentamov->id;
                $detallecuentapago->iddetallecuenta_asoc = $obj_detallecuenta["id"];
                $detallecuentapago->pago = $importesoles;
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
                $detallecuentapago->iddetallecuenta = $objdetallecuentamov->id;
                $detallecuentapago->iddetallecuenta_asoc = $objdetallecuentamov->id;
                $detallecuentapago->pago = $importesoles;
                $detallecuentapago->fechapago = date('Y-m-d H:i:s');
                $detallecuentapago->activo = 1;
                $detallecuentapago->created_by = Session::get('nombreusuario');
                $detallecuentapago->updated_by = Session::get('nombreusuario');
                $detallecuentapago->save();

                if(!($detallecuentapago->id > 0)){
                    $error = true;
                }

            }

            $objordensalida = Input::get("objordensalida");
            if($objordensalida!=null)
            {
                $obj_ordeningresosalida = new Ordeningresosalida;
                $obj_ordeningresosalida->codigo = "";

                
                $obj_ordeningresosalida->codigo = $codigosalida[0]->rpta;
                
                $obj_ordeningresosalida->idempresa = $idempresa;
                $obj_ordeningresosalida->idsede = $idsede;
                $obj_ordeningresosalida->idempresapropietario = $objordensalida["idempresapropietario"];
                $obj_ordeningresosalida->idempresaadministra = $objordensalida["idempresaadministra"];
                $obj_ordeningresosalida->fechaorden = $objordensalida["fechaorden"];
                $obj_ordeningresosalida->idtipo = $objordensalida["idtipo"];
                $obj_ordeningresosalida->idestado = $objordensalida["idestado"];
                $obj_ordeningresosalida->idmovimientoinventario = $objordensalida["idmovimientoinventario"];
                $obj_ordeningresosalida->codigooperacion = $objordensalida["codigooperacion"];
                $obj_ordeningresosalida->idmodulo = $objordensalida["idmodulo"];
                $obj_ordeningresosalida->glosa = $objordensalida["glosa"];
                $obj_ordeningresosalida->inddevolucion = ($inddevolucion == 0);
                $obj_ordeningresosalida->created_by = $usuario ; 
                $obj_ordeningresosalida->updated_by = $usuario ;
                $obj_ordeningresosalida->activo = 1;
                $obj_ordeningresosalida->save();
                //Detalles
                foreach($objordensalida["detalles"] as $obj=>$val)
                {
                    $iddetalle = $val["id"];
                    //Guardar Nuevo DetalleOrdenIngresoSalida
                    if($iddetalle=="")
                    {
                        if($val["activo"]==1)
                        {
                            $obj_detalleingresosalida = new Detalleingresosalida;
                            $obj_detalleingresosalida->idempresa = $idempresa;
                            $obj_detalleingresosalida->idsede = $idsede;
                            $obj_detalleingresosalida->idordeningresosalida = $obj_ordeningresosalida->id;
                            $obj_detalleingresosalida->idmaterial = $val['idmaterial'];
                            $obj_detalleingresosalida->idlote = $val['idlote'];
                            $obj_detalleingresosalida->cantidad = $val['cantidad'];
                            $obj_detalleingresosalida->costoorigen = $val['costoorigen'];
                            $obj_detalleingresosalida->costo =$val['costo'];
                            $obj_detalleingresosalida->idalmacen = $val['idalmacen'];
                            $obj_detalleingresosalida->idunidadmedida = $val['idunidadmedida'];
                            $obj_detalleingresosalida->created_by = $usuario;
                            $obj_detalleingresosalida->updated_by = $usuario;
                            $obj_detalleingresosalida->activo = 1;
                            $obj_detalleingresosalida->save();
                            //Si la orden ingreso o salida está en estado terminado generar registro inventario
                            if ($objordensalida["idestado"] == config('constants.estadooios.terminado')) 
                            {
                                //Insertar Registro Inventario
                                $obj_registroinventario = new Registroinventario;
                                $obj_registroinventario->idempresa = $idempresa;
                                $obj_registroinventario->idsede = $idsede;
                                $obj_registroinventario->iddetalleingresosalida = $obj_detalleingresosalida->id;
                                $obj_registroinventario->idalmacen = $val['idalmacen'];
                                $obj_registroinventario->idlote = $val['idlote'];
                                $obj_registroinventario->idmaterial = $val['idmaterial'];
                                $obj_registroinventario->idmovimientoinventario = $obj_ordeningresosalida->idmovimientoinventario;
                                $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                                $obj_registroinventario->fechamovimiento = $obj_ordeningresosalida->fechaorden;
                                $obj_registroinventario->cantidad = $val['cantidad'];
                                $obj_registroinventario->costo = $val['costo'];
                                $obj_registroinventario->glosa = '';
                                $obj_registroinventario->inddevolucion = $obj_ordeningresosalida->inddevolucion;
                                $obj_registroinventario->created_by = $usuario;
                                $obj_registroinventario->updated_by = $usuario;
                                $obj_registroinventario->activo = 1;
                                $obj_registroinventario->save();
                                self::Ajuste($obj_registroinventario);
                            }
                        }
                    }
                }

                if(!($obj_ordeningresosalida->id > 0)){
                    $error = true;
                }else{
                    //------------- ASOCIACIÓN CON EL DOCUMENTO ------------
                    $objovsalida = new Ordenventaordensalida;
                    $objovsalida->idempresa = $idempresa;
                    $objovsalida->idsede = $idsede;
                    $objovsalida->idordenventa = $obj_ordenventa->id;
                    $objovsalida->idordensalida = $obj_ordeningresosalida->id;
                    $objovsalida->activo = 1;
                    $objovsalida->created_by = $usuario;
                    $objovsalida->updated_by = $usuario;
                    $objovsalida->save();
                    if(!($objovsalida->id > 0)){
                        $error = true;
                    }
                }



                if(Input::get('nropedido')!=null){
                    $nropedido = Input::get('nropedido');
                    $Ordenventa = Ordenventa::where('nropedido', '=', $nropedido )->get();
                    $idordenventa = $Ordenventa[0]->id; //Actualiza el id de la venta si la encontre por el pedido


                    //Verificar las cantidades pendientes.
                    $detallespedido = DB::select("SELECT dp.*, dp.cantidad - IFNULL(det_sal.cantidad,0) AS pend_sal
                                                FROM detallepedido dp
                                                LEFT JOIN (SELECT op.id idpedido, ds.idmaterial, SUM(ds.cantidad) cantidad
                                                            FROM ordenventa ov 
                                                            INNER JOIN ordenpedido op ON op.codigo = ov.nropedido
                                                            INNER JOIN ordenventaordensalida ovs ON ovs.idordenventa = ov.id
                                                            INNER JOIN ordeningresosalida os ON os.id = ovs.idordensalida
                                                            INNER JOIN detalleingresosalida ds ON ds.idordeningresosalida = os.id
                                                            INNER JOIN material m ON m.id = ds.idmaterial
                                                            WHERE ov.activo = 1 AND ovs.activo = 1 AND ds.activo = 1 
                                                            GROUP BY op.id, ds.idmaterial) det_sal 
                                                                ON det_sal.idpedido = dp.idpedido AND det_sal.idmaterial = dp.idproducto
                                                INNER JOIN ordenpedido op on op.id = dp.idpedido
                                                WHERE dp.activo = 1 and op.codigo = ? ", array($nropedido));
                    if($detallespedido){
                        $cantpendiente = 0;
                        if( count($detallespedido) > 0 ){

                            //recorrer la lista principal
                            //$objordensalida = Input::get("objordensalida");
                            foreach($objordensalida["detalles"] as $obj=>$val)
                            {
                                foreach($detallespedido as $obj2=>$val2){
                                    
                                    if($val['idmaterial']==$val2->idproducto){
                                        //$pend = $val2->pend_sal - $val["cantidad"];
                                        $cantpendiente = $cantpendiente + $val2->pend_sal;
                                    }
                                    
                                }
                            }
                            //throw new Exception($cantpendiente, 1);
                            if($cantpendiente == 0){
                                DB::table('ordenpedido')->where([['codigo','=',$nropedido]])->update(['idestado' => Config::get('constants.estadopedido.atendido')]);
                            }else{
                                DB::table('ordenpedido')->where([['codigo','=',$nropedido]])->update(['idestado' => Config::get('constants.estadopedido.atendidoparcial')]);
                            }
                            //throw new Exception($cantpendiente, 1);
                        }
                    }
                }



            }

            $mensaje = 'Registro exitoso';
        }
        else{
            $Ordenventa = Ordenventa::find($id);
            //$Ordenventa->codigo = Input::get('codigo');
            //$Ordenventa->idempresa = Session::get('idempresa');
            //$Ordenventa->idsede = Session::get('idsede');
            //$Ordenventa->idcliente = Input::get('idcliente');
            $Ordenventa->fecha = Input::get('fecha');
            $Ordenventa->fechaentrega = Input::get('fechaentrega');
            $Ordenventa->fechapago = Input::get('fechapago');
            $Ordenventa->indmaterialservicio = Input::get('indmaterialservicio');
            $Ordenventa->idtipoorden = Input::get('idtipoorden');
            $Ordenventa->idmodulosistema = Input::get('idmodulosistema');
            $Ordenventa->idtipopago = Input::get('idtipopago');
            $Ordenventa->idmoneda = Input::get('idmoneda');
            $Ordenventa->idestado = Input::get('idestado');
            //$Ordenventa->idcuenta = Input::get('idcuenta');
            //$Ordenventa->idsubcuenta = Input::get('idsubcuenta');
            $Ordenventa->idmovimiento = Input::get('idmovimiento');
            $Ordenventa->tipocambio = Input::get('tipocambio');
            //$Ordenventa->subtotal = Input::get('subtotal');
            //$Ordenventa->impuestovta = Input::get('impuestovta');
            //$Ordenventa->total = Input::get('total');
            //$Ordenventa->totaldscto = Input::get('totaldscto');
            $Ordenventa->glosa = Input::get('glosa');
            $Ordenventa->idvendedor = Input::get('idvendedor');
            //$Ordenventa->nropedido = Input::get('nropedido');
            $Ordenventa->idmediopago = Input::get('idmediopago');
            $Ordenventa->activo = 1;
            $Ordenventa->updated_by = Session::get('nombreusuario');
            $Ordenventa->save();
            //$resultado = DB::select('call ordenventa_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$codigo,$idempresa,$idsede,$idcliente,$fecha,$fechaentrega,$fechapago,$indmaterialservicio,$idtipoorden,$idmodulosistema,$idtipopago,$idmoneda,$idestado,$idcuenta,$idsubcuenta,$idmovimiento,$tipocambio,$subtotal,$impuestovta,$total,$totaldscto,$glosa,$idvendedor,$nropedido,$activo,$usuario,'UPD'));

            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                $idempresa =Session::get('idempresa');
                $idsede = Session::get('idsede');
                $idtabla = $Ordenventa->id;
                $idproducto = $val["idproducto"];
                $nombreproducto = $val["nombreproducto"];
                $descripcion = $val["descripcion"];
                $idalmacen = $val["idalmacen"];
                $cantidad = $val["cantidad"];
                $cantidadpendiente = $val["cantidadpendiente"];
                $precio_unit_sigv = $val["precio_unit_sigv"];
                $precio_unit_igv = $val["precio_unit_igv"];
                $valor_vta_sigv = $val["valor_vta_sigv"];
                $valor_vta_igv = $val["valor_vta_igv"];
                $dscto = $val["dscto"];
                $indigv = $val["indigv"];
                $idunidadmedida = $val['idunidadmedida'];
                $unidadmedida = $val['unidadmedida'];

                if($iddetalle==""){
                    if($val["activo"]==1){
                        $activo = 1;
                        $usuario = Session::get('nombreusuario');
                        $resultado2 = DB::select('call detallematerial_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idtabla,$idproducto,$nombreproducto,$descripcion,$idalmacen,$cantidad,$cantidadpendiente,$precio_unit_sigv,$precio_unit_igv,$valor_vta_sigv,$valor_vta_igv,$dscto,$indigv,$idunidadmedida,$unidadmedida,$usuario,$activo,'INS'));
                    }  
                }
                else{
                    if($val["activo"]==1){
                        $usuario = Session::get('nombreusuario');
                        $resultado2 = DB::select('call detallematerial_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idtabla,$idproducto,$nombreproducto,$descripcion,$idalmacen,$cantidad,$cantidadpendiente,$precio_unit_sigv,$precio_unit_igv,$valor_vta_sigv,$valor_vta_igv,$dscto,$indigv,$idunidadmedida,$unidadmedida,$usuario,$activo,'UPD')); 
                     }else{
                        $resultado2 = DB::select('call detallematerial_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$idtabla,$idproducto,$nombreproducto,$descripcion,$idalmacen,$cantidad,$cantidadpendiente,$precio_unit_sigv,$precio_unit_igv,$valor_vta_sigv,$valor_vta_igv,$dscto,$indigv,$idunidadmedida,$unidadmedida,$usuario,$activo,'DEL'));
                     }
                }
            }

            $mensaje = 'Registro Actualizado';
            
        }

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $obj_ordenventa->id
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


public function GenerarDocumento(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    $error = false;
    $obj_ordenventa = new Ordenventa;
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
            $correlativo = DB::table('serie')->where('idtipodocumento',$objdocumento['idtipodocumento'])
                                            ->where('nroserie',$objdocumento['serie'])
                                            ->where('idempresa',$idempresa)
                                            ->first();
            $correlativo = Serie::find($correlativo->id);
            $correlativo->nrocorrelativo = $objdocumento['numero'];
            $correlativo->updated_by = $usuario;
            $correlativo->updated_at = date('Y-m-d H:i:s');
            $correlativo->save();

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
            $objovdocumento = new Ordenventadocumento;
            $objovdocumento->idempresa = $idempresa;
            $objovdocumento->idsede = $idsede;
            $objovdocumento->idordenventa = $id;
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
            if($idtipoorden==Config::get('constants.tipoventa.comercial')){
                $concepto = Config::get('constants.conceptos.ventacomercial');
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
            $obj_detallecuenta->indcargoabono = "C";
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

        //GENERAR DATOS PARA FACTURACIÓN ELECTRÓNICA




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


public function GenerarDatosFacturacion($documento){
    try {
        
        $Venta = new TVenta;
        $idpersona = 1;
        $idempresa = 1;

        //Generar venta
        //buscar y registrar el Cliente / empresa según corresponda
        //
        
        $empresa = Empresa::find($documento['idclienteproveedor']);
        if($empresa){

            $idtipoident = 0;
            $codigoident = 0;


            //Buscar si existe el numero doc
            $tident = TIdentificacion::where("nroidentificacion",$empresa->numerodocumento)->first();

            if($empresa->idtipodocumento == Config::get('constants.tipodocumentoidentidad.dni') ){
                $idtipoident = 2;
                $codigoident = 1;                

                //Si encuentra la identificacion seleccionarlo sino registrarlo
                if($tident){
                    $personafact = TPersona::find($tident->id_persona);
                    $idpersona = $personafact->id;
                }else{

                    $persona = Persona::find($empresa->idpersona);

                    $personafact = new TPersona;
                    $personafact->nombres = $persona->nombres;
                    $personafact->apellidos = $persona->apellidopaterno." ".$persona->apellidomaterno;
                    $personafact->direccion = $empresa->direccion1;
                    $personafact->email = $empresa->correo;
                    $personafact->fch_nac = $empresa->fechanac;
                    $personafact->telefono = $empresa->telefono1;
                    $personafact->sexo = 1;
                    $personafact->estado = 1;
                    $personafact->id_dis = 1;
                    $personafact->id_prov = 1;
                    $personafact->id_dep = 1;
                    $personafact->save();
                    $idpersona = $personafact->id;

                    $tident_1 = new TIdentificacion;
                    $tident_1->id_persona = $idpersona;
                    $tident_1->nroidentificacion = $empresa->numerodocumento;
                    $tident_1->id_tipo_identificacion = 2;
                    $tident_1->id_empresa = 1;
                    $tident_1->save();

                }


            }elseif($empresa->idtipodocumento == Config::get('constants.tipodocumentoidentidad.ruc') ){
                $idtipoident = 4;
                $codigoident = 6;

                //Buscar si la persona existe, sino registrarlo
                if($tident){
                    $empresafact = TEmpresa::find($tident->id_empresa);
                    $idempresa = $empresafact->id;
                }else{
                    $empresafact = new TEmpresa;
                    $empresafact->nombre = $empresa->nombre;
                    $empresafact->razonsocial = $empresa->nombre;
                    $empresafact->ruc = $empresa->numerodocumento;
                    $empresafact->direccion = $empresa->direccion1;
                    $empresafact->telefono1 = $empresa->telefono1;
                    $empresafact->telefono2 = $empresa->telefono2;
                    $empresafact->email = $empresa->correo;
                    $empresafact->estado = 1;
                    $empresafact->id_dis = 1;
                    $empresafact->id_prov = 1;
                    $empresafact->id_dep = 1;
                    $empresafact->save();
                    $idempresa = $empresafact->id;

                    $tident_1 = new TIdentificacion;
                    $tident_1->id_persona = 1;
                    $tident_1->nroidentificacion = $empresa->numerodocumento;
                    $tident_1->id_tipo_identificacion = 4;
                    $tident_1->id_empresa = $empresafact->id;
                    $tident_1->save();

                }

            }

            $Venta->num_serie = $documento['serie'];
            $Venta->num_documento = $documento['numero'];
            $Venta->cod_doc = ($documento['idtipodocumento'] == Config::get('constants.tipodocumento.factura') ? '01' : '03');
            $Venta->id_forma = 1;
            $Venta->efectivo = $documento['total'];
            $Venta->tarjeta = 0;
            $Venta->transferencia = 0;
            $Venta->fecha = $documento['fechaemision'];
            $Venta->id_usuario = 1;
            $Venta->id_persona = $idpersona;
            $Venta->id_empresa = $idempresa;
            $Venta->descuento = 0;
            $Venta->total = $documento['total'];
            $Venta->moneda = 'PEN';
            $Venta->estado = 1;
            $Venta->detraccion = 0;

            $Venta->save();

            foreach($documento["detalles"] as $obj=>$val)
            {

                //Producto
                $idproducto = 1;
                $codigoproducto = "";

                $material = Material::find($val['idmaterialservicio']);
                $item = Titems::where('nombre', $material->nombre)->first();
                if($item){

                    $idproducto = $item->id;
                    $codigoproducto = $item->codigo;

                }else{
                    

                    $item_1 = new TItems;
                    $item_1->nombre = $material->nombre;
                    $item_1->abreviatura = $material->nombre;
                    $item_1->descripcion = $material->nombre;
                    $item_1->codigo_catalogo = "16000000";
                    $item_1->tipo = 1;
                    $item_1->stock = 0;
                    $item_1->estado = 0;
                    $item_1->id_medida = 1;
                    $item_1->save();

                    $idproducto = $item_1->id;
                    $codigoproducto = $material->codigo;

                }

                $detalle = new TDetalleventa();
                $detalle->num_serie = $Venta->num_serie;
                $detalle->num_documento = $Venta->num_documento;
                $detalle->cod_doc = $Venta->cod_doc;
                $detalle->id_item = $idproducto;
                $detalle->cantidad = $val['cantidad'];
                $detalle->precioventa = $val['preciounitigv'];
                $detalle->descuento = 0;
                $detalle->tipo_igv = $val['indigv'];
                $detalle->igv = $val['preciounitigv'] - $val['preciounit'];
                $detalle->id_medida = "01";
                $detalle->codigo_catalogo = $codigoproducto;
                $detalle->save();
            }

        }   



    } catch (Exception $e) {
        throw $e;
    }
}


public function GenerarOrdenSalida(){

    $idempresa = Session::get('idempresa');
    $idsede = Session::get('idsede');
    $usuario = Session::get('nombreusuario');
    $idtipoorden = Input::get('idtipoorden');
    $fecha = Input::get('fecha');
    $fechapago = Input::get('fechapago');
    $codigosalida = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'SALIDA'));
    $inddevolucion = '1';
    $idordenventa = "";

    try {
        
            DB::beginTransaction();
            $mensaje='';
            $id = Input::get('id');
            $error = false;
            $obj_ordenventa = new Ordenventa;

            //Si la salida viene de un pedido que está asociado a la venta
            if(Input::get('nropedido')!=null){
                $nropedido = Input::get('nropedido');
                $Ordenventa = Ordenventa::where('nropedido', '=', $nropedido )->get();
                $idordenventa = $Ordenventa[0]->id; //Actualiza el id de la venta si la encontre por el pedido


                //Verificar las cantidades pendientes.
                $detallespedido = DB::select("SELECT dp.*, dp.cantidad - IFNULL(det_sal.cantidad,0) AS pend_sal
                                            FROM detallepedido dp
                                            LEFT JOIN (SELECT op.id idpedido, ds.idmaterial, SUM(ds.cantidad) cantidad
                                                        FROM ordenventa ov 
                                                        INNER JOIN ordenpedido op ON op.codigo = ov.nropedido
                                                        INNER JOIN ordenventaordensalida ovs ON ovs.idordenventa = ov.id
                                                        INNER JOIN ordeningresosalida os ON os.id = ovs.idordensalida
                                                        INNER JOIN detalleingresosalida ds ON ds.idordeningresosalida = os.id
                                                        INNER JOIN material m ON m.id = ds.idmaterial
                                                        WHERE ov.activo = 1 AND ovs.activo = 1 AND ds.activo = 1 
                                                        GROUP BY op.id, ds.idmaterial) det_sal 
                                                            ON det_sal.idpedido = dp.idpedido AND det_sal.idmaterial = dp.idproducto
                                            INNER JOIN ordenpedido op on op.id = dp.idpedido
                                            WHERE dp.activo = 1 and op.codigo = ? ", array($nropedido));
                if($detallespedido){
                    $cantpendiente = 0;
                    if( count($detallespedido) > 0 ){

                        //recorrer la lista principal
                        $objordensalida = Input::get("objordensalida");
                        foreach($objordensalida["detalles"] as $obj=>$val)
                        {
                            foreach($detallespedido as $obj2=>$val2){
                                if($val['idmaterial']==$val2->idproducto){
                                    $pend = $val2->pend_sal - $val["cantidad"];
                                    $cantpendiente = $cantpendiente + $pend;
                                }
                                
                            }
                        }
                        if($cantpendiente == 0){
                            DB::table('ordenpedido')->where([['codigo','=',$nropedido]])->update(['idestado' => Config::get('constants.estadopedido.despachado')]);
                        }else{
                            DB::table('ordenpedido')->where([['codigo','=',$nropedido]])->update(['idestado' => Config::get('constants.estadopedido.atendidoparcial')]);
                        }
                        //throw new Exception($cantpendiente, 1);
                    }
                }
            }else{
                $idordenventa = $id;
            }
            

            $activo = 1;

            $objordensalida = Input::get("objordensalida");
            if($objordensalida!=null){
                $obj_ordeningresosalida = new Ordeningresosalida;
                $obj_ordeningresosalida->codigo = "";

                
                $obj_ordeningresosalida->codigo = $codigosalida[0]->rpta;
                
                $obj_ordeningresosalida->idempresa = $idempresa;
                $obj_ordeningresosalida->idsede = $idsede;
                $obj_ordeningresosalida->idempresapropietario = $objordensalida["idempresapropietario"];
                $obj_ordeningresosalida->idempresaadministra = $objordensalida["idempresaadministra"];
                $obj_ordeningresosalida->fechaorden = $objordensalida["fechaorden"];
                $obj_ordeningresosalida->idtipo = $objordensalida["idtipo"];
                $obj_ordeningresosalida->idestado = $objordensalida["idestado"];
                $obj_ordeningresosalida->idmovimientoinventario = $objordensalida["idmovimientoinventario"];
                $obj_ordeningresosalida->codigooperacion = $objordensalida["codigooperacion"];
                $obj_ordeningresosalida->idmodulo = $objordensalida["idmodulo"];
                $obj_ordeningresosalida->glosa = $objordensalida["glosa"];
                $obj_ordeningresosalida->inddevolucion = ($inddevolucion == 0);
                $obj_ordeningresosalida->created_by = $usuario ; 
                $obj_ordeningresosalida->updated_by = $usuario ;
                $obj_ordeningresosalida->activo = 1;
                $obj_ordeningresosalida->save();
                //Detalles
                foreach($objordensalida["detalles"] as $obj=>$val)
                {
                    $iddetalle = $val["id"];
                    //Guardar Nuevo DetalleOrdenIngresoSalida
                    if($iddetalle=="")
                    {
                        if($val["activo"]==1)
                        {
                            $obj_detalleingresosalida = new Detalleingresosalida;
                            $obj_detalleingresosalida->idempresa = $idempresa;
                            $obj_detalleingresosalida->idsede = $idsede;
                            $obj_detalleingresosalida->idordeningresosalida = $obj_ordeningresosalida->id;
                            $obj_detalleingresosalida->idmaterial = $val['idmaterial'];
                            $obj_detalleingresosalida->idlote = $val['idlote'];
                            $obj_detalleingresosalida->cantidad = $val['cantidad'];
                            $obj_detalleingresosalida->costoorigen = $val['costoorigen'];
                            $obj_detalleingresosalida->costo =$val['costo'];
                            $obj_detalleingresosalida->idalmacen = $val['idalmacen'];
                            $obj_detalleingresosalida->idunidadmedida = $val['idunidadmedida'];
                            $obj_detalleingresosalida->created_by = $usuario;
                            $obj_detalleingresosalida->updated_by = $usuario;
                            $obj_detalleingresosalida->activo = 1;
                            $obj_detalleingresosalida->save();
                            //Si la orden ingreso o salida está en estado terminado generar registro inventario
                            if ($objordensalida["idestado"] == config('constants.estadooios.terminado')) 
                            {
                                //Insertar Registro Inventario
                                $obj_registroinventario = new Registroinventario;
                                $obj_registroinventario->idempresa = $idempresa;
                                $obj_registroinventario->idsede = $idsede;
                                $obj_registroinventario->iddetalleingresosalida = $obj_detalleingresosalida->id;
                                $obj_registroinventario->idalmacen = $val['idalmacen'];
                                $obj_registroinventario->idlote = $val['idlote'];
                                $obj_registroinventario->idmaterial = $val['idmaterial'];
                                $obj_registroinventario->idmovimientoinventario = $obj_ordeningresosalida->idmovimientoinventario;
                                $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                                $obj_registroinventario->fechamovimiento = $obj_ordeningresosalida->fechaorden;
                                $obj_registroinventario->cantidad = $val['cantidad'];
                                $obj_registroinventario->costo = $val['costo'];
                                $obj_registroinventario->glosa = '';
                                $obj_registroinventario->inddevolucion = $obj_ordeningresosalida->inddevolucion;
                                $obj_registroinventario->created_by = $usuario;
                                $obj_registroinventario->updated_by = $usuario;
                                $obj_registroinventario->activo = 1;
                                $obj_registroinventario->save();
                                self::Ajuste($obj_registroinventario);
                            }
                        }
                    }
                }

                if(!($obj_ordeningresosalida->id > 0)){
                    $error = true;
                }else{
                    //------------- ASOCIACIÓN CON EL DOCUMENTO ------------
                    $objovsalida = new Ordenventaordensalida;
                    $objovsalida->idempresa = $idempresa;
                    $objovsalida->idsede = $idsede;
                    $objovsalida->idordenventa = $idordenventa;
                    $objovsalida->idordensalida = $obj_ordeningresosalida->id;
                    $objovsalida->activo = 1;
                    $objovsalida->created_by = $usuario;
                    $objovsalida->updated_by = $usuario;
                    $objovsalida->save();
                    if(!($objovsalida->id > 0)){
                        $error = true;
                    }
                }
            }

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  "Registro exitoso",
                'resultado'     => $id
            ));
        }else{
            DB::rollBack();
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
        }

    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll",
            'line'          => $e->getLine()
        ));
    }
}



Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call ordenventa_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    $filtro = "";
    $filtrotabla = " AND tbl.idtabla = '".$id."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $detalles = DB::select('call detallematerial_listar(?,?)', array('tbl.id',$filtro));

    $filtro2 = "";
    $filtro2 .= " AND tbl.idordenventa = ".$id;
    $documentos = DB::select('call ordenventadocumento_listar(?,?)', array('tbl.id',$filtro2));
    $ordenessalida = DB::select('call ordenventaordensalida_listar(?,?)', array('tbl.id',$filtro2));
    return Response::json(array('obj' =>$resultado,'detalles'=>$detalles,'documentos'=>$documentos,'ordenessalida'=>$ordenessalida));
}

public function Eliminar(){
    DB::beginTransaction();
    try {
        $id = Input::get('id');
        $usuario = 'Admin';

        //Buscar documentos asociados a la venta
        $nrodocs = Ordenventadocumento::where('activo', '=', 1)->where("idordenventa","=",$id)->count();
        if($nrodocs>0){
            throw new Exception("La OV está asociada a documento, primero elimine el documento", 1);
        }

        $Ordenventa = Ordenventa::find($id);
        $Ordenventa->activo = 0;
        $Ordenventa->updated_by = Session::get("nombreusuario");
        $Ordenventa->save();

        Detallematerial::where('idtabla', '=', $id)->update(['activo' => 0]);

        DB::commit();

        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
        
    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
        ));
    }
    
}

public function Anular(){
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $codigoingreso = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'INGRESO'));
    DB::beginTransaction();
    try {
        $id = Input::get('id');
        
        //Buscar Relaciones con documentos para eliminarlos
        $Ordenventadocumento = Ordenventadocumento::where("idordenventa","=",$id)->where("activo","=",1)->firstOrFail();
        if($Ordenventadocumento){
            $iddoc = $Ordenventadocumento->iddocumento;
            $Detallecuenta = Detallecuenta::where('referencia', '=', $iddoc)->where('activo', '=', 1)->firstOrFail();
            $pagos = Detallecuentapago::where('iddetallecuenta_asoc',"=", $Detallecuenta->id)->get();
            if(count($pagos)>0){
                foreach ($pagos as $key => $value) {
                    //Eliminar el pago y la oc
                    $Detallecuenta = Detallecuenta::find($value["iddetallecuenta"]);
                    DB::table('detallecuenta')->where('id', '=', $Detallecuenta->id)->update(['activo' => 0]);
                    DB::table('movimientocaja')->where('id', '=', $Detallecuenta->referencia)->update(['activo' => 0]);
                }
                DB::table('detallecuentapago')->where('iddetallecuenta', '=', $Detallecuenta->id)->update(['activo' => 0]);
            }
            DB::table('detallecuenta')->where('referencia', '=', $iddoc)->update(['activo' => 0]);
            DB::table('documento')->where([['id','=',$iddoc]])->update(['idestado' => Config::get('constants.estadodocumento.anulado')]);
        }


        //Generar Ordenes (Orden de Ingreso por el total)
        $ReferenciasSalidas = Ordenventaordensalida::where("idordenventa","=",$id)->where("activo","=",1)->get();
        if(count($ReferenciasSalidas)>0){
            foreach ($ReferenciasSalidas as $key => $value) {
                $Ordeningresosalida = Ordeningresosalida::find($value["idordensalida"]);
                $OrdenIngreso = new Ordeningresosalida;

                $OrdenIngreso->idempresa = $idempresa;
                $OrdenIngreso->idsede = $idsede;
                $OrdenIngreso->codigo = $codigoingreso[0]->rpta;
                $OrdenIngreso->idempresapropietario = $Ordeningresosalida->idempresapropietario;
                $OrdenIngreso->idempresaadministra = $Ordeningresosalida->idempresaadministra;
                $OrdenIngreso->fechaorden = date("Y-m-d");
                $OrdenIngreso->idtipo = Config::get('constants.tipoordeningresosalida.ingreso');
                $OrdenIngreso->idestado = $Ordeningresosalida->idestado;
                $OrdenIngreso->idmovimientoinventario = Config::get('constants.movimientoinventario.ingresodevolucion');
                $OrdenIngreso->codigooperacion = $Ordeningresosalida->codigooperacion;
                $OrdenIngreso->idmodulo = $Ordeningresosalida->idmodulo;
                $OrdenIngreso->glosa = "INGRESO POR DEVOLUCIÓN DE CLIENTES // ".$Ordeningresosalida->codigo;
                $OrdenIngreso->inddevolucion = 0;
                $OrdenIngreso->created_by = Session::get("nombreusuario");
                $OrdenIngreso->updated_by = Session::get("nombreusuario");
                $OrdenIngreso->activo = 1;
                $OrdenIngreso->save();

                $Detalleingresosalidas = Detalleingresosalida::where("idordeningresosalida","=",$value["idordensalida"])->where("activo","=",1)->get();
                if(count($Detalleingresosalidas)>0){
                    foreach ($Detalleingresosalidas as $key => $value2) {
                        $DetalleIngreso = new Detalleingresosalida;
                        $DetalleIngreso->idempresa = $idempresa;
                        $DetalleIngreso->idsede = $idsede;
                        $DetalleIngreso->idordeningresosalida = $OrdenIngreso->id;
                        $DetalleIngreso->idmaterial = $value2['idmaterial'];
                        $DetalleIngreso->idlote = $value2['idlote'];
                        $DetalleIngreso->cantidad = $value2['cantidad'];
                        $DetalleIngreso->costoorigen = $value2['costoorigen'];
                        $DetalleIngreso->costo =$value2['costo'];
                        $DetalleIngreso->idalmacen = $value2['idalmacen'];
                        $DetalleIngreso->idunidadmedida = $value2['idunidadmedida'];
                        $DetalleIngreso->created_by = Session::get("nombreusuario");
                        $DetalleIngreso->updated_by = Session::get("nombreusuario");
                        $DetalleIngreso->activo = 1;
                        $DetalleIngreso->save();

                        $obj_registroinventario = new Registroinventario;
                        $obj_registroinventario->idempresa = $idempresa;
                        $obj_registroinventario->idsede = $idsede;
                        $obj_registroinventario->iddetalleingresosalida = $DetalleIngreso->id;
                        $obj_registroinventario->idalmacen = $DetalleIngreso->idalmacen;
                        $obj_registroinventario->idlote = $DetalleIngreso->idlote;
                        $obj_registroinventario->idmaterial = $DetalleIngreso->idmaterial;
                        $obj_registroinventario->idmovimientoinventario = $OrdenIngreso->idmovimientoinventario;
                        $obj_registroinventario->idordeningresosalida = $OrdenIngreso->id;
                        $obj_registroinventario->fechamovimiento = $OrdenIngreso->fechaorden;
                        $obj_registroinventario->cantidad = $DetalleIngreso->cantidad;
                        $obj_registroinventario->costo = $DetalleIngreso->costo;
                        $obj_registroinventario->glosa = '';
                        $obj_registroinventario->inddevolucion = $OrdenIngreso->inddevolucion;
                        $obj_registroinventario->created_by = Session::get("nombreusuario");
                        $obj_registroinventario->updated_by = Session::get("nombreusuario");
                        $obj_registroinventario->activo = 1;
                        $obj_registroinventario->save();
                        self::Ajuste($obj_registroinventario);

                    }
                }
            }
        }


        DB::table('ordenventa')->where([['id','=',$id]])->update(['idestado' => Config::get('constants.estadoventa.anulada')]);
        DB::commit();

        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));

    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll"
        ));
    }
    

}


//============================================================= AJUSTE DE INVENTARIO ===================================================================


public function Ajuste($reginventario){
    //DB::beginTransaction();
    try {
        $fechainventarioanterior = '';
        //Obtener inventario almacen anterior a la fecha indicada
        $invalmacen = DB::table('inventarioalmacen')
                                ->select('id', 'fechainventario')
                                ->where([
                                            ['activo','=','1'],
                                            ['idmaterial','=',$reginventario->idmaterial],
                                            ['idlote','=',$reginventario->idlote],
                                            ['idalmacen','=',$reginventario->idalmacen],
                                            ['fechainventario','<',$reginventario->fechamovimiento],
                                        ])
                                ->orderBy('fechainventario', 'desc')
                                ->first();
        if (empty($invalmacen->id)) 
        {
            $fechainventarioanterior = $reginventario->fechamovimiento;
        }else{
            $fechainventarioanterior = $invalmacen->fechainventario;
        }
        //desactivar inventario almacen desde la fechainventarioanterior
        DB::table('inventarioalmacen')
                ->where([
                            ['activo','=','1'],
                            ['idmaterial','=',$reginventario->idmaterial],
                            ['idlote','=',$reginventario->idlote],
                            ['idalmacen','=',$reginventario->idalmacen],
                            ['fechainventario','>=',$fechainventarioanterior],
                        ])
                ->update(['activo' => 0]);
        //listar registro inventario desde la fechainventarioanterior
        $registroinventario = DB::table('registroinventario')
                                ->where([
                                            ['activo','=','1'],
                                            ['idmaterial','=',$reginventario->idmaterial],
                                            ['idlote','=',$reginventario->idlote],
                                            ['idalmacen','=',$reginventario->idalmacen],
                                            ['fechamovimiento','>=',$fechainventarioanterior],
                                        ])
                                ->orderBy('fechamovimiento', 'asc')
                                ->get();
        foreach ($registroinventario as $key => $ri) 
        {
            $categoria = DB::table('categoria')
                                ->select('abreviatura')
                                ->where([
                                            ['id','=',$ri->idmovimientoinventario],
                                            ['activo','=','1'],
                                        ])
                                ->first();
            if (!empty($categoria->abreviatura)) 
            {
                $IndicadorIngreso = false;
                if ($categoria->abreviatura == 'I') {
                    $IndicadorIngreso = true;
                }
                $costofinal = self::inventarioalmaceniud($ri,$IndicadorIngreso);
                if ($categoria->abreviatura == 'S' && $reginventario->inddevolucion == 0 ) 
                {   
                    $reginv = Registroinventario::find($ri->id);
                    $reginv->costo = $costofinal;
                    $reginv->save();
                }
            }else
            {
                throw new Exception("Ocurrió un error en Inventario", 1);
            }

        }
    } catch (Exception $e) {
        throw $e;
    }
}

private function inventarioalmaceniud($ri,$indingreso)
{   
    try {
        $costopromedio = 0;
        //Verificar si existe registro de inventario almacen en la fecha enviada
        $invalmacen = DB::table('inventarioalmacen')
                    ->where([
                                ['activo','=','1'],
                                ['indstockactual','=','1'],
                                ['idmaterial','=',$ri->idmaterial],
                                ['idlote','=',$ri->idlote],
                                ['idalmacen','=',$ri->idalmacen],
                                ['fechainventario','=',$ri->fechamovimiento],
                            ])
                    ->first();
        if (!empty($invalmacen->id)) 
        {
            //si existe inventario almacen
            $inventarioalmacen = Inventarioalmacen::find($invalmacen->id);
            $costofinal = $inventarioalmacen->costo;
            $costototal = $inventarioalmacen->stock * $inventarioalmacen->costo;
            //si es un ingreso sumar
            if ($indingreso) 
            {
                $inventarioalmacen->cantidadingreso += $ri->cantidad;
                $inventarioalmacen->stock += $ri->cantidad;
                $inventarioalmacen->costo = round((($ri->cantidad * $ri->costo) + $costototal) / $inventarioalmacen->stock,8,PHP_ROUND_HALF_UP);
                $inventarioalmacen->updated_by = $ri->updated_by;
                $inventarioalmacen->save();
                $costopromedio =  $inventarioalmacen->costo;
            }elseif (!$indingreso && $ri->inddevolucion == 0) 
            {
                //si es una salida y no es devolucion restar
                if ($inventarioalmacen->stock - $ri->cantidad < 0) 
                {
                    throw new Exception("Stock Negativo", 1);
                }
                $inventarioalmacen->cantidadsalida += $ri->cantidad;
                $inventarioalmacen->stock -= $ri->cantidad;
                $inventarioalmacen->updated_by = $ri->updated_by;
                $inventarioalmacen->save();
                $costopromedio =  $inventarioalmacen->costo;
            }else
            {
                //si es una salida y devolucion restar costeando ya que se devuelve al mismo costo que se compro (verificando que cantidad puede ser = 0)
                if ($inventarioalmacen->stock - $ri->cantidad < 0) 
                {
                    throw new Exception("Stock Negativo", 1);
                }
                $inventarioalmacen->cantidadsalida += $ri->cantidad;
                $inventarioalmacen->stock -= $ri->cantidad;
                if ($inventarioalmacen->stock>0) 
                {
                    //verificar la cantidad xq puede ser 0
                    if ($ri->cantidad > 0) 
                    {
                       $inventarioalmacen->costo = round(($costototal - ($ri->cantidad * $ri->costo)) / $inventarioalmacen->stock,8,PHP_ROUND_HALF_UP);
                    }else
                    {
                        $inventarioalmacen->costo = round(($costototal - $ri->costo) / $inventarioalmacen->stock,8,PHP_ROUND_HALF_UP);
                    }
                    $inventarioalmacen->updated_by = $ri->updated_by;
                    $inventarioalmacen->save();
                    $costopromedio =  $inventarioalmacen->costo;
                }else
                {
                    //stock es igual a 0
                    $inventarioalmacen->costo = 0;
                    $inventarioalmacen->updated_by = $ri->updated_by;
                    $inventarioalmacen->save();
                    $costopromedio =  $costofinal;
                }
            }
        }else
        {
            //no existe inventario almacen para esa fecha
            //buscar el registro anterior
            //throw new Exception("idmaterial: ".$ri->idmaterial.",idlote: ".$ri->idlote.",idalmacen: ".$ri->idalmacen." / ".date("Y-m-d", strtotime($ri->fechamovimiento)), 1);
            $invalmacen = DB::table('inventarioalmacen')
                    ->where([
                                ['activo','=','1'],
                                ['idmaterial','=',$ri->idmaterial],
                                ['idlote','=',$ri->idlote],
                                ['idalmacen','=',$ri->idalmacen],
                                ['fechainventario','<',$ri->fechamovimiento],
                            ])
                    ->orderBy('fechainventario', 'desc')
                    ->first();
            if (empty($invalmacen->id)) 
            {
                //Primero registro en la tabla inventario almacen
                //Verificar si es salida retornar excepcion stock negativo
                if (!$indingreso) 
                {
                    //throw new Exception("IDPROD: ".$ri->idmaterial." IDALM: ".$ri->idalmacen." IDLOTE: ".$ri->idlote, 1);
                    throw new Exception("Uno de los productos no tiene Stock en almacén", 1);
                }else
                {
                    //tipo orden ingreso , Guardo registro en inventario almacen
                    $obj_inventarioalmacen = new Inventarioalmacen;
                    $obj_inventarioalmacen->idempresa = $ri->idempresa;
                    $obj_inventarioalmacen->idsede = $ri->idsede;
                    $obj_inventarioalmacen->idalmacen = $ri->idalmacen;
                    $obj_inventarioalmacen->idlote = $ri->idlote;
                    $obj_inventarioalmacen->idmaterial = $ri->idmaterial;
                    $obj_inventarioalmacen->fechainventario = $ri->fechamovimiento;
                    $obj_inventarioalmacen->cantidadinicial = 0;
                    $obj_inventarioalmacen->cantidadingreso = $ri->cantidad;
                    $obj_inventarioalmacen->cantidadsalida = 0;
                    $obj_inventarioalmacen->stock = $ri->cantidad;
                    $obj_inventarioalmacen->costo = $ri->costo;
                    $obj_inventarioalmacen->indstockactual = 1;
                    $obj_inventarioalmacen->created_by = $ri->updated_by;
                    $obj_inventarioalmacen->updated_by = $ri->updated_by;
                    $obj_inventarioalmacen->activo = 1;
                    $obj_inventarioalmacen->save();
                    $costopromedio =  $obj_inventarioalmacen->costo;
                }
            }else
            {
                //sí existe un registro anterior a la fecha movimiento en inventario almacen 
                $inventarioalmacenant = Inventarioalmacen::find($invalmacen->id);
                $costototal = $inventarioalmacenant->stock * $inventarioalmacenant->costo;
                $costofinal = $inventarioalmacenant->costo;
                $inventarioalmacenant->indstockactual = 0;
                $inventarioalmacenant->updated_by = $ri->updated_by;
                $inventarioalmacenant->save();
                //verificar ingreso ,salida devolucion , salida normal
                if ($indingreso) 
                {
                    //ingreso
                    //tipo orden ingreso , Guardo registro en inventario almacen
                    $obj_inventarioalmacen = new Inventarioalmacen;
                    $obj_inventarioalmacen->idempresa = $ri->idempresa;
                    $obj_inventarioalmacen->idsede = $ri->idsede;
                    $obj_inventarioalmacen->idalmacen = $ri->idalmacen;
                    $obj_inventarioalmacen->idlote = $ri->idlote;
                    $obj_inventarioalmacen->idmaterial = $ri->idmaterial;
                    $obj_inventarioalmacen->fechainventario = $ri->fechamovimiento;
                    $obj_inventarioalmacen->cantidadinicial = $inventarioalmacenant->stock;
                    $obj_inventarioalmacen->cantidadingreso = $ri->cantidad;
                    $obj_inventarioalmacen->cantidadsalida = 0;
                    $obj_inventarioalmacen->stock = $inventarioalmacenant->stock + $ri->cantidad;
                    $obj_inventarioalmacen->costo = round((($ri->cantidad * $ri->costo) + $costototal) / $obj_inventarioalmacen->stock,8,PHP_ROUND_HALF_UP);
                    $obj_inventarioalmacen->indstockactual = 1;
                    $obj_inventarioalmacen->created_by = $ri->updated_by;
                    $obj_inventarioalmacen->updated_by = $ri->updated_by;
                    $obj_inventarioalmacen->activo = 1;
                    $obj_inventarioalmacen->save();
                    $costopromedio =  $obj_inventarioalmacen->costo;
                }elseif(!$indingreso && $ri->inddevolucion == 0)
                {
                    //salida normal
                    //verificar stock negativo
                    if ($inventarioalmacenant->stock - $ri->cantidad < 0 ) 
                    {
                        throw new Exception("Stock Negativo", 1);
                    }
                    $obj_inventarioalmacen = new Inventarioalmacen;
                    $obj_inventarioalmacen->idempresa = $ri->idempresa;
                    $obj_inventarioalmacen->idsede = $ri->idsede;
                    $obj_inventarioalmacen->idalmacen = $ri->idalmacen;
                    $obj_inventarioalmacen->idlote = $ri->idlote;
                    $obj_inventarioalmacen->idmaterial = $ri->idmaterial;
                    $obj_inventarioalmacen->fechainventario = $ri->fechamovimiento;
                    $obj_inventarioalmacen->cantidadinicial = $inventarioalmacenant->stock;
                    $obj_inventarioalmacen->cantidadingreso = 0;
                    $obj_inventarioalmacen->cantidadsalida = $ri->cantidad;
                    $obj_inventarioalmacen->stock = $inventarioalmacenant->stock - $ri->cantidad;
                    $obj_inventarioalmacen->costo =  $inventarioalmacenant->costo;
                    $obj_inventarioalmacen->indstockactual = 1;
                    $obj_inventarioalmacen->created_by = $ri->updated_by;
                    $obj_inventarioalmacen->updated_by = $ri->updated_by;
                    $obj_inventarioalmacen->activo = 1;
                    $obj_inventarioalmacen->save();
                    $costopromedio =  $obj_inventarioalmacen->costo;

                }else
                {
                    //salida devolucion
                    //verificar stock negativo
                    if ($inventarioalmacenant->stock - $ri->cantidad < 0 ) 
                    {
                         throw new Exception("Stock Negativo", 1);
                         
                    }
                    //si nuevo stock mayor que 0
                    if ($inventarioalmacenant->stock - $ri->cantidad > 0) 
                    {
                        $obj_inventarioalmacen = new Inventarioalmacen;
                        $obj_inventarioalmacen->idempresa = $ri->idempresa;
                        $obj_inventarioalmacen->idsede = $ri->idsede;
                        $obj_inventarioalmacen->idalmacen = $ri->idalmacen;
                        $obj_inventarioalmacen->idlote = $ri->idlote;
                        $obj_inventarioalmacen->idmaterial = $ri->idmaterial;
                        $obj_inventarioalmacen->fechainventario = $ri->fechamovimiento;
                        $obj_inventarioalmacen->cantidadinicial = $inventarioalmacenant->stock;
                        $obj_inventarioalmacen->cantidadingreso = 0;
                        $obj_inventarioalmacen->cantidadsalida = $ri->cantidad;
                        $obj_inventarioalmacen->stock = $inventarioalmacenant->stock - $ri->cantidad;
                        $obj_inventarioalmacen->costo = round(( $costototal - ($ri->cantidad * $ri->costo)) / $obj_inventarioalmacen->stock,8,PHP_ROUND_HALF_UP);
                        $obj_inventarioalmacen->indstockactual = 1;
                        $obj_inventarioalmacen->created_by = $ri->updated_by;
                        $obj_inventarioalmacen->updated_by = $ri->updated_by;
                        $obj_inventarioalmacen->activo = 1;
                        $obj_inventarioalmacen->save();
                        $costopromedio =  $obj_inventarioalmacen->costo;
                    }else
                    {
                        //stock 0
                        $obj_inventarioalmacen = new Inventarioalmacen;
                        $obj_inventarioalmacen->idempresa = $ri->idempresa;
                        $obj_inventarioalmacen->idsede = $ri->idsede;
                        $obj_inventarioalmacen->idalmacen = $ri->idalmacen;
                        $obj_inventarioalmacen->idlote = $ri->idlote;
                        $obj_inventarioalmacen->idmaterial = $ri->idmaterial;
                        $obj_inventarioalmacen->fechainventario = $ri->fechamovimiento;
                        $obj_inventarioalmacen->cantidadinicial = $inventarioalmacenant->stock;
                        $obj_inventarioalmacen->cantidadingreso = 0;
                        $obj_inventarioalmacen->cantidadsalida = $ri->cantidad;
                        $obj_inventarioalmacen->stock = $inventarioalmacenant->stock - $ri->cantidad;
                        $obj_inventarioalmacen->costo = 0;
                        $obj_inventarioalmacen->indstockactual = 1;
                        $obj_inventarioalmacen->created_by = $ri->updated_by;
                        $obj_inventarioalmacen->updated_by = $ri->updated_by;
                        $obj_inventarioalmacen->activo = 1;
                        $obj_inventarioalmacen->save();
                        $costopromedio =  $costofinal;
                    }
                }
            }

        }

        return $costopromedio;
    } catch (Exception $e) {
        //DB::rollBack();
        throw $e;
    }
    
}


}


