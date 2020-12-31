<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Informaciongeneral;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use Config;

class InformaciongeneralController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call informaciongeneral_listar(?,?)', array('',' AND tbl.activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

public function Guardar(){
    try {
        
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $error = false;

        $obj_informaciongeneral = new Informaciongeneral;
        if($id === ''){
            $obj_informaciongeneral = new Informaciongeneral;
        }else{
            $obj_informaciongeneral = Informaciongeneral::find($id);
        }

        $obj_informaciongeneral->empresa = Input::get('empresa');
        $obj_informaciongeneral->direccion = Input::get('direccion');
        $obj_informaciongeneral->telefono1 = Input::get('telefono1');
        $obj_informaciongeneral->telefono2 = Input::get('telefono2');
        $obj_informaciongeneral->correo = Input::get('correo');
        $obj_informaciongeneral->nosotros = Input::get('nosotros');
        $obj_informaciongeneral->nosotrosresumen = Input::get('nosotrosresumen');
        $obj_informaciongeneral->linkfacebook = Input::get('linkfacebook');
        $obj_informaciongeneral->linktwitter = Input::get('linktwitter');
        $obj_informaciongeneral->linkinstagram = Input::get('linkinstagram');
        $obj_informaciongeneral->linklikedin = Input::get('linklikedin');
        $obj_informaciongeneral->linkwhatsapp = Input::get('linkwhatsapp');
        $obj_informaciongeneral->footer = Input::get('editor1');
        $obj_informaciongeneral->formapago = Input::get('formapago');
        $obj_informaciongeneral->orden_publicaciones = Input::get('orden_publicaciones');
        $obj_informaciongeneral->ind_carro = Input::get('ind_carro');
        $obj_informaciongeneral->ind_testimonios = Input::get('ind_testimonios');
        $obj_informaciongeneral->datosimpresion = Input::get('datosimpresion');

        $obj_informaciongeneral->activo = 1;
        $usuario = "Administrador";
        $obj_informaciongeneral->created_by = $usuario;
        $obj_informaciongeneral->updated_by = $usuario;
        

        $destinationPath = public_path().'/imagenes/slide/';
        $filename = "";
        if (Input::hasFile('imagen')) {
		    $file = Input::file('imagen');
	    	$tamaniocadena = strlen(base_path());
		    $position = $tamaniocadena - 7;
            $base = substr(base_path(),0,$position);
	        $destinationPath = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/';
	        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
	        $uploadSuccess   = $file->move($destinationPath, $filename);
	        /*
            $file            = Input::file('imagen');
            $filename        = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
	        */
            $obj_informaciongeneral->logo = 'imagenes/'.$filename;
	    
        }

        $filename2 = "";
        if (Input::hasFile('slide1')) {
            $file = Input::file('slide1');
	    	$tamaniocadena = strlen(base_path());
		    $position = $tamaniocadena - 7;
		    $base = substr(base_path(),0,$position);
	        $destinationPath2 = $base.'/'.Config::get('constants.rutapublica.nombrecarpeta').'/imagenes/';
	        $filename2        = str_random(6) . '_' . $file->getClientOriginalName();
	        $uploadSuccess   = $file->move($destinationPath2, $filename2);
	        /*
            $file            = Input::file('imagen');
            $filename        = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
	        */
	       $obj_informaciongeneral->slide1 = 'imagenes/'.$filename2;
        }
        
        $obj_informaciongeneral->save();

        if(!($obj_informaciongeneral->id > 0)){
            throw new Exception("Ocurrio un error al registrar la operacion", 1);
        }else{
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje
            ));
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
    $resultado = Informaciongeneral::find($id);
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    
    DB::beginTransaction();
    try {
        $id = Input::get('id');
        $usuario = 'Admin';
        $obj = Informaciongeneral::find($id);
        $obj->activo = 0;
        $obj->save();

        DB::commit();
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));

    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
        ));
    }

}

}


