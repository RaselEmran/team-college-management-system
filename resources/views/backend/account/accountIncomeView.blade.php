{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') income view @endsection
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
         Income view
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Income view</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">

                    <form role="form" action="{{ route('accounting.postexpencelist') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label for="session">Income Year</label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                                    <input type="text"  required="true" class="form-control datepicker" name="year" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label for="ff">&nbsp;</label>
                                                <div class="input-group">
                                                <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>
                                                    </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <br>
                            </form>

                 @if(count($incomes)>0)
                    <div class="row">
                        <div class="col-md-12">
                        <div class="box-body margin-top-20">
                        <div class="table-responsive">
                        <table id="listDataTableWithSearch" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Name</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Date</th>
                                <th width="10%">Description</th>
                                <th class="notexport" width="10%">Action</th>
                            </tr>
                            </thead>
                                <tbody>
                                @foreach($incomes as $income)
                                    <tr>
                                        <td>
                                         {{$loop->iteration}}
                                        </td>
                                        <td>{{$income->name}}</td>
                                        <td>{{$income->amount}}</td>
                                        <td>{{$income->date}}</td>
                                        <td>{{$income->description}}</td>
                                        <td>
                                          <div class="btn-group">
                                         <a title="Edit" href="{{ route('accounting.incomeedit',$income->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                       </div>
                                         <div class="btn-group">
                                      <form  class="myAction" method="POST" action="{{ route('accounting.incomedelete') }}">
                                          {{@csrf_field()}}
                                          <input type="hidden" name="hiddenId" value="{{$income->id}}">
                                          <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                              <i class="fa fa-fw fa-trash"></i>
                                          </button>
                                      </form>
                                  </div>
                                  </td>
                              </tr>
                               @endforeach
                          </tbody>
                        </table>
                    </div>
                    </div>
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
            format: "YYYY",
            viewMode: "years",
            ignoreReadonly: true,
        });
    </script>


@endsection
<!-- END PAGE JS-->
