<?php

namespace App\Http\Controllers\Backend;

use App\ClassOff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ClassOffController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$offdays = ClassOff::where('status', 1)->get();
		return View::Make('backend.student.class-off.list', compact('offdays'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$rules = [
			'offDate' => 'required',
			'oType' => 'required',

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/class-off')->withErrors($validator);
		} else {

			$offDateStart = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('offDate'));
			$offDateEnd = null;
			if (strlen(Input::get('offDateEnd'))) {
				$offDateEnd = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('offDateEnd'));
			}

			$offList = [];
			$desc = Input::get('description');
			$oType = Input::get('oType');

			if ($offDateEnd) {
				if ($offDateEnd < $offDateStart) {
					$messages = $validator->errors();
					$messages->add('Wrong Input!', 'Date End can\'t be less than start date!');
					return Redirect::to('/class-off')->withErrors($messages)->withInput();
				}

				$start_time = strtotime($offDateStart);
				$end_time = strtotime($offDateEnd);
				for ($i = $start_time; $i <= $end_time; $i += 86400) {
					$offList[] = [
						'offDate' => date('Y-m-d', $i),
						'created_at' => \Carbon\Carbon::now(),
						'updated_at' => \Carbon\Carbon::now(),
						'description' => $desc,
						'oType' => $oType,
						'status' => 1,
					];

				}

			} else {
				$offList[] = [
					'offDate' => $offDateStart->format('Y-m-d'),
					'created_at' => \Carbon\Carbon::now(),
					'updated_at' => \Carbon\Carbon::now(),
					'description' => $desc,
					'oType' => $oType,
					'status' => 1,
				];
			}

			ClassOff::insert($offList);

			return Redirect::to('/class-off')->with("success", "Class off entry added.");
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$classOff = ClassOff::where('status', 1)->where('id', $id)->first();

		if (!$classOff) {
			return Redirect::to('/class-off')->with("error", "Class off entry not found!");

		}
		$classOff->status = 0;
		$classOff->save();

		return Redirect::to('/class-off')->with("success", "Class off entry deleted successfully.");
	}
}
