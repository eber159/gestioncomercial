<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordencompra extends Model { //clase Eloquent
protected $table = 'ordencompra';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idproveedor'
              ,'fecharegistro'
              ,'fechacompra'
              ,'fecharecepcion'
              ,'indmaterialservicio'
              ,'idtipopago'
              ,'idmoneda'
              ,'idestado'
              ,'idcuenta'
              ,'idsubcuenta'
              ,'subtotal'
              ,'impuestovta'
              ,'total'
              ,'tipocambio'
              ,'glosa'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
