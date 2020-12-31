<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TDetalleventa extends Model { //clase Eloquent
protected $table = 'tdetalleventa';
protected $fillable = array(
          'num_serie'
          ,'num_documento'
          ,'cod_doc'
          ,'id_item'
          ,'cantidad'
          ,'precioventa'
          ,'descuento'
          ,'tipo_igv'
          ,'igv'
          ,'id_medida'
          ,'codigo_catalogo'
          ,'created_at'
          ,'updated_at'
      );
}
?>
