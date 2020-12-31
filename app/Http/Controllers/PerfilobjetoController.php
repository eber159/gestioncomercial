<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Perfilobjeto;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;

class PerfilobjetoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro .= " AND tbl.activo = 1 ";
    if(Input::get('idperfil')!=null){
        $idperfil = Input::get('idperfil');
        $filtro .= " AND tbl.idperfil = ".$idperfil;
    }
    $resultado = DB::select('call perfilobjeto_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $idperfil = Input::get('idperfil');
    $resultado_ = DB::update('DELETE FROM perfilobjeto WHERE idperfil = '.$idperfil);

    foreach(Input::get('objetos') as $obj=>$val)
    {
        $id = "";
        $idobjeto = $val['id'];
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call perfilobjeto_iud(?,?,?,?,?,?)', array($id,$idperfil,$idobjeto,$activo,$usuario,'INS'));
    }
    $mensaje = 'Registro exitoso';

    if($resultado > 0){
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
    $resultado = DB::select('call perfilobjeto_listar(?,?)', array('',' AND activo = 1 AND id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call perfilobjeto_iud(?,?,?,?,?,?)', array($id,'','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

}


