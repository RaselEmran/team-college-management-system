{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Admission List @endsection
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
            Admission List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Admission List</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
            <div class="box col-md-12">
                   <div class="box-header">
                        <div class="box-tools pull-right">
                            <a class="btn btn-info btn-sm" href="{{ URL::route('admission.create') }}"><i class="fa fa-plus-circle"></i> Generate New</a>
                        </div>
                    </div>
        <div class="box-inner">
                    <form role="form" id="gradesheet" action="{{ route('admission_list') }}" method="post" enctype="multipart/form-data">
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




                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get Admission List</button>

                            </div>
                        </div>
                    </form>

                      @if($admission)
                        <div class="row">
                            <div class="col-md-12">
                                <table id="listDataTableWithSearch" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Session</th>
                                        <th>Class</th>
                                        <th>Section</th>

                                        <th>Admission Name</th>
                                        <th>Open</th>
                                        <th>Close</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admission as $key=> $admissions)
                                        <tr>
                                            <td>{{$admissions->academicyear->title}}</td>
                                            <td>{{$admissions->class->name}}</td>
                                            <td>@if ($admissions->section)
                                            {{$admissions->section->name}}
                                            @endif </td>
                                            <td>{{$admissions->name}}</td>
                                            
                                            <td>{{$admissions->open}}</td>
                                            <td>{{$admissions->close}}</td>
                                          <td>
                                              @if ($admissions->status=='1')
                                            <a href="{{ route('admission_active',$admissions->id) }}" class="btn btn-info">Active</a>
                                            @else
                                             <a href="{{ route('admission_inactive',$admissions->id) }}" class="btn btn-danger">Inactive</a>
                                              @endif
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
