<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class DetalleProducto extends Eloquent
{
    protected $table = 'detalle_producto';
    protected $fillable = [
        'id'
		,'id_tabla'
		,'txt_nombre_producto'
		,'can_producto'
		,'can_precio_unit_igv'
		,'can_valor_venta_igv'
        ,'cod_estado'
    ];

}
