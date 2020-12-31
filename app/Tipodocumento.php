<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model { //clase Eloquent
protected $table = 'tipodocumento';
protected $fillable = array(
              'id'
              ,'nombre'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
