<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordencompradocumento extends Model { //clase Eloquent
protected $table = 'ordencompradocumento';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idordencompra'
              ,'iddocumento'
              ,'idtipodocumento'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
