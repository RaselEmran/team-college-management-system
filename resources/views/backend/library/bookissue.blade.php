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
           <form role="form" action="{{ route('library.postissuebook') }}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-9">
                <div class="form-group">
                  <label for="name">Select Student</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                    {{ Form::select('regiNo',$students->pluck('student.name','regi_no')->prepend('Select Student',""),null,['class'=>'form-control select2'])}}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group ">
                  <label for="idate">Issue Date</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                    <input type="text"   class="form-control datepicker" name="issueDate" required>
                  </div>


                </div>
              </div>


            </div>
          </div>
          <hr class="hrclass">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Book Name/Author Name</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-book blue"></i></span>
                    {{ Form::select('code',$books->pluck('author','code')->prepend('Select Book Author',""),null,['id' => 'bookCode','class'=>'form-control select2'])}}

                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label" for="rack">Quantity</label>

                  <input type="text" id="quantity" class="form-control" name="quantity"   placeholder="1">

                </div>

              </div>

              <div class="col-md-2">
                <div class="form-group ">
                  <label for="rdate">Return Date</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                    <input type="text" id="returnDate"  class="form-control datepicker" name="returnDate">
                  </div>


                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label" for="fine">Fine</label>
                  <input type="text" id="fine" class="form-control" value="0.00"  name="fine" placeholder="Fine Amount">

                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="input-group">
                    <button type="button" class="btn btn-primary" id="btnAddRow"  ><i class="glyphicon glyphicon-plus"></i></button>&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" id="btnDeleteRow" ><i class="glyphicon glyphicon-trash"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="hrclass">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="bookList" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Quantity</th>
                      <th>Return</th>
                      <th>Fine</th>

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

                  <button id="btnsave" class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-plus"></i> Submit</button>

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

      <script type="text/javascript">
    var btnSaveIsvisibale =function ()
    {
      var table = document.getElementById('bookList');
      var rowCount = table.rows.length;
      //console.log(rowCount);
      if(rowCount>1)
      {
        $('#btnsave').show();
      }
      else {
        $('#btnsave').hide();
      }
    };
    var addBook = function() {
      var table = document.getElementById('bookList');
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var cell1 = row.insertCell(0);
      var chkbox = document.createElement("input");
      chkbox.type = "checkbox";
      chkbox.checked=false;
      chkbox.name="sl[]";
      chkbox.size="3";
      cell1.appendChild(chkbox);

      var cell2 = row.insertCell(1);
      var title = document.createElement("label");
      title.innerHTML=$('#bookCode option:selected').text();
      cell2.appendChild(title);
      var bookCode = document.createElement("input");
      bookCode.name="bookCode[]";
      bookCode.value=$('#bookCode option:selected').val();
      bookCode.type="hidden";
      cell2.appendChild(bookCode);


      var cell3 = row.insertCell(2);
      var quantity = document.createElement("label");
      quantity.innerHTML=$('#quantity').val();
      cell3.appendChild(quantity);
      var hquantity = document.createElement("input");
      hquantity.name="quantity[]";
      hquantity.value=$('#quantity').val();
      hquantity.type="hidden";
      cell3.appendChild(hquantity);

      var cell4 = row.insertCell(3);
      var returnDate = document.createElement("label");
      returnDate.innerHTML=$('#returnDate').val();
      cell4.appendChild(returnDate);
      var hreturnDate = document.createElement("input");
      hreturnDate.name="returnDate[]";
      hreturnDate.value=$('#returnDate').val();
      hreturnDate.type="hidden";
      cell4.appendChild(hreturnDate);

      var cell5 = row.insertCell(4);
      var fine = document.createElement("label");
      fine.innerHTML=$('#fine').val();
      cell5.appendChild(fine);
      var hfine = document.createElement("input");
      hfine.name="fine[]";
      hfine.value=$('#fine').val();
      hfine.type="hidden";
      cell5.appendChild(hfine);

      btnSaveIsvisibale();
      $('select#bookCode').select2().select2("val", '');
      $('#quantity').val('');
      $('#returnDate').val('');
      $('#fine').val('0.0');

    };

    $( document ).ready(function() {
      btnSaveIsvisibale();
      $('select').select2();
      //add fee to grid
      $( "#btnAddRow" ).click(function() {
        if(!$('#bookCode').val() ||
        !$('#quantity').val() ||
        !$('#returnDate').val() ||
        !$('#fine').val())
        {
          alert('Please select book,quanty,return date first!!!');
          return false;
        }
        $.ajax({
          url: '/library/issuebook-availabe/'+$('#bookCode').val()+'/'+$('#quantity').val(),
          data: {
            format: 'json'
          },
          error: function(error) {
            console.log(error);
            alert(error);
          },
          dataType: 'json',
          success: function(data) {
            //console.log(data);
            if(data.isAvailable==="Yes"){
              addBook();
            }
            else {
              alert('Book Quantity Not Available!');
            }

          },
          type: 'GET'
        });

      });
      //remove fee to grid
      $( "#btnDeleteRow" ).click(function() {
        try {
          var table = document.getElementById("bookList");

          var rowCount = table.rows.length;

          for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.getElementsByTagName('input')[0];
            //  console.log(chkbox);
            if(null != chkbox && true == chkbox.checked) {
              table.deleteRow(i);
              rowCount--;
              i--;

            }
          }
          btnSaveIsvisibale();
        }catch(e) {
          alert(e);
        }
      });

    });

    </script>
@endsection
<!-- END PAGE JS-->
