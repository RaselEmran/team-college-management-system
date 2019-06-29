{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Fee Setup @endsection
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
            Fees List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">List</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <div class="box-tools pull-right">
                            <a class="btn btn-info btn-sm" href="{{ URL::route('student.fee.setup') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body margin-top-20">
                        <div class="table-responsive">
                        <table id="listDataTableWithSearch" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Academic</th>
                                <th width="10%">Class Name</th>
                                <th width="10%">Type</th>
                                <th width="10%">Title</th>
                                <th width="10%">Fee</th>
                                <th width="10%">Let Fee</th>
                                <th width="10%">Description</th>

                                <th class="notexport" width="10%">Action</th>
                            </tr>
                            </thead>
                                      <tbody>
                                        @foreach($fees as $fee)
                                          <tr>
                                               <td>
                                               {{$loop->iteration}}
                                                </td>
                                                <td>{{$fee->academicyear->title}}</td>
                                                <td>{{$fee->class->name}}</td>
                                                <td>{{$fee->type}}</td>
                                                <td>{{$fee->title}}</td>
                                                <td>{{$fee->fee}}</td>
                                                <td>{{$fee->Latefee}}</td>
                                                <td>{{$fee->description}}</td>

                                                <td>
                                                  <div class="btn-group">
                                               <a title="Edit" href="{{URL::route('student.feessetup_edit',$fee->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                        </div>
                                               <div class="btn-group">
                                            <form  class="myAction" method="POST" action="{{URL::route('student.feessetup_destroy')}}">
                                                {{@csrf_field()}}
                                                <input type="hidden" name="hiddenId" value="{{$fee->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        </td>
                                            @endforeach
                                        </tbody>
                            <tfoot>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Academic</th>
                                <th width="10%">Class Name</th>
                                <th width="10%">Type</th>
                                <th width="10%">Title</th>
                                <th width="10%">Fee</th>
                                <th width="10%">Let Fee</th>
                                   <th width="10%">Description</th>
                                <th class="notexport" width="10%">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                    <!-- /.box-body -->
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
@endsection
<!-- END PAGE JS-->
