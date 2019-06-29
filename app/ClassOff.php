<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassOff extends Model {
	protected $dates = ['offDate'];

	protected $fillable = [
		'offDate',
		'description',
		'oType',
		'status',
	];
}
