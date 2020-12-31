<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model { //clase Eloquent
protected $table = 'lote';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'idempresa'
              ,'idsede'
              ,'idtipo'
              ,'idordeningresosalida'
              ,'idordenrecepcion'
              ,'idproduccion'
              ,'fecharegistro'
              ,'fechavencimiento'
              ,'nrolote'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
