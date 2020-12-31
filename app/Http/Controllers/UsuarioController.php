<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Usuario;
use App\Persona;
use App\Empresa;
use App\Perfilusuario;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Config;
use Session;
use Exception;

use PHPMailer\PHPMailer\PHPMailer;

class UsuarioController extends BaseController {

Public Function Listar()
{
    $resultado = DB::select('call usuario_listar(?,?)', array('',' AND tbl.activo = 1'));
    return Response::json(array('lista'=>$resultado));
}

Public Function Logear()
{
    $idusuario = "";
    $indcorreoverificado = 0;
    $usuario = Input::get('usuario');
    $clave = Input::get('clave');
    $resultado = DB::select("call usuario_listar(?,?)", array(''," AND tbl.activo = 1 AND tbl.nombre = '".$usuario."' AND tbl.clave = '".$clave."'"));

    if($resultado){
        if($resultado[0]->id > 0){
            $idusuario = $resultado[0]->id;
            $indcorreoverificado = $resultado[0]->indcorreoverificado;
        }
    }else{
        $resultado = null;
    }

    $filtro = "";
    $filtrotabla = " AND tbl.idusuario = '".$idusuario."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $perfiles = DB::select('call perfilusuario_listar(?,?)', array('',$filtro));

    return Response::json(array('obj' =>$resultado,'perfiles'=>$perfiles, 'usuario'=>$resultado[0]));

}


public function Guardar(){
    DB::beginTransaction();
    $mensaje='';
    $id = Input::get('id');
    if($id === ''){
        $obj_usuario = new Usuario;
        $idempresa = 1;
        $nombre = Input::get('nombre');
        $clave = Input::get('clave');
        $idtrabajador = Input::get('idtrabajador');
        $trabajador = Input::get('trabajador');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call usuario_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$nombre,$clave,$idtrabajador,$trabajador,$activo,$usuario,'INS'));
        $mensaje = 'Registro exitoso';
    }
    else{
        $Usuario = Usuario::find($id);
        $idempresa = 1;
        $nombre = Input::get('nombre');
        $clave = Input::get('clave');
        $idtrabajador = Input::get('idtrabajador');
        $trabajador = Input::get('trabajador');
        $activo = 1;
        $usuario = 'Admin';
        $resultado = DB::select('call usuario_iud(?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$nombre,$clave,$idtrabajador,$trabajador,$activo,$usuario,'UPD'));
        $mensaje = 'Registro Actualizado';
    }

    if($resultado > 0){
        DB::commit();
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  $mensaje
        ));
    }else{
        DB::rollBack();
    }
}

