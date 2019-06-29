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
use App\StudentAttendance;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;


class GradesheetController extends Controller
{
       public function index()
    {
        $result=array();
        $classes = IClass::all();
        $class_id=null;
        $section = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

         $exam = Exam::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();

        $academic_year = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();


        return View::Make('backend.gradesheet.gradeSheet',compact('classes','result','section','academic_year','exam'));
    }

       public function stdlist()
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
                return View::Make('backend.gradesheet.gradeSheet', compact('result','classes','section','academic_year','exam'));
            }

            else
            {
            	 Toastr::warning('Result Not Publish Yet!:','Warning');
                return Redirect::to('/gradesheet');
            }


        }



    public function printsheet($regiNo,$exam,$class)
    {

       $student =Registration::where('regi_no','=',$regiNo)
                              ->where('class_id','=',$class)
                              ->first();
        $regi_no =$student->id;                       
             $appSettings = AppHelper::getAppSettings();
                                 // dd($student);
               $examname =Exam::find($exam);
               $result =Result::where('class_id',$class)->where('registration_id',$regi_no)->where('exam_id',$exam)->first(); 
               $mark =Mark::where('class_id',$class)->where('registration_id',$regi_no)->where('exam_id',$exam)->get();
               $attn =StudentAttendance::where('academic_year_id',$student->academic_year_id)->where('registration_id',$student->id)->get();

         return View::Make('backend.gradesheet.stdgradesheet', compact('student','appSettings','examname','regiNo','result','mark','attn'));                     
        // if(count($student)>0) {
         
        //     if (count($student) < 1) {
        //         return Redirect::back()->with('noresult', 'Result Not Found!');
        //     } else {
             

        //         //sub group need to implement
        //         $subjects = Subject::where('class_id', '=', $student->class_id)->get();
        //         //get class information
        //         $requestedClass = IClass::where('id',$student->class_id)->first();

        //         $overallSubject = array();
        //         $subcollection = array();

        //         $banglatotal = 0;
        //         $banglatotalhighest = 0;
        //         $banglaArray = array();
        //         $blextra = array();

        //         $englishtotal = 0;
        //         $englishtotalhighest = 0;
        //         $englishArray = array();
        //         $enextra = array();

        //         $totalHighest = 0;
        //         $isBanglaFail=false;
        //         $isEnglishFail=false;

        //         //2 paper written and mcq pass check
        //         $banglaWritten = 0;
        //         $banglaMcq = 0;
        //         $bnTotalExamMarks = 0;
        //         $bnWrittenPass = 0;
        //         $bnMcqPass = 0;

        //         $englishWritten = 0;
        //         $englishMcq = 0;
        //         $enTotalExamMarks = 0;
        //         $enWrittenPass = 0;
        //         $enMcqPass = 0;


        //         foreach ($subjects as $subject) {
        //             $submarks = Mark::where('registration_id', '=', $student->id)
        //                 ->where('subject_id', '=', $subject->id)->where('exam_id', '=', $exam)->where('class_id', '=', $class)->first();
        //             $maxMarks = Mark::select(DB::raw('max(total_marks) as highest'))->where('class_id', '=', $class)->where('academic_year_id', '=', $student->academic_year_id)
        //                 ->where('subject_id', '=', $subject->id)->where('exam_id', '=', $exam)->first();

        //             $submarks["highest"] = $maxMarks->highest;
        //             $submarks["subcode"] = $subject->code;
        //             $submarks["subname"] = $subject->name;


        //             if ($this->getSubGroup($subjects, $subject->code) === "Bangla") {

        //                 //check if this class have combine pass
        //                 if($requestedClass->combinePass){
        //                     $subInfo = self::getSubjectInfo($subjects,$subject->code);
        //                     $bnTotalExamMarks += $subInfo->totalfull;
        //                     $bnWrittenPass += $subInfo->wpass;
        //                     $bnMcqPass += $subInfo->mpass;

        //                     $banglaWritten += json_decode($submarks->marks, true)[1];
        //                     $banglaMcq += json_decode($submarks->marks, true)[2];

        //                     $banglatotal += $submarks->total;
        //                     $banglatotalhighest += $submarks->highest;

        //                     $bangla = array($submarks->subcode, $submarks->subname, json_decode($submarks->marks, true)[1], json_decode($submarks->marks, true)[2]);
        //                     array_push($banglaArray, $bangla);

        //                 }
        //                 else{
        //                     // these are safe code if user make mistake in add subject
        //                     $totalHighest += $maxMarks->highest;
        //                     array_push($subcollection, $submarks);

        //                 }


        //             }
        //             else if ($this->getSubGroup($subjects, $subject->code) === "English") {
        //                 //check if this class have combine pass
        //                 if($requestedClass->combinePass){
        //                     $subInfo = self::getSubjectInfo($subjects,$subject->code);
        //                     $enTotalExamMarks += $subInfo->totalfull;
        //                     $enWrittenPass += $subInfo->wpass;
        //                     $enMcqPass += $subInfo->mpass;

        //                     $englishWritten +=  json_decode($submarks->marks, true)[1];;
        //                     $englishMcq +=  json_decode($submarks->marks, true)[2];

        //                     $englishtotal += $submarks->total;
        //                     $englishtotalhighest += $submarks->highest;

        //                     $english = array($submarks->subcode, $submarks->subname,  json_decode($submarks->marks, true)[1],  json_decode($submarks->marks, true)[2]);
        //                     array_push($englishArray, $english);
        //                 }
        //                 else{
        //                     // these are safe code if user make mistake in add subject
        //                     $totalHighest += $maxMarks->highest;
        //                     array_push($subcollection, $submarks);
        //                 }

        //             }
        //             else {

        //                 //check if 4th subject
        //                 if ($subject->type === "Electives") {

        //                     //if this is student 4th subject or student main subject by exchange
        //                     if($student->fourthSubject == $subject->code || $student->cphsSubject == $subject->code ){
        //                         $totalHighest += $maxMarks->highest;
        //                         array_push($subcollection, $submarks);
        //                     }
        //                 }
        //                 else{
        //                     $totalHighest += $maxMarks->highest;
        //                     array_push($subcollection, $submarks);
        //                 }
        //             }


        //         }

        //         //check two paper pass
        //         //check written and mcq 2 papers additional pass or not.
        //         $gparules = Grade::where('for',"1")->get();
        //         $subgrpbl = false;
        //         $subgrpen = false;
        //         if($requestedClass->combinePass){
        //             $subgrpbl = true;
        //             $subgrpen = true;

        //             //let's do calculation for bangla
        //             if ($banglaWritten < $bnWrittenPass) {
        //                 $isBanglaFail = true;
        //             }
        //             if ($bnMcqPass && $banglaMcq < $bnMcqPass) {
        //                 $isBanglaFail = true;
        //             }

        //             //now combine subject marks round policy
        //             // and grading
        //             $blt=0.00;
        //             if($banglatotal>0) {
        //                 if ($bnTotalExamMarks >= 200) {
        //                     $blt = round($banglatotal / 2);
        //                 }
        //                 else {
        //                     $blt = round($banglatotal / 1.5);
        //                 }
        //             }

        //             $totalHighest += $banglatotalhighest;
        //             $gcal = $this->gpaCalculator($blt, $gparules);

        //             array_push($blextra, $banglatotal);
        //             array_push($blextra, $banglatotalhighest);


        //             if($isBanglaFail)
        //             {
        //                 array_push($blextra, "0.00");
        //                 array_push($blextra, "F");
        //             }
        //             else {
        //                 array_push($blextra, number_format($gcal[0],2));
        //                 array_push($blextra, $gcal[1]);
        //             }


        //             //let's do calculation for english
        //             if($englishWritten < $enWrittenPass){
        //                 $isEnglishFail = true;
        //             }
        //             if($enMcqPass && $englishMcq < $enMcqPass){
        //                 $isEnglishFail = true;
        //             }

        //             //now combine subject marks round policy
        //             // and grading
        //             $enmarks=0.00;
        //             //for exception handle
        //             if($englishtotal>0) {
        //                 if ($enTotalExamMarks >= 200) {
        //                     $enmarks = round($englishtotal / 2);
        //                 }
        //                 else {
        //                     $enmarks = round($englishtotal / 1.5);
        //                 }
        //             }

        //             $totalHighest += $englishtotalhighest;
        //             $gcal = $this->gpaCalculator($enmarks, $gparules);
        //             array_push($enextra, $englishtotal);
        //             array_push($enextra, $englishtotalhighest);
        //             if($isEnglishFail)
        //             {
        //                 array_push($enextra, "0.00");
        //                 array_push($enextra, "F");

        //             }
        //             else {
        //                 array_push($enextra, number_format($gcal[0],2));
        //                 array_push($enextra, $gcal[1]);

        //             }


        //         }




        //         $extra = array($exam, $subgrpbl, $totalHighest, $subgrpen, $student->extraActivity);
        //         $query="select left(MONTHNAME(STR_TO_DATE(m, '%m')),3) as month, count(regiNo) AS present from ( select 01 as m union all select 02 union all select 03 union all select 04 union all select 05 union all select 06 union all select 07 union all select 08 union all select 09 union all select 10 union all select 11 union all select 12 ) as months LEFT OUTER JOIN Attendance ON MONTH(Attendance.date)=m and Attendance.regiNo ='".$regiNo."' GROUP BY m";
        //         $attendance=DB::select(DB::RAW($query));
        //         return View::Make('app.stdgradesheet', compact('student', 'extra', 'meritdata', 'subcollection', 'blextra', 'banglaArray', 'enextra', 'englishArray','attendance'));

        //     }
        // }
        // else
        // {
        //     //echo "<h1 style='text-align: center;color: red'>Result Not Found</h1>";
        //     return  Redirect::back()->with('noresult','Result Not Found!');

        // }
    }

      public  function getSubGroup($subjects,$subject)
    {
        $group="";
        foreach($subjects as $sub)
        {
            if($sub->code===$subject)
            {
                $group=$sub->subgroup;
                break;

            }
        }
        return $group;
    }

        private static function getSubjectInfo($subjects,$code){
        $requestSubject = null;
        foreach($subjects as $sub)
        {
            if($sub->code===$code)
            {
                $requestSubject =$sub;
                break;
            }
        }
        return $requestSubject;
    }

        public  function gpaCalculator($marks,$gparules)
    {
        $gpacal= array();

        foreach ($gparules as $gpa) {
            if ($marks >= $gpa->markfrom){
                $gpacal[0]=$gpa->grade;
                $gpacal[1]=$gpa->gpa;
                break;
            }
        }
        return $gpacal;
    }
    
}
