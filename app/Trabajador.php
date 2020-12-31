<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model { //clase Eloquent
protected $table = 'trabajador';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idpersona'
              ,'idcargotrabajador'
              ,'fechaingreso'
              ,'fechatermino'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
