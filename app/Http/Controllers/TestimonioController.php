<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Testimonio;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class TestimonioController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    $resultado = DB::select('call testimonio_listar(?,?)', array('',$filtro));
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
            $obj_testimonio = new Testimonio;
            $obj_testimonio->idempresa = 1;
            $obj_testimonio->cliente = Input::get('cliente');
            $obj_testimonio->descripcion = Input::get('editor1');
            $obj_testimonio->link = Input::get('link');
            $obj_testimonio->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_testimonio->created_by = $usuario;
            $obj_testimonio->updated_by = $usuario;
            
            
            if (Input::hasFile('imagen')) {
                $file = Input::file('imagen');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/testimonios/';
                
                //$destinationPath = public_path().'/imagenes/testimonios/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_testimonio->imagen = 'imagenes/testimonios/'.$filename;
                
            }
            
            $obj_testimonio->save();

            if(!($obj_testimonio->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_testimonio = Testimonio::find($id);
            $obj_testimonio->cliente = Input::get('cliente');
            $obj_testimonio->descripcion = Input::get('editor1');
            $obj_testimonio->link = Input::get('link');
            $obj_testimonio->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_testimonio->created_by = $usuario;
            $obj_testimonio->updated_by = $usuario;

            if((Input::hasFile('imagen'))!=null){
                if (Input::hasFile('imagen')) {
                    $file = Input::file('imagen');
                    
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/testimonios/';
                    
                    //$destinationPath = public_path().'/imagenes/testimonios/';
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $obj_testimonio->imagen = 'imagenes/testimonios/'.$filename;
                }
            }
            
            $obj_testimonio->save();

            if(!($obj_testimonio->id > 0)){
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

Public function Error(){
    try {
        throw new Exception("No hay Stock Suficiente", 1);
    } catch (Exception $e) {
        throw $e;
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call testimonio_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Testimonio::find($id);
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
    $producto = DB::table('testimonio')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


