{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Fee collect view @endsection
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
            Fees Collection Views
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Fees Collection Views </li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
            <div data-original-title="" class="box-header well">
                <h2><i class="glyphicon glyphicon-list"></i> Student Fee Collection View</h2>

            </div>
            <div class="box-content">

              <form role="form" action="{{ route('student.fee.postviews') }}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                      <div class="col-md-12">



                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="control-label" for="class">Class</label>

                                              <div class="input-group">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                                      <select  id="class" name="class_id" class="form-control select2"  required>
                                                    <option value="">--Select Class--</option>
                                                      @foreach($classes as $class)
                                                          <option value="{{$class->id}}">{{$class->name}}</option>
                                                      @endforeach
                                                    </select>

                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="control-label" for="section">Section</label>

                                              <div class="input-group">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>                                           
                                                  

                                                    <select id="section" name="academic_year_id"  class="form-control select2" required >
                                                      <option value="">Select Section</option>
                                             

                                                  </select>



                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="control-label" for="shift">Shift</label>

                                                <div class="input-group">
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                  <select id="shift" name="shift"  class="form-control select2" required >
                                                      <option value="Day">Day</option>
                                                      <option value="Morning">Morning</option>
                                                  </select>

                                              </div>
                                          </div>
                                      </div>


                                  </div>
                              </div>

                  <div class="row">
                      <div class="col-md-12">
                  <div class="col-md-4">
                      <div class="form-group ">
                          <label for="session">session</label>
                          <div class="input-group">

                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                             
                                <select id="session" name="session"  class="form-control select2" required >
                                  <option value="">Select Section</option>
                               @foreach($academicYear as $year)
                                      <option value="{{$year->id}}">{{$year->title}}</option>
                                  @endforeach

                             </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label class="control-label" for="student">Student</label>

                          <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-book blue"></i></span>
                              <select id="student" name="student" class="form-control select2" required="true">
                                  <option value="">--Select Student--</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group">
                          <label class="control-label" for="">&nbsp;</label>

                          <div class="input-group">
                            <button class="btn btn-primary pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-th"></i> Get List</button>

                          </div>
                      </div>
                  </div>



                          </div>
                      </div>
                      <hr class="hrclass">




        </form>

          @if(count($fees)<1)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There are no fees entry for this student.<br><br>
            </div>
          @endif
          @if($fees)
              <div class="row">
                  <div class="col-md-12">
                      <table id="feeList" class="table table-striped table-bordered table-hover">
                          <thead>
                          <tr>
                              <th>Bill No</th>
                              <th>Payable Amount</th>
                              <th>Paid Amount</th>
                              <th>Due Amount</th>
                              <th>Pay Date</th>
                              <th>Action</th>
                          
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($fees as $fee)
                              <tr>
                                  <td><a class="btnbill" href="#">{{$fee->billNo}}</a></td>
                                  <td>{{$fee->payableAmount}}</td>
                                  <td>{{$fee->paidAmount}}</td>
                                  <td>{{$fee->dueAmount}}</td>
                                  <td>{{$fee->date}}</td>
                                  <td><a href="{{ route('student.fee.print',$fee->billNo) }}" target="_blank"><i class="fa fa-print"></i> Print</a></td>


                          @endforeach
                          </tbody>
                      </table>
                  </div>

              </div>
              <div class="row">
                  <div class="col-md-12">
                      <table class="table">

                          <tbody>

                              <tr>
                                  <td></td>
                                  <td>Total Payable: <strong><i class="blue">{{$totals->payTotal}}</i></strong> tk.</td>
                                  <td>Total Paid: <strong><i class="blue">{{$totals->paiTotal}}</i></strong> tk.</td>
                                  <td>Total Due: <strong><i class="blue">{{$fee->dueAmount}}</i></strong> tk.</td>
                                  <td></td>

                                  <td>
                                    <a title='Print' id="btnPrint" class='btn btn-info' target='_blank' href='{{ route('student.fee.getreport',$regi) }}'> <i class="fa fa-print"></i> Print</a>
                                  </td>

                          </tbody>
                      </table>
                  </div>

              </div>
          @endif
        </div>
    </div>
</div>

<!-- Modal Goes here -->
<div id="billDetails" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="table-responsive">
                          <table id="billItem" class="table table-striped table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th>Title</th>
                                  <th>Month</th>
                                  <th>Fee</th>
                                  <th>Late Fee</th>
                                  <th>Total</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tbody>
                          </table>
                      </div>
                  </div>

              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

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
              Academic.sectionInit();
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

    <script>


          $('#feeList').dataTable();
          var session = $('#session').val().trim();
          if(session!="")
          {
            getstudents();
          }
            $( document ).on('change','#session',function(){
                  getstudents();
             });

         //get section
         $(document).on('change','#class',function(){
            var aclass =$(this).val();
            // console.log(aclass);
                 $.ajax({
                  url: '/class/getsection/'+aclass,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                    console.log(data);
                    $('#section').empty();
                    $('#section').append($('<option>').text("--Select section--").attr('value',""));
                    $.each(data, function(i, section) {

                        $('#section').append($('<option>').text(section.name).attr('value', section.id));
                    });
                        //console.log(data);
               $('.select2').select2();
                  },
                  type: 'GET'
              });
         });

          $(".btnbill").click(function(){
              var billId=$(this).text();
              $('.modal-title').html('"'+billId+'" bill details information');
              $.ajax({
                  url: '/fees/details/'+billId,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                      //console.log(data);
                      $("#billItem").find("tr:gt(0)").remove();
                      for(var i =0;i < data.length;i++)
                      {
                          addRow(data[i],i);
                      }

                  },
                  type: 'GET'
              });
              $("#billDetails").modal('show');
          });


         function getstudents()
          {
              var aclass = $('#class').val();
              var section =  $('#section').val();
              var shift = $('#shift').val();
              var session = $('#session').val().trim();
                           $.ajax({
                  url: '/student/getList/'+aclass+'/'+section+'/'+shift+'/'+session,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                    $('#student').empty();
                    $('#student').append($('<option>').text("--Select Student--").attr('value',""));
                    $.each(data, function(i, student) {

                        $('#student').append($('<option>').text(student.student.name+"["+student.regi_no+"]").attr('value', student.regi_no));
                    });
                        //console.log(data);
               $('.select2').select2();
                  },
                  type: 'GET'
              });
        };

           function addRow(data,index) {
            var table = document.getElementById('billItem');
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var cell2 = row.insertCell(0);
            var title = document.createElement("label");

            title.innerHTML=data['title'];
            cell2.appendChild(title);

            var cell3 = row.insertCell(1);
            var month = document.createElement("label");
            month.innerHTML=getTXTmonth(data['month']);
            cell3.appendChild(month);


            var cell4 = row.insertCell(2);
            var fee = document.createElement("label");
            fee.innerHTML=data['fee'];
            cell4.appendChild(fee);

            var cell5 = row.insertCell(3);
            var lateFee = document.createElement("label");
            lateFee.innerHTML=data['lateFee'];
            cell5.appendChild(lateFee);

            var cell6 = row.insertCell(4);
            var total = document.createElement("label");
            total.innerHTML=data['total'];
            cell6.appendChild(total);
        };


       function getTXTmonth(mindex)
       {
         if(mindex=="1")
         {
           return "January";
         }
         else if(mindex=="2")
         {
            return "February";
         }
         else if(mindex=="3")
         {
            return "March";
         }
         else if(mindex=="4")
         {
            return "April";
         }
         else if(mindex=="5")
         {
            return "May";
         }
         else if(mindex=="6")
         {
            return "June";
         }
         else if(mindex=="7")
         {
            return "July";
         }
         else if(mindex=="8")
         {
            return "August";
         }
         else if(mindex=="9")
         {
            return "September";
         }
         else if(mindex=="10")
         {
            return "October";
         }
         else if(mindex=="11")
         {
            return "November";
         }
         else if(mindex=="12")
         {
            return "December";
         }
         else {
            return "Not Monthly Fee";
         }


       };
    </script>
@endsection
<!-- END PAGE JS-->
