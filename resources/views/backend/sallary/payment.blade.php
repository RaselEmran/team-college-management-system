{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Sallary payment @endsection
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
         Sallary Payment
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Sallary Payment</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
                   <form role="form" action="{{ route('sallary.postpayment') }}" method="post" enctype="multipart/form-data" id="create">
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
                                          <select id="employee" name="employee_id"  class="form-control select2" required="true">
                                              <option value="">--Select Employee--</option>


                                          </select>
                                      </div>
                                  </div>
                              </div>
                                </div>
                            </div>
                 
                        </div>
           
                      </div>
                    </div>

                    <div class="row" style="display: none" id="sallary_form">
                      <div class="col-md-6">
                          <div class="form-group">
                          <label for="">Basic Sallary</label>
                            <input type="text" name="basic_sallary" class="form-control" id="basic_sallary"  value="" required readonly>
                          </div>
                       </div>

                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="">House Rent</label>
                        <input type="text" name="house_rent" class="form-control" id="house_rent"  value="" required readonly>
                       </div>
                      </div>

                          <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Medical Allowance</label>
                            <input type="text" name="medical_allowance" class="form-control" id="medical_allowance" value="" required readonly>
                          </div>
                      </div>

                          <div class="col-md-6">
                         <div class="form-group">
                          <label for="">Transport Allowance</label>
                          <input type="text" name="Transport_allowance" class="form-control" id="Transport_allowance"  value="" required readonly>
                        </div>
                      </div>

                      <div class="col-md-4">
                           <div class="form-group">
                          <label for="">Insurance</label>
                          <input type="text" name="insurance" class="form-control" id="insurance" value="" required readonly>
                        </div>
                      </div>

                      <div class="col-md-4">
                       <div class="form-group">
                          <label for="">Extra Over Time</label>
                          <input type="text" name="extra_over_time" class="form-control" id="extra_over_time" value="" required readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group" id="ad">
                          <label for="">Total</label>
                          <input type="text" name="pay_amt" class="form-control" id="total" value="" required readonly>
                        </div>
                      </div>

                      <div class="col-md-4">
                      <div class="form-group">
                          <label for="">Pay Date</label>
                          <input type="text" name="pay_date" class="form-control datepicker" id="pay_date" value="" required readonly>
                        </div>
                      </div>

                        <div class="col-md-4">
                      <div class="form-group">
                          <label for="">Pay Month</label>
                          <input type="text" name="pay_month" class="form-control datemonth" id="pay_month" value="" required readonly>
                        </div>
                      </div>

                        <div class="col-md-4">
                        <div class="form-group">
                    <label>Payment Mode</label>
                    <select class="form-control select2" name="mode" id="mode" style="width: 100%;" required>
                      <option value="">Select an Mode</option>
                      <option value="cash">Cash</option>
                      <option value="check">Check</option>
  
                   </select>

                    </div>
                      </div>

                    <div id="bank" style="display: none">
                    <div class="col-md-6">
                   <div class="form-group">
                    <label>Cheque/Pay Order No *</label>
                    <input type="text" name="check_num" class="form-control" value="">
  
                  </div>
                  </div>

                  <div class="col-md-6">
                   <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" name="bank_name" class="form-control" value="">
  
                  </div>
                  </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Payment Status</label>
                    <select class="form-control select2" name="status"  style="width: 100%;" required>
                      <option value="">Select an status</option>
                      <option value="Regular">Regular</option>
                      <option value="Advanced">Advanced</option>
  
                   </select>

                    </div>
               
                    </div>
                    <div class="col-md-6" id="submit">
                      <button type="submit" class="btn btn-info">Create</button>
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
            format: "YYYY-MM-DD",
            ignoreReadonly: true,
        });

          $(".datemonth").datetimepicker({
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
         $(document).on('change','#employee',function(){
             var employee= $("#employee").val();
             var role_id= $(".role_id").val();
             
               $.ajax({
                    url:'/sallary/sallaryinfo/',
                    type:'get',
                    data:{employee:employee,role_id:role_id},
                    dataType: 'json',
                    success: function( json ) {
                       $("#basic_sallary").val(json.basic_sallary);
                       $("#house_rent").val(json.house_rent);
                       $("#medical_allowance").val(json.medical_allowance);
                       $("#Transport_allowance").val(json.Transport_allowance);
                       $("#insurance").val(json.insurance);
                       $("#extra_over_time").val(json.extra_over_time);
                       $("#total").val(json.total);
                       $("#sallary_form").show();
                       
                    }
                });
         });


    </script>
    <script>
      $("#mode").change(function(){
        var mode=$("#mode").val();
        if (mode =="check") {
          $("#bank").show(300);
        }
        else {
           $("#bank").hide(300);
        }
      });

      $("#pay_month").blur(function(){
        var employee =$("#employee").val();
        var pay_month =$("#pay_month").val();
        var total =parseInt($("#total").val());
              $.ajax({
                    url:'/sallary/checkpayment/',
                    type:'get',
                    data:{employee:employee,pay_month:pay_month},
                    dataType: 'json',
                    success: function( json ) {
                      var ad =parseInt(json.pay_amt);
                      var a =total-ad;
                      if (a ==0) {
                          $("#ad").css('color:red');
                          $("#total").val(a);
                          $("#submit").hide();
                      }
                      else {
                         $("#submit").show();
                    }
                      }
                });

      });
    </script>
@endsection
<!-- END PAGE JS-->
