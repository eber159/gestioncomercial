<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model { //clase Eloquent
protected $table = 'categoria';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'idempresa'
              ,'idsede'
              ,'idcategoriasuperior'
              ,'grupo'
              ,'prefijo'
              ,'nombre'
              ,'abreviatura'
              ,'glosa'
              ,'codctble'
              ,'codigosunat'
              ,'tiporeferencia'
              ,'referencia'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
