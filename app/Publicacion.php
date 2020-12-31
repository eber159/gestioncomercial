<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model { //clase Eloquent
protected $table = 'publicacion';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'titulo'
              ,'descripcion'
              ,'imagen'
              ,'urlvideo'
              ,'indlink'
              ,'urlmapa'
              ,'urlexterno'
              ,'indtexto'
              ,'indtextocompleto'
              ,'orden'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
