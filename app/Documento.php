<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model { //clase Eloquent
protected $table = 'documento';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idtipodocumento'
              ,'idclienteproveedor'
              ,'idperiodo'
              ,'idestado'
              ,'cuentacontable'
              ,'idmoneda'
              ,'tipocambio'
              ,'idtipocompraventa'
              ,'idmaterialservicio'
              ,'serie'
              ,'numero'
              ,'fechaemision'
              ,'fechavencimiento'
              ,'tasaimpuesto'
              ,'nogravadas'
              ,'subtotal'
              ,'impuesto'
              ,'total'
              ,'saldo'
              ,'operador'
              ,'indextorno'
              ,'idmotivotraslado'
              ,'idempresaemisor'
              ,'idempresatransporte'
              ,'idempresachofer'
              ,'iddireccionorigen'
              ,'iddirecciondestino'
              ,'idvehiculotracto'
              ,'idvehiculocarreta'
              ,'idmotivoemision'
              ,'glosa'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
