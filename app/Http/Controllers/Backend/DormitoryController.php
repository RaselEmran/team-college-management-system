<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;
use App\Dormitory;
use App\IClass;
use App\Section;
use App\AcademicYear;
use App\Registration;
use App\DormitoryStudent;
use App\Dormitoryfee;


class DormitoryController extends Controller
{
   public function index()
	{
		$dormitories=Dormitory::all();
		$dormitory=array();
		return View::Make('backend.dormitory.dormitory',compact('dormitories','dormitory'));
	}

 public function create()
	{
		$rules=[
			'name' => 'required',
			'numOfRoom' => 'required|integer',
			'address' => 'required',

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/dormitory')->withErrors($validator);
		}
		else {
			$dormitory = new Dormitory;
			$dormitory->name= Input::get('name');
			$dormitory->numOfRoom=Input::get('numOfRoom');
			$dormitory->address=Input::get('address');
			$dormitory->description=Input::get('description');
			$dormitory->save();
			 Toastr::success('Dormitory Created Succesfully:','Success');
			return Redirect::to('/dormitory');

		}
	}

   public function edit($id)
	{
		$dormitory = Dormitory::find($id);
		$dormitories=Dormitory::all();
		return View::Make('backend.dormitory.dormitory',compact('dormitories','dormitory'));
	}

