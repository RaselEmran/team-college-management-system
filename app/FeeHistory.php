<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeHistory extends Model
{
    protected $fillable = ['billNo','title','month','fee','lateFee','total'];
	public $timestamps = false;

	
}
