<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasealmacen extends Model { //clase Eloquent
protected $table = 'clasealmacen';
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
