<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfilusuario extends Model { //clase Eloquent
protected $table = 'perfilusuario';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idperfil'
              ,'idusuario'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
