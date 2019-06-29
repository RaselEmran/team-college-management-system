{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Fee Setup @endsection
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
            Fees
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Fees Setup</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
            <div data-original-title="" class="box-header well">
                <h2><i class="glyphicon glyphicon-list"></i> Fee Setup</h2>

            </div>
            <div class="box-content">
              <form role="form" action="{{ route('student.fee.setuppost') }}" id="feesetup" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="control-label" for="class">Academic session</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                            <select id="class" name="academic_year_id" class="form-control select2" required="required" >
                                <option value="">Select academic session</option>
                                @foreach($academic_years as $academic_year)
                                    <option value="{{$academic_year->id}}">{{$academic_year->title}}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">{{ $errors->first('academic_year_id') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="class">Class</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                            <select id="class" name="class_id" class="form-control select2" required="required" >
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">{{ $errors->first('class_id') }}</span>
                        </div>
                    </div>
                      <div class="form-group">
                                            <label class="control-label" for="type">Type</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                                <select name="type" class="form-control select2" required="required" >
                                                <option value="">Select Type</option>
                                                <option value="Admission">Admission</option>
                                                  <option value="Monthly">Monthly</option>
                                                <option value="Other">Other</option>
                                                

                                                </select>
                                            <span class="text-danger">{{ $errors->first('type') }}</span>
                                            </div>

                                        </div>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <input type="text" class="form-control"  name="title" placeholder="Fee title" required="required" >
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="written">Fee</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <input type="text" class="form-control" r name="fee" placeholder="0.00" required="required" >
                              <span class="text-danger">{{ $errors->first('fee') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="written">Late Fee</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <input type="text" class="form-control" name="Latefee" placeholder="0.00">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                            <textarea type="text" class="form-control" name="description" placeholder="Fee Description"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Add</button>
                    <br>
                  </div>
                </form>






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
            Academic.iclassInit();
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
