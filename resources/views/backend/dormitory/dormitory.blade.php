{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') dormitory @endsection
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
            Dormitory
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Dormitory</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
            <div class="box col-md-12">
        <div class="box-inner">
 @if($dormitory)
                     <form role="form" action="{{ route('dormitory.update') }}" method="post" enctype="multipart/form-data" id="create">
                       <input type="hidden" name="id" value="{{$dormitory->id}}">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <div class="row">
                         <div class="col-md-12">
                           <div class="col-md-4">
                               <div class="form-group">
                             <label for="name">Name</label>
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                 <input type="text" class="form-control" required name="name"  value="{{$dormitory->name}}">
                             </div>
                         </div>
                           </div>
                           <div class="col-md-2">
                             <div class="form-group">
                                 <label for="numOfRoom">Number Of Rooms</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                     <input type="text" class="form-control" required name="numOfRoom" value="{{$dormitory->numOfRoom}}">
                                 </div>
                             </div>
                           </div>
                           <div class="col-md-3">
                             <div class="form-group">
                                 <label for="address">Address</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                     <textarea class="form-control" required name="address" >{{$dormitory->address}}</textarea>
                                 </div>
                             </div>
                           </div>
                           <div class="col-md-3">
                             <div class="form-group">
                                 <label for="description">Description</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                     <textarea class="form-control"  name="description">{{$dormitory->description}}</textarea>
                                 </div>
                             </div>
                           </div>

                         </div>
                       </div>
                    <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Update</button>
                      </form>
                    @else
                    <form role="form" action="/dormitory/create" method="post" enctype="multipart/form-data" id="edit">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                          <div class="form-group">
                        <label for="name">Name</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <input type="text" class="form-control" required name="name"  placeholder="Dormitory Name">
                        </div>
                    </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="numOfRoom">Number Of Rooms</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <input type="text" class="form-control" required name="numOfRoom" placeholder="Total rooms in it">
                            </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <textarea class="form-control" required name="address" ></textarea>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                <textarea class="form-control"  name="description"></textarea>
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

            @if(count($dormitories)>0)
                <div class="row">
                  <div class="col-md-12">
                    <table id="listDataTableWithSearch" class="table table-striped table-bordered table-hover">
                                   <thead>
                                       <tr>
                                           <th>Name</th>
                                           <th>Num Of Rooms</th>
                                           <th>Address</th>

                                            <th>Description</th>
                                              <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                     @foreach($dormitories as $dorm)

                                       <tr>
                                          <td>{{$dorm->name}}</td>
                                         <td>{{$dorm->numOfRoom}}</td>
                                         <td>{{$dorm->address}}</td>
                                         <td>{{$dorm->description}}</td>

                                         <td>
                                           <a title='Edit' class='btn btn-info' href='{{ route('dormitory.edit',$dorm->id) }}'> <i class="fa fa-edit"></i></a>&nbsp&nbsp<a title='Delete' class='btn btn-danger' href='{{ route('dormitory.delete',$dorm->id) }}'>  <i class="fa fa-fw fa-trash"></i></a>
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
