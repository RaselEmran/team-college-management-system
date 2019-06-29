{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') dormitory student @endsection
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
            Dormitory student list
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">student list</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
            <div class="box col-md-12">
        <div class="box-inner">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{ route('dormitory.assignstd.postlist') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="class">Dormitory</label>

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
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="control-label" for="">&nbsp;</label>
                                                <div class="input-group">
                                              <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>
                                            </div>
                                            </div>
                                      </div>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>

            @if(count($students)>0)

            <div class="row">
                    <div class="col-md-12">
              <table id="listDataTableWithSearch" class="table table-striped table-bordered table-hover">
                                 <thead>
                                     <tr>
                                        <th>Regi No</th>
                                         <th>Roll No</th>
                                         <th>Class</th>
                                         <th>Name</th>
                                         <th>Room No</th>
                                          <th>Fee</th>
                                          <th>Joind Date</th>
                                          <th>Leave Date</th>

                                         <th>Is Active</th>
                                          <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                   @foreach($students as $all)
                                     <tr>
                                        <td>{{$all->registration->regi_no}}</td>
                                             <td>{{$all->registration->rollNo}}</td>
                                             <td>{{$all->registration->class->name}}</td>
                                       <td>{{$all->registration->student->name}}</td>
        
                                       <td>{{$all->roomNo}}</td>
                                          <td>{{$all->monthlyFee}}</td>
                                          <td>{{$all->joinDate}}</td>
                                          <td>{{$all->leaveDate}}</td>
                                          <td>{{$all->isActive}}</td>
                               <td>
                        <a title='Edit' class='btn btn-info' href='{{ route('dormitory.assignstd.edit',$all->id) }}'> <i class="fa fa-edit"></i></a>&nbsp&nbsp<a title='Delete' class='btn btn-danger' href='{{ route('dormitory.assignstd.delete',$all->id) }}'> <i class="fa fa-fw fa-trash"></i></a>
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
    	$("#edit").validate({
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
    </script>
@endsection
<!-- END PAGE JS-->
