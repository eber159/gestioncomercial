<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Nosotros extends Model { //clase Eloquent
protected $table = 'nosotros';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'titulo'
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
