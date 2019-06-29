<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model {
	protected $table = 'holidays';
	protected $dates = ['holiDate'];
	protected $fillable = [
		'holiDate',
		'description',
		'status',
	];
}
