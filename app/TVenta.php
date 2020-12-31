<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TVenta extends Model { //clase Eloquent
protected $table = 'tventa';
protected $fillable = array(
          'num_serie'
          ,'num_documento'
          ,'cod_doc'
          ,'idforma'
          ,'efectivo'
          ,'tarjeta'
          ,'transferencia'
          ,'fecha'
          ,'id_usuario'
          ,'id_persona'
          ,'id_empresa'
          ,'descuento'
          ,'total'
          ,'moneda'
          ,'estado'
          ,'detraccion'
          ,'created_at'
          ,'updated_at'
      );
}
?>
