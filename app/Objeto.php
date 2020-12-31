<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Objeto extends Model { //clase Eloquent
protected $table = 'objeto';
protected $fillable = array(
              'id'
              ,'nombre'
              ,'titulo'
              ,'idobjetopadre'
              ,'nivel'
              ,'idtipoobjeto'
              ,'nroorden'
              ,'propiedad'
              ,'icono'
              ,'parametros'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
