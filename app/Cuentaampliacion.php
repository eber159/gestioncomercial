<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentaampliacion extends Model { //clase Eloquent
protected $table = 'cuentaampliacion';
protected $fillable = array(
              'id'
              ,'idempr'
              ,'idsede'
              ,'idcuenta'
              ,'monto'
              ,'fecha'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
