<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimientocaja extends Model { //clase Eloquent
protected $table = 'movimientocaja';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'fechamovimiento'
              ,'fechaoperacion'
              ,'idtipomovimiento'
              ,'idestadomovimiento'
              ,'idemprafecta'
              ,'idsubcuenta'
              ,'idcajabanco'
              ,'nroctactble'
              ,'idmediopago'
              ,'fechacheque'
              ,'nrovoucher'
              ,'idmoneda'
              ,'tipocambio'
              ,'debe_mn'
              ,'haber_mn'
              ,'debe_me'
              ,'haber_me'
              ,'iddetalleextorno'
              ,'glosa'
              ,'referencia'
              ,'tiporeferencia'
              ,'idmovimientoorigendestino'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
