{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Admission create @endsection
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
            Admission Create
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
             <li><a href="{{ route('admission_name') }}"></a>Admission</li>
            <li class="active">Admission Create</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
            <div class="box col-md-12">
       
        <div class="box-inner">
                    <form role="form" id="gradesheet" action="{{ route('postadmission') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Class</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                            {{ Form::select('class_id',$classes->pluck('name','id')->prepend('Select class Name',""),NULL,['class'=>'form-control select2 classes','required'=>'true'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="section">Section</label>

                                        <div class="input-group" id="section">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            
                                            {{ Form::select('section',$sections->pluck('name','id')->prepend('Select class Section',""),NULL,['class'=>'form-control select2','required'=>'true'])}}


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="session">session</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                          {{ Form::select('academic_year_id',$academic_years->pluck('title','id')->prepend('Select session',""),NULL,['class'=>'form-control select2','required'=>'true'])}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="session">Admission Name</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                         <input type="text" name="name" class="form-control" required="true">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="session">Open Date</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                       <input type="text" name="open" class="form-control datepicker" required="true" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="session">Close Date</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                       <input type="text" name="close" class="form-control datepicker" required="true" readonly="true">
                                        </div>
                                    </div>
                                </div> 




                            </div>
                        </div>

      
                <div class="row">
                <div class="col-md-12">

                    <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Add</button>

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
    $(".datepicker").datetimepicker({
            format: "YYYY-MM-DD",
            viewMode: 'days',
            ignoreReadonly: true,
        });
  $('.select2').select2();
    </script>
    <script>
    	$("#gradesheet").validate({
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
        $(".classes").change(function(){
         var classes =$(this).val();

           $.ajax({

              type: 'GET',
              url: "{{ route('get-section') }}",
              data : {classes:classes},
              dateType: 'text',
              success: function(data){
                $("#section").html(data)
                $("#section").find('select').select2();
               }
              
            });   


        });
    </script>
@endsection
<!-- END PAGE JS-->
