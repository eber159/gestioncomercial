<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Subfamilia extends Model { //clase Eloquent
protected $table = 'subfamilia';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idfamilia'
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
