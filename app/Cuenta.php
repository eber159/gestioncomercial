<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model { //clase Eloquent
protected $table = 'cuenta';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'idempr'
              ,'idsede'
              ,'idtitular'
              ,'idtipocuenta'
              ,'idestadocuenta'
              ,'idmoneda'
              ,'fecha'
              ,'idvendedor'
              ,'limitecredito'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
