{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Sallary setup @endsection
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
         Sallary Setup
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Sallary Setup</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
                   <form role="form" action="{{ route('sallary.setup') }}" method="post" enctype="multipart/form-data" id="create">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="role_id">Employee Type/Role<span class="text-danger">*</span>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set a employee Type"></i>
                                        </label>
                                        {!! Form::select('role_id', $roles, $role , ['placeholder' => 'Pick a type...','class' => 'form-control select2 role_id', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                    </div>
                                </div>


                              <div class="col-md-6">
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
                                </div>
                            </div>
                 
                        <!--button save -->
                        <div class="row"  style="display: none" id="set">
                            <div class="col-md-12">

                                <button class="btn btn-primary pull-right" type="button" id="genarate"><i class="glyphicon glyphicon-plus"></i>Sallary Set</button>
                              </div>
                          </div>
                        </div>
           
                      </div>
                    </div>

                    <div class="row" style="display: none" id="sallary_form">
                      <div class="col-md-6">
                          <div class="form-group">
                          <label for="">Basic Sallary</label>
                            <input type="text" name="basic_sallary" class="form-control" id="inputHelpText"  value="" required>
                          </div>
                       </div>

                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="">House Rent</label>
                        <input type="text" name="house_rent" class="form-control" id="inputHelpText"  value="" required>
                       </div>
                      </div>

                          <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Medical Allowance</label>
                            <input type="text" name="medical_allowance" class="form-control" id="inputHelpText" value="" required>
                          </div>
                      </div>

                          <div class="col-md-6">
                         <div class="form-group">
                          <label for="">Transport Allowance</label>
                          <input type="text" name="Transport_allowance" class="form-control" id="inputHelpText"  value="" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                           <div class="form-group">
                          <label for="">Insurance</label>
                          <input type="text" name="insurance" class="form-control" id="inputHelpText" value="" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                       <div class="form-group">
                          <label for="">Extra Over Time</label>
                          <input type="text" name="extra_over_time" class="form-control" id="inputHelpText" value="" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                   
                      </div>
                           <div class="col-md-6">
                       <div class="form-group">
                       
                         <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Set</button>
                        </div>
                      </div>
                    </div>
               </form>    
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

            $("#genarate").click(function(){
              $("#sallary_form").show(1000,function(){
                $("#genarate").hide();
              });
            });

        });

    </script>
@endsection
<!-- END PAGE JS-->
