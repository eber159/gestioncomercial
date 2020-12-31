<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidadmedida extends Model { //clase Eloquent
protected $table = 'unidadmedida';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'codigo'
              ,'nombre'
              ,'abreviatura'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
