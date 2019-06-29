<?php

namespace App\Http\Controllers\Backend;

use App\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HolidayController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$holidays = Holiday::where('status', 1)->get();
		return View::Make('backend.teacher.holiday.list', compact('holidays'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$rules = [
			'holiDate' => 'required',
		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('/holiday/create')->withErrors($validator);
		} else {

			$holiDayStart = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('holiDate'));
			$holiDayEnd = null;
			if (strlen(Input::get('holiDateEnd'))) {
				$holiDayEnd = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('holiDateEnd'));
			}

			$dateList = [];

			$desc = Input::get('description');

			if ($holiDayEnd) {
				if ($holiDayEnd < $holiDayStart) {
					$messages = $validator->errors();
					$messages->add('Wrong Input!', 'Date End can\'t be less than start date!');
					return Redirect::to('/holidays')->withErrors($messages)->withInput();
				}

				$start_time = strtotime($holiDayStart);
				$end_time = strtotime($holiDayEnd);
				for ($i = $start_time; $i <= $end_time; $i += 86400) {
					$dateList[] = [
						'holiDate' => date('Y-m-d', $i),
						'description' => $desc,
						'created_at' => \Carbon\Carbon::now(),
						'status' => 1,
					];

				}

			} else {
				$dateList[] = [
					'holiDate' => $holiDayStart->format('Y-m-d'),
					'description' => $desc,
					'created_at' => \Carbon\Carbon::now(),
					'status' => 1,
				];
			}
			//dd($dateList);
			Holiday::insert($dateList);

			return Redirect::to('/holidays')->with("success", "Holidays added succesfully.");

		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$holiDay = Holiday::findOrFail($id);
		$holiDay->status = 0;
		$holiDay->save();

		return Redirect::to('/holidays')->with("success", "Holiday Deleted Succesfully.");
	}
}
