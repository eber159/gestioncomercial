<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipomaterial extends Model { //clase Eloquent
protected $table = 'tipomaterial';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
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
