{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Fee Collect @endsection
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
            Fees Collection
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Fees Collection</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
     <section class="content">
          <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
           <form role="form" action="{{ route('student.fee.collection') }}" method="post" enctype="multipart/form-data" id="fee_colect">
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
                              <select id="student" name="regi_no"  class="form-control select2" required="true">
                                  <option value="">--Select Student--</option>
                              </select>
                          </div>
                      </div>
                  </div>

                          <div class="col-md-4">
                              <div class="form-group ">
                                  <label for="dob">Collection Date</label>
                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                      <input type="text"   class="form-control datepicker" name="date" value="{{date('Y-m-d')}}" required readonly >
                                  </div>


                              </div>
                          </div>

                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-4">
                              <div class="form-group ">
                                  <label for="dob">Collection Due</label>
                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i> </span>
                                      <input type="text"   class="form-control c_due " name=""  readonly >
                                  </div>


                              </div>
                        </div>
                      </div>
                      </div>
                      <hr class="hrclass">
                      <div class="row">
                          <div class="col-md-12">
                                   <div class="col-md-4">
                                     <div class="form-group">
                                         <label class="control-label" for="type">Type</label>

                                         <div class="input-group">
                                             <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                             <select id="type" name="type" class="form-control select2" required>
                                                <option>--Select Fee Type--</option>
                                                <option value="Admission">Admission</option>
                                               <option value="Monthly">Monthly</option>
                                             <option value="Other">Other</option>

                                             </select>
                                         </div>
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                     <div class="form-group">
                                      <label class="control-label" for="month">Month</label>

                                       <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                           <select id="month" name="month" class="form-control " style="display:none">

                                          <option selected="selected" value="-1">--Select Month--</option>
                                          <option value="1">January</option>
                                          <option value="2">February</option>
                                          <option value="3">March</option>
                                          <option value="4">April</option>
                                          <option value="5">May</option>
                                          <option value="6">June</option>
                                          <option value="7">July</option>
                                          <option value="8">August</option>
                                          <option value="9">September</option>
                                          <option value="10">October</option>
                                          <option value="11">November</option>
                                          <option value="12">December</option>

                                          </select>
                                       </div>
                                      </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label class="control-label" for="student">Fee Name</label>

                                           <div class="input-group">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                               <select id="fee" name="fee" class="form-control select2" required="true">
                                                   <option value="-1">--Select Fee--</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>

                    </div>
                    </div>
                    <div id="feeInfoDiv" style="display:none">
                    <div class="row">
                        <div class="col-md-12">
                       <div class="col-md-4">
                         <div class="form-group">
                             <label for="feeAmount">Fee</label>
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                 <input id="feeAmount" type="text" class="form-control"   name="feeAmount" placeholder="0.00">
                             </div>
                         </div>
                       </div>
                       <div class="col-md-4">
                         <div class="form-group">
                             <label for="LateFeeAmount">Late Fee</label>
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                 <input id="LateFeeAmount" type="text" class="form-control" name="LateFeeAmount" placeholder="0.00">
                             </div>
                         </div>
                       </div>
                       <div class="col-md-4">
                         <div class="form-group">
                             <label>&nbsp;</label>
                              <div class="input-group">
                         <button type="button" class="btn btn-primary" id="btnAddRow"  ><i class="glyphicon glyphicon-plus"></i> Add Fee</button>&nbsp;&nbsp;
                         <button type="button" class="btn btn-danger" id="btnDeleteRow" ><i class="glyphicon glyphicon-trash"></i> Remove Fee</button>
                       </div>
                       </div>
                         </div>

                  </div>
                  </div>
                </div>


                  <hr class="hrclass">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="feeList" class="table table-striped table-bordered table-hover">
                              <thead>
                                       <tr>
                                           <th>#</th>
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
                    <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                            <div class="col-md-6">
                           <label class="control-label" for="ctotal">Current Total:</label>
                         </div>
                             <div class="col-md-6">
                            <input type="text" class="form-control" id="ctotal" readOnly="true" name="ctotal" value="0.00">
                          </div>
                             </div>
                           </div>
                           <div class="row">
                               <div class="col-md-12">
                           <div class="col-md-6">
                            <label class="control-label" for="previousdue">Previous Due:</label>
                          </div>
                             <div class="col-md-6">
                             <input type="text" class="form-control" id="previousdue" readOnly="true"  name="previousdue" value="0.00">
                           </div>
                           </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                              <div class="col-md-6">
                               <label class="control-label" for="gtotal">Grand Total:</label>
                             </div>
                                <div class="col-md-6">
                                <input type="text" class="form-control" id="gtotal" readOnly="true"  name="gtotal" value="0.00">
                              </div>
                              </div>
                                 </div>
                              <div class="row">
                                  <div class="col-md-12">
                              <div class="col-md-6">
                             <label class="control-label" for="paidamount">Paid Amount:</label>
                           </div>
                                 <div class="col-md-6">
                              <input type="text" class="form-control" id="paidamount" required="true" name="paidamount" value="0.00">
                            </div>
                          </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-12">
                               <div class="col-md-6">
                              <label class="control-label" for="dueamount">Due Amount:</label>
                            </div>
                                     <div class="col-md-6">
                               <input type="text" class="form-control" id="dueamount" readOnly="true"  name="dueamount" value="0.00">
                             </div>
                           </div>
                                </div>
                          </div>
                          <div class="col-md-6">
                                     <button class="btn btn-primary pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i>Save</button>
                            </div>
                        </div>
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
 <script type="text/javascript">
        $(document).ready(function () {
            Academic.iclassInit();
        });
    </script>
    <script>
 $('.select2').select2();
    	$("#fee_colect").validate({
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

        <script type="text/javascript">
        function btnSaveIsvisibale()
        {
          var table = document.getElementById('feeList');
          var rowCount = table.rows.length;
          console.log(rowCount);
          if(rowCount>1)
          {
            $('#btnsave').show();
          }
          else {
            $('#btnsave').hide();
          }
        }
        $( document ).ready(function() {

          btnSaveIsvisibale();

        $(".datepicker").datetimepicker({
            format: "YYYY-MM-DD",
            viewMode: 'days',
            ignoreReadonly: true,
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
//.........................
          $( document ).on('change','#session',function(){
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
            });


//get fee list
          $('#type').change(function() {
                  $('#feeInfoDiv').hide();
              if ($('#type').val()=="Monthly")
              {
                $('#month').show();
              }
              else
              {
                  $('#month').hide();
              }
              var aclass = $('#class').val();
              var student = $('#student').val();
              var type =  $('#type').val();
              $.ajax({
                  url: '/fee/getListjson/'+aclass+'/'+type+'/'+student,
                  data: {
                      format: 'json'
                  },
                  error: function(error) {
                      alert("Please fill all inputs correctly!");
                  },
                  dataType: 'json',
                  success: function(data) {
                    $('#fee').empty();
                    $('#fee').append($('<option>').text("--Select Fee--").attr('value',"-1"));
                    $.each(data, function(i, fee) {
                       // console.log(fee);

                        $('#fee').append($('<option>').text(fee.title).attr('value', fee.feeid));
                    });
                       $('.select2').select2();

                  },
                  type: 'GET'
              });


          });
          //get fee info
                    $('#fee').change(function() {

                        if ($('#fee').val()!="-1")
                        {
                          $('#feeInfoDiv').show();
                        }
                        else
                        {
                            $('#feeInfoDiv').hide();
                        }
                        var id = $('#fee').val();
                        var stdid =$("#student").val();

                        $.ajax({
                            url: '/fee/getFeeInfo/'+id+'/'+stdid,
                            data: {
                                format: 'json'
                            },
                            error: function(error) {
                                alert("Please fill all inputs correctly!");
                            },
                            dataType: 'json',
                            success: function(data) {
                              if (!data[0].Latefee) {
                                var Latefee =0;
                              }
                              else
                              {
                                var Latefee =data[0].Latefee
                              }
                              $('#LateFeeAmount').val(Latefee);
                              $('#feeAmount').val(data[0].fee);
                              //console.log(data);

                            },
                            type: 'GET'
                        });


                    });
                    //add fee to grid
                    $( "#btnAddRow" ).click(function() {
                          //  console.log($('#fee').val());

                          var table = document.getElementById('feeList');
                          var rowCount = table.rows.length;
                          var row = table.insertRow(rowCount);
                          var late =$('#LateFeeAmount').val();

                          //total fee
                        var totalFee=parseFloat($('#feeAmount').val())+parseFloat($('#LateFeeAmount').val());

                           var cell1 = row.insertCell(0);
                         var chkbox = document.createElement("input");
                           chkbox.type = "checkbox";
                           chkbox.checked=false;
                           chkbox.name="sl[]";
                           chkbox.size="3";
                           cell1.appendChild(chkbox);

                          var cell2 = row.insertCell(1);
                          var title = document.createElement("input");
                          title.name="gridFeeTitle[]";
                          title.readOnly="true";
                          title.value=$('#fee option:selected').text();
                          cell2.appendChild(title);


                          // var hdregi = document.createElement("input");
                          // hdregi.name="regi_no[]";
                          // hdregi.value=data['regi_no'];
                          // hdregi.type="hidden";
                          // cell2.appendChild(hdregi);


                          var cell3 = row.insertCell(2);
                          var month = document.createElement("input");
                            month.name="gridMonth[]";
                              month.readOnly="true";
                          month.value=$('#month option:selected').val();
                          cell3.appendChild(month);
                          /*   var hdroll = document.createElement("input");
                           hdroll.name="rollNo[]";
                           hdroll.value=data['rollNo'];
                           hdroll.type="hidden";
                           cell3.appendChild(hdroll);*/

                          var cell4 = row.insertCell(3);
                          var feeAmount = document.createElement("input");
                            feeAmount.name="gridFeeAmount[]";
                              feeAmount.readOnly="true";
                          feeAmount.value=$('#feeAmount').val();
                          cell4.appendChild(feeAmount);

                          var cell5 = row.insertCell(4);
                          var LateFeeAmount = document.createElement("input");
                            LateFeeAmount.name="gridLateFeeAmount[]";
                                  LateFeeAmount.readOnly="true";
                          LateFeeAmount.value=$('#LateFeeAmount').val();
                          cell5.appendChild(LateFeeAmount);

                          var cell6 = row.insertCell(5);
                          var total = document.createElement("input");
                            total.name="gridTotal[]";
                                total.readOnly="true";
                          total.value=totalFee;
                          cell6.appendChild(total);

                    //add to total fee below
                    var ctotal= parseFloat($('#ctotal').val());

                    $('#ctotal').val(ctotal+totalFee);
                         addTotalWithDue();
                   btnSaveIsvisibale();
                  $('#month').val(-1);

                    });
              //remove fee to grid
              $( "#btnDeleteRow" ).click(function() {
                    try {
                        var table = document.getElementById("feeList");

                    var rowCount = table.rows.length;

                    for(var i=0; i<rowCount; i++) {
                        var row = table.rows[i];
                        var chkbox = row.getElementsByTagName('input')[0];
                      //  console.log(chkbox);
                        if(null != chkbox && true == chkbox.checked) {
                            var ftotal = parseFloat(row.getElementsByTagName('input')[5].value);
                            var ctotal= parseFloat($('#ctotal').val());
                            $('#ctotal').val(ctotal-ftotal);

                            table.deleteRow(i);
                            rowCount--;
                            i--;
                            addTotalWithDue();
                        }
                    }
                      btnSaveIsvisibale();
                }catch(e) {
                    alert(e);
                }
              });

              //get previous due
              $('#student').change(function() {
                  var aclass = $('#class').val();
                  var stdId = $('#student').val();

                $.ajax({
                      url: '/fee/getDue/'+aclass+'/'+stdId,
                      data: {
                          format: 'json'
                      },
                      error: function(error) {
                          alert(error.message);
                      },
                      dataType: 'json',
                      success: function(data) {
                        $('#previousdue').val(data);
                        console.log(data);

                      },
                      type: 'GET'
                  });


              });
             function addTotalWithDue() {
                  try {

                    var gtotal = parseFloat($('#previousdue').val())+parseFloat($('#ctotal').val());
                    $('#gtotal').val(gtotal);
                    $('#paidamount').val(gtotal);

                }
                catch (e) {
                 // statements to handle any exceptions
                 alert(e.message); // pass exception object to error handler
                }
              };
              $('#paidamount').on('input change keyup paste mouseup propertychange', function() {
                        try {
                            var paidamount =parseFloat($('#paidamount').val());
                            if(isNaN(paidamount))
                            {
                              throw "Invalid Number Format!";
                            }
                            else {
                            var grandTotal = parseFloat($('#gtotal').val());
                            var due = grandTotal-paidamount;
                            $('#dueamount').val(due);
                          }

                        }
                        catch (e) {
                         // statements to handle any exceptions
                         alert(e); // pass exception object to error handler
                        }
             });
          });

    </script>

    <script>
       $("#student").change(function(){
         var student =$(this).val();

              $.ajax({

              type: 'GET',
              url: "{{ URL::to('/get-studentduefee') }}",
              data : {student:student},
              dateType: 'json',
              success: function(data){
                $(".c_due").val(data);
               }
              
            });
          });
    </script>
@endsection
<!-- END PAGE JS-->
