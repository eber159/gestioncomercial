<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenpedido extends Model { //clase Eloquent
protected $table = 'ordenpedido';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'fecha'
              ,'idcliente'
              ,'idestado'
              ,'total'
              ,'idvendedor'
              ,'glosa'
              ,'idtipopago'
              ,'formapago'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
