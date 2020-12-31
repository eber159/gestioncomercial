<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Ordeningresosalida;
use App\Detalleingresosalida;
use App\Registroinventario;
use App\Inventarioalmacen;
use App\Lote;
use config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;

class OrdeningresosalidaController extends BaseController {

Public Function Listar()
{
    $idtipoingresosalida = Input::get('idtipo');
    $idtipodocumento = " AND tbl.idtipo = ".$idtipoingresosalida;
    $filtro = " AND tbl.activo = 1".$idtipodocumento;
    $resultado = DB::select('call ordeningresosalida_listar(?,?)', array(' tbl.id desc',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar()
{
    DB::beginTransaction();
    $rpta = "";
    try {
        $mensaje='';
        $id = Input::get('id');
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        $usuario = Session::get("nombreusuario");
        $inddevolucion = '1';


        if($idempresa==""){
            $rpta = "session";
            throw new Exception("Su tiempo de sesi&oacute;n ha expirado, Por favor vuelva a logearse.");
        }


        //Nueva OrdenIngresoSalida
        if($id === '')
        {
            $obj_ordeningresosalida = new Ordeningresosalida;
            $obj_ordeningresosalida->codigo = Input::get('codigo');
            if (Input::get('idtipo') == config('constants.tipoordeningresosalida.ingreso')) {
                $codigo = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'INGRESO'));
                $obj_ordeningresosalida->codigo = $codigo[0]->rpta;    
            }else{
                $codigo = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'SALIDA'));
                $obj_ordeningresosalida->codigo = $codigo[0]->rpta;    
            }
            $obj_ordeningresosalida->idempresa = $idempresa;
            $obj_ordeningresosalida->idsede = $idsede;
            $obj_ordeningresosalida->idempresapropietario = Input::get('idempresapropietario');
            $obj_ordeningresosalida->idempresaadministra = Input::get('idempresaadministra');
            $obj_ordeningresosalida->fechaorden = Input::get('fechaorden');
            $obj_ordeningresosalida->idtipo = Input::get('idtipo');
            $obj_ordeningresosalida->idestado = Input::get('idestado');
            $obj_ordeningresosalida->idmovimientoinventario = Input::get('idmovimientoinventario');
            $obj_ordeningresosalida->codigooperacion = Input::get('codigooperacion');
            $obj_ordeningresosalida->idmodulo = Input::get('idmodulo');
            $obj_ordeningresosalida->glosa = Input::get('glosa');
            $obj_ordeningresosalida->inddevolucion = ($inddevolucion == 0);
            $obj_ordeningresosalida->created_by = $usuario ; 
            $obj_ordeningresosalida->updated_by = $usuario ;
            $obj_ordeningresosalida->activo = 1;
            $obj_ordeningresosalida->save();
            //Detalles
            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                //Guardar Nuevo DetalleOrdenIngresoSalida
                if($iddetalle=="")
                {
                    if($val["activo"]==1)
                    {

                        //preguntar si el producto tiene el indicador gen lote.
                        $idlote = $val['nrolote'];
                        $obj_detalleingresosalida = new Detalleingresosalida;
                        $obj_detalleingresosalida->idempresa = $idempresa;
                        $obj_detalleingresosalida->idsede = $idsede;
                        $obj_detalleingresosalida->idordeningresosalida = $obj_ordeningresosalida->id;
                        $obj_detalleingresosalida->idmaterial = $val['idmaterial'];
                        $obj_detalleingresosalida->idlote = $idlote;
                        $obj_detalleingresosalida->fechavencimiento = $val['fechavencimiento'];
                        $obj_detalleingresosalida->nrolote = $val['nrolote'];
                        $obj_detalleingresosalida->cantidad = $val['cantidad'];
                        $obj_detalleingresosalida->costoorigen = $val['costoorigen'];
                        $obj_detalleingresosalida->costo =$val['costo'];
                        $obj_detalleingresosalida->idalmacen = $val['idalmacen'];
                        $obj_detalleingresosalida->idunidadmedida = $val['idunidadmedida'];
                        $obj_detalleingresosalida->created_by = $usuario;
                        $obj_detalleingresosalida->updated_by = $usuario;
                        $obj_detalleingresosalida->activo = 1;
                        $obj_detalleingresosalida->save();
                        //Si la orden ingreso o salida esta en estado terminado generar registro inventario
                        if (Input::get('idestado') == config('constants.estadooios.terminado')) 
                        {
                            //Insertar Registro Inventario
                            $obj_registroinventario = new Registroinventario;
                            $obj_registroinventario->idempresa = $idempresa;
                            $obj_registroinventario->idsede = $idsede;
                            $obj_registroinventario->iddetalleingresosalida = $obj_detalleingresosalida->id;
                            $obj_registroinventario->idalmacen = $val['idalmacen'];
                            $obj_registroinventario->idlote = $val['idlote'];
                            $obj_registroinventario->idmaterial = $val['idmaterial'];
                            $obj_registroinventario->idmovimientoinventario = Input::get('idmovimientoinventario');
                            $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                            $obj_registroinventario->fechamovimiento = Input::get('fechaorden');
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
                $mensaje = 'Registro exitoso';
            }
        }
        else
        {
            //Editar Orden Ingreso/Salida
            $obj_ordeningresosalida = Ordeningresosalida::find($id);
            $obj_ordeningresosalida->idempresapropietario = Input::get('idempresapropietario');
            $obj_ordeningresosalida->idempresaadministra = Input::get('idempresaadministra');
            $obj_ordeningresosalida->fechaorden = Input::get('fechaorden');
            $obj_ordeningresosalida->idtipo = Input::get('idtipo');
            $obj_ordeningresosalida->idestado = Input::get('idestado');
            $obj_ordeningresosalida->idmovimientoinventario = Input::get('idmovimientoinventario');
            $obj_ordeningresosalida->codigooperacion = Input::get('codigooperacion');
            $obj_ordeningresosalida->idmodulo = Input::get('idmodulo');
            $obj_ordeningresosalida->glosa = Input::get('glosa');
            $obj_ordeningresosalida->updated_by = $usuario ;
            $activo = 1;
            $obj_ordeningresosalida->save();
            //Detalles
            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle=="")
                {
                    if($val["activo"]==1)
                    {
                        //Guardar Nuevo Detalle

                        $idlote = $val['idlote'];
                        
                        $obj_detalleingresosalida = new Detalleingresosalida;
                        $obj_detalleingresosalida->idempresa = $idempresa;
                        $obj_detalleingresosalida->idsede = $idsede;
                        $obj_detalleingresosalida->idordeningresosalida = $obj_ordeningresosalida->id;
                        $obj_detalleingresosalida->idmaterial = $val['idmaterial'];
                        $obj_detalleingresosalida->idlote = $idlote;
                        $obj_detalleingresosalida->cantidad = $val['cantidad'];
                        $obj_detalleingresosalida->costoorigen = $val['costoorigen'];
                        $obj_detalleingresosalida->costo = $val['costo'];
                        $obj_detalleingresosalida->idalmacen = $val['idalmacen'];
                        $obj_detalleingresosalida->idunidadmedida = $val['idunidadmedida'];
                        $obj_detalleingresosalida->created_by = $usuario;
                        $obj_detalleingresosalida->updated_by = $usuario;
                        $obj_detalleingresosalida->activo = 1;
                        $obj_detalleingresosalida->save();
                        //Si la orden ingreso o salida esta en estado terminado generar registro inventario
                        if (Input::get('idestado') == config('constants.estadooios.terminado')) 
                        {
                            //Insertar Registro Inventario
                            $obj_registroinventario = new Registroinventario;
                            $obj_registroinventario->idempresa = $idempresa;
                            $obj_registroinventario->idsede = $idsede;
                            $obj_registroinventario->iddetalleingresosalida = $obj_detalleingresosalida->id;
                            $obj_registroinventario->idalmacen = $val['idalmacen'];
                            $obj_registroinventario->idlote = $val['idlote'];
                            $obj_registroinventario->idmaterial = $val['idmaterial'];
                            $obj_registroinventario->idmovimientoinventario = Input::get('idmovimientoinventario');
                            $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                            $obj_registroinventario->fechamovimiento = Input::get('fechaorden');
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
                else
                {

                    $idlote = $val['idlote'];
                    if($idlote == "0"){
                        if (Input::get('idtipo') == config('constants.tipoordeningresosalida.ingreso') && Input::get('idestado') == config('constants.estadooios.terminado')) {
                            $producto = DB::table("material")->where("id",$val['idmaterial'])->first();
                            if($producto){
                                //Si el producto es lotizable al ingresarlo debe generar un lote
                                if($producto->indlotizable == "1"){
    
                                    //generar lote
                                    $lote = new Lote;
                                    $lote->idempresa = $idempresa;
                                    $lote->idsede = $idsede;            
                                    $lote->idtipo = 1;
                                    $lote->idordeningresosalida = $obj_ordeningresosalida->id;
                                    $lote->idordenrecepcion = 0;
                                    $lote->idordenrecepcion = 0;
                                    $lote->fecharegistro = Input::get('fechaorden');
                                    $lote->fechavencimiento = $val['fechavencimiento'];
                                    $lote->nrolote = $val['nrolote'];
                                    $lote->created_by = $usuario ; 
                                    $lote->updated_by = $usuario ;
                                    $lote->activo = 1;
                                    $lote->save();
                                    $idlote = $lote->id;
                                }
                            }
                        }
                    }
                    

                    //obtener detalle e ingresar datos modificados
                    $obj_detalleingresosalida = Detalleingresosalida::find($iddetalle);
                    $obj_detalleingresosalida->idmaterial = $val['idmaterial'];
                    $obj_detalleingresosalida->idlote = $idlote;
                    $obj_detalleingresosalida->cantidad = $val['cantidad'];
                    $obj_detalleingresosalida->costoorigen = $val['costoorigen'];
                    $obj_detalleingresosalida->costo = $val['costo'];
                    $obj_detalleingresosalida->idalmacen = $val['idalmacen'];
                    $obj_detalleingresosalida->updated_by = $usuario;
                    if($val["activo"]==1)
                    {
                        //Actualizar detalle
                        $obj_detalleingresosalida->activo = 1;
                        $obj_detalleingresosalida->save();
                        //Si la orden ingreso o salida esta en estado terminado actualizar registro inventario
                        if (Input::get('idestado') == config('constants.estadooios.terminado')) 
                        {
                            //Actualizar registro Inventario
                            $idregistroinventario = DB::table('registroinventario')
                                                    ->where([
                                                            ['iddetalleingresosalida','=',$iddetalle],
                                                            ['activo','=','1'],
                                                            ])
                                                    ->value('id');
                            //Verificar si no se ha generado para guardar o actualizar (detalle activo)
                            if (empty($idregistroinventario)) 
                            {
                                //Insertar Registro Inventario
                                $obj_registroinventario = new Registroinventario;
                                $obj_registroinventario->idempresa = $idempresa;
                                $obj_registroinventario->idsede = $idsede;
                                $obj_registroinventario->iddetalleingresosalida = $obj_detalleingresosalida->id;
                                $obj_registroinventario->idalmacen = $val['idalmacen'];
                                $obj_registroinventario->idlote = $idlote;
                                $obj_registroinventario->idmaterial = $val['idmaterial'];
                                $obj_registroinventario->idmovimientoinventario = Input::get('idmovimientoinventario');
                                $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                                $obj_registroinventario->fechamovimiento = Input::get('fechaorden');
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
                            else
                            {
                                $obj_registroinventario = Registroinventario::find($idregistroinventario);
                                $obj_registroinventario->idalmacen = $val['idalmacen'];
                                $obj_registroinventario->idlote = $idlote;
                                $obj_registroinventario->idmaterial = $val['idmaterial'];
                                $obj_registroinventario->idmovimientoinventario = Input::get('idmovimientoinventario');
                                $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                                $obj_registroinventario->fechamovimiento = Input::get('fechaorden');
                                $obj_registroinventario->cantidad = $val['cantidad'];
                                $obj_registroinventario->costo = $val['costo'];
                                $obj_registroinventario->glosa = '';
                                $obj_registroinventario->inddevolucion = $obj_ordeningresosalida->inddevolucion;
                                $obj_registroinventario->updated_by = $usuario;
                                $obj_registroinventario->activo = 1;
                                $obj_registroinventario->save();
                                self::Ajuste($obj_registroinventario);
                            }
                        }
                     }else
                     {
                        //eliminar detalle
                        $obj_detalleingresosalida->activo = 0;
                        $obj_detalleingresosalida->save();
                        //Si la orden ingreso o salida esta en estado terminado actualizar registro inventario
                        if (Input::get('idestado') == config('constants.estadooios.terminado')) 
                        {
                            //eliminar registro Inventario
                            $idregistroinventario = DB::table('registroinventario')
                                                    ->where([
                                                            ['iddetalleingresosalida','=',$iddetalle],
                                                            ['activo','=','1'],
                                                            ])
                                                    ->value('id');
                            //Verificar si no se ha generado registroinventario no hacer nada
                            if (!empty($idregistroinventario)) 
                            {
                                $obj_registroinventario = Registroinventario::find($idregistroinventario);
                                $obj_registroinventario->idalmacen = $val['idalmacen'];
                                $obj_registroinventario->idlote = $idlote;
                                $obj_registroinventario->idmaterial = $val['idmaterial'];
                                $obj_registroinventario->idmovimientoinventario = Input::get('idmovimientoinventario');
                                $obj_registroinventario->idordeningresosalida = $obj_ordeningresosalida->id;
                                $obj_registroinventario->fechamovimiento = Input::get('fechaorden');
                                $obj_registroinventario->cantidad = $val['cantidad'];
                                $obj_registroinventario->costo = $val['costo'];
                                $obj_registroinventario->glosa = '';
                                $obj_registroinventario->inddevolucion = $obj_ordeningresosalida->inddevolucion;
                                $obj_registroinventario->updated_by = $usuario;
                                $obj_registroinventario->activo = 0;
                                $obj_registroinventario->save();
                                self::Ajuste($obj_registroinventario);
                            }                        
                        }
                     }
                }
            }
            $mensaje = 'Registro Actualizado';
        }

        if($obj_ordeningresosalida->id > 0)
        {
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje
            ));
        }else
        {
            DB::rollBack();
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ha ocurrido un error en el registro"
            ));
        }
    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll",
            'rpta'          => $rpta
        ));
    }

}

