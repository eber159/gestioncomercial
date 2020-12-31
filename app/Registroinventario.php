<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Registroinventario extends Model { //clase Eloquent
protected $table = 'registroinventario';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'iddetalleingresosalida'
              ,'idalmacen'
              ,'idlote'
              ,'idmaterial'
              ,'idmovimientoinventario'
              ,'idordeningresosalida'
              ,'fechamovimiento'
              ,'cantidad'
              ,'costo'
              ,'glosa'
              ,'inddevolucion'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
