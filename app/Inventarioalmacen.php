<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventarioalmacen extends Model { //clase Eloquent
protected $table = 'inventarioalmacen';
protected $fillable = array(
              'id'
              ,'idempresa'
              ,'idsede'
              ,'idalmacen'
              ,'idlote'
              ,'idmaterial'
              ,'fechainventario'
              ,'cantidadinicial'
              ,'cantidadingreso'
              ,'cantidadsalida'
              ,'stock'
              ,'costo'
              ,'indstockactual'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
  protected $casts = [
          'indstockactual' => 'boolean',
          'activo' => 'boolean',
      ];
}
?>
