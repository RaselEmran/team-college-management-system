<?php

use App\Http\Helpers\AppHelper;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Route::group(['middleware' => 'role:admin'], function() {
//    Route::get('/admin', function() {
//        return 'Welcome Admin';
//    });
//});

/**
 * Admin panel routes goes below
 */
Route::group(
	['namespace' => 'Backend', 'middleware' => ['guest']], function () {
		Route::get('/login', 'UserController@login')->name('login');
		Route::post('/login', 'UserController@authenticate');
		Route::get('/forgot', 'UserController@forgot')->name('forgot');
		Route::post('/forgot', 'UserController@forgot')
			->name('forgot');
		Route::get('/reset/{token}', 'UserController@reset')
			->name('reset');
		Route::post('/reset/{token}', 'UserController@reset')
			->name('reset');

	}
);

Route::group(
	['namespace' => 'Backend', 'middleware' => ['auth', 'permission']], function () {
		Route::get('/logout', 'UserController@logout')->name('logout');
		Route::get('/lock', 'UserController@lock')->name('lockscreen');
		Route::get('/dashboard', 'UserController@dashboard')->name('user.dashboard');

		//user management
		Route::resource('user', 'UserController');
		Route::get('/profile', 'UserController@profile')
			->name('profile');
		Route::post('/profile', 'UserController@profile')
			->name('profile');
		Route::get('/change-password', 'UserController@changePassword')
			->name('change_password');
		Route::post('/change-password', 'UserController@changePassword')
			->name('change_password');
		Route::post('user/status/{id}', 'UserController@changeStatus')
			->name('user.status');
		Route::any('user/{id}/permission', 'UserController@updatePermission')
			->name('user.permission');

		//user notification
		Route::get('/notification/unread', 'NotificationController@getUnReadNotification')
			->name('user.notification_unread');
		Route::get('/notification/read', 'NotificationController@getReadNotification')
			->name('user.notification_read');
		Route::get('/notification/all', 'NotificationController@getAllNotification')
			->name('user.notification_all');

		//system user management
		Route::get('/administrator/user', 'AdministratorController@userIndex')
			->name('administrator.user_index');
		Route::get('/administrator/user/create', 'AdministratorController@userCreate')
			->name('administrator.user_create');
		Route::post('/administrator/user/store', 'AdministratorController@userStore')
			->name('administrator.user_store');
		Route::get('/administrator/user/{id}/edit', 'AdministratorController@userEdit')
			->name('administrator.user_edit');
		Route::post('/administrator/user/{id}/update', 'AdministratorController@userUpdate')
			->name('administrator.user_update');
		Route::post('/administrator/user/{id}/delete', 'AdministratorController@userDestroy')
			->name('administrator.user_destroy');
		Route::post('administrator/user/status/{id}', 'AdministratorController@userChangeStatus')
			->name('administrator.user_status');

		Route::any('/administrator/user/reset-password', 'AdministratorController@userResetPassword')
			->name('administrator.user_password_reset');

		//user role manage
		Route::get('/role', 'UserController@roles')
			->name('user.role_index');
		Route::post('/role', 'UserController@roles')
			->name('user.role_destroy');
		Route::get('/role/create', 'UserController@roleCreate')
			->name('user.role_create');
		Route::post('/role/store', 'UserController@roleCreate')
			->name('user.role_store');
		Route::any('/role/update/{id}', 'UserController@roleUpdate')
			->name('user.role_update');

		// application settings routes
		Route::get('settings/institute', 'SettingsController@institute')
			->name('settings.institute');
		Route::post('settings/institute', 'SettingsController@institute')
			->name('settings.institute');

		// academic calendar
		Route::get('settings/academic-calendar', 'SettingsController@academicCalendarIndex')
			->name('settings.academic_calendar.index');
		Route::post('settings/academic-calendar', 'SettingsController@academicCalendarIndex')
			->name('settings.academic_calendar.destroy');
		Route::get('settings/academic-calendar/create', 'SettingsController@academicCalendarCru')
			->name('settings.academic_calendar.create');
		Route::post('settings/academic-calendar/create', 'SettingsController@academicCalendarCru')
			->name('settings.academic_calendar.store');
		Route::get('settings/academic-calendar/edit/{id}', 'SettingsController@academicCalendarCru')
			->name('settings.academic_calendar.edit');
		Route::post('settings/academic-calendar/update/{id}', 'SettingsController@academicCalendarCru')
			->name('settings.academic_calendar.update');

		//sms gateways
		Route::get('settings/sms-gateway', 'SettingsController@smsGatewayIndex')
			->name('settings.sms_gateway.index');
		Route::post('settings/sms-gateway', 'SettingsController@smsGatewayIndex')
			->name('settings.sms_gateway.destroy');
		Route::get('settings/sms-gateway/create', 'SettingsController@smsGatewayCru')
			->name('settings.sms_gateway.create');
		Route::post('settings/sms-gateway/create', 'SettingsController@smsGatewayCru')
			->name('settings.sms_gateway.store');
		Route::get('settings/sms-gateway/edit/{id}', 'SettingsController@smsGatewayCru')
			->name('settings.sms_gateway.edit');
		Route::post('settings/sms-gateway/update/{id}', 'SettingsController@smsGatewayCru')
			->name('settings.sms_gateway.update');

		//report settings
		Route::get('settings/report', 'SettingsController@report')
			->name('settings.report');
		Route::post('settings/report', 'SettingsController@report')
			->name('settings.report');

		// administrator routes
		//academic year
		Route::get('administrator/academic_year', 'AdministratorController@academicYearIndex')
			->name('administrator.academic_year');
		Route::post('administrator/academic_year', 'AdministratorController@academicYearIndex')
			->name('administrator.academic_year_destroy');
		Route::get('administrator/academic_year/create', 'AdministratorController@academicYearCru')
			->name('administrator.academic_year_create');
		Route::post('administrator/academic_year/create', 'AdministratorController@academicYearCru')
			->name('administrator.academic_year_store');
		Route::get('administrator/academic_year/edit/{id}', 'AdministratorController@academicYearCru')
			->name('administrator.academic_year_edit');
		Route::post('administrator/academic_year/update/{id}', 'AdministratorController@academicYearCru')
			->name('administrator.academic_year_update');
		Route::post('administrator/academic_year/status/{id}', 'AdministratorController@academicYearChangeStatus')
			->name('administrator.academic_year_status');

		// template
		//mail and sms
		Route::get('administrator/template/mailandsms', 'AdministratorController@templateMailAndSmsIndex')
			->name('administrator.template.mailsms.index');
		Route::post('administrator/template/mailandsms', 'AdministratorController@templateMailAndSmsIndex')
			->name('administrator.template.mailsms.destroy');
		Route::get('administrator/template/mailandsms/create', 'AdministratorController@templateMailAndSmsCru')
			->name('administrator.template.mailsms.create');
		Route::post('administrator/template/mailandsms/create', 'AdministratorController@templateMailAndSmsCru')
			->name('administrator.template.mailsms.store');
		Route::get('administrator/template/mailandsms/edit/{id}', 'AdministratorController@templateMailAndSmsCru')
			->name('administrator.template.mailsms.edit');
		Route::post('administrator/template/mailandsms/update/{id}', 'AdministratorController@templateMailAndSmsCru')
			->name('administrator.template.mailsms.update');
		// id card
		Route::get('administrator/template/idcard', 'AdministratorController@templateIdcardIndex')
			->name('administrator.template.idcard.index');
		Route::post('administrator/template/idcard', 'AdministratorController@templateIdcardIndex')
			->name('administrator.template.idcard.destroy');
		Route::get('administrator/template/idcard/create', 'AdministratorController@templateIdcardCru')
			->name('administrator.template.idcard.create');
		Route::post('administrator/template/idcard/create', 'AdministratorController@templateIdcardCru')
			->name('administrator.template.idcard.store');
		Route::get('administrator/template/idcard/edit/{id}', 'AdministratorController@templateIdcardCru')
			->name('administrator.template.idcard.edit');
		Route::post('administrator/template/idcard/update/{id}', 'AdministratorController@templateIdcardCru')
			->name('administrator.template.idcard.update');

		// academic routes
		// class
		Route::get('academic/class', 'AcademicController@classIndex')
			->name('academic.class');
		Route::post('academic/class', 'AcademicController@classIndex')
			->name('academic.class_destroy');
		Route::get('academic/class/create', 'AcademicController@classCru')
			->name('academic.class_create');
		Route::post('academic/class/create', 'AcademicController@classCru')
			->name('academic.class_store');
		Route::get('academic/class/edit/{id}', 'AcademicController@classCru')
			->name('academic.class_edit');
		Route::post('academic/class/update/{id}', 'AcademicController@classCru')
			->name('academic.class_update');
		Route::post('academic/class/status/{id}', 'AcademicController@classStatus')
			->name('academic.class_status');

		// section
		Route::get('academic/section', 'AcademicController@sectionIndex')
			->name('academic.section');
		Route::post('academic/section', 'AcademicController@sectionIndex')
			->name('academic.section_destroy');
		Route::get('academic/section/create', 'AcademicController@sectionCru')
			->name('academic.section_create');
		Route::post('academic/section/create', 'AcademicController@sectionCru')
			->name('academic.section_store');
		Route::get('academic/section/edit/{id}', 'AcademicController@sectionCru')
			->name('academic.section_edit');
		Route::post('academic/section/update/{id}', 'AcademicController@sectionCru')
			->name('academic.section_update');
		Route::post('academic/section/status/{id}', 'AcademicController@sectionStatus')
			->name('academic.section_status');

		// subject
		Route::get('academic/subject', 'AcademicController@subjectIndex')
			->name('academic.subject');
		Route::post('academic/subject', 'AcademicController@subjectIndex')
			->name('academic.subject_destroy');
		Route::get('academic/subject/create', 'AcademicController@subjectCru')
			->name('academic.subject_create');
		Route::post('academic/subject/create', 'AcademicController@subjectCru')
			->name('academic.subject_store');
		Route::get('academic/subject/edit/{id}', 'AcademicController@subjectCru')
			->name('academic.subject_edit');
		Route::post('academic/subject/update/{id}', 'AcademicController@subjectCru')
			->name('academic.subject_update');
		Route::post('academic/subject/status/{id}', 'AcademicController@subjectStatus')
			->name('academic.subject_status');

		// teacher routes
		Route::resource('teacher', 'TeacherController');
		Route::post('teacher/status/{id}', 'TeacherController@changeStatus')
			->name('teacher.status');

		// student routes
		Route::resource('student', 'StudentController');
		Route::post('student/status/{id}', 'StudentController@changeStatus')
			->name('student.status');
		Route::get('student-list-by-filter', 'StudentController@studentListByFitler')
			->name('student.list_by_fitler');

		// student attendance routes
		Route::get('student-attendance', 'StudentAttendanceController@index')->name('student_attendance.index');
		Route::any('student-attendance/create', 'StudentAttendanceController@create')->name('student_attendance.create');
		Route::post('student-attendance/store', 'StudentAttendanceController@store')->name('student_attendance.store');
		Route::post('student-attendance/status/{id}', 'StudentAttendanceController@changeStatus')
			->name('student_attendance.status');
		Route::any('student-attendance/file-upload', 'StudentAttendanceController@createFromFile')
			->name('student_attendance.create_file');
		Route::get('student-attendance/file-queue-status', 'StudentAttendanceController@fileQueueStatus')
			->name('student_attendance.file_queue_status');

		// HRM
		//Employee
		Route::resource('hrm/employee', 'EmployeeController', ['as' => 'hrm']);
		Route::post('hrm/employee/status/{id}', 'EmployeeController@changeStatus')
			->name('hrm.employee.status');
		// Leave
		Route::resource('hrm/leave', 'LeaveController', ['as' => 'hrm']);
		Route::resource('hrm/work_outside', 'WorkOutsideController', ['as' => 'hrm']);
		// policy
		Route::get('hrm/policy', 'EmployeeController@hrmPolicy')
			->name('hrm.policy');
		Route::post('hrm/policy', 'EmployeeController@hrmPolicy')
			->name('hrm.policy');

		// employee attendance routes
		Route::get('employee-attendance', 'EmployeeAttendanceController@index')->name('employee_attendance.index');
		Route::get('employee-attendance/create', 'EmployeeAttendanceController@create')->name('employee_attendance.create');
		Route::post('employee-attendance/create', 'EmployeeAttendanceController@store')->name('employee_attendance.store');
		Route::post('employee-attendance/status/{id}', 'EmployeeAttendanceController@changeStatus')
			->name('employee_attendance.status');
		Route::any('employee-attendance/file-upload', 'EmployeeAttendanceController@createFromFile')
			->name('employee_attendance.create_file');
		Route::get('employee-attendance/file-queue-status', 'EmployeeAttendanceController@fileQueueStatus')
			->name('employee_attendance.file_queue_status');

		//exam
		Route::get('exam', 'ExamController@index')
			->name('exam.index');
		Route::get('exam/create', 'ExamController@create')
			->name('exam.create');
		Route::post('exam/store', 'ExamController@store')
			->name('exam.store');
		Route::get('exam/edit/{id}', 'ExamController@edit')
			->name('exam.edit');
		Route::post('exam/update/{id}', 'ExamController@update')
			->name('exam.update');
		Route::post('exam/status/{id}', 'ExamController@changeStatus')
			->name('exam.status');
		Route::post('exam/delete/{id}', 'ExamController@destroy')
			->name('exam.destroy');
		//grade
		Route::get('exam/grade', 'ExamController@gradeIndex')
			->name('exam.grade.index');
		Route::post('exam/grade', 'ExamController@gradeIndex')
			->name('exam.grade.destroy');
		Route::get('exam/grade/create', 'ExamController@gradeCru')
			->name('exam.grade.create');
		Route::post('exam/grade/create', 'ExamController@gradeCru')
			->name('exam.grade.store');
		Route::get('exam/grade/edit/{id}', 'ExamController@gradeCru')
			->name('exam.grade.edit');
		Route::post('exam/grade/update/{id}', 'ExamController@gradeCru')
			->name('exam.grade.update');
		//exam rules
		Route::get('exam/rule', 'ExamController@ruleIndex')
			->name('exam.rule.index');
		Route::post('exam/rule', 'ExamController@ruleIndex')
			->name('exam.rule.destroy');
		Route::get('exam/rule/create', 'ExamController@ruleCreate')
			->name('exam.rule.create');
		Route::post('exam/rule/create', 'ExamController@ruleCreate')
			->name('exam.rule.store');
		Route::get('exam/rule/edit/{id}', 'ExamController@ruleEdit')
			->name('exam.rule.edit');
		Route::post('exam/rule/update/{id}', 'ExamController@ruleEdit')
			->name('exam.rule.update');

		//Marks
		Route::any('marks', 'MarkController@index')
			->name('marks.index');
		Route::any('marks/create', 'MarkController@create')
			->name('marks.create');
		Route::post('marks/store', 'MarkController@store')
			->name('marks.store');
		Route::get('marks/edit/{id}', 'MarkController@edit')
			->name('marks.edit');
		Route::post('marks/update/{id}', 'MarkController@update')
			->name('marks.update');
		//result
		Route::any('result', 'MarkController@resultIndex')
			->name('result.index');
		Route::any('result/generate', 'MarkController@resultGenerate')
			->name('result.create');

		// Reporting

		Route::any('report/student-monthly-attendance', 'ReportController@studentMonthlyAttendance')
			->name('report.student_monthly_attendance');
		Route::any('report/student-list', 'ReportController@studentList')
			->name('report.student_list');
		//Fees
		Route::get('/fees/setup/list', 'FessController@getsetuplist')->name('student.fee.setuplist');
		Route::get('/fees/setup', 'FessController@getsetup')->name('student.fee.setup');
		Route::post('/fees/setup', 'FessController@postsetup')->name('student.fee.setuppost');
		Route::get('/fees/setup/edit/{id}', 'FessController@feessetup_edit')->name('student.feessetup_edit');
		Route::post('/fees/setup/edit', 'FessController@feessetup_update')->name('student.feessetup_update');
		Route::post('/fees/setup/delete/', 'FessController@feessetup_destroy')->name('student.feessetup_destroy');

		Route::get('/fees/collection', 'FessController@getCollection')->name('student.fee.collection');

		Route::get('/student/getList/{class}/{section}/{shift}/{session}', 'StudentController@getStudentList')->name('student.getlist');
		Route::get('/fee/getListjson/{class}/{type}/{student}', 'FessController@getListjson')->name('student.fee.getListjson');
		Route::get('/class/getsection/{class}','AcademicController@getsectionlist');
		Route::get('/fee/getFeeInfo/{id}/{stdid}', 'FessController@getFeeInfo')->name('student.fee.getFeeInfo');
		Route::get('/fee/getDue/{class}/{stdId}', 'FessController@getDue')->name('student.fee.getDue');
		Route::get('/fees/collection/{id}', 'FessController@feeprint')->name('student.fee.print');
		Route::post('/fees/collection', 'FessController@postCollection')->name('student.fee.postcollection');

		Route::get('/fees/view', 'FessController@stdfeeview')->name('student.fee.views');
		Route::post('/fees/view', 'FessController@stdfeeviewpost')->name('student.fee.postviews');

		Route::get('/fees/report', 'FessController@report')->name('student.fee.report');
		Route::get('/fees/report/std/{regiNo}', 'FessController@reportstd')->name('student.fee.getreport');
		Route::get('/fees/report/{sDate}/{eDate}', 'FessController@reportprint')->name('student.fee.datereport');
		Route::get('/fees/details/{billNo}', 'FessController@billDetails')->name('student.fees.details');

		//no permission setup
		Route::get('/get-studentduefee', 'FessController@get_studentduefee');
		//report....

		Route::any('report/student-monthly-attendance-details', 'ReportController@studentMonthlyAttendanceDetails')
			->name('report.student_monthly_attendance_details');

		Route::any('report/employee-monthly-attendance', 'ReportController@employeeMonthlyAttendance')
			->name('report.employee_monthly_attendance');
		Route::any('report/employee-list', 'ReportController@employeeList')
			->name('report.employee_list');
		Route::any('report/employee-monthly-attendance-details', 'ReportController@employeeMonthlyAttendanceDetails')
			->name('report.employee_monthly_attendance_details');

		//Library.....
		Route::get('/library/search', 'LibraryController@getsearch')->name('library.search');
		Route::post('/library/search', 'LibraryController@postsearch')->name('library.search1');
		Route::post('/library/search2', 'LibraryController@postsearch2')->name('library.search2');

		Route::get('/library/issuebookview', 'LibraryController@getissueBookview')->name('library.issuebookview');

		Route::post('/library/issuebookview', 'LibraryController@postissueBookview')->name('library.postissuebookview');

		Route::get('/library/issuebookupdate/{id}', 'LibraryController@getissueBookupdate')->name('library.issuebookupdate');

		Route::post('/library/issuebookupdate', 'libraryController@postissueBookupdate')->name('library.postissueBookupdate');

		Route::get('/library/issuebookdelete/{id}', 'LibraryController@deleteissueBook')->name('library.issuebookdelete');

		Route::get('/library/issuebook', 'LibraryController@getissueBook')->name('library.issuebook');

		//check availabe book
		Route::get('/library/issuebook-availabe/{code}/{quantity}', 'LibraryController@checkBookAvailability')->name('library.issuebook-availabe');

		Route::post('/library/issuebook', 'LibraryController@postissueBook')->name('library.postissuebook');

		Route::get('/library/view-show', 'LibraryController@getviewbook')->name('library.getview-show');
		Route::post('/library/view-show', 'LibraryController@postviewbook')->name('library.postview-show');

		Route::get('/library/addbook', 'LibraryController@getAddbook')->name('library.getaddbook');
		Route::post('/library/addbook', 'LibraryController@postAddbook')->name('library.postaddbook');
		Route::get('/library/edit/{id}', 'LibraryController@getBook')->name('library.edit');
		Route::post('/library/update', 'LibraryController@postUpdateBook')->name('library.update');
		Route::get('/library/delete/{id}', 'LibraryController@deleteBook')->name('library.delete');

		Route::get('/library/reports', 'LibraryController@getReports')->name('library.reports');
		Route::get('/library/reports/fine', 'LibraryController@getReportsFine')->name('library.reports.fine');

		Route::get('/library/reportprint/{do}', 'LibraryController@Reportprint')->name('library.reportprint');
		Route::get('/library/reports/fine/{month}', 'LibraryController@ReportsFineprint')->name('library.reports.monthlyfine');

		//gradesheet ..........
		Route::get('/gradesheet', 'GradesheetController@index')->name('gradesheet');
		Route::post('/gradesheet', 'GradesheetController@stdlist')->name('postgradesheet');
		Route::get('/gradesheet/print/{regiNo}/{exam}/{class}', 'GradesheetController@printsheet')->name('gradesheet.print');

		//tabulation sheet
		Route::get('/tabulation', 'TabulationController@index')->name('tabulation');
		Route::post('/tabulation', 'TabulationController@getsheet')->name('posttabulation');

		//Result Summary
		Route::get('/passing-summery', 'ResultSummaryController@passing_summary')->name('passing_summary');
		Route::post('/passing-summery', 'ResultSummaryController@passing_postsummary')->name('passing_postsummary');

		Route::get('/subject-pass', 'ResultSummaryController@subjectpass_summary')->name('subjectpass_summary');
		Route::post('/subject-pass', 'ResultSummaryController@subjectpass_postsummary')->name('subjectpass_postsummary');

		//Admission.....
		Route::get('/exam/admission', 'AdmissionController@index')->name('admission_name');
		Route::post('/exam/admission', 'AdmissionController@list')->name('admission_list');

		Route::get('/admission-active/{id}', 'AdmissionController@active')->name('admission_active');
		Route::get('/admission-inactive/{id}', 'AdmissionController@inactive')->name('admission_inactive');
		Route::get('/admission/create', 'AdmissionController@create')->name('admission.create');
		Route::post('/admission/create', 'AdmissionController@postadmission')->name('postadmission');

		//get academic info
		Route::get('/get-subject', 'ResultSummaryController@get_subject')->name('get-subject');
		Route::get('/get-section', 'ResultSummaryController@get_section')->name('get-section');
		Route::get('/get-exam', 'ResultSummaryController@get_exam')->name('get-exam');
		//no permission
		Route::get('/get-studentfee', 'StudentController@get_studentfee');
//no permission
		//promotion
		Route::get('/promotion', 'PromotionController@index')->name('promotion');
		Route::get('/promotion/studentlist/{class}/{section}/{shift}/{session}', 'PromotionController@getStudentList')->name('student.getlist');
		Route::post('/promotion', 'PromotionController@post_promotion')->name('post-promotion');

		//hostel
		Route::get('/dormitory', 'DormitoryController@index')->name('dormitory');
		Route::post('/dormitory/create', 'DormitoryController@create')->name('dormitory.create');
		Route::get('/dormitory/edit/{id}', 'DormitoryController@edit')->name('dormitory.edit');
		Route::post('/dormitory/update', 'DormitoryController@update')->name('dormitory.update');
		Route::get('/dormitory/delete/{id}', 'DormitoryController@delete')->name('dormitory.delete');
		Route::get('/dormitory/getstudents/{dormid}', 'DormitoryController@getstudents')->name('dormitory.getstudents');

		Route::get('/dormitory/assignstd', 'DormitoryController@stdindex')->name('dormitory.assignstd');
		Route::post('/dormitory/assignstd/create', 'DormitoryController@stdcreate')->name('dormitory.assignstd.create');
		Route::get('/dormitory/assignstd/list', 'DormitoryController@stdshow')->name('dormitory.assignstd.list');
		Route::post('/dormitory/assignstd/list', 'DormitoryController@poststdShow')->name('dormitory.assignstd.postlist');
		Route::get('/dormitory/assignstd/edit/{id}', 'DormitoryController@stdedit')->name('dormitory.assignstd.edit');
		Route::post('/dormitory/assignstd/update', 'DormitoryController@stdupdate')->name('dormitory.assignstd.update');
		Route::get('dormitory/assignstd/delete/{id}', 'DormitoryController@stddelete')->name('dormitory.assignstd.delete');

		Route::get('/dormitory/fee', 'DormitoryController@feeindex')->name('dormitory.fee');
		Route::get('/dormitory/fee/info/{regiNo}', 'DormitoryController@feeinfo')->name('dormitory.fee.info');
		Route::post('/dormitory/fee', 'DormitoryController@feeadd')->name('dormitory.fee');
		Route::get('/dormitory/mainfee', 'DormitoryController@mainfee')->name('dormitory.mainfee');
		Route::get('/dormitory/fees/print/{id}', 'DormitoryController@feesprint')->name('dormitory.fee.print');
		Route::get('/dormitory/report/std', 'DormitoryController@reportstd')->name('dormitory.report.std');
		Route::get('/dormitory/report/std/{dormId}', 'DormitoryController@reportstdprint')->name('dormitory.report.postst');
		Route::get('/dormitory/report/fee', 'DormitoryController@reportfee')->name('dormitory.report.fee');
		Route::get('/dormitory/report/fee/{dormId}/{month}', 'dormitoryController@reportfeeprint')->name('dormitory.report.postfee');

		//sallary system....
		Route::get('/sallary/setuplist', 'SallaryController@setuplist')->name('sallary.setuplist');
		Route::get('/sallary/setup/active/{id}', 'SallaryController@setupactive')->name('sallary.setup.active');
		Route::get('/sallary/setup/inactive/{id}', 'SallaryController@setupinactive')->name('sallary.setup.inactive');
		Route::get('sallary/setup/edit/{id}', 'SallaryController@setupedit')->name('sallary.setup.edit');
		Route::post('/sallary/setup/update', 'SallaryController@setupupade')->name('sallary.setup.update');
		Route::post('/sallary/setup/delete', 'SallaryController@sallarysetup_destroy')->name('sallary.setup.delete');

		Route::get('/sallary', 'SallaryController@index')->name('sallary');
		Route::get('/sallary/jsonemployee/{id}', 'SallaryController@jsonemployee');
		Route::post('/sallary/setup', 'SallaryController@setup')->name('sallary.setup');
		Route::get('/sallary/payment', 'SallaryController@payment')->name('sallary.payment');
		Route::get('/sallary/sallaryinfo', 'SallaryController@sallaryinfo')->name('sallary.sallaryinfo');
		Route::get('/sallary/payment/print/{id}', 'SallaryController@paymentprint')->name('sallary.payment.print');
		Route::get('/sallary/checkpayment', 'SallaryController@checkpayment')->name('sallary.checkpayment');
		Route::post('sallary/payment', 'SallaryController@postpayment')->name('sallary.postpayment');
		Route::get('sallary/report', 'SallaryController@report')->name('sallary.report');
		Route::get('sallary/report/{employee}/{fdate}/{tdate}', 'SallaryController@employee_sallary_report')->name('sallary.emp.report');
		Route::get('sallary/allreport/{fdate}/{tdate}', 'SallaryController@employee_allsallary_report')->name('sallary.emp.allreport');

		//accounting route...
		Route::get('/accounting/sectors', 'AccountingController@sectors')->name('sectors');
		Route::post('/accounting/sectorcreate', 'AccountingController@sectorCreate')->name('accounting.sectorcreate');
		Route::get('/accounting/sectorlist', 'AccountingController@sectorList');

		Route::get('/accounting/sectoredit/{id}', 'AccountingController@sectorEdit')->name('accounting.sectoredit');
		Route::post('/accounting/sectorupdate', 'AccountingController@sectorUpdate')->name('accounting.sectorupdate');
		Route::post('/accounting/sectordelete', 'AccountingController@sectorDelete')->name('accounting.sectordelete');

		Route::get('/accounting/income', 'AccountingController@income')->name('accounting.income');
		Route::post('/accounting/incomecreate', 'AccountingController@incomeCreate')->name('accounting.incomecreate');
		Route::get('/accounting/incomelist', 'AccountingController@incomeList')->name('accounting.incomelist');
		Route::post('/accounting/incomelist', 'AccountingController@incomeListPost')->name('accounting.postincomelist');
		Route::get('/accounting/incomeedit/{id}', 'AccountingController@incomeEdit')->name('accounting.incomeedit');
		Route::post('/accounting/incomeupdate', 'AccountingController@incomeUpdate')->name('accounting.postincomeupdate');
		Route::post('/accounting/incomedelete', 'AccountingController@incomeDelete')->name('accounting.incomedelete');

		Route::get('/accounting/expence', 'accountingController@expence')->name('accounting.expence');
		Route::post('/accounting/expencecreate', 'AccountingController@expenceCreate')->name('accounting.expencecreate');
		Route::get('/accounting/expencelist', 'AccountingController@expenceList')->name('accounting.expencelist');
		Route::post('/accounting/expencelist', 'AccountingController@expenceListPost')->name('accounting.postexpencelist');
		Route::get('/accounting/expenceedit/{id}', 'AccountingController@expenceEdit')->name('accounting.expenceedit');
		Route::post('/accounting/expenceupdate', 'AccountingController@expenceUpdate')->name('accounting.expenceupdate');
		Route::get('/accounting/expencedelete', 'AccountingController@expenceDelete')->name('accounting.expencedelete');

		Route::get('/accounting/report', 'AccountingController@getReport')->name('accounting.report');
		Route::get('/accounting/reportsum', 'AccountingController@getReportsum')->name('accounting.reportsum');

		Route::get('/accounting/reportprint/{rtype}/{fdate}/{tdate}', 'AccountingController@printReport')->name('accounting.reportprint');
		Route::get('/accounting/reportprintsum/{fdate}/{tdate}', 'AccountingController@printReportsum')->name('accounting.reportprintsum');

	}
);

Route::group(
	['namespace' => 'Backend', 'middleware' => ['auth']], function () {
		//student fee

	});

//change website locale
Route::get(
	'/set-locale/{lang}', function ($lang) {
		//set user wanted locale to session
		Session::put('user_locale', $lang);
		return redirect()->back();
	}
)->name('setLocale');

//web artisan routes
Route::get(
	'/student-attendance-file-queue-start/{code}', function ($code) {
		if ($code == "hr799") {
			try {
				echo '<br>Started student attendance processing...<br>';
				Artisan::call('attendance:seedStudent');
				echo '<br>Student attendance processing completed.<br>You will be redirect in 5 seconds.<br>';
				sleep(5);

				return redirect()->route('student_attendance.create_file')->with("success", "Students attendance saved and send sms successfully.");

			} catch (Exception $e) {
				Response::make($e->getMessage(), 500);
			}
		} else {
			App::abort(404);
		}
	}
)->name('student_attendance_seeder');

Route::get(
	'/employee-attendance-file-queue-start/{code}', function ($code) {
		if ($code == "hr799") {
			try {
				echo '<br>Started employee attendance processing...<br>';
				Artisan::call('attendance:seedEmployee');
				echo '<br>Employee attendance processing completed.<br>You will be redirect in 5 seconds.<br>';
				sleep(5);

				return redirect()->route('employee_attendance.create_file')->with("success", "Employee attendance saved and notify successfully.");

			} catch (Exception $e) {
				Response::make($e->getMessage(), 500);
			}
		} else {
			App::abort(404);
		}
	}
)->name('employee_attendance_seeder');

//dev routes
Route::get(
	'/make-link/{code}', function ($code) {
		if ($code !== '007') {
			return 'Wrong code!';
		}

		//check if developer mode enabled?
		if (!env('DEVELOPER_MODE_ENABLED', false)) {
			return "Please enable developer mode in '.env' file." . PHP_EOL . "set 'DEVELOPER_MODE_ENABLED=true'";
		}
		//remove first
		if (is_link(public_path('storage'))) {
			unlink(public_path('storage'));
		}

		//create symbolic link for public image storage
		App::make('files')->link(storage_path('app/public'), public_path('storage'));
		return 'Done link';
	}
);
Route::get(
	'/cache-clear/{code}', function ($code) {
		if ($code !== '007') {
			return 'Wrong code!';
		}

		// check if developer mode enabled?
		// if(!env('DEVELOPER_MODE_ENABLED', false)) {
		//     return "Please enable developer mode in '.env' file.".PHP_EOL."set 'DEVELOPER_MODE_ENABLED=true'";
		// }

		$exitCode = Artisan::call('cache:clear');
		$exitCode = Artisan::call('config:clear');
		$exitCode = Artisan::call('view:clear');
		$exitCode = Artisan::call('route:clear');
		return 'clear cache';
	}
);

// create tiggers
Route::get(
	'/create-triggers/{code}', function ($code) {
		if ($code !== '007') {
			return 'Wrong code!';
		}

		//check if developer mode enabled?
		if (!env('DEVELOPER_MODE_ENABLED', false)) {
			return "Please enable developer mode in '.env' file." . PHP_EOL . "set 'DEVELOPER_MODE_ENABLED=true'";
		}

		AppHelper::createTriggers();

		return 'Triggers created :)';
	}
);
//test sms send
Route::get(
	'/test-sms/{code}', function ($code) {
		if ($code !== '007') {
			return 'Wrong code!';
		}
		//check if developer mode enabled?
		if (!env('DEVELOPER_MODE_ENABLED', false)) {
			return "Please enable developer mode in '.env' file." . PHP_EOL . "set 'DEVELOPER_MODE_ENABLED=true'";
		}

		$gateway = \App\AppMeta::where('id', AppHelper::getAppSettings('student_attendance_gateway'))->first();
		$gateway = json_decode($gateway->meta_value);
		$smsHelper = new \App\Http\Helpers\SmsHelper($gateway);
		$res = $smsHelper->sendSms('8801722813644', 'test sms vai');
		dd($res);
	}
);
