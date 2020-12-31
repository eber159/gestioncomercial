<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model { //clase Eloquent
protected $table = 'serie';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'nroserie'
              ,'nrocorrelativo'
              ,'idtipodocumento'
              ,'indcompraventa'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
