<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Trabajador;
use App\Persona;
use App\Usuario;
use App\Perfilusuario;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use Session;

class TrabajadorController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    if((Input::get("idempresa")!=null)){
        $idempresa = Input::get("idempresa");
        $filtro .= " AND tbl.idempresa = ".$idempresa;    
    }
    $resultado = DB::select('call trabajador_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');


    $obj_trabajador = new Trabajador;
    $obj_persona = new Persona;
    

    if($id != ''){
        $obj_trabajador = Trabajador::find($id);
        $obj_persona = Persona::find($obj_trabajador->id);
    }

    $obj_persona->idtipodocumento = Input::get('idtipodocumento');
    $obj_persona->nrodocumento = Input::get('nrodocumento');
    $obj_persona->nombres = Input::get('nombres');
    $obj_persona->apellidopaterno = Input::get('apellidopaterno');
    $obj_persona->apellidomaterno = Input::get('apellidomaterno');
    $obj_persona->sexo = Input::get('sexo');
    $obj_persona->fechanacimiento = Input::get('fechanacimiento');
    $obj_persona->direccion = Input::get('direccion');
    $obj_persona->idestadocivil = Input::get('idestadocivil');
    $obj_persona->activo = 1;
    $usuario = Session::get("nombreusuario");
    $obj_persona->created_by = $usuario;
    $obj_persona->updated_by = $usuario;
    $obj_persona->save();

    $obj_trabajador->idempresa = Input::get('idempresa'); // Session::get("idempresa");
    $obj_trabajador->idcargotrabajador = Input::get('idcargotrabajador');
    $obj_trabajador->fechaingreso = Input::get('fechaingreso');
    $obj_trabajador->fechatermino = Input::get('fechatermino');
    $obj_trabajador->idpersona = $obj_persona->id;
    $obj_trabajador->activo = 1;
    $usuario = Session::get("nombreusuario");
    $obj_trabajador->created_by = $usuario;
    $obj_trabajador->updated_by = $usuario;
    $obj_trabajador->save();

    if($id == ''){
        $obj_usuario = new Usuario;
        $obj_usuario->idempresa = Session::get("idempresa");
        $obj_usuario->nombre = Input::get('nombreusuario');
        $obj_usuario->clave = Input::get('clave');
        $obj_usuario->idtrabajador = $obj_trabajador->id;
        $obj_usuario->trabajador = $obj_persona->apellidopaterno." ".$obj_persona->apellidomaterno." ".$obj_persona->nombres;
        $obj_usuario->activo = 1;
        $obj_usuario->created_by = $usuario;
        $obj_usuario->updated_by = $usuario;
        $obj_usuario->save();

        if(Input::get('cmbPerfil')!==""){
            //Crea el nuevo perfil de ese usuario
            $obj_perfilusuario = new Perfilusuario;
            $obj_perfilusuario->idperfil = Input::get('cmbPerfil');
            $obj_perfilusuario->idempresa = Input::get('idempresa');
            $obj_perfilusuario->idsede = Input::get('cmbSede');
            $obj_perfilusuario->idusuario = $obj_usuario->id;
            $obj_perfilusuario->idtrabajador = $obj_trabajador->id;
            $obj_perfilusuario->activo = 1;
            $obj_perfilusuario->created_by = $usuario;
            $obj_perfilusuario->updated_by = $usuario;
            $obj_perfilusuario->save();
        }

    }

   


    if($id === ''){
        $mensaje = 'Registro exitoso';
    }
    else{
        $mensaje = 'Registro Actualizado';
    }

    if($obj_trabajador->id > 0){
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
    $resultado = DB::select('call trabajador_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    $resultadopersona = DB::select('call persona_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$resultado[0]->idpersona));
    return Response::json(array('obj' =>$resultado,'objpersona' =>$resultadopersona));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = Session::get("idusuario");
    $resultado = DB::select('call trabajador_iud(?,?,?,?,?,?,?,?)', array($id,'','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


