<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DormitoryStudent extends Model
{
	protected $with = ['registration'];
    public function registration () {
		return $this->belongsTo('App\Registration','regi_no','regi_no');
	}
}
