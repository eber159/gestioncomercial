<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallematerial extends Model { //clase Eloquent
protected $table = 'detallematerial';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idtabla'
              ,'idproducto'
              ,'nombreproducto'
              ,'descripcion'
              ,'idalmacen'
              ,'cantidad'
              ,'cantidadpendiente'
              ,'precio_unit_sigv'
              ,'precio_unit_igv'
              ,'valor_vta_sigv'
              ,'valor_vta_igv'
              ,'dscto'
              ,'indigv'
              ,'idunidadmedida'
              ,'unidadmedida'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
