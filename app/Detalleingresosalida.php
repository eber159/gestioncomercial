<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleingresosalida extends Model { //clase Eloquent
protected $table = 'detalleingresosalida';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idordeningresosalida'
              ,'idmaterial'
              ,'idlote'
              ,'cantidad'
              ,'costoorigen'
              ,'costo'
              ,'idalmacen'
              ,'idunidadmedida'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
