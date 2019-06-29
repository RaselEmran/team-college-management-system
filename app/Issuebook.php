<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issuebook extends Model
{
	protected $with = ['class','registration'];

   public function class () {
		return $this->belongsTo('App\IClass', 'class_id');
	}

	public function registration () {
		return $this->belongsTo('App\Registration','regi_no');
	}
}