  public function update()
	{

		$rules=[
			'name' => 'required',
			'numOfRoom' => 'required|integer',
			'address' => 'required',

		];


		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/dormitory/edit/'.Input::get('id'))->withErrors($validator);
		}
		else {
			$dormitory = Dormitory::find(Input::get('id'));
			$dormitory->name= Input::get('name');
			$dormitory->numOfRoom=Input::get('numOfRoom');
			$dormitory->address=Input::get('address');
			$dormitory->description=Input::get('description');
			$dormitory->save();
			Toastr::success('Dormitory update Succesfully:','Success');
			return Redirect::to('/dormitory');

		}
	}

	public function delete($id)
	{
		$dormitory = Dormitory::find($id);
		$dormitory->delete();
		Toastr::success('Dormitory update Succesfully:','Success');
		return Redirect::to('/dormitory');
	}


	//student assign to dormitory part goes Here
	public function stdindex()
	{
		$classes = IClass::select('id','name')->orderby('id','asc')->get();
		$section =Section::all();
		$academicYear =AcademicYear::all();
		$dormitories = Dormitory::select('id','name')->orderby('id','asc')->get();
		return View::Make('backend.dormitory.dormitory_stdadd',compact('classes','dormitories','section','academicYear'));
	}

		public function stdcreate()
	{
		$rules=[
			'regi_no' => 'required',
			'joinDate' => 'required',
			'isActive' => 'required',
			'dormitory' => 'required',
			'roomNo' => 'required',
			'monthlyFee' => 'required|numeric',


		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/dormitory/assignstd')->withErrors($validator);
		}
		else {
			$dormStd = new DormitoryStudent;
			$dormStd->regi_no=Input::get('regi_no');
			$dormStd->joinDate=Input::get('joinDate');
			$dormStd->dormitory=Input::get('dormitory');
			$dormStd->roomNo=Input::get('roomNo');
			$dormStd->monthlyFee=Input::get('monthlyFee');
			$dormStd->isActive=Input::get('isActive');
			$dormStd->save();
			Toastr::success('Student added to dormitory Succesfully:','Success');
			return Redirect::to('/dormitory/assignstd');

		}
	}

	public function stdShow()
	{

		$dormitories = Dormitory::all();
		$students=array();
		return View::Make('backend.dormitory.dormitory_stdlist',compact('students','dormitories'));
	}

	public function poststdShow()
	{
	  $rules = ['dormitory' => 'required',];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/dormitory/assignstd/list')->withInput(Input::all())->withErrors($validator);
		}
		else
		{
			$dormitories = Dormitory::all();
			$students =DormitoryStudent::where('dormitory',Input::get('dormitory'))->get();
				return View::Make('backend.dormitory.dormitory_stdlist',compact('students','dormitories'));
		}
	}

		public function stdedit($id)
	{
		$student = DormitoryStudent::find($id);
		$dormitories=Dormitory::all();
		return View::Make('backend.dormitory.dormitory_stdedit',compact('dormitories','student'));
	}


	public function stdupdate()
	{

		$rules=[
			'isActive' => 'required',
			'dormitory' => 'required',
			'roomNo' => 'required',
			'monthlyFee' => 'required|numeric',

		];


		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/dormitory/assignstd/edit/'.Input::get('id'))->withErrors($validator);
		}
		else {
			$dormStd = DormitoryStudent::find(Input::get('id'));
			if(Input::get('leaveDate')!=""){
				$dormStd->leaveDate=Input::get('leaveDate');
			}

			$dormStd->dormitory=Input::get('dormitory');
			$dormStd->roomNo=Input::get('roomNo');
			$dormStd->monthlyFee=Input::get('monthlyFee');
			$dormStd->isActive=Input::get('isActive');
			$dormStd->save();
			Toastr::success('Dormitory student info update Succesfully:','Success');
			return Redirect::to('/dormitory/assignstd/list');
		}
	}

	public function stddelete($id)
	{
		$dormstd = DormitoryStudent::find($id);
		$dormstd->delete();
		Toastr::success('Dormitory student deleted Succesfully:','Success');
		return Redirect::to('/dormitory/assignstd/list');
	}

	public function feeindex()
	{
		$dormitories=Dormitory::select('name','id')->orderby('id','asc')->get();
		return View::Make('backend.dormitory.dormitory_fee',compact('dormitories'));
	}


	public function getstudents($dormid)
	{
	   $students = DormitoryStudent::with('registration')->where('dormitory', $dormid)
            ->where('isActive', 'Yes')
            ->get();
            return $students;
	}

	public function feeinfo($regiNo)
	{
		$fee = DormitoryStudent::select('monthlyFee')
		->where('regi_no',$regiNo)
		->get();

		$isPaid= Dormitoryfee::
		  select('regi_no','feeAmount')
		->where('regi_no',$regiNo)
		->whereRaw('EXTRACT(YEAR_MONTH FROM feeMonth) = EXTRACT(YEAR_MONTH FROM NOW())')
		->get();

		$info=array($fee[0]->monthlyFee);
		if(count($isPaid)>0)
		{
			array_push($info,"true");
		}
		else {
			array_push($info,"false");
		}
		return $info;
	}

	public function mainfee()
	{
		$fee =DormitoryStudent::where('regi_no',Input::get('val'))->where('dormitory',Input::get('dormitory'))->first();
		return $fee;
	
	}

	public function feesprint($id)
	{
		$fees=Dormitoryfee::where('regi_no',$id)->where('paydate',date('Y-m-d'))->get();
		$info =Dormitoryfee::where('regi_no',$id)->where('paydate',date('Y-m-d'))->first();
		// dd($fee);
	    $appSettings = AppHelper::getAppSettings();

		return view('backend.dormitory.feesprint',compact('fees','appSettings','info'));
			}

	public function feeadd()
	{
		$rules=[
			'regi_no' => 'required',
			'todate' => 'required',
			'formdate' => 'required',
			'feeAmount' => 'required',

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/dormitory/fee')->withErrors($validator);
		}
		else {
			$to =Input::get('todate');
			$toex =explode('-', $to);
			$toyear =$toex[0];
		    $todate =$toex[1];

		    $form =Input::get('formdate');
			$formex =explode('-', $form);
		    $formdate =$formex[1];
		    $count =$formdate-$todate;
		    for ($i=0; $i <$count ; $i++) {     	
			$dormFee = new Dormitoryfee;
			$dormFee->regi_no=Input::get('regi_no');
			
			$dormFee->month=$toyear.'-0'.($todate+$i);
			$dormFee->paydate=date('Y-m-d');
			$dormFee->feeAmount=Input::get('feeAmount');
			$dormFee->save();


		    }
		return redirect()->route('dormitory.fee.print',Input::get('regi_no'));

		}
	}


	public function reportstd()
	{
		$dormitories=Dormitory::select('name','id')->orderby('id','asc')->get();
		return View::Make('backend.dormitory.dormitory_rptstd',compact('dormitories'));

		
	}

	public function reportstdprint($dormId)
	{
		 $students = DormitoryStudent::with('registration')->where('dormitory', $dormId)
            ->where('isActive', 'Yes')
            ->get();
         $appSettings = AppHelper::getAppSettings();
         $dormInfo = Dormitory::find($dormId);
         return View::Make('backend.dormitory.dormitory_rptstdprint',compact('students','appSettings','dormInfo'));
	}

	public function reportfee()
	{
		$dormitories=Dormitory::select('name','id')->orderby('id','asc')->get();
		return View::Make('backend.dormitory.dormitory_rptfee',compact('dormitories'));
	}

	public function reportfeeprint($dormId,$month)
	{
	$a= explode('-', $month);
     $b=$a[1];
     $fee =Dormitoryfee::where('dormitory_id',$dormId)->where('month',$month)->get();
     // dd($fee);
     $dormInfo = Dormitory::find($dormId);
     $appSettings = AppHelper::getAppSettings();
     return View::Make('backend.dormitory.dormitory_rptfeeprint',compact('fee','appSettings','dormInfo','b'));
	}

}
