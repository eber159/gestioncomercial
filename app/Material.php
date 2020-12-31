<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model { //clase Eloquent
protected $table = 'material';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idsubfamilia'
              ,'idunidadmedida'
              ,'codigo'
              ,'codigobarras'
              ,'precioventa'
              ,'nombre'
              ,'descripcionguia'
              ,'peso'
              ,'idlinea'
              ,'indpublicado'
              ,'indstock'
              ,'indlotizable'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
