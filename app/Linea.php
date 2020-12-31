<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model { //clase Eloquent
protected $table = 'linea';
protected $fillable = array(
              'id'
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
