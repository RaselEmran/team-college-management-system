<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeSetup extends Model {
	protected $with = ['class','academicyear'];
	protected $table = 'fee_setups';
	protected $fillable = ['class_id', 'type', 'title', 'fee', 'Latefee', 'description'];

	public function class () {
		return $this->belongsTo('App\IClass', 'class_id');
	}

	public function academicyear () {
		return $this->belongsTo('App\AcademicYear', 'academic_year_id');
	}
}
