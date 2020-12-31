<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenventa extends Model { //clase Eloquent
protected $table = 'ordenventa';
protected $fillable = array(
              'id'
              ,'codigo'
              ,'idempresa'
              ,'idsede'
              ,'idcliente'
              ,'fecha'
              ,'fechaentrega'
              ,'fechapago'
              ,'indmaterialservicio'
              ,'idtipoorden'
              ,'idmodulosistema'
              ,'idtipopago'
              ,'idmoneda'
              ,'idestado'
              ,'idcuenta'
              ,'idsubcuenta'
              ,'idmovimiento'
              ,'tipocambio'
              ,'subtotal'
              ,'impuestovta'
              ,'total'
              ,'totaldscto'
              ,'glosa'
              ,'idvendedor'
              ,'nropedido'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
