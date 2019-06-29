{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Grade sheet @endsection
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
            Grade Sheet
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Grade Sheet</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
            <div class="box col-md-12">
        <div class="box-inner">
                    <form role="form" id="gradesheet" action="{{ route('postgradesheet') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="class">Class</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                            {{ Form::select('class_id',$classes->pluck('name','id')->prepend('Select class Name',""),NULL,['class'=>'form-control select2 classes','required'=>'true'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="section">Section</label>

                                        <div class="input-group" id="section">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            
                                            {{ Form::select('section',$section->pluck('name','id')->prepend('Select class Section',""),NULL,['class'=>'form-control select2','required'=>'true'])}}


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="session">session</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                          {{ Form::select('academic_year_id',$academic_year->pluck('title','id')->prepend('Select session',""),NULL,['class'=>'form-control select2','required'=>'true'])}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="exam">Examination</label>

                                        <div class="input-group" id="exam">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                        
                                            {{ Form::select('exam_id',$exam->pluck('name','id')->prepend('Select Exam Name',""),NULL,['class'=>'form-control select2','required'=>'true'])}}


                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>

                            </div>
                        </div>
                    </form>

                      @if($result)
                        <div class="row">
                            <div class="col-md-12">
                                <table id="listDataTableWithSearch" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Regi No</th>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Shift</th>
                                        <th>Mark</th>
                                        <th>Grade</th>
                                        <th>Point</th>
                                        <th>Merit</th>
                                       
                                         <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key=> $student)
                                        <tr>
                                            <td>{{$student->student->regi_no}}</td>
                                            <td>{{$student->student->roll_no}}</td>
                                            <td>{{$student->student->student->name}} </td>
                                            <td>{{$student->class->name}}</td>
                                            <td>{{$student->student->shift}}</td>
                                            <td>{{$student->total_marks}}</td>
                                              <td>{{$student->grade}}</td>
                                              <td>{{$student->point}}</td>
                                              <td>{{$key+1}}</td>

                                            <td>
                                                <a title='Print' target="_blank" class='btn btn-info' href='{{ route('gradesheet.print',[$student->student->regi_no,$student->exam_id,$student->exam_id]) }}' target="_blank"> <i class="glyphicon glyphicon-print icon-printer"></i></a>
                                            </td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endif
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
              url: "{{ route('get-subject') }}",
              data : {classes:classes},
              dateType: 'text',
              success: function(data){
                $("#subject").html(data)
                $("#subject").find('select').select2();
               }
              
            });

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

              $.ajax({

              type: 'GET',
              url: "{{ route('get-exam') }}",
              data : {classes:classes},
              dateType: 'text',
              success: function(data){
                $("#exam").html(data)
                $("#exam").find('select').select2();
               }
              
            }); 
        });
    </script>
@endsection
<!-- END PAGE JS-->
