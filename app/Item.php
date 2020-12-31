<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model { //clase Eloquent
protected $table = 'item';
protected $fillable = array(
              'id'
              ,'certificado'
              ,'stock'
              ,'precio'
              ,'forma'
              ,'carats'
              ,'claridad'
              ,'color'
              ,'corte'
              ,'pulido'
              ,'simetria'
              ,'fluorescent'
              ,'lab'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
