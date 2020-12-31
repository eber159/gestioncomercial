<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcuenta extends Model { //clase Eloquent
protected $table = 'subcuenta';
protected $fillable = array(
              'id'
              ,'idempr'
              ,'idsede'
              ,'idcuenta'
              ,'fecha'
              ,'descripcion'
              ,'limitecredito'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
