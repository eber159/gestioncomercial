<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Productowebrecurso;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class ProductowebrecursoController extends BaseController {

Public Function Listar()
{
    $filtro = "";
    $filtro = " AND tbl.activo = 1 ";
    if(Input::get('idproductowebfiltro')!=null){
        $idproductoweb = Input::get('idproductowebfiltro');
        $filtro .= " AND tbl.idproductoweb = ".$idproductoweb;
    }
    if(Input::get('tiporecurso')!=null){
        $tiporecurso = Input::get('tiporecurso');
        $filtro .= " AND tbl.tiporecurso = ".$tiporecurso;
    }
    $resultado = DB::select('call productowebrecurso_listar(?,?)', array('',$filtro));
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
            $obj = new Productoweb;
            $obj->idempresa = Session::get('idempresa');
            $obj->nombre = Input::get('nombre');
            $obj->descripcion = Input::get('descripcion');
            $obj->precio = Input::get('precio');
            $obj->linkfacebook = Input::get('linkfacebook');
            $obj->linkubicacion = Input::get('linkubicacion');
            $obj->idlinea = Input::get('idlinea');
            $obj->idtipo = Input::get('idtipo');
            $obj->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj->created_by = $usuario;
            $obj->updated_by = $usuario;
            
            $filename = "";
            if (Input::hasFile('imagen')) {
                $file = Input::file('imagen');
                $tamaniocadena = strlen(base_path());
                $position = $tamaniocadena - 7;
                $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/productos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                /*
                $file            = Input::file('imagen');
                $destinationPath = public_path().'/imagenes/productos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                */
                $obj->imagen = 'imagenes/productos/'.$filename;
            }


            
            $obj->save();

            if(!($obj->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj = Productoweb::find($id);
            $obj->idempresa = Session::get('idempresa');
            $obj->nombre = Input::get('nombre');
            $obj->descripcion = Input::get('descripcion');
            $obj->precio = Input::get('precio');
            $obj->linkfacebook = Input::get('linkfacebook');
            $obj->linkubicacion = Input::get('linkubicacion');
            $obj->idlinea = Input::get('idlinea');
            $obj->idtipo = Input::get('idtipo');
            $obj->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj->created_by = $usuario;
            $obj->updated_by = $usuario;

            if (Input::hasFile('imagen')) {
	    	    $file = Input::file('imagen');
	    	    $tamaniocadena = strlen(base_path());
		        $position = $tamaniocadena - 7;
		        $base = substr(base_path(),0,$position);
                $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/productos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
	    	    $ruta = $base;
                /*
                $file            = Input::file('imagen');
                $destinationPath = public_path().'/imagenes/productos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
                */
                $obj->imagen = 'imagenes/productos/'.$filename;
            }
            
            $obj->save();

            if(!($obj->id > 0)){
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


public function GuardarImagen(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $error = false;
        
        $ruta = "";
        
        
        $obj = new Productowebrecurso;
        $obj->idempresa = Session::get('idempresa');
        $obj->idproductoweb = Input::get('idproductowebimagen');
        $obj->descripcion = Input::get('descripcionimagen');
        $obj->tiporecurso = 1;
        $obj->activo = 1;
        $usuario = Session::get("nombreusuario");
        $obj->created_by = $usuario;
        $obj->updated_by = $usuario;
        
        $filename = "";
        $filename2 = "";
        if (Input::hasFile('imagenrecurso')) {
            $file = Input::file('imagenrecurso');
            
            $tamaniocadena = strlen(base_path());
            $position = $tamaniocadena - 7;
            $base = substr(base_path(),0,$position);
            $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/productos/';
            
            //$destinationPath = public_path().'/imagenes/productos/';
            $filename        = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            
            $obj->rutarecurso = 'imagenes/productos/'.$filename;
        }
        
        if (Input::hasFile('imagenminiatura1')) {
            $file = Input::file('imagenminiatura1');
            
            $tamaniocadena = strlen(base_path());
            $position = $tamaniocadena - 7;
            $base = substr(base_path(),0,$position);
            $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/productos/';
            
            //$destinationPath = public_path().'/imagenes/productos/';
            $filename2        = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename2);
            
            $obj->imagen = 'imagenes/productos/'.$filename2;
        }

        $obj->save();

        if(!($obj->id > 0)){
            $error = true;
        }
        $mensaje = 'Registro exitoso';


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


public function GuardarVideo(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $error = false;
        
        $ruta = "";
        $obj = new Productowebrecurso;
        $obj->idempresa = Session::get('idempresa');
        $obj->idproductoweb = Input::get('idproductowebvideo');
        $obj->descripcion = Input::get('descripcionvideo');
        $obj->rutarecurso = Input::get('urlvideo');
        $obj->tiporecurso = 2;
        $obj->activo = 1;
        $usuario = Session::get("nombreusuario");
        $obj->created_by = $usuario;
        $obj->updated_by = $usuario;

        $filename2 = "";
        if (Input::hasFile('imagenminiatura2')) {
            
            $tamaniocadena = strlen(base_path());
            $position = $tamaniocadena - 7;
            $base = substr(base_path(),0,$position);
            $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/productos/';
            
            //$destinationPath = public_path().'/imagenes/productos/';
            $filename2        = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename2);
            
            $obj->imagen = 'imagenes/productos/'.$filename2;
        }

        $obj->save();

        if(!($obj->id > 0)){
            $error = true;
        }
        $mensaje = 'Registro exitoso';


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
    $resultado = DB::select('call productowebrecurso_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');

    $obj_item = Productowebrecurso::find($id);
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
    $producto = DB::table('productowebrecurso')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


