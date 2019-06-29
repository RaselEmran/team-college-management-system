<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use App\AccountSector;
use App\Accounting;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class AccountingController extends Controller
{
   
   public function sectors()
	{

		$sectors=AccountSector::all();
		$sector = array();
		return View::Make('backend.account.accountsector',compact('sectors','sector'));
	}

  public function sectorCreate()
	{
		$rules=[
			'name' => 'required',
			'type' => 'required'

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/accounting/sectors')->withInput(Input::all())->withErrors($validator);
		}
		else {
			$sector = new AccountSector();
			$sector->name= Input::get('name');
			$sector->type=Input::get('type');
			$sector->save();
			 Toastr::success('Accounting Sector Created Succesfully:','Success');
			return Redirect::to('/accounting/sectors');

		}
	}

   public function sectorEdit($id)
	{
		$sectors= array();
		$sector = AccountSector::find($id);
		return View::Make('backend.account.accountsector',compact('sectors','sector'));
	}

	public function sectorUpdate()
	{
		$rules=[
			'name' => 'required',
			'type' => 'required'

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/accounting/sectoredit/'.Input::get('id'))->withInput(Input::all())->withErrors($validator);
		}
		else {
			$sector = AccountSector::find(Input::get('id'));
			$sector->name= Input::get('name');
			$sector->type=Input::get('type');
			$sector->save();
			 Toastr::success('Accounting Sector Updated Succesfully:','Success');
			return Redirect::to('/accounting/sectors');

		}
	}

  public function sectorDelete()
	{
		$sector = AccountSector::find(Input::get('hiddenId'));
		$sector->delete();
         Toastr::success('Accounting Sector Deleted Succesfully:','Success');
		return Redirect::to('/accounting/sectors');
	}

  public function  income()
	{
		$sectors = AccountSector::where('type','=','Income')->orderby('id','asc')->get();
		return View::Make('backend.account.accountIncome',compact('sectors'));

	}

	public function  incomeCreate()
	{

			$sectors = Input::get('name');
			$amount = Input::get('amount');
			$date = Input::get('date');
			$desc = Input::get('description');
			if(count($amount)>0){
            $counter=0;
			for ($i=0; $i <count($amount) ; $i++) { 
				if ($amount[$i] !=null && $date[$i] !=null) {
				
			    $income = new Accounting();
			    $income->name = $sectors[$i];
			    $income->type="Income";
			    $income->amount = $amount[$i];
				$income->description = $desc[$i];

				$income->date = $date[$i];
				$income->year = date('Y');
				$income->save();
			    $counter++;
			  }

			}
			Toastr::success($counter.'s income saved Succesfully:','Success');
			return Redirect::to('/accounting/income')->with("success",$counter."'s income saved Succesfully.");
		}
		else
		{
	      Toastr::warning('atlest one income add:','Warning');
		 return Redirect::to('/accounting/income');
		}
	

	}

	public  function incomeList()
	{
		$incomes = array();
		return View::Make('backend.account.accountIncomeView',compact('incomes'));
	}

	public function incomeListPost()
	{
		$incomes =Accounting::where('type','Income')
		                     ->where('year',Input::get('year'))
		                     ->get();
		return View::Make('backend.account.accountIncomeView',compact('incomes'));                     

	}

	public function  incomeEdit($id)
	{
		$income = Accounting::find($id);
		return View::Make('backend.account.accountIncomeEdit',compact('income'));
	}

	public function incomeUpdate()
	{
		$rules=[
			'name' => 'required',
			'amount' => 'required|numeric',
			'date'   => 'required'

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/accounting/incomeedit/'.Input::get('id'))->withErrors($validator);
		}
		else {
			$income = Accounting::find(Input::get('id'));
			$income->amount=Input::get('amount');
			$income->description=Input::get('description');
			$income->date=Input::get('date');
			$income->save();
           	Toastr::success('Income Updated Succesfully:','Success');
			return Redirect::to('/accounting/incomelist');
		}
	}

	public function incomeDelete()
	{
		$income = Accounting::find(Input::get('hiddenId'));
		$income->delete();
		 Toastr::success('Income Deleted Succesfully:','Success');
		return Redirect::to('/accounting/incomelist');
	}

	public function  expence()
	{
		$sectors = AccountSector::select('id','name')->where('type','=','Expence')->orderby('id','asc')->get();
		return View::Make('backend.account.accountExpence',compact('sectors'));

	}

	public function expenceCreate()
	{

			$sectors = Input::get('name');
			$amount = Input::get('amount');
			$date = Input::get('date');
			$desc = Input::get('description');
			if(count($amount)>0){
            $counter=0;
			for ($i=0; $i <count($amount) ; $i++) { 
				if ($amount[$i] !=null && $date[$i] !=null) {
				
			    $expense = new Accounting();
			    $expense->name = $sectors[$i];
			    $expense->type="Expence";
			    $expense->amount = $amount[$i];
				$expense->description = $desc[$i];

				$expense->date = $date[$i];
				$expense->year = date('Y');
				$expense->save();
			    $counter++;
			  }

			}
			Toastr::success($counter.'s expense saved Succesfully:','Success');
			return Redirect::to('accounting/expence')->with("success",$counter."'s expense saved Succesfully.");
		}
		else
		{
	      Toastr::warning('atlest one income add:','Warning');
		 return Redirect::to('accounting/expence');
		}
	}

	public  function expenceList()
	{
		$expenses = array();
		return View::Make('backend.account.accountExpenceView',compact('expenses'));
	}

	public function expenceListPost()
	{
		$expenses =Accounting::where('type','Expence')
		                     ->where('year',Input::get('year'))
		                     ->get();
		return View::Make('backend.account.accountExpenceView',compact('expenses'));                     

	}

	public function  expenceEdit($id)
	{
		$expence = Accounting::find($id);
		return View::Make('backend.account.accountExpenceEdit',compact('expence'));
	}

	public function expenceUpdate()
	{
		$rules=[
			'name' => 'required',
			'amount' => 'required|numeric',
			'date'   => 'required'

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/accounting/expencelist'.Input::get('id'))->withErrors($validator);
		}
		else {
			$income = Accounting::find(Input::get('id'));
			$income->amount=Input::get('amount');
			$income->description=Input::get('description');
			$income->date=Input::get('date');
			$income->save();
           	Toastr::success('Expense Updated Succesfully:','Success');
			return Redirect::to('/accounting/expencelist');
		}
	}


	public function expenceDelete()
	{
		$expense = Accounting::find(Input::get('hiddenId'));
		$expense->delete();
		 Toastr::success('Expense Deleted Succesfully:','Success');
		return Redirect::to('/accounting/expencelist');
	}

	public  function getReport()
	{
		$datas=array();
		return View::Make('backend.account.accountingReport',compact('datas'));
	}

   public  function printReport($rtype,$fdate,$tdate)
	{
     
     $report =Accounting::where('type',$rtype)
     					 ->where('date','>=',$fdate)
     					 ->where('date','<=',$tdate)
     					 ->get();

       $appSettings = AppHelper::getAppSettings();
     return View::Make('backend.account.accountreportprint', compact('report','appSettings'));    					 
	}

	public  function  getReportsum()
	{
		return View::Make('backend.account.accountingReportsum');

	}

	public  function  printReportsum($fdate,$tdate)
	{
   
       $incomes =Accounting::where('type','Income')
     					 ->where('date','>=',$fdate)
     					 ->where('date','<=',$tdate)
     					 ->get();  

       $expenses =Accounting::where('type','Expence')
     					 ->where('date','>=',$fdate)
     					 ->where('date','<=',$tdate)
     					 ->get();
       $appSettings = AppHelper::getAppSettings(); 					 
       return View::Make('backend.account.accountreportprintsum', compact('incomes','expenses','appSettings'));					 

	}

}
