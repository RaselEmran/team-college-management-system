<?php

namespace App\Http\Controllers\Backend;

use App\IClass;
use App\Section;
use App\AcademicYear;
use App\Book;
use App\bookStock;
use App\Issuebook;
use App\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class LibraryController extends Controller
{
    

public function getAddbook()
	{
		$classes =IClass::all();
		return View::Make('backend.library.addbook',compact('classes'));
	}


	public function postAddbook()
	{
		$rules=[
			'title' => 'required|max:250',
			'author' => 'required|max:100',
			'type' => 'required',
			'class' => 'required'
		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/library/addbook')->withErrors($validator)->withInput();
		}
		else {
			$book=Book::select('*')->where('code',Input::get('code'))->get();
			if(count($book)>0)
			{
				$errorMessages = new Illuminate\Support\MessageBag;
				$errorMessages->add('deplicate', 'Book Code allready exists!!');
				return Redirect::to('/library/addbook')->withInput()->withErrors($errorMessages);
			}
			else {
				 $uid =substr(uniqid('', true), -4).substr(number_format(time() * rand(),0,'',''),0,2);
				 $count =Book::count();
            if ($count>0) {
             $code ='BO0'.$uid.$count;
             }
            else
             {
            $code ="BO00".$uid;
              }
				$book = new Book();
				$book->code = $code;
				$book->title = Input::get('title');
				$book->author = Input::get('author');
				$book->quantity = Input::get('quantity');
				$book->rackNo = Input::get('rackNo');
				$book->rowNo = Input::get('rowNo');
				$book->type = Input::get('type');
				$book->class = Input::get('class');
				$book->desc = Input::get('desc');
				$book->save();
				
				$book_stocks =new bookStock();
				$book_stocks->code =$code;
				$book_stocks->quantity =Input::get('quantity');
                $book_stocks->save();

				 Toastr::success('Book added to library Succesfully:','Success');
				return Redirect::to('/library/addbook');

			}
		}

	}

 public function getsearch()
 {
	$classes = IClass::all();
	$books =array();
	return View::Make('backend.library.booksearch',compact('classes','books'));
 }

public function postsearch()
{
	if(Input::get('code')!="" || Input::get('title')!="" || Input::get('author') !="")
	{

		$books =Book::where('books.code','=',Input::get('code'))
		             ->orWhere('books.title','LIKE','%'.Input::get('title').'%')
		             ->orWhere('books.author','LIKE','%'.Input::get('author').'%')
		             ->get();

		$classes =IClass::select('name','id');
		return View::Make('backend.library.booksearch',compact('books','classes'));

	}
	else {
        Toastr::warning('Please Fill up atlest one field:','Warning');
		return Redirect::to('/library/search');

	}
}

public function postsearch2()
{
	$rules=[
		'type' => 'required',
		'class' => 'required',


	];
	$validator = \Validator::make(Input::all(), $rules);
	if ($validator->fails())
	{
		return Redirect::to('/library/search')->withErrors($validator);
	}
	else {

			$books =Book::where('books.class',Input::get('class'))
			->where('books.type',Input::get('type'))->get();
		$classes = IClass::select('name','id');
		return View::Make('backend.library.booksearch',compact('books','classes'));

	}
}

public function getissueBookview()
{

	return View::Make('backend.library.bookissueview');
}

public function postissueBookview()
{

	if(Input::get('status')!="")
	{
		$books = Issuebook::select('*')
		->Where('Status','=',Input::get('status'))
		->get();
		return View::Make('backend.library.bookissueview',compact('books'));
	}
	if(Input::get('regiNo')!="" || Input::get('code') !="" || Input::get('issueDate') !="" || Input::get('returnDate') !="")
	{

		$books = Issuebook::select('*')->where('regiNo','=',Input::get('regiNo'))
		->orWhere('code','=',Input::get('code'))
		->orWhere('issueDate','=',$this->parseAppDate(Input::get('issueDate')))
		->orWhere('returnDate','=',$this->parseAppDate(Input::get('returnDate')))

		->get();
		return View::Make('backend.library.bookissueview',compact('books'));

	}
	else {
        
        Toastr::warning('Pleae fill up at least one feild!:','Warning');

		return Redirect::to('/library/issuebookview');

	}

}

public function getissueBookupdate($id)
{
	$book= Issuebook::find($id);
	return View::Make('backend.library.bookissueedit',compact('book'));
}


public function postissueBookupdate()
{
	$rules=[
		'regiNo' => 'required|max:20',
		'code' => 'required|max:50',
		'issueDate' => 'required',
		'returnDate' => 'required',
		'status' => 'required',

	];
	$validator = \Validator::make(Input::all(), $rules);
	if ($validator->fails())
	{
		return Redirect::to('/library/issuebookupdate/'.Input::get('id'))->withErrors($validator);
	}
	else {
		if (Input::get('status')=='Returned') {

        $book_stocks =bookStock::where('code',Input::get('code'))->first();
        $stk =$book_stocks->quantity;
        $rem =$stk+Input::get('quantity');
        $book_stocks->quantity=$rem;
        $book_stocks->save();

    }


		$book = Issuebook::find(Input::get('id'));
		$book->code = Input::get('code');
		$book->regiNo = Input::get('regiNo');
		$book->issueDate = Input::get('issueDate');
		$book->returnDate = Input::get('returnDate');
		$book->fine = Input::get('fine');
		$book->Status = Input::get('status');
		$book->save();
		 Toastr::success('Succesfully book record updated:','Success');
		return Redirect::to('/library/issuebookview');

	}
}

public function getissueBook()
	{
		
         $students = Registration::with('student')
            ->get();
		$books = Book::all();
		return View::Make('backend.library.bookissue',compact('students','books'));
	}



	public function checkBookAvailability($code,$quantity)
{

	$availabeQuantity=DB::table('book_stocks')
	->select('quantity')
	->where('code',$code)->first();
	 $availabeQuantity->quantity;
	$result = "Yes";
	if($quantity>$availabeQuantity->quantity)
	$result = "No";
	return ["isAvailable" => $result ];
	

}


	public function postissueBook()
	{

		$rules=[
			'regiNo' => 'required',
			'bookCode' => 'required',
			'quantity' => 'required',
			'issueDate' => 'required',
			'returnDate' => 'required',

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/library/issuebook')->withErrors($validator)->withInput();
		}
		else {
 $code =Input::get('bookCode');
 $regiNo =Input::get('regiNo');
 $issueDate =Input::get('issueDate');
 $quantity =Input::get('quantity');
 $returnDate =Input::get('returnDate');
 $fine =Input::get('fine');

 for ($i=0; $i <count($code) ; $i++) { 

	$book_stocks =bookStock::where('code',$code[$i])->first();
	$stk =$book_stocks->quantity;
	$rem =$stk-$quantity[$i];
	$book_stocks->quantity =$rem;
	$book_stocks->save();

	$Issuebook =new Issuebook();
	$Issuebook->regiNo=$regiNo;
	$Issuebook->code=$code[$i];
 	$Issuebook->quantity=$quantity[$i];
	$Issuebook->issueDate=$issueDate;
	$Issuebook->returnDate=$returnDate[$i];
	$Issuebook->fine=$fine[$i];
	$Issuebook->save();
	
}
		Toastr::success('Succesfully book borrowed for:','Success');
		return Redirect::to('/library/issuebook');

	}

}

	public function getviewbook()
	{
		$classes = IClass::select('name','id');
		$books=array();
		return View::Make('backend.library.booklist',compact('classes','books'));
	}

   public function postviewbook()
	{

		if(Input::get('classcode')=="All"){
			$books=Book::leftJoin('i_classes', function($join) {
				$join->on('Books.class', '=', 'i_classes.id');
			})
			->select('books.id', 'books.code', 'books.title', 'books.author','books.quantity','books.rackNo','books.rowNo','books.type','books.desc',DB::raw("IFNULL(i_classes.name,'All') as class"))

			->orderBy('id', 'desc')->get();

		}
		else {

			$books = DB::table('books')
			->join('i_classes', 'books.class', '=', 'i_classes.id')
			->select('books.id', 'books.code', 'books.title', 'books.author','books.quantity','books.rackNo','books.rowNo','books.type','books.desc','i_classes.name as class')
			->where('books.class',Input::get('classcode'))->orderBy('id', 'desc')->get();
		}

		$classes = IClass::select('name','id');
		return View::Make('backend.library.booklist',compact('classes','books'));

	}

	public function getBook($id)
	{
		$classes = IClass::select('name','id');
		$book= Book::select('*')->find($id);
		return View::Make('backend.library.bookedit',compact('classes','book'));
	}

	public function postUpdateBook()
	{
		$rules=[
			'code' => 'required|max:50',
			'title' => 'required|max:250',
			'author' => 'required|max:100',
			'type' => 'required',
			'class' => 'required'
		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/library/edit/'.Input::get('id'))->withErrors($validator)->withInput();
		}
		else {

			$book = Book::find(Input::get('id'));
			//$book->code = Input::get('code');
			$book->title = Input::get('title');
			$book->author = Input::get('author');
			$book->quantity = Input::get('quantity');
			$book->rackNo = Input::get('rackNo');
			$book->rowNo = Input::get('rowNo');
			$book->type = Input::get('type');
			$book->class = Input::get('class');
			$book->desc = Input::get('desc');
			$book->save();
			 Toastr::success('Book updated Succesfully:','Success');
			return Redirect::to('/library/view-show');

		}

	}

	public function deleteBook($id)
	{
		$book = BookS::find($id);
		$book->delete();
		 Toastr::success('Book updated Succesfully:','Success');
		return Redirect::to('/library/view');
	}


	private function  parseAppDate($datestr)
	{
		$date = explode('/', $datestr);
		return $date[2].'-'.$date[1].'-'.$date[0];
	}

	public function getReports()
   {

	return View::Make('backend.library.libraryReports');
   }

   public function Reportprint($do)
{
	if($do=="today")
	{
		$todayReturn = DB::table('issuebooks')
		   ->join('registrations', 'issuebooks.regiNo', '=', 'registrations.regi_no')
            ->join('books','books.code','=','issuebooks.code')
            ->join('students', 'students.id', '=', 'registrations.student_id')
            ->select('issuebooks.quantity','issuebooks.fine','books.*','registrations.*','students.name')
		->where('issuebooks.returnDate',date('Y-m-d'))
		->where('issuebooks.Status','Borrowed')
		->get();
		$rdata =array('name'=>'Today Return List','total'=>count($todayReturn));

		$datas=$todayReturn;
		 $appSettings = AppHelper::getAppSettings();
		return View::Make('backend.library.libraryreportprinttex',compact('datas','rdata','appSettings'));

	}
	else if($do=="expire")
	{

		$expires = DB::table('issuebooks')
		   ->join('registrations', 'issuebooks.regiNo', '=', 'registrations.regi_no')
            ->join('books','books.code','=','issuebooks.code')
            ->join('students', 'students.id', '=', 'registrations.student_id')
            ->select('issuebooks.quantity','issuebooks.fine','books.*','registrations.*','students.name')
		->where('issuebooks.returnDate','<',date('Y-m-d'))
		 ->where('issuebooks.Status','Borrowed')
		->get();
		$rdata =array('name'=>'Today Expire List','total'=>count($expires));

		$datas=$expires;
	 $appSettings = AppHelper::getAppSettings();
		return View::Make('backend.library.libraryreportprinttex',compact('datas','rdata','appSettings'));
	}
	else {
		echo 'kkkkkk';
		$books = Book::select('*')->where('type',$do)->get();
		$rdata =array('name'=>$do,'total'=>count($books));

		$datas=$books;
		$appSettings = AppHelper::getAppSettings();
		return View::Make('backend.library.libraryreportbooks',compact('datas','rdata','appSettings'));
	}
}

public function getReportsFine()
{
	return View::Make('backend.library.libraryfinereport');
}

public function ReportsFineprint($month)
{
	$sqlraw="select sum(fine) as totalFine from issuebooks where Status='Returned' and EXTRACT(YEAR_MONTH FROM returnDAte) = EXTRACT(YEAR_MONTH FROM '".$month."')";
	$fines = DB::select(DB::RAW($sqlraw));
	if($fines[0]->totalFine)
	{

		$total=$fines[0]->totalFine;
	}
	else
	{
		$total=0;
	}
	$appSettings = AppHelper::getAppSettings();
	$rdata =array('month'=>date('F-Y', strtotime($month)),'name'=>'Monthly Fine Collection Report','total'=>$total);
	return View::Make('backend.library.libraryfinereportprint',compact('rdata','appSettings'));


}
}
