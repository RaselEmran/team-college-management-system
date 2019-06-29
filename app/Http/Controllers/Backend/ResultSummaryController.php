<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IClass;
use App\Section;
use App\AcademicYear;
use App\Exam;
use App\Result;
use App\Registration;
use App\Subject;
use App\Mark;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class ResultSummaryController extends Controller
{
    
    public function passing_summary()
    {
        $result=array();
        $class_id=null;
        $sections = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

            $subjects = Subject::where('status', AppHelper::ACTIVE)
                 ->where('class_id', $class_id)
                ->get();

            $exams = Exam::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

            $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();
            $classes = IClass::all();

        return View::Make('backend.passingsummary.classpassSummary',compact('classes','result','sections','academic_years','exams'));
    }

      public function passing_postsummary()
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
        $sections =Section::all();
        $academic_years =AcademicYear::all();
        $exams =Exam::all();
        if ($exams) {
           Input::get('academic_year_id');
              $result =Result::with(['student','student.student','exam','class','academicyear','class'])->where('academic_year_id',Input::get('academic_year_id'))->where('class_id',Input::get('class_id'))->where('exam_id',Input::get('exam_id'))->where('grade','!=','F')->orderBy('total_marks','desc')->get();              
                return View::Make('backend.passingsummary.classpassSummary', compact('result','classes','sections','academic_years','exams'));
            }

            else
            {
                Toastr::warning('Result Not Publish Yet!:','Warning');
                return Redirect::to('/gradesheet');
            }


        }

     public function subjectpass_summary()
     {
     	$result=array();
        $exams = [];
        $class_id =null;
            $sections = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

            $subjects = Subject::where('status', AppHelper::ACTIVE)
                 ->where('class_id', $class_id)
                ->get();

            $exams = Exam::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

            $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();

            $classes = IClass::all();

        return View::Make('backend.passingsummary.subjectpassSummary',compact('classes','sections','exams','academic_years','classes','result' ,'subjects'));
     } 

     public function subjectpass_postsummary()
     {
      
           $rules=[
            'class_id' => 'required',
            'academic_year_id' => 'required',
            'exam_id' => 'required',
            'subject_id' => 'required',

            // 'session' => 'required'


        ];
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {

            return Redirect::to('/subject-pass')->withErrors($validator);
        }
        
        $classes = IClass::all();
          $class_id =null;
            $sections = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

            $subjects = Subject::where('status', AppHelper::ACTIVE)
                 ->where('class_id', $class_id)
                ->get();

            $exams = Exam::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

            $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();
            $exam =Exam::all();
        if ($exam) {
           Input::get('academic_year_id');
              $result =Mark::with(['student','student.student','exam','class','academicyear','subject'])
                           ->where('academic_year_id',Input::get('academic_year_id'))
                             ->where('class_id',Input::get('class_id'))
                             ->where('section_id',Input::get('section'))
                             ->where('exam_id',Input::get('exam_id'))
                             ->where('subject_id',Input::get('subject_id'))
                             ->where('grade','!=','F')
                             ->orderBy('total_marks','desc')
                             ->get();            
                return View::Make('backend.passingsummary.subjectpassSummary', compact('result','classes','sections','academic_years','exams','subjects'));
            }

            else
            {
                Toastr::warning('Result Not Publish Yet!:','Warning');
                return Redirect::to('/subject-pass');
            }


     } 




















     public function get_subject()
     {
        $class_id =Input::get('classes');
        $subject =Subject::where('class_id',$class_id)->get();
        $res ='<span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>';
        $res.='<select class="form-control select2" name="subject_id"><option value="">Select Subject</option>';
        foreach ($subject as $key => $allsub) {
        $res.='<option value="'.$allsub->id.'">'.$allsub->name.'</option>';
        }
        $res.='<select>';
        return $res;
     } 

     public function get_section()
     {
        $class_id =Input::get('classes');
        $section =Section::where('class_id',$class_id)->get();
        $res ='<span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>';
        $res.='<select class="form-control select2" name="section"><option value="">Select Section</option>';
        foreach ($section as $key => $allsec) {
        $res.='<option value="'.$allsec->id.'">'.$allsec->name.'</option>';
        }
        $res.='<select>';
        return $res;
     }

    public function get_exam()
     {
        $class_id =Input::get('classes');
        $exam =Exam::where('class_id',$class_id)->get();
        $res ='<span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>';
        $res.='<select class="form-control select2" name="exam_id"><option value="">Select Exam</option>';
        foreach ($exam as $key => $allexm) {
        $res.='<option value="'.$allexm->id.'">'.$allexm->name.'</option>';
        }
        $res.='<select>';
        return $res;
     }
}
