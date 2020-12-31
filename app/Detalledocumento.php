<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalledocumento extends Model { //clase Eloquent
protected $table = 'detalledocumento';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'iddocumento'
              ,'idtipomaterialservicio'
              ,'idmaterialservicio'
              ,'cantidad'
              ,'preciounit'
              ,'preciounitigv'
              ,'indigv'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
