<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model { //clase Eloquent
protected $table = 'testimonio';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'cliente'
              ,'descripcion'
              ,'imagen'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
