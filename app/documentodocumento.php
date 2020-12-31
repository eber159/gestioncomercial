<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentodocumento extends Model { //clase Eloquent
protected $table = 'documentodocumento';
protected $fillable = array(
              'id'
              ,'iddocumento'
              ,'iddocumentoasoc'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
