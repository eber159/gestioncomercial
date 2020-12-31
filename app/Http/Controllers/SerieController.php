<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Serie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;

class SerieController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa; //." AND tbl.idsede = ".$idsede;
    if(Input::get('idtipodocumento')!=null){
        $idtipodocumento = Input::get('idtipodocumento');
        $filtro .= " AND tbl.idtipodocumento = ".$idtipodocumento;
    }
    if(Input::get('indcompraventa')!=null){
        $indcompraventa = Input::get('indcompraventa');
        $filtro .= " AND tbl.indcompraventa = '".$indcompraventa."'";
    }
    if(Input::get('serie')!=null){
        $serie = Input::get('serie');
        $filtro .= " AND tbl.nroserie = '".$serie."'";
    }
    $resultado = DB::select('call serie_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    $error = false;

    try {
        if($id === ''){
            $obj_serie = new Serie;
            $obj_serie->idempresa =Session::get('idempresa');
            $obj_serie->idsede = Session::get('idsede');
            $obj_serie->nroserie = Input::get('nroserie');
            $obj_serie->nrocorrelativo = Input::get('nrocorrelativo');
            $obj_serie->idtipodocumento = Input::get('idtipodocumento');
            $obj_serie->indcompraventa = Input::get('indcompraventa');
            $obj_serie->activo = 1;
            $usuario = 'Admin';
            $obj_serie->created_by = $usuario;
            $obj_serie->updated_by = $usuario;
            
            $obj_serie->save();
            if(!($obj_serie->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';

        }
        else{
            $obj_serie = Serie::find($id);
            $obj_serie->nroserie = Input::get('nroserie');
            $obj_serie->nrocorrelativo = Input::get('nrocorrelativo');
            $obj_serie->idtipodocumento = Input::get('idtipodocumento');
            $obj_serie->indcompraventa = Input::get('indcompraventa');
            $obj_serie->activo = 1;
            $usuario = 'Admin';
            $obj_serie->updated_by = $usuario;

            $obj_serie->save();
            if(!($obj_serie->id > 0)){
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
    $resultado = DB::select('call serie_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call serie_iud(?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

Public Function ListarCorrelativo()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa; //." AND tbl.idsede = ".$idsede;
    if(Input::get('idtipodocumento')!=null){
        $idtipodocumento = Input::get('idtipodocumento');
        $filtro .= " AND tbl.idtipodocumento = ".$idtipodocumento;
    }
    if(Input::get('indcompraventa')!=null){
        $indcompraventa = Input::get('indcompraventa');
        $filtro .= " AND tbl.indcompraventa = '".$indcompraventa."'";
    }
    if(Input::get('serie')!=null){
        $serie = Input::get('serie');
        $filtro .= " AND tbl.nroserie = '".$serie."'";
    }
    $resultado = DB::select('call serie_listar(?,?)', array('',$filtro));

    if($resultado){
        if(Input::get('serie')!=null){
            $corr = (int) $resultado[0]->nrocorrelativo;
            $corr = $corr + 1;
            $resultado[0]->nrocorrelativo = str_pad($corr, 8, "0", STR_PAD_LEFT);
        }    
    }
    

    return Response::json(array('lista'=>$resultado));
}

}

