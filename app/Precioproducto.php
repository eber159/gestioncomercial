<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Precioproducto extends Model { //clase Eloquent
protected $table = 'precioproducto';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idproducto'
              ,'preciomenor'
              ,'preciomayor'
              ,'preciodistrib'
              ,'preciocaja'
              ,'preciofactura'
              ,'preciooferta'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
