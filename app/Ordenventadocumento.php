<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenventadocumento extends Model { //clase Eloquent
protected $table = 'ordenventadocumento';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idordenventa'
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
