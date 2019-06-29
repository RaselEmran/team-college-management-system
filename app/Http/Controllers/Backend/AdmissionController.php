<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IClass;
use App\Section;
use App\AcademicYear;
use App\Admission;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class AdmissionController extends Controller
{
    public function index()
    {
    	  $classes = IClass::all();
          $class_id =null;
          $sections = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();
    	  $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();

    	  $admission =array();
    	  return View::Make('backend.admission.admissionlist', compact('classes','sections','academic_years','admission'));
    }

    public function list()
    {

      $rules=[
            'class_id' => 'required',
            'academic_year_id' => 'required',


        ];
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {

            return Redirect::to('/admission')->withErrors($validator);
        }

          $classes = IClass::all();
          $class_id =null;
          $sections = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();
    	  $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();

    	$admission =Admission::with(['academicyear','class','section'])
    	                      ->where('academic_year_id',Input::get('academic_year_id'))
    	                      ->where('class_id',Input::get('class_id'))
    	                      ->where('section_id',Input::get('section'))
    	                      ->get();
    	 return View::Make('backend.admission.admissionlist', compact('classes','sections','academic_years','admission'));                     
    	                   
    }

    public function active($id)
    {
    	$admission=Admission::find($id);
    	$admission->status=false;
    	$admission->save();
    	Toastr::success('Admission Status Update:','Success');
    	return redirect()->back();
    }

    public function inactive($id)
    {
    	$admission=Admission::find($id);
    	$admission->status=true;
    	$admission->save();
    	Toastr::success('Admission Status Update:','Success');
    	return redirect()->back();
    }

    public function create()
    {
    	  $classes = IClass::all();
          $class_id =null;
          $sections = Section::where('status', AppHelper::ACTIVE)
                ->where('class_id', $class_id)
                ->get();
    	  $academic_years = AcademicYear::where('status', '1')->orderBy('id', 'desc')->get();

    	   return View::Make('backend.admission.admissioncreate', compact('classes','sections','academic_years'));   

    }

    public function postadmission()
    {
    	 $rules=[
            'class_id' => 'required',
            'academic_year_id' => 'required',
            'name' => 'required',
            'open' => 'required',
            'close' => 'required',


        ];
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {

            return Redirect::to('/admission/create')->withErrors($validator);
        }

        else
        {
        	$admission =new Admission();
        	$admission->academic_year_id=Input::get('academic_year_id');
        	$admission->class_id=Input::get('class_id');
        	$admission->section_id=Input::get('section');
        	$admission->name=Input::get('name');
        	$admission->open=Input::get('open');
        	$admission->close=Input::get('close');
        	$admission->save();
        	Toastr::success('Admission Craete Successfully:','Success');
        	return Redirect::to('exam/admission');

        }
    }
}
