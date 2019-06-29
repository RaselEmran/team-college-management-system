<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
      public function academicyear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id');
    }

     public function class()
    {
        return $this->belongsTo('App\IClass', 'class_id');
    }

     public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }
}
