<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Publicacion;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class PublicacionController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    $resultado = DB::select('call publicacion_listar(?,?)', array('',$filtro));
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
            $obj_publicacion = new Publicacion;
            $obj_publicacion->idempresa = 1;
            $obj_publicacion->titulo = Input::get('titulo');
            $obj_publicacion->descripcion = Input::get('editor1');
            $obj_publicacion->urlvideo = Input::get('urlvideo');
            if(!empty(Input::get('indlink'))){
                $indlink = 1;
            }else{$indlink = 0;}
            $obj_publicacion->indlink = $indlink;
            $obj_publicacion->urlmapa = Input::get('urlmapa');
            if(!empty(Input::get('indtexto'))){
                $indtexto = 1;
            }else{$indtexto = 0;}
            $obj_publicacion->indtexto = $indtexto;
            if(!empty(Input::get('indtextocompleto'))){
                $indtextocompleto = 1;
            }else{$indtextocompleto = 0;}
            $obj_publicacion->indtextocompleto = $indtextocompleto;
            /*
            if(!empty(Input::get('indlargo'))){
                $indlargo = 1;
            }else{$indlargo = 0;}
            $obj_publicacion->indlargo = $indlargo;
            */
            $obj_publicacion->indlargo = Input::get('indlargo');
            $obj_publicacion->urlexterno = Input::get('urlexterno');
            $obj_publicacion->orden = Input::get('orden');
            $obj_publicacion->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_publicacion->created_by = $usuario;
            $obj_publicacion->updated_by = $usuario;
            
            
            if (Input::hasFile('imagen')) {
                $file = Input::file('imagen');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/publicaciones/';
                
                /*
                $destinationPath = public_path().'/imagenes/publicaciones/';
                */
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_publicacion->imagen = 'imagenes/publicaciones/'.$filename;
                
            }
            
            $obj_publicacion->save();

            if(!($obj_publicacion->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_publicacion = Publicacion::find($id);
            $obj_publicacion->titulo = Input::get('titulo');
            $obj_publicacion->descripcion = Input::get('editor1');
            $obj_publicacion->urlvideo = Input::get('urlvideo');
            if(!empty(Input::get('indlink'))){
                $indlink = 1;
            }else{$indlink = 0;}
            $obj_publicacion->indlink = $indlink;
            $obj_publicacion->urlmapa = Input::get('urlmapa');
            if(!empty(Input::get('indtexto'))){
                $indtexto = 1;
            }else{$indtexto = 0;}
            if(!empty(Input::get('indtextocompleto'))){
                $indtextocompleto = 1;
            }else{$indtextocompleto = 0;}
            $obj_publicacion->indtextocompleto = $indtextocompleto;
            /*
            if(!empty(Input::get('indlargo'))){
                $indlargo = 1;
            }else{$indlargo = 0;}
            $obj_publicacion->indlargo = $indlargo;
            */
            $obj_publicacion->indlargo = Input::get('indlargo');
            $obj_publicacion->indtexto = $indtexto;
            $obj_publicacion->urlexterno = Input::get('urlexterno');
            $obj_publicacion->orden = Input::get('orden');
            $obj_publicacion->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_publicacion->created_by = $usuario;
            $obj_publicacion->updated_by = $usuario;

            if((Input::hasFile('imagen'))!=null){
                if (Input::hasFile('imagen')) {
                    $file = Input::file('imagen');
                
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/publicaciones/';
                    
                    /*
                    $destinationPath = public_path().'/imagenes/publicaciones/';
                    */
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $obj_publicacion->imagen = 'imagenes/publicaciones/'.$filename;
                }
            }
            
            $obj_publicacion->save();

            if(!($obj_publicacion->id > 0)){
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
            throw new Exception("Ha ocurrido un error en el proceso", 1);
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
    $resultado = DB::select('call publicacion_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Publicacion::find($id);
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
    $producto = DB::table('publicacion')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


