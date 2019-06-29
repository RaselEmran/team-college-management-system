{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') sallary setup update @endsection
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
         Sallary Setup Update
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Sallary Setup Update</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
                   <form role="form" action="{{ route('sallary.setup.update') }}" method="post" enctype="multipart/form-data" id="create">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $list->id }}">


                    <div class="row" id="sallary_form">
                      <div class="col-md-6">
                          <div class="form-group">
                          <label for="">Basic Sallary</label>
                            <input type="text" name="basic_sallary" class="form-control" id="inputHelpText"  value="{{$list->basic_sallary}}" required>
                          </div>
                       </div>

                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="">House Rent</label>
                        <input type="text" name="house_rent" class="form-control" id="inputHelpText"  value="{{$list->house_rent}}" required>
                       </div>
                      </div>

                          <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Medical Allowance</label>
                            <input type="text" name="medical_allowance" class="form-control" id="inputHelpText" value="{{$list->medical_allowance}}" required>
                          </div>
                      </div>

                          <div class="col-md-6">
                         <div class="form-group">
                          <label for="">Transport Allowance</label>
                          <input type="text" name="Transport_allowance" class="form-control" id="inputHelpText"  value="{{$list->Transport_allowance}}" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                           <div class="form-group">
                          <label for="">Insurance</label>
                          <input type="text" name="insurance" class="form-control" id="inputHelpText" value="{{$list->insurance}}" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                       <div class="form-group">
                          <label for="">Extra Over Time</label>
                          <input type="text" name="extra_over_time" class="form-control" id="inputHelpText" value="{{$list->extra_over_time}}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                   
                      </div>
                           <div class="col-md-6">
                       <div class="form-group">
                       
                         <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Update</button>
                        </div>
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

    <script>
         


    </script>
@endsection
<!-- END PAGE JS-->
