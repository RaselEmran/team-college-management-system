{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') promotion @endsection
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
            Student Promotion
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Promotion</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
           <div class="box-header" data-original-title="" style="background: #3C8DBC;color: #fff">
                  <h2><i class="glyphicon glyphicon-edit"></i> Promotion From</h2>

            </div>
            <div class="box-content">
         <form role="form" action="{{ route('post-promotion') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box col-md-6">
                                    <div class="box-inner">
                                   
                                        <div class="box-content">
                                            <div class="row">
                                                <div class="col-md-12">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="class">Class</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                                    <select id="class" name="class" class="form-control select2" >
                                                        <option value="">Select Class</option>
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="section">Section</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                <select id="section" name="section"  class="form-control select2" >
                                                    <option value="">Select Section</option>
       

                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="shift">Shift</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <select id="shift" name="shift"  class="form-control select2" >
                                                <option value="">Select Shift</option>
                                                <option value="Day">Day</option>
                                                <option value="Morning">Morning</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="session">session</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <select id="session" name="session"  class="form-control select2" >
                                                    <option value="">Select Session</option>
                                                   @foreach($academic_years as $academic_year)
                                                            <option value="{{$academic_year->id}}">{{$academic_year->title}}</option>
                                                  @endforeach

                                                </select>
                                        
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header" data-original-title="" style="background: #3C8DBC;color: #fff">
                    <h2><i class="glyphicon glyphicon-edit"></i> Promotion To</h2>


                </div>
                <div class="box-content">

                    <div class="row">
                        <div class="col-md-12">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="class">Class</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                        <select id="nclass" name="nclass" class="form-control select2" >
                                            <option value="">Select Class</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="section">Section</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                        <select id="nsection" name="nsection"  class="form-control select2" >
                                            <option value="">Select Section</option>
                                                

                                        </select>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="shift">Shift</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                        <select id="shift" name="nshift"  class="form-control select2" >
                                            <option value="">Select Shift</option>
                                            <option value="Day">Day</option>
                                            <option value="Morning">Morning</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="session">session</label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                     
                                               <select id="nsession" name="nsession"  class="form-control select2" >
                                            <option value="">Select Section</option>
                                                  @foreach($academic_years as $academic_year)
                                                            <option value="{{$academic_year->id}}">{{$academic_year->title}}</option>
                                                  @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="allcheck" name="allcheck"> SL#</th>
                        <th>Registration No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>New Roll No</th>
                    </tr>
                    </thead>
                    <tbody id="studentList" >


                    <tbody>
                </table>
            </div>
        </div>

    </div>

    <!--button save -->
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i>Save</button>
</form>





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
    <script>
    	$("#feesetup").validate({
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
    </script>

    <script>
        
          $( document ).on('change','#session',function(){
             var aclass = $('#class').val();
              var section =  $('#section').val();
              var shift = $('#shift').val();
              var session = $('#session').val().trim();
                           $.ajax({
                  url: '/promotion/studentlist/'+aclass+'/'+section+'/'+shift+'/'+session,
                  data: {
                      format: 'html'
                  },
                   error: function(error) {
                        alert(error);
                    },
                    dataType: 'html',
                    success: function(data) {

                        $("#studentList").find("tr:gt(0)").remove();
                       $("#studentList").html(data);
                            $('#btnsave').show();
                

                    },
                  type: 'GET'
              });
            });

        $('#allcheck').click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);

        });

         //get section
         $(document).on('change','#class',function(){
            var aclass =$(this).val();
            // console.log(aclass);
                 $.ajax({
                  url: '/class/getsection/'+aclass,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                    console.log(data);
                    $('#section').empty();
                    $('#section').append($('<option>').text("--Select section--").attr('value',""));
                    $.each(data, function(i, section) {

                        $('#section').append($('<option>').text(section.name).attr('value', section.id));
                    });
                        //console.log(data);
               $('.select2').select2();
                  },
                  type: 'GET'
              });
         });


         //get section
         $(document).on('change','#nclass',function(){
            var aclass =$(this).val();
            // console.log(aclass);
                 $.ajax({
                  url: '/class/getsection/'+aclass,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                    console.log(data);
                    $('#nsection').empty();
                    $('#nsection').append($('<option>').text("--Select section--").attr('value',""));
                    $.each(data, function(i, nsection) {

                        $('#nsection').append($('<option>').text(nsection.name).attr('value', nsection.id));
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
