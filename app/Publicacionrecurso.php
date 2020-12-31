<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacionrecurso extends Model { //clase Eloquent
protected $table = 'publicacionrecurso';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idpublicacion'
              ,'descripcion'
              ,'rutarecurso'
              ,'tiporecurso'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'
          );
}
?>