Public Function Leer(){
    $id = Input::get('id');
    $resultado = DB::select('call usuario_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));

    $filtro = "";
    $filtrotabla = " AND tbl.idusuario = '".$id."'";
    $filtro .= $filtrotabla." AND tbl.activo = 1 ";
    $perfiles = DB::select('call perfilusuario_listar(?,?)', array('',$filtro));

    return Response::json(array('obj' =>$resultado,'perfiles'=>$perfiles));

}

Public Function Acceder(){
    $idusuario = Input::get('idusuario');
    $idperfil = Input::get('idperfil');
    $idempresa = Input::get('idempresa');
    $idsede = Input::get('idsede');
    $idtrabajador = Input::get('idtrabajador');

    $resultadocliente = array();

    $objUsuario = Usuario::find($idusuario);

    $resultadousuario = DB::select('call usuario_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idusuario));
    $resultadoperfil = DB::select('call perfil_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idperfil));
    $resultadoempresa = DB::select('call empresa_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idempresa));
    $resultadosede = DB::select('call sede_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idsede));
    $resultadotrabajador = DB::select('call trabajador_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idtrabajador));
    if($objUsuario){
        if($objUsuario->idcliente!=""){
            $resultadocliente = DB::select('call empresa_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$objUsuario->idcliente)); 
        }
    }
    
    $opciones = DB::select("select o.* from perfilobjeto po left join perfil p on p.id = po.idperfil 
    left join objeto o on o.id = po.idobjeto 
    where o.activo = 1 and o.activo = 1 and p.id = '".$idperfil."' order by nroorden");


    if($resultadousuario){
        Session::put('idusuario', $resultadousuario[0]->id);
        Session::put('nombreusuario', $resultadousuario[0]->nombre);
        Session::put('idperfil', $resultadoperfil[0]->id);
        Session::put('nombreperfil', $resultadoperfil[0]->nombre);
        Session::put('idempresa', $resultadoempresa[0]->id);
        Session::put('empresa', $resultadoempresa[0]->nombre);
        Session::put('idsede', $resultadosede[0]->id);
        Session::put('sede', $resultadosede[0]->nombre);
        if(count($resultadotrabajador)>0){
            Session::put('idtrabajador', $resultadotrabajador[0]->id);
            Session::put('nombretrabajador', $resultadotrabajador[0]->nombre);
        }
        if(count($resultadocliente)>0){
            Session::put('idtrabajador', $resultadocliente[0]->id);
            Session::put('nombretrabajador', $resultadocliente[0]->nombre);
        }
        
        Session::put('opcionesperfil', $opciones);
    }

    return Response::json(array('usuario' =>$resultadousuario,'perfil'=>$resultadoperfil));

}

    
public function RefrescarOpciones(){
    $idperfil = Session::get('idperfil');
    $opciones = DB::select("select o.* from perfilobjeto po left join perfil p on p.id = po.idperfil 
    left join objeto o on o.id = po.idobjeto 
    where o.activo = 1 and o.activo = 1 and p.id = '".$idperfil."' order by nroorden");
    Session::put('opcionesperfil', $opciones);
    return Response::json(array('opciones' =>$opciones));
}


Public Function AccederCliente(){
    $idusuario = Input::get('idusuario');
    $idperfil = Input::get('idperfil');
    $idempresa = Input::get('idempresa');
    $idsede = Input::get('idsede');

    $objUsuario = Usuario::find($idusuario);

    $resultadousuario = DB::select('call usuario_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idusuario));
    $resultadoperfil = DB::select('call perfil_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idperfil));
    $resultadoempresa = DB::select('call empresa_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idempresa));
    $resultadosede = DB::select('call sede_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$idsede));
    $resultadocliente = DB::select('call empresa_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$objUsuario->idcliente));
    $opciones = DB::select("select o.* from perfilobjeto po left join perfil p on p.id = po.idperfil 
    left join objeto o on o.id = po.idobjeto 
    where o.activo = 1 and o.activo = 1 and p.id = '".$idperfil."' order by nroorden");


    if($resultadousuario){
        Session::put('idusuario', $resultadousuario[0]->id);
        Session::put('nombreusuario', $resultadousuario[0]->nombre);
        Session::put('idperfil', $resultadoperfil[0]->id);
        Session::put('nombreperfil', $resultadoperfil[0]->nombre);
        Session::put('idempresa', $resultadoempresa[0]->id);
        Session::put('empresa', $resultadoempresa[0]->nombre);
        Session::put('idsede', $resultadosede[0]->id);
        Session::put('sede', $resultadosede[0]->nombre);
        Session::put('idtrabajador', $resultadocliente[0]->id);
        Session::put('nombretrabajador', $resultadocliente[0]->nombre);
        Session::put('opcionesperfil', $opciones);
    }

    return Response::json(array('usuario' =>$resultadousuario,'perfil'=>$resultadoperfil));

}

public function Eliminar(){
    $id = Input::get('id');
    $usuario = 'Admin';
    $resultado = DB::select('call usuario_iud(?,?,?,?,?,?,?,?,?)', array($id,'','','','','','',$usuario,'DEL'));
    if($resultado){
        return Response::json(array(
            'success'       =>  true,
            'message'       =>  'Registro Eliminado'
        ));
    }
}

public function RegistroWeb(){
    try {
        DB::beginTransaction();
        $mensaje='';
        $error = false;
        $codigoempresa = DB::select('call retornarcodigo(?,?,?)', array(0,0,'EMPRESA'));
        //Validaciones
        //Saber si el usuario está siendo usado
        $usuario = DB::table('usuario')->where([
                                                ['nombre', '=', Input::get("usuario")],
                                                ['activo', '=', '1'],
                                        ])->first();
        if($usuario){
            throw new Exception("El usuario ya esta en uso, Ingrese otro");
        }


        //Registrar Persona
        $objPersona = new Persona;
        $objPersona->idtipodocumento = 1;
        $objPersona->nrodocumento = Input::get('ruc');
        $objPersona->nombres = Input::get('nombres');
        $objPersona->apellidopaterno = Input::get('apellidopaterno');
        $objPersona->apellidomaterno = Input::get('apellidomaterno');
        $objPersona->sexo = '';
        $objPersona->fechanacimiento = Input::get('fechanacimiento');
        $objPersona->direccion = Input::get('direccion');
        $objPersona->activo = 1;
        $objPersona->created_by = 'UsuarioWEB';
        $objPersona->updated_by = 'UsuarioWEB';
        $objPersona->save();
        if(!($objPersona->id > 0)){
            throw new Exception("Ocurrió un error al registrar PERSONA", 1);
            $error = true;
        }


        $objEmpresa = new Empresa;
        $objEmpresa->codigo = $codigoempresa[0]->rpta;
        $objEmpresa->idempresa = 1;
        $objEmpresa->idsede = 1;
        $objEmpresa->idpersona = $objPersona->id;
        $objEmpresa->idtipoempresa = 0;
        //$objEmpresa->idtipodocumento = Input::get('idtipodocumento');
        //$objEmpresa->numerodocumento = Input::get('ruc');
        $objEmpresa->idtipodocumento = 1;
        $objEmpresa->numerodocumento = '00000000';
        $objEmpresa->nombre = Input::get('apellidopaterno')." ".Input::get('apellidomaterno')." ".Input::get('nombres');
        $objEmpresa->abreviatura = "";
        $objEmpresa->indcliente = 1;
        $objEmpresa->indproveedor = 0;
        $objEmpresa->indsistema = 0;
        $objEmpresa->direccion1 = Input::get('direccion');
        $objEmpresa->direccion2 = "";
        $objEmpresa->telefono1 = Input::get('telefonomovil');
        $objEmpresa->telefono2 = Input::get('telefonofijo');
        $objEmpresa->fechanac = Input::get('fechanacimiento');
        $objEmpresa->correo = Input::get('usuario');
        $objEmpresa->fecharegistro = date('Y-m-d');
        $objEmpresa->activo = 1;   
        $objEmpresa->created_by = 'UsuarioWEB';
        $objEmpresa->updated_by = 'UsuarioWEB';
        $objEmpresa->save();
        if(!($objEmpresa->id > 0)){
            throw new Exception("Ocurrió un error al registrar EMPRESA", 1);
            $error = true;
        }

        //Registrar al Usuario
        $objUsuario = new Usuario;
        $objUsuario->idempresa = 1;
        $objUsuario->nombre = Input::get("usuario");
        $objUsuario->clave = Input::get("clave");
        $objUsuario->idtrabajador = "";
        $objUsuario->trabajador = "";
        $objUsuario->idcliente = $objEmpresa->id;
        $objUsuario->indcorreoverificado = 1;
        $objUsuario->tipousuario = 2;
        $objUsuario->created_by = 'UsuarioWEB';
        $objUsuario->updated_by = 'UsuarioWEB';
        $objUsuario->activo = 1;
        $objUsuario->save();
        if(!($objUsuario->id > 0)){
            throw new Exception("Ocurrió un error al registrar USUARIO", 1);
            $error = true;
        }
        
        //Registrar Usuario-Perfil
        $objPerfilusuario = new Perfilusuario;
        $objPerfilusuario->idempresa = 1;
        $objPerfilusuario->idsede = 1;
        $objPerfilusuario->idperfil = 2;
        $objPerfilusuario->idusuario = $objUsuario->id;
        $objPerfilusuario->idtrabajador = "";
        $objPerfilusuario->activo = 1;
        $objPerfilusuario->created_by = 'UsuarioWEB';
        $objPerfilusuario->updated_by = 'UsuarioWEB';
        $objPerfilusuario->save();
        if(!($objPerfilusuario->id > 0)){
            throw new Exception("Ocurrió un error al registrar PERFILUSUARIO", 1);
            $error = true;
        }

        self::EnviarCorreo(Input::get("usuario"),"Alta de Usuario");

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje
            ));
        }else{
            throw new Exception("Ocurrió un error al registrar la operación", 1);
        }
    } catch (Exception $e) {
        DB::rollBack();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage()
        ));
    }
}


public function CambiarEstado(){
    
    try {
        $error = false;
        DB::beginTransaction();
        $mensaje='';
        $usuario = Session::get('nombreusuario');

        $id = Input::get('id');
        $objUsuario = new Usuario;
        $objUsuario = Usuario::find($id);
        $objUsuario->indcorreoverificado = Input::get('estado');
        $objUsuario->updated_by = $usuario;
        $objUsuario->save();
        if(!($objUsuario->id > 0)){
            throw new Exception("Ocurrió un error en la operación", 1);
            $error = true;
        }

        $empresa = Empresa::where("id","=",$objUsuario->idcliente)->where("activo","=",1)->first();
        if(Input::get('estado')==1){
            self::EnviarCorreo($empresa->correo,"Cuenta Activada");
        }
        

        if($error == false){
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  $mensaje,
                'resultado'     => $objUsuario->id,
                'resultadocodigo' => $objUsuario->id
            ));
        }else{
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  "Ocurrió un error en el registro",
                'resultado'     => 0
            ));
            DB::rollback();
        }
    } catch (Exception $e) {
        DB::rollback();
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage(),
            'rollBack'      => "roll"
        ));   
    }
}

Public Function Logout(){
    //Auth::logout();
    Session::flush();
    return Response::json(array('rpta' =>'ok'));
}

public Function EnviarCorreo($correo,$evento){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = Config::get('constants.correoweb.servidor');  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = Config::get('constants.correoweb.correo');                     // SMTP username
    $mail->Password   = Config::get('constants.correoweb.password');                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom(Config::get('constants.correoweb.correo'), Config::get('constants.sistema.nombrecorto'));
    $mail->addAddress($correo);     // Add a recipient
    //$mail->addAddress('grettalisboa@lamaquinabtl.com', 'Gretta');               // Name is optional
    //$mail->addAddress('lizzlisboa@lamaquinabtl.com', 'Lizzet');
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('grettalisboa@lamaquinabtl.com');
    //$mail->addCC('lizzlisboa@lamaquinabtl.com');
    //$mail->addBCC('bcc@example.com');

    // Archivos Adjuntos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment($destinationPath.$codigo.".pdf", "e-ticket-".$codigo.'.pdf');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Confirmando el alta de su Cuenta';
    $mail->Body    = 'Estimado Usuario, le damos la bienvenida al sistema , la plataforma desde donde podr&aacute; acceder a nuestro stock en l&iacute;nea y generar &oacute;rdenes, como tambi&eacute;n pedidos .  
                      <br/>Esperamos atenderlo de la mejor manera y hacer m&aacute;s simple su proceso de compra .
                      <br/>Se ha confirmado la activaci&oacute;n de su cuenta.
                      <br/>Si no puede utilizar sus credenciales no dude en comunicarse con nosotros a través del correo: '.Config::get('constants.correoweb.correo');
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

}


public Function EnviarCorreoPassword(){
    try {

        $correo = Input::get("idusuario");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = Config::get('constants.correoweb.servidor');  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = Config::get('constants.correoweb.correo');                     // SMTP username
        $mail->Password   = Config::get('constants.correoweb.password');                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom(Config::get('constants.correoweb.correo'), Config::get('constants.sistema.nombrecorto'));
        $mail->addAddress($correo);

        $usuario = Usuario::where("nombre","=",$correo)->where("activo","=",1)->first();
        if($usuario){
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Recuperación de Clave de acceso.';
            $mail->Body    = 'Sus datos de acceso son los siguientes:
                              <br/><b><b>Usuario</b>: '.$correo.'
                              <br/><b>Contraseña</b>: '.$usuario->clave.'
                              <br/><br/>Ingrese <a href=\' '.Config::get('constants.rutapublica.url').' \'> '.Config::get('constants.sistema.nombrecorto').' </a> para más información.';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  "Mensaje Enviado Correctamente. Verifique su bandeja de mensajes."
            ));

        }else{
            throw new Exception("El usuario no existe", 1);
        }

        
    } catch (Exception $e) {
        return Response::json(array(
            'success'       =>  false,
            'message'       =>  $e->getMessage()
        ));
    }


    

}

}


