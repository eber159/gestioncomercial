<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model { //clase Eloquent
protected $table = 'persona';
protected $fillable = array(
              'id'
              ,'idtipodocumento'
              ,'nrodocumento'
              ,'nombres'
              ,'apellidopaterno'
              ,'apellidomaterno'
              ,'sexo'
              ,'fechanacimiento'
              ,'direccion'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
