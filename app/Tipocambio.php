<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class tipocambio extends Model { //clase Eloquent
protected $table = 'tipocambio';
protected $fillable = array(
              'id'
              ,'fecha'
              ,'compra'
              ,'venta'
              ,'activo'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'

          );
}
?>
