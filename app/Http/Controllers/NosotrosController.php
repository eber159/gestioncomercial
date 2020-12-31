<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Nosotros;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class NosotrosController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    $resultado = DB::select('call nosotros_listar(?,?)', array('',$filtro));
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
            $obj_nosotros = new Nosotros;
            $obj_nosotros->idempresa = 1;
            $obj_nosotros->titulo = Input::get('titulo');
            $obj_nosotros->descripcion = Input::get('descripcion');
            $obj_nosotros->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_nosotros->created_by = $usuario;
            $obj_nosotros->updated_by = $usuario;
            
            
            if (Input::hasFile('imagen')) {
                $file            = Input::file('imagen');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/nosotros/';
                
                //$destinationPath = public_path().'/imagenes/nosotross/';

                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_nosotros->imagen = 'imagenes/nosotros/'.$filename;
                
            }
            
            $obj_nosotros->save();

            if(!($obj_nosotros->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_nosotros = Nosotros::find($id);
            $obj_nosotros->titulo = Input::get('titulo');
            $obj_nosotros->descripcion = Input::get('descripcion');
            $obj_nosotros->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_nosotros->created_by = $usuario;
            $obj_nosotros->updated_by = $usuario;

            if((Input::hasFile('imagen'))!=null){
                if (Input::hasFile('imagen')) {
                    $file            = Input::file('imagen');
                    
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/nosotros/';
                    
                    //$destinationPath = public_path().'/imagenes/nosotros/';
                    
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $obj_nosotros->imagen = 'imagenes/nosotros/'.$filename;
                }
            }
            
            $obj_nosotros->save();

            if(!($obj_nosotros->id > 0)){
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
    $resultado = DB::select('call nosotros_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Nosotros::find($id);
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
    $producto = DB::table('nosotros')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


