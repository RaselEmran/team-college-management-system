<!-- Master page  -->
@extends('backend.layouts.master')
<!-- Page title -->
@section('pageTitle') Holidays @endsection
<!-- End block -->
<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->
<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
    Holiday
    <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{URL::route('class-off.index')}}"><i class="fa icon-teacher"></i> Class Off</a></li>
    </ol>
</section>
<!-- ./Section header -->
<section class="content">
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div data-original-title="" class="box-header well">
                    <h2><i class="glyphicon glyphicon-user"></i> Class-Off</h2>
                </div>
                <div class="box-content">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form  novalidate id="entryForm" action="{{ route('class-off.store') }}" method="post" enctype="multipart/form-data">
                        <legend class="text-info">Add new class off day</legend>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group ">
                                        <label for="dob">Date Start</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"   class="form-control date_picker" name="offDate" required readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group ">
                                        <label for="holiDateTo">Date End <span class="text-danger">[Optional]</span></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <input type="text"  class="form-control date_picker" name="offDateEnd"  readonly="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" for="gender">Off type</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <select name="oType" class="form-control select2" required >
                                                <option value="E">Exam (E)</option>
                                                <option value="O">Class Off (O)</option>
                                                <option value="CP">College Program (CP)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="holiDateTo">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i> </span>
                                            <textarea class="form-control" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div>
                                            <button class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <br />
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="listDataTable" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                        <thead>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offdays as $day)
                        <tr>
                            <td>{{$day->offDate->format('j M,Y')}}</td>
                            <td>
                                @if($day->oType=='E')
                                Exam
                                @elseif($day->oType=="O")
                                Class Off
                                @else
                                College Program
                                @endif
                            </td>
                            <td>{{$day->description}}</td>
                            <td>{{$day->created_at->format('d/m/Y h:i:s a')}}</td>
                            <td>
                                <a title='Delete' class='btn btn-danger' href='{{url("/class-off/delete")}}/{{$day->id}}'> <i class="fa fa-fw fa-trash"></i></a>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@stop
@section('extraScript')
<script type="text/javascript">
$(document).ready(function () {
Generic.initCommonPageJS();
});
</script>
@stop