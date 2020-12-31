<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cajabanco extends Model { //clase Eloquent
protected $table = 'cajabanco';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idmoneda'
              ,'idemprbanco'
              ,'nombre'
              ,'cci'
              ,'indcajabanco'
              ,'nrocta'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
