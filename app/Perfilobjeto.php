<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfilobjeto extends Model { //clase Eloquent
protected $table = 'perfilobjeto';
protected $fillable = array(
              'id'
              ,'idperfil'
              ,'idobjeto'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
