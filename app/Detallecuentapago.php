<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallecuentapago extends Model { //clase Eloquent
protected $table = 'detallecuentapago';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'iddetallecuenta'
              ,'iddetallecuenta_asoc'
              ,'fechapago'
              ,'pago'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
