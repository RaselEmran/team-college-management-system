<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dormitoryfee extends Model
{
    protected $with = ['registration','dormitory','dormitoryStudent'];
    public function registration () {
		return $this->belongsTo('App\Registration','regi_no','regi_no');
	}

	public function dormitory () {
		return $this->belongsTo('App\Dormitory','dormitory_id');
	}
	public function dormitoryStudent()
	{
		return $this->belongsTo('App\DormitoryStudent','regi_no','regi_no');
	}
}
