<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Item;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;

class ItemController extends BaseController {

Public Function Listar()
{
    $fil = ' AND tbl.activo = 1';
    $filtro = Input::get("filtro");
    if($filtro!="" && $filtro!=null){
        $fil .= " AND concat(tbl.certificado,tbl.stock,tbl.precio,tbl.forma,tbl.carats,tbl.claridad,tbl.color,tbl.corte,tbl.pulido,tbl.simetria,tbl.fluorescent,tbl.lab) like '%".$filtro."%' ";
    }
    $resultado = DB::select('call item_listar(?,?)', array('',$fil));
    return Response::json(array('lista'=>$resultado));
}

Public Function ListarFiltros()
{
    $filtro = "";
    $tipo = Input::get('tipo');
    $fil = Input::get('filtro');
    $filtro = " AND tbl.activo = 1 ";
    if($tipo=="cod"){
        $filtro .= " AND LTRIM(tbl.codigo) like '%".$fil."'";
    }
    if($tipo=="nombre"){
        $filtro .= " AND LTRIM(concat(tbl.nombre,tbl.codigo)) like '%".$fil."%' ";
    }
    $resultado = DB::select('call item_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $error = false;
        if($id === ''){
            $obj_item = new Item;
            $obj_item->certificado = Input::get('certificado');
            $obj_item->stock = Input::get('stock');
            $obj_item->precio = Input::get('precio');
            $obj_item->forma = Input::get('forma');
            $obj_item->carats = Input::get('carats');
            $obj_item->claridad = Input::get('claridad');
            $obj_item->color = Input::get('color');
            $obj_item->corte = Input::get('corte');
            $obj_item->pulido = Input::get('pulido');
            $obj_item->simetria = Input::get('simetria');
            $obj_item->fluorescent = Input::get('fluorescent');
            $obj_item->lab = Input::get('lab');
            $obj_item->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_item->created_by = $usuario;
            $obj_item->updated_by = $usuario;

            $obj_item->save();
            if(!($obj_item->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_item = Item::find($id);
            $obj_item->certificado = Input::get('certificado');
            $obj_item->stock = Input::get('stock');
            $obj_item->precio = Input::get('precio');
            $obj_item->forma = Input::get('forma');
            $obj_item->carats = Input::get('carats');
            $obj_item->claridad = Input::get('claridad');
            $obj_item->color = Input::get('color');
            $obj_item->corte = Input::get('corte');
            $obj_item->pulido = Input::get('pulido');
            $obj_item->simetria = Input::get('simetria');
            $obj_item->fluorescent = Input::get('fluorescent');
            $obj_item->lab = Input::get('lab');
            $obj_item->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_item->created_by = $usuario;
            $obj_item->updated_by = $usuario;
            /*
            if (Input::hasFile('imagen')) {
                $file            = Input::file('imagen');
                $destinationPath = public_path().'/imagenes/productos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_item->imagen = 'imagenes/productos/'.$filename;
            }
            */
            $obj_item->save();

            if(!($obj_item->id > 0)){
                $error = true;
            }
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
        
        
        //return self::Error();
    } catch (Exception $e) {
        DB::rollBack();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage()
        ));
    }
    
}

Public function Error(){
    try {
        throw new Exception("No hay Stock Suficiente", 1);
    } catch (Exception $e) {
        throw $e;
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call item_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Item::find($id);
    $obj_item->activo = 0;
    $usuario = Session::get("nombreusuario");
    $obj_item->updated_by = $usuario;
    $obj_item->save();

    if($obj_item){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}

}


