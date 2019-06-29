{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Book Issue @endsection
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
            Book Issue
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active"> Book Issue</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-body margin-top-20">
                   <form role="form" action="{{ route('library.postissueBookupdate') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$book->id}}">
                    <div class="row">
                      <div class="col-md-12">
                          <h3 class="text-info"> Book Issue Details</h3>
                          <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="name">Student Regi No</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                  <input type="text" class="form-control" required name="regiNo" value="{{$book->regiNo}}" readonly>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="name">Book Code/ISBN No</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                              <input type="text" class="form-control" required name="code" value="{{$book->code}}" readonly>
                              </div>
                          </div>
                        </div>

                            <div class="col-md-4">
                          <div class="form-group">
                              <label for="name">Book Quantity</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                              <input type="text" class="form-control" required name="quantity" value="{{$book->quantity}}" readonly>
                              </div>
                          </div>
                        </div>


                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="idate">Issue Date</label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                    <input type="text"   class="form-control datepicker" name="issueDate" required value="{{Carbon\Carbon::createFromFormat('Y-m-d',$book->issueDate)->format('d/m/Y')}}" readonly>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="rdate">Return Date</label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                    <input type="text"   class="form-control datepicker" name="returnDate" required value="{{Carbon\Carbon::createFromFormat('Y-m-d',$book->returnDate)->format('d/m/Y')}}" readonly>
                                </div>


                            </div>
                        </div>
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label class="control-label" for="fine">Fine</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign  blue"></i></span>
                                      <input type="text" class="form-control"  name="fine" value="{{$book->fine}}">
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
                                        @if($book->Status=="Borrowed")

                                          <option selected="true" value="Borrowed">Borrowed</option>
                                         <option value="Returned">Returned</option>
                                        @else
                                        <option  value="Borrowed">Borrowed</option>
                                        <option selected="true" value="Returned">Returned</option>
                                        @endif

                                      </select>
                                  </div>


                              </div>
                          </div>
                        </div>
                    </div>




                <div class="row">
                <div class="col-md-12">

                    <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i> Update</button>

                  </div>
                </div>
            

                </form>
                   
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
