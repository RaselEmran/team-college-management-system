<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Role;
use App\SallarySet;
use App\SallaryPayment;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class SallaryController extends Controller
{
    public function index()
    {
    $role = 0;
    $roles = Role::whereNotIn('id', [AppHelper::USER_ADMIN,AppHelper::USER_STUDENT, AppHelper::USER_PARENTS])->pluck('name', 'id');
    	return view('backend.sallary.setup',compact('roles','role'));
    }

    public function setuplist()
    {
    	$lists =SallarySet::all();
    	return view('backend.sallary.setuplist',compact('lists'));
    }

    public function setupactive($id)
    {
      $list =SallarySet::find($id);
      $list->status=false;
      $list->save();
      Toastr::success('Status Update:','Success');
      return redirect()->back();
    }

     public function setupinactive($id)
    {
      $list =SallarySet::find($id);
      $list->status=true;
      $list->save();
      Toastr::success('Status Update:','Success');
      return redirect()->back();
    }

    public function jsonemployee($id)
    {
    	$list =Employee::where('role_id',$id)->get();
    	return $list;
    }

    public function setup(Request $request)
    {

    $rules = [

			'role_id' => 'required',
			'employee_id' => 'required',
			'basic_sallary' => 'required',
			'house_rent' => 'required',
			'medical_allowance' => 'required',
			'Transport_allowance' => 'required',
			'insurance' => 'required',
			'extra_over_time' => 'required',

		];
		$validator = \Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/sallary/setup')->withErrors($validator);
		}
		else
		{
			$total=$request->basic_sallary+$request->house_rent+$request->medical_allowance+$request->Transport_allowance+$request->insurance+$request->extra_over_time;

			$sallarySet =new SallarySet;
			$sallarySet->role_id =$request->role_id;
			$sallarySet->employee_id =$request->employee_id;
			$sallarySet->basic_sallary =$request->basic_sallary;
			$sallarySet->house_rent =$request->house_rent;
			$sallarySet->medical_allowance =$request->medical_allowance;
			$sallarySet->Transport_allowance =$request->Transport_allowance;
			$sallarySet->insurance =$request->insurance;
			$sallarySet->extra_over_time =$request->extra_over_time;
			$sallarySet->total =$total;
			$sallarySet->status =true;
			$sallarySet->save();
		    Toastr::success('Employee Sallary Set Successfully:','Success');
		    return redirect()->back();
		}	
    }

    public function setupedit($id)
    {
     $list =SallarySet::find($id);
     $roles = Role::whereNotIn('id', [AppHelper::USER_ADMIN,AppHelper::USER_STUDENT, AppHelper::USER_PARENTS])->pluck('name', 'id');
     $role = $list->role_id;
     return view('backend.sallary.setupedit',compact('list','roles','role'));
    }

    public function setupupade(Request $request)
    {
      $total=$request->basic_sallary+$request->house_rent+$request->medical_allowance+$request->Transport_allowance+$request->insurance+$request->extra_over_time;
    	$sallary =SallarySet::find($request->id);
		$sallary->basic_sallary =$request->basic_sallary;
		$sallary->house_rent =$request->house_rent;
		$sallary->medical_allowance =$request->medical_allowance;
		$sallary->Transport_allowance =$request->Transport_allowance;
		$sallary->insurance =$request->insurance;
		$sallary->extra_over_time =$request->extra_over_time;
		$sallary->total =$total;
		$sallary->status =true;
		$sallary->save();
	    Toastr::success('Employee Sallary Update Successfully:','Success');
	    return redirect()->route('sallary.setuplist');

    }

    public function sallarysetup_destroy(Request $request)
    {
    	$sallary =SallarySet::find($request->hiddenId);
    	$sallary->delete();
    	Toastr::success('Employee Sallary Delete Successfully:','Success');
	    return redirect()->route('sallary.setuplist');

    }

    public function payment()
    {
    	$role = 0;
        $roles = Role::whereNotIn('id', [AppHelper::USER_ADMIN, AppHelper::USER_STUDENT, AppHelper::USER_PARENTS])->pluck('name', 'id');
    	return view('backend.sallary.payment',compact('role','roles'));
    }

    public function sallaryinfo(Request $request)
    {
    	$set =SallarySet::where('role_id',$request->role_id)
    	                        ->where('employee_id',$request->employee)
    	                        ->where('status',true)
    	                        ->first();
    	return $set;                        
    }

   public function paymentprint($id)
   {
    $pay =SallaryPayment::find($id);
      $appSettings = AppHelper::getAppSettings();
   return view('backend.sallary.paymentprint',compact('pay','appSettings'));
   }

   public function checkpayment(Request $request)
   {
    $pay =SallaryPayment::where('employee_id',$request->employee)->where('pay_month',$request->pay_month)->first();
    return $pay;
   }
    public function postpayment(Request $request)
    {
    $rules = [

      'role_id' => 'required',
      'employee_id' => 'required',
      'basic_sallary' => 'required',
      'house_rent' => 'required',
      'medical_allowance' => 'required',
      'Transport_allowance' => 'required',
      'insurance' => 'required',
      'extra_over_time' => 'required',
      'pay_date' => 'required',
      'pay_month' => 'required',
      'pay_amt' => 'required',
      'status' => 'required',
      'mode' => 'required',

    ];
    $validator = \Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return Redirect::to('/sallary/payment')->withErrors($validator);
    }

    else
    {
      $payment =new SallaryPayment;
      $payment->role_id =$request->role_id;
      $payment->employee_id =$request->employee_id;
      $payment->pay_date =$request->pay_date;
      $payment->pay_month =$request->pay_month;
      $payment->pay_amt =$request->pay_amt;
      $payment->mode =$request->mode;
      $payment->check_num =$request->check_num;
      $payment->bank_name =$request->bank_name;
      $payment->status =$request->status;
      $payment->save();
      return redirect()->route('sallary.payment.print',$payment->id);

    }
    }

    public function report()
    {
        $role = 0;
        $roles = Role::whereNotIn('id', [AppHelper::USER_ADMIN, AppHelper::USER_TEACHER, AppHelper::USER_STUDENT, AppHelper::USER_PARENTS])->pluck('name', 'id');
      return view('backend.sallary.report',compact('role','roles'));
    }

    public function employee_sallary_report($employee,$fdate,$tdate)
    {
      $report =SallaryPayment::where('employee_id',$employee)
                              ->where('pay_month','>=',$tdate)
                              ->where('pay_month','<=',$fdate)
                              ->get();
       $appSettings = AppHelper::getAppSettings();                        
      return view('backend.sallary.sallarysheetprint',compact('report','appSettings'));                        
    }

    public function employee_allsallary_report($fdate,$tdate)
    {
     $report =SallaryPayment::where('pay_month','>=',$tdate)
                              ->where('pay_month','<=',$fdate)
                              ->get();
       $appSettings = AppHelper::getAppSettings();                        
      return view('backend.sallary.tsallarysheetprint',compact('report','appSettings'));  
    }
}
