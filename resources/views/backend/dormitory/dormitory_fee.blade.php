{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') dormitory fee @endsection
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
          Student  Dormitory Fee
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Dormitory fee</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
                   <form role="form" action="{{ route('dormitory.fee') }}" method="post" enctype="multipart/form-data" id="create">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="dormitory">Dormitory</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                            <select id="dormitory"  name="dormitory" class="form-control select2" required="true">
                                              <option value="">--Select Dormitory--</option>
                                              @foreach($dormitories as $dorm)
                                                  <option value="{{$dorm->id}}">{{$dorm->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label" for="students">Student</label>

                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
                                          <select id="students" name="regi_no" class="form-control select2" required="true">
                                              <option value="">--Select Student--</option>


                                          </select>
                                      </div>
                                  </div>
                              </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="month">To month</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"   class="form-control datepicker" name="todate" required id="todate">
                                        </div>


                                    </div>
                                  </div>

                                    <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="month">Form month</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"   class="form-control datepicker" name="formdate" required id="formdate">
                                        </div>


                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label" for="amount">Fee Amount</label>

                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                              <input type="text"  name="feeAmount" id="feeAmount" class="form-control" required="true" placeholder="5000.00" />

                                          </div>
                                      </div>
                                  </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label" for="amount">Total Amount</label>

                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                              <input type="text"  name="totalAmount" id="totalAmount" class="form-control" required="true" placeholder="5000.00" />

                                          </div>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                        <!--button save -->
                        <div class="row">
                            <div class="col-md-12">

                                <button class="btn btn-primary pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i>Save</button>
                              </div>
                          </div>
                        </div>
                              <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">

                                      <div id="board" style="background: green;color:#fff">
                                          <h3 >Monthly Fees</h3>
                                          <strong><h2  class="yellow" id='mfee'>0.00 TK.</h2></strong>
                                           <h3 id="status" class="green">Status: Paid</h3>
                                      </div>
                                      </div>
                                  </div>
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
     

            $('#btnsave').hide();
            $('#board').show();


            $("#dormitory").change(function() {
              var val = $(this).val();
           
                      $.ajax({
                    url:'/dormitory/getstudents/'+val,
                    type:'get',
                    dataType: 'json',
                    success: function( json ) {

                        $('#students').empty();
                        $('#students').append($('<option>').text("--Select Student--").attr('value',""));
                        $.each(json, function(i, student) {
                        

                             $('#students').append($('<option>').text(student.registration.student.name+"["+student.registration.regi_no+"]").attr('value', student.registration.regi_no));
                        });

                    }
                });

     
            });

            $("#students").change(function() {
              var val = $(this).val();
              var dormitory =$("#dormitory").val();
              console.log(val);
                // $.ajax({
                //     url:'/dormitory/fee/info/'+val,
                //     type:'get',
                //     dataType: 'json',
                //     success: function( data ) {
                      
                //         $('#board').hide();
                //         // $('#mfee').text(data[0]);
                //         if(data[1]=="false")
                //         {
                //           console.log(data[0]);
                //            $('#board').show();
                //            $("#mfee").text('');
                //            $('#status').text('');
                //            $("#board").removeAttr('style');
                //            $("#board").attr('style','color:red;background:yellow');
                //            $('#mfee').text(data[0]+'TK')
                //            $('#status').text('Status: Due');
                //           // $('#status').removeClass();
                //           // $('#status').addClass("red");

                //         }
                //         if(data[1]=="true")
                //         {
                //            $('#board').show();
                //            $("#mfee").text('');
                //            $('#status').text('');
                //            $("#board").removeAttr('style');
                //            $("#board").attr('style','color:#fff;background:green');
                //            $('#mfee').text(data[0]+'TK')
                //           $('#status').text('Status: Paid');

                //         }

                //         $('#btnsave').show();
                //     }
                // });

                     $.ajax({
                    url:'/dormitory/mainfee',
                    type:'get',
                    data:{val:val,dormitory:dormitory},
                    dataType: 'json',
                    success: function( data ) {
                      $("#feeAmount").val(data.monthlyFee);
                       $('#btnsave').show();
               
                    }
                    }); 
             
            });

        });

$(document).on('blur','#formdate',function(){
  var formdate =$(this).val();
  var formmoth =formdate.split('-');
  var formval =formmoth[1];
  var todate =$("#todate").val();
  var tomonth =todate.split('-');
  var toval =tomonth[1];
  var final =parseInt(formval-toval);
  var feeAmount =parseInt($("#feeAmount").val());
  var totalAmount =final*feeAmount;
  $("#totalAmount").val(totalAmount);
});

    </script>
@endsection
<!-- END PAGE JS-->
