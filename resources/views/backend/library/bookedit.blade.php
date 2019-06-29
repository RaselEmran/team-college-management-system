{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Book Update @endsection
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
             Books Update
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active"> Books Update</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-body margin-top-20">

                   <form role="form" action="{{ route('library.update') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <input type="hidden" name="id" value="{{$book->id }}">
                    <div class="row">
                      <div class="col-md-12">
                          <h3 class="text-info"> Book Details</h3>
                          <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="name">Code/ISBN No</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                  <input type="text" readonly="true" class="form-control" required name="code"  value="{{$book->code}}">
                              </div>
                          </div>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                              <label for="name">Title/Name</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                  <input type="text" class="form-control" required name="title" value="{{$book->title}}">
                              </div>
                          </div>
                        </div>


                     </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                          <label class="control-label" for="author">Author</label>

                          <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                <input type="text" class="form-control" required name="author" value="{{$book->author}}">
                          </div>
                      </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label" for="rack">Quantity</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                    <input type="text" class="form-control"  name="quantity" value="{{$book->quantity}}">
                                </div>
                            </div>
                        </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label class="control-label" for="rack">Rack No</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                      <input type="text" class="form-control"  name="rackNo" value="{{$book->rackNo}}">
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label class="control-label" for="row">Row No</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                      <input type="text" class="form-control"  name="rowNo" value="{{$book->rowNo}}">
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                          <div class="row">
                            <div class="col-md-12">
                    <div class="col-md-3">
                      <div class="form-group">
                            <label class="control-label" for="type">Type</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                   {{ Form::select('type',['Academic'=>'Academic','Story'=>'Story','Magazine'=>'Magazine','Other'=>'Other'],$book->type,['class'=>'form-control select2'])}}

                            </div>
                        </div>
                    </div>
                      <div class="col-md-4">
                            <div class="form-group">
                                            <label class="control-label" for="class">Class</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                                 {{ Form::select('class',$classes->pluck('name','id'),$book->class,['class'=>'form-control select2'])}}
                                            </div>
                                        </div>
                      </div>
                      <div class="col-md-5">
                          <div class="form-group">
                              <label class="control-label" for="dec">Description</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                <textarea class="form-control"  name="desc" >{{$book->desc}} </textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>



                <div class="row">
                <div class="col-md-12">

                    <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Update</button>

                  </div>
                </div>
                </form>
          </div>
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
      $(".datepicker").datetimepicker({
            format: "YYYY-MM-DD",
            viewMode: 'days',
            ignoreReadonly: true,
        });
      $('#booklist').dataTable();
  </script>
@endsection
<!-- END PAGE JS-->
