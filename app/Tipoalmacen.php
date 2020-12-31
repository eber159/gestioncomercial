<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoalmacen extends Model { //clase Eloquent
protected $table = 'tipoalmacen';
protected $fillable = array(
              'id'
              ,'nombre'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
