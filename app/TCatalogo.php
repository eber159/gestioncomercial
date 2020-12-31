<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TCatalogo extends Model { //clase Eloquent
protected $table = 'tcatalogo';
protected $fillable = array(
              'codigo'
              ,'nombre'
              ,'created_at'
              ,'updated_at'
          );
}
?>
