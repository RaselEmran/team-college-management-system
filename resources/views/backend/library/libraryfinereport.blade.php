{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Library report @endsection
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
            Fees Report
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Library report</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
       <div class="row">
                    <div class="col-md-12">


                            <div class="row">
                                <div class="col-md-12">


                                  <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="month">Fine month</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"   class="form-control datepicker" id="fineMonth" required >
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
            Academic.iclassInit();
        });
    </script>

    <script type="text/javascript">
        $(".datepicker").datetimepicker({
            format: "MM",
            viewMode: 'months',
            ignoreReadonly: true,
        });


    </script>
        <script type="text/javascript">
        $( document ).ready(function() {
        
            $( "#btnPrint" ).click(function() {

                var month =  $('#fineMonth').val();
                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host;
                var url =baseUrl+"/library/reports/fine/";
                if(month !="" ) {
                   url +=month;
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
