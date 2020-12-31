<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TEmpresa extends Model { //clase Eloquent
protected $table = 'tempresa';
protected $fillable = array(
              'id'
              ,'nombre'
              ,'razonsocial'
              ,'ruc'
              ,'direccion'
              ,'telefono1'
              ,'telefono2'
              ,'email'
              ,'estado'
              ,'id_dis'
              ,'id_prov'
              ,'id_dep'
              ,'created_at'
              ,'updated_at'
          );
}
?>
