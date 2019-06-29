{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Sallary report @endsection
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
         Sallary Report
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Sallary Report</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
              <div style="background: #3C8DBC;padding: 8px;text-align:center">
                <h2>Enployee Sallary Report</h2>
              </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">
                              <div class="col-md-3">
                                    <div class="form-group has-feedback">
                                        <label for="role_id">Employee Type/Role<span class="text-danger">*</span>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set a employee Type"></i>
                                        </label>
                                        {!! Form::select('role_id', $roles, $role , ['placeholder' => 'Pick a type...','class' => 'form-control select2 role_id', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                    </div>
                                </div>


                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label" for="employee">Employee</label>

                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
                                          <select id="employee" name="employee_id" class="form-control select2" required="true">
                                              <option value="">--Select Employee--</option>


                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-3">

                                <div class="form-group">
                                    <label class="control-label" for="">To Month</label>
                                  <input type="text" class="form-control datepicker" name="tomonth" id="tdate">
                                </div>
                              </div>

                                <div class="col-md-3">
                                <div class="form-group">
                                   <label class="control-label" for="">Form Month</label>
                                  <input type="text" class="form-control datepicker" name="formmonth" id="fdate">
                                </div>
                              </div>
                
                                </div>
                              <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" id="btnPrint"><i class="glyphicon glyphicon-print"></i> Print</button>

                            </div>
                        </div> 

              <div style="background: #3C8DBC;padding: 8px;text-align:center">
                <h2> Sallary Report</h2>
              </div> 


                        <div class="row">


                              <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label" for="">To Month</label>
                                  <input type="text" class="form-control datepicker" name="tomonth" id="tdate1">
                                </div>
                              </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                   <label class="control-label" for="">Form Month</label>
                                  <input type="text" class="form-control datepicker" name="formmonth" id="fdate1">
                                </div>
                              </div>
                
                          </div>
                         <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" id="btnPrint1"><i class="glyphicon glyphicon-print"></i> Print</button>

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
    </script>
    <script>
    	$("#create").validate({
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");
                error.insertAfter(element);

            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group>div").addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group>div").addClass("has-success").removeClass("has-error");
            }
        });
         $(".datepicker").datetimepicker({
            format: "YYYY-MM",
            viewMode: 'months',
            ignoreReadonly: true,
        });
    </script>

    <script>
         
        $( document ).ready(function() {
     


            $(".role_id").change(function() {
              var val = $(this).val();
           
                $.ajax({
                    url:'/sallary/jsonemployee/'+val,
                    type:'get',
                    dataType: 'json',
                    success: function( json ) {

                        $('#employee').empty();
                        $('#employee').append($('<option>').text("--Select Employee--").attr('value',""));
                        $.each(json, function(i, student) {
                        

                             $('#employee').append($('<option>').text(student.name+"["+student.designation+"]").attr('value', student.id));
                        });
                    $("#set").show();
                    }
                });
     
            });
          });

  

    </script>
    <script>
            $( "#btnPrint" ).click(function() {
                var fdate = $('#fdate').val();
                var tdate =  $('#tdate').val();
                var employee =$("#employee").val();

                if(fdate!="" && tdate !="") {
                    var getUrl = window.location;
                    var baseUrl = getUrl .protocol + "//" + getUrl.host;
                    var url =baseUrl+"/sallary/report/"+employee+"/"+fdate+"/"+tdate;

                    var win = window.open(url, '_blank');
                   win.focus();
                }
                else
                {
                    alert('Fill up inputs feilds correclty!!!');
                }
            });

               $( "#btnPrint1" ).click(function() {
                var fdate = $('#fdate1').val();
                var tdate =  $('#tdate1').val();

                if(fdate!="" && tdate !="") {
                    var getUrl = window.location;
                    var baseUrl = getUrl .protocol + "//" + getUrl.host;
                    var url =baseUrl+"/sallary/allreport/"+fdate+"/"+tdate;

                    var win = window.open(url, '_blank');
                   win.focus();
                }
                else
                {
                    alert('Fill up inputs feilds correclty!!!');
                }
            });
    </script>
@endsection
<!-- END PAGE JS-->
