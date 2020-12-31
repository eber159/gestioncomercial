<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model { //clase Eloquent
protected $table = 'usuario';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'nombre'
              ,'clave'
              ,'idtrabajador'
              ,'trabajador'
              ,'idcliente'
              ,'indcorreoverificado'
              ,'tipousuario'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
