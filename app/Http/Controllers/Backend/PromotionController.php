<?php

namespace App\Http\Controllers\Backend;

use App\IClass;
use App\Section;
use App\AcademicYear;
use App\Registration;
use App\Student;
use App\FeeCollection;
use App\StudentFees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class PromotionController extends Controller
{
    public function index()
	{
		$classes = IClass::all();
		$sections =Section::all();
		$academic_years =AcademicYear::all();

		return View::Make('backend.promotion.promotion',compact('classes','sections','academic_years'));
	}

	  public function getStudentList($class,$section,$shift,$session)
    {
         $students = Registration::with('student')->where('academic_year_id', $session)
            ->where('class_id', $class)
            ->where('section_id', $section)
            ->where('shift', $shift)
            ->get();
         return view('backend.promotion.stdlist',compact('students'));
            // return $students;
    }



  public function post_promotion()
	{      
    $rules = [
		'nclass' => 'required',
		'nsection' => 'required',
		'nshift' => 'required',
		'nsession' => 'required'

	];
	$validator = \Validator::make(Input::all(), $rules);
	if ($validator->fails()) {
		return Redirect::to('/promotion')->withInput(Input::all())->withErrors($validator);
	} else {
		if(Input::get('section')==Input::get('nsection'))
		{

		    Toastr::warning('Promotion From and Promotion To Section should n not be same!:','Warning');
			return Redirect::to('/promotion')->withInput(Input::all());
		}
		else
		{
		  $promotion = Input::get('promot');
			$newrollNo= Input::get('newrollNo');
			if (!isset($promotion)) {
			Toastr::warning('Plese Student Select to Promote:','Warning');
			return Redirect::to('/promotion')->withInput(Input::all());


			}

			if (isset($promotion)) {

		    $classInfo = IClass::find(Input::get('nclass'));
            $academicYearInfo = AcademicYear::find(Input::get('nsession'));
            $regiNo = $academicYearInfo->start_date->format('y') . (string)$classInfo->numeric_value.Input::get('nsection');

            $totalStudent = Registration::where('academic_year_id', $academicYearInfo->id)
                ->where('class_id', $classInfo->id)->withTrashed()->count();
            $regiNo .= str_pad(++$totalStudent,3,'0',STR_PAD_LEFT);
            $regi =Input::get('regi_no');
            $roll= Input::get('newrollNo');
			for($i=0;$i<count($promotion);$i++)
			{
				
        if($newrollNo[$i]=='')
				{
			    Toastr::warning('New Roll Number Can not be empty:','Warning');
			   return Redirect::to('/promotion')->withInput(Input::all());
				}
				else
				{

               $info =Registration::where('regi_no',$regi[$i])->first();
				
                $student = new Student();
                $student->user_id =$info->student->user_id;
                $student->name =$info->student->name;
                $student->dob =$info->student->dob;
                $student->gender =AppHelper::gender($info->student->gender);
                $student->religion =AppHelper::religion($info->student->religion);
                $student->blood_group =AppHelper::Blood($info->student->blood_group);
                $student->nationality =$info->student->nationality;
                $student->photo =$info->student->photo;
                $student->email =$info->student->email;
                $student->phone_no =$info->student->phone_no;
                $student->extra_activity =$info->student->extra_activity;
                $student->note =$info->student->note;
                $student->father_name =$info->student->father_name;
                $student->father_phone_no =$info->student->father_phone_no;
                $student->mother_name =$info->student->mother_name;
                $student->mother_phone_no =$info->student->mother_phone_no;
                $student->guardian =$info->student->guardian;
                $student->guardian_phone_no =$info->student->guardian_phone_no;
                $student->present_address =$info->student->present_address;
                $student->permanent_address =$info->student->permanent_address;
                $student->status =$info->student->status;
                $student->save();
                $student_id =$student->id;

                $fees =FeeCollection::where('regi_no',$regi[$i])->get();
                $pay_fee=$fees->sum('paidAmount');
                $due_fee =$info->fee_total-$pay_fee;

                $registration =new Registration();
                $registration->regi_no =$regiNo+$i;
                $registration->student_id =$student_id;
                $registration->class_id=Input::get('nclass');
                $registration->section_id=Input::get('nsection');
                $registration->academic_year_id=Input::get('nsession');
                $registration->roll_no=$roll[$i];
                $registration->shift=Input::get('nshift');
                $registration->card_no=$info->card_no;
                $registration->board_regi_no=$info->board_regi_no;
                $registration->fourth_subject=$info->fourth_subject;
                $registration->alt_fourth_subject=$info->alt_fourth_subject;
                $registration->house=$info->house;
                $registration->fee_total=$due_fee;
                $registration->status=$info->status;
                $registration->save();

                $studentFees =StudentFees::where('regi_num',$regi[$i])->get();
                foreach ($studentFees as $key => $value) {
                  $studentFees =new StudentFees;
                  $studentFees->class_id =Input::get('nclass');
                  $studentFees->regi_num =$regiNo+$i;
                  $studentFees->feeid =$value->feeid;
                  $studentFees->origin_fee =$value->origin_fee;
                  $studentFees->type =$value->type;
                  $studentFees->title =$value->title;
                  $studentFees->fee =$value->fee;
                  $studentFees->Latefee =$value->Latefee;
                  $studentFees->save();



                }


				}
			}
             Toastr::success('Student Promotion Successfully:','Success');
             return redirect()->back();
			
			}

		}
	}


}



}
