{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') sallary Setup list @endsection
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
            Sallary Setup List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Sallary Setup List</li>
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
                            <a class="btn btn-info btn-sm" href="{{ URL::route('sallary') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body margin-top-20">
                        <div class="table-responsive">
                        <table id="listDataTableWithSearch" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Type</th>
                                <th width="10%">Name</th>
                                <th width="10%">Designation</th>
                                <th width="10%">Total Sallary</th>
                                <th width="10%">Status</th>
                                <th class="notexport" width="10%">Action</th>
                            </tr>
                            </thead>
                                      <tbody>
                                        @foreach($lists as $list)
                                          <tr>
                                               <td>
                                               {{$loop->iteration}}
                                                </td>
                                                <td>{{$list->role->name}}</td>
                                                <td>{{$list->employee->name}}</td>
                                                <td>{{$list->employee->designation}}</td>
                                                <td>{{$list->total}}</td>
                                                <td>
                                                    @if ($list->status==true)
                                                       <a href="{{ route('sallary.setup.active',$list->id) }}" class="btn btn-success">Active</a>
                                                       @else
                                                       <a href="{{ route('sallary.setup.inactive',$list->id) }}" class="btn btn-danger">Inactive</a>
                                                    @endif
                                                </td>

                                                <td>
                                                  <div class="btn-group">
                                               <a title="Edit" href="{{URL::route('sallary.setup.edit',$list->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                        </div>
                                               <div class="btn-group">
                                            <form  class="myAction" method="POST" action="{{URL::route('sallary.setup.delete')}}">
                                                {{@csrf_field()}}
                                                <input type="hidden" name="hiddenId" value="{{$list->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        </td>
                                     @endforeach
                                </tbody>
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
