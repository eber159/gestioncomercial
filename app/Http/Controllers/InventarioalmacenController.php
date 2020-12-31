<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Inventarioalmacen;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;

class InventarioalmacenController extends BaseController {

Public Function Listar()
{
	$filtro = "";
	$idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    
    if(Input::get('idalmacen')!=null){
        $idalmacen = Input::get('idalmacen');
        $filtro .= " AND tbl.idalmacen = ".$idalmacen;
    }
    if(Input::get('idproducto')!=null){
        $idproducto = Input::get('idproducto');
        $filtro .= " AND tbl.idmaterial = ".$idproducto;
    }
    
    $resultado = DB::select('call inventarioalmacen_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}


Public Function Kardex()
{
    $filtro = "";
    $idempresa = Session::get("idempresa");
    $idsede = Session::get("idsede");
    $idalmacen = Input::get("idalmacen");
    $idproducto = Input::get("idproducto");
    $fechaini = Input::get("fechaini");
    $fechafin = Input::get("fechafin");
    
    $resultado = DB::select('call rpt_kardex(?,?,?,?)', array($idalmacen,$idproducto,$fechaini,$fechafin));
    return Response::json(array('lista'=>$resultado));
}


}