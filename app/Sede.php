<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model { //clase Eloquent
protected $table = 'sede';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'nombre'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
