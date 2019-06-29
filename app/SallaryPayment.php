<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SallaryPayment extends Model
{
	protected $with=['employee','role'];

 public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    } 



}
