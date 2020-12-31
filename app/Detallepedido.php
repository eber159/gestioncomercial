<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallepedido extends Model { //clase Eloquent
protected $table = 'detallepedido';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idpedido'
              ,'idproducto'
              ,'nombreproducto'
              ,'precio'
              ,'valor_vta'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
