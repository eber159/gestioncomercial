<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model { //clase Eloquent
protected $table = 'familia';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idtipomaterial'
              ,'codigo'
              ,'nombre'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
