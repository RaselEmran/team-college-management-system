@extends('frontend.layouts.master')
@section('pageTitle') @lang('site.admission') @endsection

@section('pageBreadCrumb')
	<!-- page title -->
	<div class="page-title">
		<div class="grid-row">
			<h1>@lang('site.admission')</h1>
			<nav class="bread-crumb">
				<a href="{{URL::route('home')}}">@lang('site.menu_home')</a>
				<i class="fa fa-long-arrow-right"></i>
				<a href="#">@lang('site.admission')</a>
			</nav>
		</div>
	</div>
	<!-- / page title -->
@endsection

@section('pageContent')
	<!-- content -->

	<div class="page-content">
		<div class="container">
			<!-- main content -->
			<main>
   <div>
   	@if ($admission)
      <div class="p-5" style="text-align: center; background: #f5f1e7; " >
       <h2 style="border: 1px solid #eee" >ADMISSION Select</h2>
    @foreach($admission as $adm)  
        <p>
            Admission Going On Class {{$adm->class->name}} Session {{$adm->academicyear->title}} Admission Name {{$adm->name}} <br>
            Admission Start {{$adm->open}} And End {{$adm->close}} <br>
            If You Want To  Fill Up Admission Form Please <a href="{{ route('site.admission-form',[$adm->id,$adm->class_id]) }}" target="_blank">Click Here</a>
        </p>
   @endforeach
   @else
   <div class="p-5" style="text-align: center; background: #f5f1e7; ">
   	<p>Admission are not Available Now</p>
   </div>
   @endif

      </div>
   </div>

			</main>
			<!-- / main content -->
		</div>
	</div>
	<!-- / content -->

@endsection

@section('extraScript')

@endsection
