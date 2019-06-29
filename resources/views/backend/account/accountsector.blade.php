{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') account sector @endsection
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
         Account Sector
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Account Sector</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
               @if($sector)
                        <form role="form" action="{{ route('accounting.sectorupdate') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$sector->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="gpa">Sector Name</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                <input type="text" class="form-control" required name="name" value="{{$sector->name}}" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="type">Type</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                {{ Form::select('type',['Income'=>'Income','Expence'=>'Expence'],$sector->type,['class'=>'form-control select2','required'=>'true'])}}


                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Update</button>
                            <br>
                        </form>
                    @else
                        <form role="form" action="{{ route('accounting.sectorcreate') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="gpa">Sector Name</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                <input type="text" class="form-control" required name="name"  placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="type">Type</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                <select name="type" id="type" required="true" class="form-control select2" >
                                                    <option value="Income">Income</option>
                                                    <option value="Expence">Expence</option>
                                                </select>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            <br>
                        </form>
                    @endif 
                    <br>
                   @if(count($sectors)>0)
                    <div class="row">
                        <div class="col-md-12">
                         <div class="box-body margin-top-20">
                        <div class="table-responsive">
                        <table id="listDataTableWithSearch" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Sector Name</th>
                                <th width="10%">Type</th>
                                <th class="notexport" width="10%">Action</th>
                            </tr>
                            </thead>
                                <tbody>
                                @foreach($sectors as $sector)
                                    <tr>
                                         <td>
                                         {{$loop->iteration}}
                                          </td>
                                          <td>{{$sector->name}}</td>
                                          <td>{{$sector->type}}</td>
                                          <td>
                                          <div class="btn-group">
                                         <a title="Edit" href="{{ route('accounting.sectoredit',$sector->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                  </div>
                                         <div class="btn-group">
                                      <form  class="myAction" method="POST" action="{{ route('accounting.sectordelete') }}">
                                          {{@csrf_field()}}
                                          <input type="hidden" name="hiddenId" value="{{$sector->id}}">
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
 
    </script>


@endsection
<!-- END PAGE JS-->
