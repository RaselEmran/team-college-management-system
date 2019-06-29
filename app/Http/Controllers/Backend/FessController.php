<?php

namespace App\Http\Controllers\Backend;

use App\FeeSetup;
use App\Http\Controllers\Controller;
use App\IClass;
use App\Section;
use App\AcademicYear;
use App\FeeCollection;
use App\FeeHistory;
use App\StudentFees;
use App\Registration;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class FessController extends Controller {

	public function getsetuplist() {
		$fees = array();
		$classes = IClass::all();
		$fees = FeeSetup::all();
		return View::Make('backend.fees.feesSetuplist', compact('classes', 'fees'));
	}

	public function getsetup() {
		$classes = IClass::orderby('id', 'asc')->get();
		$academic_years =AcademicYear::all();
		return view('backend.fees.feesSetup', compact('classes','academic_years'));
	}

	public function postSetup() {
		$rules = [

			'class_id' => 'required',
			'academic_year_id' => 'required',
			'type' => 'required',
			'fee' => 'required|numeric',
			'title' => 'required',

		];
		$validator = \Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/fees/setup')->withErrors($validator);
		} else {

			$fee = new FeeSetup();

			$fee->class_id = Input::get('class_id');
			$fee->academic_year_id = Input::get('academic_year_id');
			$fee->type = Input::get('type');
			$fee->title = Input::get('title');
			$fee->fee = Input::get('fee');
			$fee->Latefee = Input::get('Latefee');
			$fee->description = Input::get('description');
			$fee->save();
			return Redirect::to('/fees/setup')->with("success", "Fee Save Succesfully.");

		}
	}

	public function feessetup_edit($id) {
		$classes = IClass::all();
		$academic_years =AcademicYear::all();
		$fee = FeeSetup::find($id);
		return View::Make('backend.fees.feesSetup_edit', compact('fee', 'classes','academic_years'));
	}

	public function feessetup_update() {
		$rules = [

			'class_id' => 'required',
			'type' => 'required',
			'fee' => 'required|numeric',
			'title' => 'required',
		];
		$validator = \Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/fee/edit/' . Input::get('id'))->withErrors($validator);
		} else {

			$fee = FeeSetup::find(Input::get('id'));
			$fee->class_id = Input::get('class_id');
			$fee->type = Input::get('type');
			$fee->title = Input::get('title');
			$fee->fee = Input::get('fee');
			$fee->Latefee = Input::get('Latefee');
			$fee->description = Input::get('description');
			$fee->save();
			return Redirect::to('/fees/setup/list')->with("success", "Fee Updated Succesfully.");

		}
	}

	public function feessetup_destroy() {

		$fee = FeeSetup::find(Input::get('hiddenId'));

		$fee->delete();
		//todo: need protection to massy events. like modify after used or delete after user
		return Redirect::to('/fees/setup/list')->with('success', 'Fee Setup Deleted!');
	}

	public function getCollection() {
		$classes = IClass::orderby('id', 'asc')->get();
		$section =Section::all();
		$academicYear =AcademicYear::all();
		return View::Make('backend.fees.feeCollection', compact('classes','section','academicYear'));
	}

	public function getListjson($class,$type,$student)
	{
		$fees= StudentFees::where('class_id','=',$class)->where('regi_num','=',$student)->where('type','=',$type)->get();
		return $fees;
	}

	public function getFeeInfo($id,$stdid)
	{
		$fee= StudentFees::where('regi_num','=',$stdid)->where('feeid',$id)->get();
		return $fee;
	}

	public function getDue($class,$stdId)
	{
		$due = FeeCollection::select(DB::RAW('IFNULL(sum(payableAmount),0)- IFNULL(sum(paidAmount),0) as dueamount'))
		->where('class_id',$class)
		->where('regi_no',$stdId)
		->first();
		return $due->dueamount;

	}

	public function postCollection()
	{

		$rules=[

			'class_id' => 'required',
			'regi_no' => 'required',
			'date' => 'required',
			'paidamount' => 'required',
			'dueamount' => 'required',
			'ctotal' => 'required'

		];
		$validator = \Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('/fees/collection')->withInput(Input::all())->withErrors($validator);
		}
		else {
			try {
				$feeTitles = Input::get('gridFeeTitle');
				$feeAmounts = Input::get('gridFeeAmount');
				$feeLateAmounts = Input::get('gridLateFeeAmount');
				$feeTotalAmounts = Input::get('gridTotal');
				$feeMonths = Input::get('gridMonth');
				$counter = count($feeTitles);
				if($counter>0)
				{
					$rows = FeeCollection::count();
					if($rows<9)
					{
						$billId='B00'.($rows+1);
					}
					else if($rows<100)
					{
						$billId='B0'.($rows+1);
					}
					else {
						$billId='B'.($rows+1);
					}
					DB::transaction(function() use ($billId,$counter,$feeTitles,$feeAmounts,$feeLateAmounts,$feeTotalAmounts,$feeMonths)
					{
						$feeCol = new FeeCollection();
						$feeCol->billNo=$billId;
						$feeCol->class_id=Input::get('class_id');
						$feeCol->regi_no=Input::get('regi_no');
						$feeCol->academic_year_id=Input::get('academic_year_id');

						$feeCol->payableAmount=Input::get('ctotal');
						$feeCol->paidAmount=Input::get('paidamount');
						$feeCol->dueAmount=Input::get('dueamount');
						$feeCol->payDate=Input::get('date');
						$feeCol->save();
                      
						for ($i=0;$i<$counter;$i++) {
							$feehistory = new FeeHistory();
							$feehistory->billNo=$billId;
							$feehistory->regi=Input::get('regi_no');
							$feehistory->title=$feeTitles[$i];
							$feehistory->fee=$feeAmounts[$i];
							$feehistory->lateFee=$feeLateAmounts[$i];
							$feehistory->total=$feeTotalAmounts[$i];
							$feehistory->month=$feeMonths[$i];
							$feehistory->save();

						}
					});
					return redirect()->route('student.fee.print',$billId);
				}
				else {
					Toastr::warning('Please Add Atlest one Fee:','Warning');
					return Redirect::to('/fees/collection')->withInput(Input::all());

				}
			}
			catch(\Exception $e)
			{
               Toastr::warning('Please Add Atlest one Fee:','Warning');
				return Redirect::to('/fees/collection')->withInput();
			}

		}
	}

	public function stdfeeview()
	{
	    $classes = IClass::orderby('id', 'asc')->get();
		$section =Section::all();
		$academicYear =AcademicYear::all();
		$fees=array();
		$student ="";
		return View::Make('backend.fees.feeviewstd',compact('classes','section','fees','academicYear','student'));
	}


	public function stdfeeviewpost()
	{
		$classes = IClass::all();
	    $section =Section::all();
		$academicYear =AcademicYear::all();
		$regi =Input::get('student');
		$fees=DB::Table('fee_collections')
		->select(DB::RAW("billNo,payableAmount,paidAmount,dueAmount,DATE_FORMAT(payDate,'%D %M,%Y') AS date"))
		->where('class_id',Input::get('class_id'))
		->where('regi_no',Input::get('student'))
		->get();
		$totals = FeeCollection::select(DB::RAW('IFNULL(sum(payableAmount),0) as payTotal,IFNULL(sum(paidAmount),0) as paiTotal,(IFNULL(sum(payableAmount),0)- IFNULL(sum(paidAmount),0)) as dueamount'))
		->where('class_id',Input::get('class_id'))
		->where('regi_no',Input::get('student'))
		->first();
		if ($totals->payTotal) {
		return View::Make('backend.fees.feeviewstd',compact('classes','section','academicYear','fees','totals','regi'));
		}
		else
		{
			Toastr::warning('The Student Have no fee yet:','Warning');
			return redirect()->back();
		}
	}


	public function reportstd($regiNo)
	{

		$datas=DB::Table('fee_collections')
		->select(DB::RAW("payableAmount,paidAmount,dueAmount,DATE_FORMAT(payDate,'%D %M,%Y') AS date"))
		->where('regi_no',$regiNo)
		->get();
		$totals = FeeCollection::select(DB::RAW('IFNULL(sum(payableAmount),0) as payTotal,IFNULL(sum(paidAmount),0) as paiTotal,(IFNULL(sum(payableAmount),0)- IFNULL(sum(paidAmount),0)) as dueamount'))
		->where('regi_no',$regiNo)
		->first();
		$info =FeeCollection::where('regi_no',$regiNo)
		->first();
		$stdinfo=DB::table('fee_collections')
		->join('registrations', 'registrations.regi_no', '=', 'fee_collections.regi_no')
		->join('students', 'registrations.student_id', '=', 'students.id')
		->select('registrations.*', 'students.*')
		->where('fee_collections.regi_no',$regiNo)
		->first();
		  $appSettings = AppHelper::getAppSettings();
		$rdata =array('payTotal'=>$totals->payTotal,'paiTotal'=>$totals->paiTotal,'dueAmount'=>$totals->dueamount);
		return View::Make('backend.fees.feestdreportprint',compact('datas','rdata','info','stdinfo','appSettings'));
	

	}



	public function billDetails($billNo)
	{
		$billDeatils = FeeHistory::select("*")
		->where('billNo',$billNo)
		->get();
		return $billDeatils;
	}


	public function report()
	{
		return View::Make('backend.fees.feesreport');
	}


	public function reportprint($sDate,$eDate)
	{
		$datas= FeeCollection::select(DB::RAW('IFNULL(sum(payableAmount),0) as payTotal,IFNULL(sum(paidAmount),0) as paiTotal,(IFNULL(sum(payableAmount),0)- IFNULL(sum(paidAmount),0)) as dueamount'))
		->whereDate('created_at', '>=', date($sDate))
		->whereDate('created_at', '<=', date($eDate))
		->first();
		  $appSettings = AppHelper::getAppSettings();
		$rdata =array('sDate'=>$this->getAppdate($sDate),'eDate'=>$this->getAppdate($eDate));
		return View::Make('backend.fees.feesreportprint',compact('datas','rdata','appSettings'));
	}

		private function  parseAppDate($datestr)
	{
		$date = explode('/', $datestr);
		return $date[2].'-'.$date[1].'-'.$date[0];
	}
	private function  getAppdate($datestr)
	{
		$date = explode('-', $datestr);
		return $date[2].'/'.$date[1].'/'.$date[0];
	}

	public function feeprint($id)
	{
		$feecolect =FeeCollection::where('billNo',$id)->first();
		 $appSettings = AppHelper::getAppSettings();
		return View::Make('backend.fees.feecollectprint',compact('feecolect','appSettings'));
	}

	public function get_studentduefee()
	{
    $collect =FeeCollection::where('regi_no',Input::get('student'))->get();
    $total =$collect->sum('paidAmount');
    $full =Registration::where('regi_no',Input::get('student'))->first();
    $due =$full->fee_total-$total;
    return $due;
	}
}
