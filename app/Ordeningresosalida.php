<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

//clase Eloquent
class Ordeningresosalida extends Model 
{ 
  protected $table = 'ordeningresosalida';
  protected $fillable = array(
                'id'
                ,'codigo'
                ,'idempresa'
                ,'idsede'
                ,'idempresapropietario'
                ,'idempresaadministra'
                ,'fechaorden'
                ,'idtipo'
                ,'idestado'
                ,'idmovimientoinventario'
                ,'codigooperacion'
                ,'idmodulo'
                ,'glosa'
                ,'inddevolucion'
                ,'created_by'
                ,'created_at'
                ,'updated_by'
                ,'updated_at'
                ,'activo'

            );
  protected $casts = [
          'inddevolucion' => 'boolean',
      ];
}
?>
