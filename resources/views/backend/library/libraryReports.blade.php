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


    <span class="text-danger">[*]Fill up any feilds and print. Don't fill up more than one feild at a time.</span>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="col-md-4">

                                    <div class="form-group">
                                          <label class="control-label" for="type">Type</label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                               {{ Form::select('type',["-1"=>'--Select--','Academic'=>'Academic','Story'=>'Story','Magazine'=>'Magazine','Other'=>'Other'],NULL,['id'=>'type','class'=>'form-control select2'])}}
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-2">

                                      <div class="form-group">
                                            <label class="control-label" for="type">Today Return List</label>
                                            <br>
                                         <input type="checkbox" name="today" id="today">

                                    </div>



                                </div>




                                    <div class="col-md-2">

                                        <div class="form-group">
                                              <label class="control-label" for="type">Expire List</label>
                                             <br>
                                          <input type="checkbox" id="expire" name="expire">

                                           </div>




                                  </div>
                                  <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <div class="input-group">
                                      <button class="btn btn-primary"  type="submit" id="btnPrint"><i class="glyphicon glyphicon-print"></i> Print</button>
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
        $( document ).ready(function() {

            $( "#btnPrint" ).click(function() {
                var type = $('#type').val();
                var today =  $('#today').is(':checked');
                var expire  = $('#expire').is(':checked');
                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host;
                var url =baseUrl+"/library/reportprint/";
                if(type!="-1") {
                   url +=type;
                    var win = window.open(url, '_blank');
                    win.focus();

                }
                else if(today)
              {
                url +="today";
                 var win = window.open(url, '_blank');
                 win.focus();
              }
              else if(expire)
              {
                url +="expire";
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
