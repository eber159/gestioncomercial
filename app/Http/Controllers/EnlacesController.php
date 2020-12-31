<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Enlaces;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class EnlacesController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $idtipo = Input::get("idtipo");
    $filtro = " AND tbl.activo = 1 AND idtipo=".$idtipo;
    $resultado = DB::select('call enlaces_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}


public function Guardar(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $error = false;
	
	   $ruta = "";
	   $filename = "";
        if($id === ''){
            $obj_enlaces = new Enlaces;
            $obj_enlaces->idempresa = 1;
            $obj_enlaces->url = Input::get('url');
            $obj_enlaces->descripcion = Input::get('descripcion');
            $obj_enlaces->idtipo = Input::get('idtipo');
            $obj_enlaces->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_enlaces->created_by = $usuario;
            $obj_enlaces->updated_by = $usuario;
            
            
            if (Input::hasFile('imagen')) {
                $file            = Input::file('imagen');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/enlaces/';
                
                //$destinationPath = public_path().'/imagenes/enlaces/';

                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_enlaces->imagen = 'imagenes/enlaces/'.$filename;
                
            }
            
            $obj_enlaces->save();

            if(!($obj_enlaces->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_enlaces = Enlaces::find($id);
            $obj_enlaces->url = Input::get('url');
            $obj_enlaces->descripcion = Input::get('descripcion');
            $obj_enlaces->idtipo = Input::get('idtipo');
            $obj_enlaces->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_enlaces->created_by = $usuario;
            $obj_enlaces->updated_by = $usuario;

            if((Input::hasFile('imagen'))!=null){
                if (Input::hasFile('imagen')) {
                    $file            = Input::file('imagen');
                    
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/enlaces/';
                    
                    //$destinationPath = public_path().'/imagenes/enlaces/';
                    
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $obj_enlaces->imagen = 'imagenes/enlaces/'.$filename;
                }
            }
            
            $obj_enlaces->save();

            if(!($obj_enlaces->id > 0)){
                $error = true;
            }
	    $mensaje = 'Registro exitoso';
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

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call enlaces_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Enlaces::find($id);
    $obj_item->activo = 0;
    $usuario = Session::get("nombreusuario");
    $obj_item->updated_by = $usuario;
    $obj_item->save();

    if($obj_item){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}


public function verProducto($id){
    $producto = DB::table('enlaces')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


