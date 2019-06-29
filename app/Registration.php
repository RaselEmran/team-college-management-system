<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hrshadhin\Userstamps\UserstampsTrait;

class Registration extends Model
{
    use SoftDeletes;
    use UserstampsTrait;

protected $with=['student','info','class','section','acYear','attendance','attendanceSingleDay','result','marks','fees','studentfees'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'regi_no',
        'student_id',
        'class_id',
        'section_id',
        'academic_year_id',
        'roll_no',
        'shift',
        'card_no',
        'board_regi_no',
        'fourth_subject',
        'alt_fourth_subject',
        'house',
        'fee_total',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function info()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function class()
    {
        return $this->belongsTo('App\IClass', 'class_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function acYear()
    {
        return $this->belongsTo('App\AcademicYear', 'academic_year_id');
    }

    public function fees()
    {
        return $this->hasMany('App\FeeCollection', 'regi_no');
    }

    public function attendance()
    {
        return $this->hasMany('App\StudentAttendance', 'registration_id');
    }

    public function attendanceSingleDay()
    {
        return $this->hasOne('App\StudentAttendance', 'registration_id');
    }

    public function result()
    {
        return $this->hasMany('App\Result', 'registration_id');
    }

    public function marks()
    {
        return $this->hasMany('App\Mark', 'registration_id');
    }
    public function studentfees()
    {
        return $this->hasMany('App\StudentFees','regi_num','regi_no');
    }

    public function scopeSection($query, $section)
    {
        if($section){
            return $query->where('section_id', $section);
        }

        return $query;
    }

    public function scopeCountOrGet($query, $isCount)
    {
        if($isCount){
            return $query->count();
        }

        return $query->get();
    }
}
