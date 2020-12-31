<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Slider;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class SliderController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    $resultado = DB::select('call slider_listar(?,?)', array('',$filtro));
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
            $obj_slider = new Slider;
            $obj_slider->idempresa = 1;
            $obj_slider->titulo = Input::get('titulo');
            $obj_slider->descripcion = Input::get('descripcion');
            $obj_slider->link = Input::get('link');
            $obj_slider->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_slider->created_by = $usuario;
            $obj_slider->updated_by = $usuario;
            
            
            if (Input::hasFile('imagen')) {
                $file            = Input::file('imagen');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $carpetapublica = Config::get('constants.rutapublica.nombrecarpeta');
                $destinationPath = $base.'/'.$carpetapublica.'/imagenes/slider/';
                
                //$destinationPath = public_path().'/imagenes/slider/';

                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_slider->imagen = 'imagenes/slider/'.$filename;
                
            }
            
            $obj_slider->save();

            if(!($obj_slider->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_slider = Slider::find($id);
            $obj_slider->titulo = Input::get('titulo');
            $obj_slider->descripcion = Input::get('descripcion');
            $obj_slider->link = Input::get('link');
            $obj_slider->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_slider->created_by = $usuario;
            $obj_slider->updated_by = $usuario;

            if((Input::hasFile('imagen'))!=null){
                if (Input::hasFile('imagen')) {
                    $file            = Input::file('imagen');
                    
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $carpetapublica = Config::get('constants.rutapublica.nombrecarpeta');
                    $destinationPath = $base.'/'.$carpetapublica.'/imagenes/slider/';
                    
                    //$destinationPath = public_path().'/imagenes/slider/';
                    
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $obj_slider->imagen = 'imagenes/slider/'.$filename;
                }
            }
            
            $obj_slider->save();

            if(!($obj_slider->id > 0)){
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
    $resultado = DB::select('call slider_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Slider::find($id);
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
    $producto = DB::table('slider')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


