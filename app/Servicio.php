<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model { //clase Eloquent
protected $table = 'servicio';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'nombre'
              ,'descripcion'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
