<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TIdentificacion extends Model { //clase Eloquent
protected $table = 'tidentificacion';
protected $fillable = array(
              'id_persona'
              ,'id_tipo_identificacion'
              ,'nroidentificacion'
              ,'id_empresa'
              ,'created_at'
              ,'updated_at'
          );
}
?>
