{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') balance @endsection
@section('extraStyle')
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
         Accounting Balance
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Accounting Balance</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="type">Type</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <select name="type" id="type" required="true" class="form-control select2" >
                                                <option value="Income">Income</option>
                                                <option value="Expence">Expence</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="dob">From Date</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text" id="fdate" value=""  class="form-control datepicker" name="fromDate">
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="dob">To Date</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text" id="tdate" value="" class="form-control datepicker" name="toDate">
                                        </div>


                                    </div>
                                </div>




                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" id="btnPrint"><i class="glyphicon glyphicon-print"></i> Print</button>

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
  
            $( "#btnPrint" ).click(function() {
                var fdate = $('#fdate').val();
                var tdate =  $('#tdate').val();
                var rtype  = $('#type').val();
                if(fdate!="" && tdate !="") {
                    var getUrl = window.location;
                    var baseUrl = getUrl .protocol + "//" + getUrl.host;
                    var url =baseUrl+"/accounting/reportprint/"+rtype+"/"+fdate+"/"+tdate;

                    var win = window.open(url, '_blank');
                   win.focus();
                }
                else
                {
                    alert('Fill up inputs feilds correclty!!!');
                }
            });
         $(".datepicker").datetimepicker({
            format: "YYYY-MM-DD",
            ignoreReadonly: true,
        });
    </script>


@endsection
<!-- END PAGE JS-->
