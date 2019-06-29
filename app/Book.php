<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $with = ['classes','bookstock'];
    public function classes () {
		return $this->belongsTo('App\IClass', 'class');
	}

	public function bookstock () {
		return $this->belongsTo('App\BookStock','code');
	}

}
