<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Categoria;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;

class CategoriaController extends BaseController {

Public Function ListarGrupos()
{
    $resultado = DB::select('SELECT DISTINCT grupo FROM categoria where activo = ?', array(1));
    return Response::json(array('lista'=>$resultado));
}

Public Function Listar()
{
    $filtro = "";

    $grupo = Input::get('grupo');
    $grupo = " AND grupo = '".$grupo."'";
    $filtro .= $grupo." AND tbl.activo = 1 ";

    if(Input::get('abreviatura')!=null){
        $av = Input::get('abreviatura');
        $filtro .= $grupo." AND tbl.abreviatura = '".$av."'";
    }

    $resultado = DB::select('call categoria_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){

    $grupo = Input::get('grupo');
    $prefijo = Input::get('prefijo');
    $idempresa = Session::get('idempresa');
    $idsede = Session::get('idsede');

    $codigo = DB::select('call retornarcodigocategoria(?,?,?,?)', array($idempresa,$idsede,$grupo,$prefijo));
    DB::beginTransaction();

    try {
        $mensaje='';
        $id = Input::get('id');
        $error = false;

        if($id === ''){
            $obj_categoria = new Categoria;
            $obj_categoria->codigo = $codigo[0]->rpta;
            $obj_categoria->idempresa = $idempresa;
            $obj_categoria->idsede = $idsede;
            $obj_categoria->idcategoriasuperior = Input::get('idcategoriasuperior');
            $obj_categoria->grupo = Input::get('grupo');
            $obj_categoria->prefijo = Input::get('prefijo');
            $obj_categoria->nombre = Input::get('nombre');
            $obj_categoria->abreviatura = Input::get('abreviatura');
            $obj_categoria->glosa = Input::get('glosa');
            $obj_categoria->codctble = Input::get('codctble');
            $obj_categoria->codigosunat = Input::get('codigosunat');
            $obj_categoria->tiporeferencia = Input::get('tiporeferencia');
            $obj_categoria->referencia = Input::get('referencia');
            $obj_categoria->activo = 1;
            $usuario = 'Admin';
            $obj_categoria->created_by = $usuario;
            $obj_categoria->updated_by = $usuario;
            $obj_categoria->save();

            if(!($obj_categoria->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_categoria = Categoria::find($id);
            $obj_categoria->idcategoriasuperior = Input::get('idcategoriasuperior');
            $obj_categoria->grupo = Input::get('grupo');
            $obj_categoria->prefijo = Input::get('prefijo');
            $obj_categoria->nombre = Input::get('nombre');
            $obj_categoria->abreviatura = Input::get('abreviatura');
            $obj_categoria->glosa = Input::get('glosa');
            $obj_categoria->codctble = Input::get('codctble');
            $obj_categoria->codigosunat = Input::get('codigosunat');
            $obj_categoria->tiporeferencia = Input::get('tiporeferencia');
            $obj_categoria->referencia = Input::get('referencia');
            $obj_categoria->activo = 1;
            $usuario = 'Admin';
            $obj_categoria->updated_by = $usuario;
            $obj_categoria->save();

            if(!($obj_categoria->id > 0)){
                $error = true;
            }
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
            throw new Exception("Ocurrió un error al registrar la operación", 1);
        }
    } catch (Exception $e) {
        DB::rollBack();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage()
        ));
    }

    
    
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call categoria_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call categoria_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


