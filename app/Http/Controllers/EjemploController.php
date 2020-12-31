<?php

class EjemploController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	
	
	Public Function Listar(){
		$resultado = DB::select('SELECT e.id, e.titulo, e.desc FROM ejemplo e WHERE e.vigencia = ?', array('1'));
		return Response::json(array('Ejemplos' =>$resultado));
	}
	
	Public Function Guardar(){
		$mensaje = "";
		$id = Input::get('txtId');
		
		if($id === ""){
			 //Alumno
			$Ejemplo = new Ejemplo;
			$Ejemplo->titulo = Input::get('txtNombre');
			//$fecha = date("Y-m-d", strtotime(Input::get('txtFecha')));
			//$Ejemplo->fecha = $fecha;
			$Ejemplo->anio_periodo = Input::get('txtAnioPeriodo');
			$Ejemplo->nro_periodo = Input::get('txtNroPeriodo');
			$Ejemplo->idescuela = Input::get('cboEscuela');
			$Ejemplo->save();
			$mensaje = "Registro exitoso";
		}
		else{
			 //Alumno
			$Ejemplo = Ejemplo::find($id);
			$Ejemplo->nombre = Input::get('txtNombre');
			$fecha = date("Y-m-d", strtotime(Input::get('txtFecha')));
			$Ejemplo->fecha = $fecha;
			$Ejemplo->anio_periodo = Input::get('txtAnioPeriodo');
			$Ejemplo->nro_periodo = Input::get('txtNroPeriodo');
			$Ejemplo->idescuela = Input::get('cboEscuela');
			//$Ejemplo->updated_at = date();
			$Ejemplo->save();
			$mensaje = "Registro Actualizado";
		}
		
		
		if($Ejemplo){
			return Response::json(array(
			'success' 		=> 	true,
			'message' 		=> 	$mensaje
			));
		}

	}
	
	Public Function Leer(){
		$id = Input::get('id');
		$resultado = DB::select('SELECT * FROM Ejemplo WHERE id = ? AND vigencia = ?', array($id,'1'));
		return Response::json(array('Ejemplo' =>$resultado));
	}
	
	Public Function Eliminar(){
		$id = Input::get('id');
		$mensaje = "";
		$resultado = DB::update('UPDATE Ejemplo SET vigencia = ? WHERE id = ? ', array(0, $id));
		if($resultado){
			return Response::json(array(
			'success' 		=> 	true,
			'message' 		=> 	"Eliminado"
			));
		}
	}
	
}	
