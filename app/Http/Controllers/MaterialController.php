<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Material;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Session;
use Exception;
use View;
use App\Productoweb;
use Config;

class MaterialController extends BaseController {

Public Function Listar()
{
    $filtro = " AND tbl.activo = 1 ";
    if(Input::get('indstock')!=null && Input::get('indstock')!=""){
        $indstock = Input::get('indstock');
        $filtro .= " AND tbl.indstock = ".$indstock;
    }

    $resultado = DB::select('call material_listar(?,?)', array('',$filtro));
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
    if($tipo=="codbarras"){
        $filtro .= " AND LTRIM(tbl.codigobarras) = '".$fil."'";
    }
    if($tipo=="nombre"){
        $filtro .= " AND LTRIM(concat(tbl.nombre,tbl.codigo)) like '%".$fil."%' ";
    }

    $resultado = DB::select('call material_listar(?,?)', array('',$filtro));
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
            $obj_material = new Material;
            $obj_material->idempresa = Session::get('idempresa');
            $obj_material->idsede = Session::get('idsede');
            $obj_material->idsubfamilia = Input::get('cmbsubfamilia');
            $obj_material->idunidadmedida = Input::get('cmbunidadmedida');
            $obj_material->codigo = Input::get('codigo');
            $obj_material->codigobarras = Input::get('codigobarras');
            $obj_material->precioventa = Input::get('precioventa');
            $obj_material->nombre = Input::get('nombre');
            $obj_material->descripcionguia = Input::get('descripcionguia');
            $obj_material->peso = Input::get('peso');
            $obj_material->marca = Input::get('marca');
            $obj_material->modelo = Input::get('modelo');
            $obj_material->tamanio = Input::get('tamanio');
            $obj_material->color = Input::get('color');
            $obj_material->idlinea = Input::get('idlinea');
            $obj_material->indpublicado = Input::get('indpublicado');
            $obj_material->idproductoasociado = Input::get('idproductoasociado');
            $obj_material->indstock = Input::get('indstock');
            $obj_material->indlotizable = Input::get('indlotizable');
            $obj_material->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_material->created_by = $usuario;
            $obj_material->updated_by = $usuario;
            
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
                $obj_material->imagen = 'imagenes/productos/'.$filename;
            }
            
            $obj_material->save();

            if($obj_material->indpublicado == 1){
                $obj_Productoweb = new Productoweb;
                $obj_Productoweb->idempresa = Session::get('idempresa');
                $obj_Productoweb->nombre = Input::get('nombre');
                $obj_Productoweb->descripcion = "";
                $obj_Productoweb->precio = 0;
                $obj_Productoweb->linkfacebook = "";
                $obj_Productoweb->linkubicacion = "";
                $obj_Productoweb->idlinea = 0;
                $obj_Productoweb->idtipo = 1;
                $obj_Productoweb->idproductoasociado = $obj_material->id;
                $obj_Productoweb->activo = 1;
                $usuario = Session::get("nombreusuario");
                $obj_Productoweb->created_by = $usuario;
                $obj_Productoweb->updated_by = $usuario;
                $obj_Productoweb->save();
            }


            

            if(!($obj_material->id > 0)){
                $error = true;
            }
            $mensaje = 'Registro exitoso';
        }
        else{
            $obj_material = Material::find($id);
            $obj_material->idempresa = Session::get('idempresa');
            $obj_material->idsede = Session::get('idsede');
            $obj_material->idsubfamilia = Input::get('cmbsubfamilia');
            $obj_material->idunidadmedida = Input::get('cmbunidadmedida');
            $obj_material->codigo = Input::get('codigo');
            $obj_material->codigobarras = Input::get('codigobarras');
            $obj_material->precioventa = Input::get('precioventa');
            $obj_material->nombre = Input::get('nombre');
            $obj_material->descripcionguia = Input::get('descripcionguia');
            $obj_material->peso = Input::get('peso');
            $obj_material->marca = Input::get('marca');
            $obj_material->modelo = Input::get('modelo');
            $obj_material->tamanio = Input::get('tamanio');
            $obj_material->color = Input::get('color');
            $obj_material->idlinea = Input::get('idlinea');
            $obj_material->indpublicado = Input::get('indpublicado');
            $obj_material->idproductoasociado = Input::get('idproductoasociado');
            $obj_material->indstock = Input::get('indstock');
            $obj_material->indlotizable = Input::get('indlotizable');
            $obj_material->activo = 1;
            $usuario = Session::get("nombreusuario");
            $obj_material->created_by = $usuario;
            $obj_material->updated_by = $usuario;

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
                $obj_material->imagen = 'imagenes/productos/'.$filename;
            }
            
            $obj_material->save();


            if($obj_material->indpublicado == 1){
                
                $producto = DB::table('productoweb')->where('activo', 1)->where('idproductoasociado',$obj_material->id)->first();
                if(!($producto)){
                    $obj_Productoweb = new Productoweb;
                    $obj_Productoweb->idempresa = Session::get('idempresa');
                    $obj_Productoweb->nombre = Input::get('nombre');
                    $obj_Productoweb->descripcion = "";
                    $obj_Productoweb->precio = 0;
                    $obj_Productoweb->linkfacebook = "";
                    $obj_Productoweb->linkubicacion = "";
                    $obj_Productoweb->idlinea = 0;
                    $obj_Productoweb->idtipo = 1;
                    $obj_Productoweb->idproductoasociado = $obj_material->id;
                    $obj_Productoweb->activo = 1;
                    $usuario = Session::get("nombreusuario");
                    $obj_Productoweb->created_by = $usuario;
                    $obj_Productoweb->updated_by = $usuario;
                    $obj_Productoweb->save();
                }
                
            }


            if(!($obj_material->id > 0)){
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
    $resultado = DB::select('call material_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
    return Response::json(array('obj' =>$resultado));
}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call material_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success' 		=> 	true,
            'message' 		=> 	'Registro Eliminado'
        ));
    }
}


public function verProducto($id){
    $producto = DB::table('material')->where('activo', 1)->where('id','=',$id)->first();
    return View::make('extranet.producto', array('producto' => $producto));
}


}


