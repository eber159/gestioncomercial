<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Informaciongeneral extends Model { //clase Eloquent
protected $table = 'informaciongeneral';
protected $fillable = array(
              'id'
              ,'empresa'
              ,'direccion'
              ,'telefono1'
              ,'telefono2'
              ,'correo'
              ,'nosotros'
              ,'nosotrosresumen'
              ,'logo'
              ,'slide1'
              ,'linkfacebook'
              ,'linktwitter'
              ,'linkinstagram'
              ,'linklikedin'
              ,'linklwhatsapp'
              ,'footer'
              ,'orden_publicaciones'
              ,'ind_carro'
              ,'formapago'
              ,'created_by'
              ,'created_at'
              ,'updated_by'
              ,'updated_at'
              ,'activo'

          );
}
?>
