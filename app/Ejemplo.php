<?php

class Ejemplo extends Eloquent {
	
	protected $table = 'ejemplo';
	protected $fillable = array('titulo',
								'desc',
								'created_at',
								'updated_at',
								'vigencia'
								);
}
?>