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
            Borrowed Books List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active"> Borrowed Books</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-body margin-top-20">
                    <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{ route('library.postissuebookview') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <span class="text-danger">[*] Fill at least one feild from first 4 feilds or just select status and get list</span>
                            <div class="row">
                                <div class="col-md-12">

                                  <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="name">Student Regi No</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <input type="text" class="form-control"  name="regiNo" placeholder="Student registration No">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="name">Book Code/ISBN No</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <input type="text" class="form-control"  name="code" placeholder="Book Code">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group ">
                                          <label for="idate">Issue Date</label>
                                          <div class="input-group">

                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                              <input type="text"   class="form-control datepicker" name="issueDate" readonly>
                                          </div>


                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group ">
                                          <label for="rdate">Return Date</label>
                                          <div class="input-group">

                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                              <input type="text"   class="form-control datepicker" name="returnDate" readonly>
                                          </div>


                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group ">
                                          <label for="idate">Status</label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                              <select name="status" class="form-control select2">
                                                <option value="">Status</option>
                                                  <option value="Borrowed">Borrowed</option>
                                                 <option value="Returned">Returned</option>

                                              </select>
                                          </div>


                                      </div>
                                  </div>
                                    <div class="col-md-2">
                                      <label for="">&nbsp;</label>
                                      <div class="input-group">
                                        <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get List</button>
                                      </div>
                                    </div>

                                </div>
                            </div>

                           <br>
                        </form>
                    </div>
                </div>

                                <div class="row">
                    <div class="col-md-12">
              <table id="booklist" class="table table-striped table-bordered table-hover">
                                                         <thead>
                                                             <tr>

                                                                 <th>Std Reg No</th>
                                                                 <th>Code/ISBN No</th>
                                                                 <th>Quantity</th>
                                                                 <th>Issue Date</th>
                                                                 <th>Return Date</th>
                                                                  <th>Fine</th>
                                                                 <th>Status</th>

                                                                  <th>Action</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                     @if(isset($books))
                                     @foreach($books as $book)
                                   <tr>
                                        <td>{{$book->regiNo}}</td>
                                           <td>{{$book->code}}</td>
                                           <td>{{$book->quantity}}</td>
                                           <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$book->issueDate)->format('d/m/Y')}}</td>
                                           <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$book->returnDate)->format('d/m/Y')}}</td>
                                     <td>{{$book->fine}}</td>
                                     <td>{{$book->Status}}</td>


                                             <td>
                                               @if($book->Status=='Borrowed')
                                      <a title='Edit' class='btn btn-success' href='{{ route('library.issuebookupdate',$book->id) }}'> <i class="glyphicon glyphicon-pencil icon-white"></i></a>&nbsp&nbsp<a title='Delete' class='btn btn-danger' href='{{ route('library.issuebookdelete',$book->id) }}'> <i class="glyphicon glyphicon-trash icon-white"></i></a>
                                          @endif
                                   </td>
                                       @endforeach
                                      @endif
                                  </tbody>
                                </table>
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
