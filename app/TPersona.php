<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TPersona extends Model { //clase Eloquent
protected $table = 'tpersona';
protected $fillable = array(
              'id'
              ,'nombres'
              ,'apellidos'
              ,'direccion'
              ,'email'
              ,'fch_nac'
              ,'telefono'
              ,'sexo'
              ,'estado'
              ,'id_dis'
              ,'id_prov'
              ,'id_dep'
              ,'created_at'
              ,'updated_at'
          );
}
?>
