<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model { //clase Eloquent
protected $table = 'mensaje';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'nombres'
              ,'numero'
              ,'correo'
              ,'asunto'
              ,'mensaje'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
