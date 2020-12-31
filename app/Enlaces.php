<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Enlaces extends Model { //clase Eloquent
protected $table = 'enlaces';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'url'
              ,'descripcion'
              ,'imagen'
              ,'idtipo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