private function Ajuste($reginventario)
{
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
                /*  
                    IF @TIPO_MOV = 'SAL'
                            AND @IND_DEV = 0
                            BEGIN
                                UPDATE  ALM.REGISTRO_INVENTARIO
                                SET     CAN_COSTO = @COSTO_FINAL
                                WHERE   ID = @ID_RI
                    END
                */    
            }else
            {
                throw new Exception("Ha ocurrido un error en Inventario", 1);
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
                    throw new Exception("Stock Negativo para el producto seleccionado", 1);
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
                    throw new Exception("Stock Negativo para el producto seleccionado", 1);
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
                    throw new Exception("Uno de los productos no tiene Stock en almacen", 1);
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
                //si existe un registro anterior a la fecha movimiento en inventario almacen 
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
                         //enviar excepcion con mensaje de stock negativo
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
                        throw new Exception("Stock Negativo para el producto seleccionado", 1);
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
        throw $e;
    }


    
}

Public Function Leer()
{
    $id = Input::get('id');
    $resultado = DB::select('call ordeningresosalida_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    $filtro = "";
    $filtrotabla = " AND tbl.idordeningresosalida = '".$id."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $detalles = DB::select('call detalleingresosalida_listar(?,?)', array('tbl.id',$filtro));
    return Response::json(array('obj' =>$resultado,'detalles'=>$detalles));    
}

public function Eliminar()
{
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call ordeningresosalida_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado)
    {
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


