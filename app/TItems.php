<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TItems extends Model { //clase Eloquent
protected $table = 'titems';
protected $fillable = array(
              'id'
              ,'nombre'
              ,'abreviatura'
              ,'descripcion'
              ,'codigo_catalogo'
              ,'tipo'
              ,'stock'
              ,'estado'
              ,'id_medida'
              ,'created_at'
              ,'updated_at'
          );
}
?>
