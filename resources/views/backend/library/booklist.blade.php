{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Book List @endsection
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
             Books List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active"> Books List</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-body margin-top-20">

            <form role="form" action="{{ route('library.postview-show') }}" method="post" enctype="multipart/form-data">
   {{@csrf_field()}}
              <div class="row">
                <div class="col-md-12">

                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label" for="class">Class</label>

                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                        {{ Form::select('classcode',$classes->pluck('name','id')->prepend('Select class Name',""),NULL,['class'=>'form-control select2','required'=>'true'])}}
                      </div>
                    </div>
                  </div>


                  <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <div class="input-group">
                      <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>
                    </div>
                  </div>

                </div>
              </div>

              <br>
            </form>

          <div class="row">
          <div class="col-md-12">
            @if(count($books)>0)
            <table id="booklist" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Code/ISBN No</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Class</th>
                  <th>Type </th>
                  <th>Quantity</th>
                  <th>Rack No</th>
                  <th>Row No</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($books as $book)
                <tr>
                  <td>{{$book->code}}</td>
                  <td>{{$book->title}}</td>
                  <td>{{$book->author}}</td>
                  <td>{{$book->class}}</td>
                  <td>{{$book->type}}</td>
                  <td>{{$book->quantity}}</td>
                  <td>{{$book->rackNo}}</td>
                  <td>{{$book->rowNo}}</td>
                  <td>{{$book->desc}}</td>

                  <td>
                    <a title='Edit' class='btn btn-success' href='{{ route('library.edit',$book->id) }}'> <i class="glyphicon glyphicon-pencil icon-white"></i></a>&nbsp&nbsp<a title='Delete' class='btn btn-danger' href='{{ route('library.delete',$book->id) }}'> <i class="glyphicon glyphicon-trash icon-white"></i></a>
                  </td>
                  @endforeach
                </tbody>
              </table>
              @endif
            </div>
          </div>
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
