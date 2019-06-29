{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Book Search @endsection
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
            Book Search
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Book Search</li>
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
                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body margin-top-20">
                   <form role="form" action="{{ route('library.search1') }}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <span class="text-danger">[*]Fill up any feilds and search </span>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="name">Code/ISBN No</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                        <input type="text" class="form-control"  name="code" placeholder="Book Code">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Title/Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                        <input type="text" class="form-control"  name="title" placeholder="Book Name">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label" for="author">Author</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                        <input type="text" class="form-control"  name="author" placeholder="Writer Name">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="">&nbsp;</label>
                    <div class="input-group">
                      <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-search"></i> Search</button>
                    </div>
                  </div>

                </div>
              </div>

            </form>

             <form role="form" action="{{ route('library.search2') }}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <span class="text-danger">[*]Fill up both feilds and search </span>
              <div class="row">
                <div class="col-md-12">



                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="control-label" for="type">Type</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                     

                            <select  id="type" name="type" class="form-control select2" >
                              <option value="">--Select Type--</option>
                            
                                <option value="Academic">Academic</option>
                                <option value="Story">Story</option>
                                <option value="Magazine">Magazine</option>
                                <option value="Other">Other</option>

                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="control-label" for="class">Class</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                            <select  id="class" name="class" class="form-control select2">
                              <option value="">--Select Class--</option>
                              @foreach($classes as $class)
                                  <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach

                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="">&nbsp;</label>
                    <div class="input-group">
                      <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-search"></i> Search</button>
                    </div>
                  </div>

                </div>
              </div>


              <br>
            </form>

         @if(isset($books))
        <div class="row">
          <div class="col-md-12">
            @if(count($books)>0)
            <table id="bookList" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Code/ISBN No</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Class</th>
                  <th>Type </th>
                  <th>Quantity </th>
                  <th>Rack No</th>
                  <th>Row No</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($books as $book)
                <tr>
                  <td>{{$book->code}}</td>
                  <td>{{$book->title}}</td>
                  <td>{{$book->author}}</td>
                  <td>{{$book->classes->name}}</td>
                  <td>{{$book->type}}</td>
                  <td>{{$book->quantity}}</td>
                  <td>{{$book->rackNo}}</td>
                  <td>{{$book->rowNo}}</td>
                  <td>
                    <a title='Update Quantity' class='btn btn-success' href='{{url("/library/edit")}}/{{$book->id}}'> <i class="glyphicon glyphicon-pencil icon-white"></i></a>
                  </td>


                  @endforeach

                </tbody>
              </table>
              @else
              <div class="alert alert-warning">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Book Not Found!</strong>

              </div>
              @endif
            </div>
          </div>
          @endif
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

@endsection
<!-- END PAGE JS-->
