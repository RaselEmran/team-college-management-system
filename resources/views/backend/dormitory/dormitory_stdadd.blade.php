{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') dormitory assaign @endsection
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
          Student Add To Dormitory
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Dormitory assign</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
                    <form role="form" action="{{ route('dormitory.assignstd.create') }}" method="post" enctype="multipart/form-data" id="create">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="class">Class</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                                    <select id="class" id="class" name="class" class="form-control select2" >
                                                        <option value="">--Select Class--</option>
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="section">Section</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                        <select id="section" name="section"  class="form-control select2" >
                                                            <option value="">select section</option>
                                                      @foreach($section as $sections)
                                                            <option value="{{$sections->id}}">{{$sections->name}}</option>
                                                        @endforeach

                                                        </select>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="shift">Shift</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                        <select id="shift" name="shift"  class="form-control" >
                                                            <option value="Day">Day</option>
                                                            <option value="Morning">Morning</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group ">
                                                    <label for="session">session</label>
                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                      <select id="session" name="session"  class="form-control select2" >
                                                          <option value="">select session</option>
                                                      @foreach($academicYear as $session)
                                                            <option value="{{$session->id}}">{{$session->title}}</option>
                                                        @endforeach

                                                        </select>
                                                    
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                        <div class="row">
                            <div class="col-md-12">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="student">Student</label>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
                                    <select id="student" name="regi_no" class="form-control select2" required="true">
                                        <option value="">--Select Student--</option>


                                    </select>
                                </div>
                            </div>
                        </div>
                                <div class="col-md-2">
                                    <div class="form-group ">
                                        <label for="joindate">Join Date</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"   class="form-control datepicker" name="joinDate" required >
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="isActive">Is Active</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <select  name="isActive" class="form-control select2" required="true">
                                              <option value="Yes">Yes</option>
                                              <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="dormitory">Dormitory</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                            <select  name="dormitory" class="form-control select2" required="true">
                                              <option value="">--Select Dormitory--</option>
                                              @foreach($dormitories as $dorm)
                                                  <option value="{{$dorm->id}}">{{$dorm->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label" for="roomNo">Room No.</label>

                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                              <input type="text"  name="roomNo" class="form-control" required="true" placeholder="12" />

                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label" for="monthlyFee">Monthly Fee</label>

                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                              <input type="text"  name="monthlyFee" class="form-control" required="true" placeholder="5000.00" />

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
            viewMode: 'days',
            ignoreReadonly: true,
        });
    </script>

    <script>
            $( document ).on('change','#session',function(){
             var aclass = $('#class').val();
              var section =  $('#section').val();
              var shift = $('#shift').val();
              var session = $('#session').val().trim();
                           $.ajax({
                  url: '/student/getList/'+aclass+'/'+section+'/'+shift+'/'+session,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                    $('#student').empty();
                    $('#student').append($('<option>').text("--Select Student--").attr('value',""));
                    $.each(data, function(i, student) {

                        $('#student').append($('<option>').text(student.student.name+"["+student.regi_no+"]").attr('value', student.regi_no));
                    });
                        //console.log(data);
               $('.select2').select2();
                  },
                  type: 'GET'
              });
            });
    </script>
@endsection
<!-- END PAGE JS-->
