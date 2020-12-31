<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenventaordensalida extends Model { //clase Eloquent
protected $table = 'ordenventaordensalida';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idordenventa'
              ,'idordensalida'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
