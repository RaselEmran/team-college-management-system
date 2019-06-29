<?php

namespace App\Http\Controllers\Backend;

use App\IClass;
use App\Subject;
use App\Section;
use App\AcademicYear;
use App\Exam;
use App\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class TabulationController extends Controller
{
   public function index()
	{

		$classes = IClass::all();
        $section =Section::all();
        $academic_year =AcademicYear::all();
        $exam =Exam::all();
         $result=array();
		return View::Make('backend.tabulation.tabulationsheet',compact('classes','section','academic_year','exam','result'));
	}

	public function getsheet()
    {
        $rules=[
            'class_id' => 'required',
            'academic_year_id' => 'required',
            'exam_id' => 'required',
            // 'session' => 'required'


        ];
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {

            return Redirect::to('/gradesheet')->withErrors($validator);
        }
        
        $classes = IClass::all();
        $section =Section::all();
        $academic_year =AcademicYear::all();
        $exam =Exam::all();
        if ($exam) {
           Input::get('academic_year_id');
              $result =Result::with(['student','student.student','exam','class','academicyear','class'])->where('academic_year_id',Input::get('academic_year_id'))->where('class_id',Input::get('class_id'))->where('exam_id',Input::get('exam_id'))->orderBy('total_marks','desc')->get();              
                return View::Make('backend.tabulation.tabulationsheet', compact('result','classes','section','academic_year','exam'));
            }

            else
            {
            	 Toastr::warning('Result Not Publish Yet!:','Warning');
                return Redirect::to('/gradesheet');
            }


        }
}
