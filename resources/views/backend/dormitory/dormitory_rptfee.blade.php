{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') dormitory fee report @endsection
@section('extraStyle')
 <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
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
            Dormitory Student Fee Report
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Dormitory Fee Report</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
       <div class="box col-md-12">
        <div class="box-inner">
                <div class="row">
                    <div class="col-md-12">


                            <div class="row">
                                <div class="col-md-12">

                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label" for="dormitory">Dormitory</label>

                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                              <select id="dormitory" name="dormitory" class="form-control select2" required="true">
                                                <option value="">--Select Dormitory--</option>
                                                @foreach($dormitories as $dorm)
                                                    <option value="{{$dorm->id}}">{{$dorm->name}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="month">Fee month</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"   class="form-control datepicker" id="feeMonth" required >
                                        </div>


                                    </div>
                                  </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="control-label" for="">&nbsp;</label>
                                                <div class="input-group">
                                              <button class="btn btn-primary pull-right" id="btnPrint"><i class="glyphicon glyphicon-print"></i> Print List</button>
                                            </div>
                                            </div>
                                      </div>
                                </div>
                            </div>
                            <br>

                    </div>
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

           $(".datepicker").datetimepicker({
            format: "YYYY-MM",
            viewMode: 'months',
            ignoreReadonly: true,
        });
    </script>
      <script type="text/javascript">
        $( document ).ready(function() {

           $( "#btnPrint" ).click(function() {
                var dormitory = $('#dormitory').val();
                var month =  $('#feeMonth').val();
                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host;
                var url =baseUrl+"/dormitory/report/fee/";
                if(dormitory!="-1" && month !="" ) {
                   url +=dormitory+"/"+month;
                    var win = window.open(url, '_blank');
                    win.focus();

                }
                else
                {
                    alert('Fill up inputs feilds correclty!!!');
                }
            });
        });

    </script>
@endsection
<!-- END PAGE JS-->
