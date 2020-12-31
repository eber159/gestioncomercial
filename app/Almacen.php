<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model { //clase Eloquent
protected $table = 'almacen';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'idempresa'
              ,'idsede'
              ,'nombre'
              ,'abreviatura'
              ,'idclase'
              ,'idtipo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
