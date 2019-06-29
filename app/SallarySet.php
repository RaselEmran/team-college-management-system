<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SallarySet extends Model
{
	protected $with=['role','employee'];
    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}

