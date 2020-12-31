<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallecuenta extends Model { //clase Eloquent
protected $table = 'detallecuenta';
protected $fillable = array(
              'id'
              ,'idempr'
              ,'idsede'
              ,'idsubcuenta'
              ,'idconcepto'
              ,'tipocambio'
              ,'importemn'
              ,'importeme'
              ,'saldo'
              ,'fecha'
              ,'fechapago'
              ,'indcargoabono'
              ,'glosa'
              ,'tiporeferencia'
              ,'referencia'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
