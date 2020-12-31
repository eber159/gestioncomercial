<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model { //clase Eloquent
protected $table = 'slider';
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
