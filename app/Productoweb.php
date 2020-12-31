<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Productoweb extends Model { //clase Eloquent
protected $table = 'productoweb';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'nombre'
              ,'descripcion'
              ,'precio'
              ,'linkfacebook'
              ,'linkubicacion'
              ,'imagen'
              ,'idlinea'
              ,'idtipo'
              ,'idproductoasociado'
              ,'color'
              ,'talla'
              ,'modelo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'
          );
}
?>
