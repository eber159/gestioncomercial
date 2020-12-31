<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model { //clase Eloquent
protected $table = 'empresa';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'idempresa'
              ,'idsede'
              ,'idpersona'
              ,'idtipoempresa'
              ,'idtipodocumento'
              ,'numerodocumento'
              ,'nombre'
              ,'abreviatura'
              ,'indcliente'
              ,'indproveedor'
              ,'indsistema'
              ,'direccion1'
              ,'direccion2'
              ,'telefono1'
              ,'telefono2'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
