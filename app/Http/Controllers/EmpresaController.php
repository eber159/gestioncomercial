<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Empresa;
use App\Persona;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use Session;

class EmpresaController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    if((Input::get("idtipoempresa")!=null)){
        $tipo = Input::get("idtipoempresa");
        $filtro .= " AND tbl.idtipoempresa = ".$tipo;    
    }
    if((Input::get("indsistema")!=null)){
        $indsistema = Input::get("indsistema");
        $filtro .= " AND tbl.indsistema = ".$indsistema;    
    }
    $resultado = DB::select('call empresa_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    
    $objEmpresa = new Empresa;
    $operacion = "";
    if($id != ''){
        $objEmpresa = Empresa::find($id);
    }

    $codigo = DB::select('call retornarcodigo(?,?,?)', array(0,0,'EMPRESA'));
    $objEmpresa->codigo = $codigo[0]->rpta;
    $objEmpresa->idempresa = Input::get('idempresa');
    $objEmpresa->idsede = Input::get('idsede');
    $objEmpresa->idpersona = Input::get('idpersona');
    $objEmpresa->idtipoempresa = Input::get('idtipoempresa');
    $objEmpresa->idtipodocumento = Input::get('idtipodocumento');
    $objEmpresa->numerodocumento = Input::get('numerodocumento');
    $objEmpresa->nombre = Input::get('nombre');
    $objEmpresa->abreviatura = Input::get('abreviatura');
    if(!empty(Input::get('indcliente'))){
        $indcliente = 1;
    }else{$indcliente = 0;}

    if(!empty(Input::get('indproveedor'))){
        $indproveedor = 1;
    }else{$indproveedor = 0;}

    if(!empty(Input::get('indsistema'))){
        $indsistema = 1;
    }else{$indsistema = 0;}
    $objEmpresa->indcliente = $indcliente;
    $objEmpresa->indproveedor = $indproveedor;
    $objEmpresa->indsistema = $indsistema;
    $objEmpresa->direccion1 = Input::get('direccion1');
    $objEmpresa->direccion2 = Input::get('direccion2');
    $objEmpresa->telefono1 = Input::get('telefono1');
    $objEmpresa->telefono2 = Input::get('telefono2');
    $objEmpresa->fechanac = Input::get('fechanac');
    $objEmpresa->fecharegistro = date('Y-m-d');
    $objEmpresa->activo = 1;   
    $objEmpresa->created_by = Session::get("nombreusuario");
    $objEmpresa->updated_by = Session::get("nombreusuario");
    $objEmpresa->save();

    if($id === ''){
        $mensaje = 'Registro exitoso';
    }
    else{
        $mensaje = 'Registro Actualizado';
    }

    if($objEmpresa->id > 0){
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
    $resultado = DB::select('call empresa_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call empresa_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}


public function GuardadoRapido(){
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    //$codigocuenta = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'CUENTA'));
    $codigoempresa = DB::select('call retornarcodigo(?,?,?)', array($idempresa,$idsede,'EMPRESA'));
    try {
        DB::beginTransaction();
        $mensaje='';
        $error = false;
        
        //Validaciones
        //Saber si la empresa ya esta registrada con ese numero de documento
        $empresa = DB::table('empresa')->where([
                                                ['numerodocumento', '=', Input::get("nrodocumento")],
                                                ['activo', '=', '1'],
                                        ])->first();
        if($empresa){
            throw new Exception("Ya se ha registrado un Cliente/Prov con el mismo numero de documento.", 1);
        }


        $objEmpresa = new Empresa;
        $objEmpresa->codigo = $codigoempresa[0]->rpta;
        $objEmpresa->idempresa = $idempresa;
        $objEmpresa->idsede = $idsede;
        $objEmpresa->idtipoempresa = 0;
        $objEmpresa->idtipodocumento = Input::get('tipodocumento');
        $objEmpresa->numerodocumento = Input::get('nrodocumento');
        if($objEmpresa->idtipodocumento==3){
            $objEmpresa->nombre = Input::get('razonsocial');
        }else{
            

            $objPersona = new Persona;
            $objPersona->idtipodocumento = $objEmpresa->idtipodocumento;
            $objPersona->nrodocumento = $objEmpresa->idtipodocumento;
            $objPersona->apellidopaterno = Input::get('apellidopaterno');
            $objPersona->apellidomaterno = Input::get('apellidomaterno');
            $objPersona->nombres = Input::get('nombres');
            $objPersona->direccion = Input::get('direccion1');
            $objPersona->created_by = Session::get("nombreusuario");
            $objPersona->updated_by = Session::get("nombreusuario");
            $objPersona->save();

            $objEmpresa->nombre = Input::get('apellidopaterno')." ".Input::get('apellidomaterno')." ".Input::get('nombres');
            $objEmpresa->idpersona = $objPersona->id;

        }
        
        $objEmpresa->abreviatura = "";
        $objEmpresa->indcliente = Input::get('indcliente');
        $objEmpresa->indproveedor = Input::get('indproveedor');
        $objEmpresa->indsistema = 0;
        $objEmpresa->direccion1 = Input::get('direccion1');
        $objEmpresa->direccion2 = Input::get('direccion2');
        $objEmpresa->telefono1 = Input::get('telefono1');
        $objEmpresa->telefono2 = "";
        $objEmpresa->fechanac = "";
        $objEmpresa->correo = Input::get('correo');
        $objEmpresa->fecharegistro = date('Y-m-d');
        $objEmpresa->activo = 1;   
        $objEmpresa->created_by = Session::get("nombreusuario");
        $objEmpresa->updated_by = Session::get("nombreusuario");
        $objEmpresa->save();
        if(!($objEmpresa->id > 0)){
            throw new Exception("Ocurrio un error al registrar EMPRESA", 1);
            $error = true;
        }


        //Registrar una cuenta corriente al cliente que se registra (por demanda del sistema) - si no la tuviese
        /*
        $obj_cuenta = new Cuenta;
        $obj_cuenta->idempr =  $idempresa;
        $obj_cuenta->idsede = $idsede;
        $obj_cuenta->codigo = $codigocuenta[0]->rpta;
        $obj_cuenta->idtitular = $objEmpresa->id;
        $obj_cuenta->idtipocuenta = Input::get('idtipocuenta');
        $obj_cuenta->idestadocuenta = Config::get('constants.estadocuenta.activa');
        $obj_cuenta->idmoneda = Config::get('constants.moneda.soles');
        $obj_cuenta->fecha = date('Y-m-d H:i:s');
        $obj_cuenta->idvendedor = 0;
        $obj_cuenta->limitecredito = 99999999999999;
        $obj_cuenta->activo = 1;
        $obj_cuenta->created_by = Session::get("nombreusuario");
        $obj_cuenta->updated_by = Session::get("nombreusuario");
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
        $obj_subcuenta->created_by = Session::get("nombreusuario");
        $obj_subcuenta->save();
        */

        $mensaje = 'Registro exitoso';

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'idempresa'     =>  $objEmpresa->id
            ));
        }else{
            throw new Exception("Ocurrio un error al registrar la operacion", 1);
        }
    } catch (Exception $e) {
        DB::rollBack();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'error'       =>  $e
        ));
    }
}



}


