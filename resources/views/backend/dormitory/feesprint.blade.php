{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') dormitory Fee collect print @endsection
@section('extraStyle')
<style>
    .center {
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
}
</style>
 @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass')

 @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
        <h1>
            Dormitory Fees Collection print
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active"> Dormitory Collection print</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="row" style="background: #fff">
              <div class="box box-info" id="div1">
            <div class="col-md-12">
            <div class="box-inner">
            <div class="box-content">
          <div style="text-align: center;" >
       <img  src="@if(isset($appSettings['institute_settings']['logo'])) {{asset('storage/logo/'.$appSettings['institute_settings']['logo'])}} @else {{ asset('images/logo-md.png') }} @endif" alt="logo-md" class="img-responsive center-block">
     <b> <p style="text-align: center;">{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['name']:'Satt School'}}</p></b>
     <span>
         <strong>Establish:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['establish']:'2018'}}
         <strong>Web:</strong> <a href="{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['website_link']:'https://sattit.com'}}" target="_blank">{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['website_link']:'htpps://sattit.com'}}</a> <br>
         <strong>Email:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['email']:'satt@sattit.com'}}
         <strong>Phone:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['phone_no']:'01740390336'}} <br>
         <strong>Address:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['address']:'Talaimari Rajshahi'}}
     </span>
       </div>


     <div class="center">
       <table class="table" >
           <tr >
              <td style="margin: 28px">Name: <u><strong>{{$info->registration->student->name}} </strong></u></td>
              <td>Class: <u><strong>{{$info->registration->class->name}}</strong></u></td>
              <td>Section: <u><strong>{{$info->registration->section->name}}</strong></u></td>
           </tr>

              <tr >
              <td style="margin: 28px">Shift: <u><strong>{{$info->registration->shift}} </strong></u></td>
              <td>Regi. No: <u><strong>{{$info->registration->regi_no}}</strong></u></td>
              <td>Roll No.: <u><strong>{{$info->registration->roll_no}}</strong></u></td>
           </tr>
       </table>
       <div>
         <div style="background: #3C8DBC;padding: 8px;text-align:center;">
               <p >Bill Pay History</p>
         </div>
                <table class="table">
               @foreach($fees as $bill)
               <tr>
                 @php
                  $a= explode('-', $bill->month);
                   $b=$a[1];
                 @endphp
                   <td>
                       {{\AppHelper::getmonthbyedor($b)}} <br>
                       <small>Month name</small>
                   </td>
                   <td>
                       {{$bill->feeAmount}} <br>
                       <small>fee</small>
                   </td>
                    <td>
                       {{$bill->paydate}} <br>
                       <small>Pay Date</small>
                   </td>
            
               </tr>
               @endforeach
               <tr>
                 <td colspan="1">Total</td>
                 <td>{{$fees->sum('feeAmount')}}</td>
               </tr>
           </table>

       </div>
   </div>
       </div>

            </div>
        </div>
    </div>
          <div class="row no-print">
        <div class="col-xs-12">
          <a href="" onclick="printContent('div1')" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
 <script src="{{asset('js/toastr.min.js')}}"></script>
 <script type="text/javascript">
        $(document).ready(function () {
             window.changeExportColumnIndex = 6;
            window.excludeFilterComlumns = [0,6,7];
            Academic.sectionInit();
        });
    </script>
 <script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
@endsection
<!-- END PAGE JS-->
