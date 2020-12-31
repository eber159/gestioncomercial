<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Linea;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class LineaController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call linea_listar(?,?)', array('',' AND tbl.activo = 1'));
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
    $resultado = DB::select('call linea_listar(?,?)', array('',$filtro));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $error = false;
	
	$ruta = "";
	
        if($id === ''){
            $obj_linea = new Linea;
            $obj_linea->nombre = Input::get('nombre');
            $obj_linea->descripcion = Input::get('descripcion');
            $obj_linea->orden = Input::get('orden');
            $obj_linea->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_linea->created_by = $usuario;
            $obj_linea->updated_by = $usuario;
            
            $filename = "";
            $filename2 = "";
            if (Input::hasFile('imagen')) {
                $file = Input::file('imagen');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/lineas/';
                
                //$destinationPath = public_path().'/imagenes/lineas/';
                
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $obj_linea->imagen = 'imagenes/lineas/'.$filename;
                
            }
            if (Input::hasFile('imagenslider')) {
                $file = Input::file('imagenslider');
                
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
                $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/lineas/';
                
                
                //$destinationPath = public_path().'/imagenes/lineas/';
                
                $filename2        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename2);
                $obj_linea->slider = 'imagenes/lineas/'.$filename2;
            }
            
            
            $obj_linea->save();

            if(!($obj_linea->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_linea = Linea::find($id);
            $obj_linea->nombre = Input::get('nombre');
            $obj_linea->descripcion = Input::get('descripcion');
            $obj_linea->orden = Input::get('orden');
            $obj_linea->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_linea->created_by = $usuario;
            $obj_linea->updated_by = $usuario;

            if((Input::hasFile('imagen'))!=null){
                if (Input::hasFile('imagen')) {
                    $file = Input::file('imagen');
                    
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/lineas/';
                    
                    //$destinationPath = public_path().'/imagenes/lineas/';
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    
                    $obj_linea->imagen = 'imagenes/lineas/'.$filename;
                }
            }

            if((Input::hasFile('imagenslider'))!=null){
                if (Input::hasFile('imagenslider')) {
                    $file = Input::file('imagenslider');
                    
                    $tamaniocadena = strlen(base_path());
                    $position = $tamaniocadena - 7;
                    $base = substr(base_path(),0,$position);
                    $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/lineas/';
                    
                    //$destinationPath = public_path().'/imagenes/lineas/';
                    $filename2       = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename2);
                    $obj_linea->slider = 'imagenes/lineas/'.$filename2;
                }    
            }
            
            
            
            $obj_linea->save();

            if(!($obj_linea->id > 0)){
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
    $resultado = DB::select('call linea_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Linea::find($id);
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
    $producto = DB::table('linea')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


