<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Productowebrecurso extends Model { //clase Eloquent
protected $table = 'productowebrecurso';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idproductoweb'
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
