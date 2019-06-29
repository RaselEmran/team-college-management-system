
<!DOCTYPE html>
<html lang="en">
<head>
  <title>balance print</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

.bg{
 width: 100%;
 background-color:#dcdcdc;
}
.bg2{
 width: 100%;
background-color:#cccccc;
}
.bg3{
  width: 100%;

}
.bg3 tr:nth-child(even) {
    background-color: #81DAF5;
}
.bg3 tr:nth-child(odd) {
    background-color: #82FA58;
}

table {
border-spacing: 0;
border-collapse: separate;

}
table td{
padding-left: 5px;
}
.thead td{
  border-bottom: solid green 2px;
  font-weight: bold;
  color:blue;
}
.red
{
  color:red;
  font-weight: bold;
}
.green {
  color:green;
  font-weight: bold;
}
.logo{
  height: 150px;
  width: 200px;
}
.lefthead{
  width: 30%;
}
.righthead{
  width: 70%;
}
.righthead p{
  margin: 0px;
  padding: 0px;
}
.bg3 tr:last-child {
    background-color: #cccccc;


}
.bg3 tr:last-child td {
border-top: solid #000 2px;
margin-top:10px !important;
}
#footer
{

width:100%;
height:50px;
position:absolute;
bottom:0;
left:0;
}
.row
{
  max-width: 100%;
}
.col-md-6
{
  width: 40%;
  display: inline-block;
}
</style>
</head>

<body >
<div id="admit">
   <div style="text-align: center;" >
       <img  src="@if(isset($appSettings['institute_settings']['logo'])) {{asset('storage/logo/'.$appSettings['institute_settings']['logo'])}} @else {{ asset('images/logo-md.png') }} @endif" alt="logo-md" class="img-responsive center-block">
     <b> <p style="text-align: center;">{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['name']:'Satt School'}}</p></b>
     <span>
         <strong>Establish:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['establish']:'2018'}}
         <strong>Web:</strong> <a href="{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['website_link']:'https://sattit.com'}}" target="_blank">{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['website_link']:'https://sattit.com'}}</a> <br>
         <strong>Email:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['email']:'satt@sattbd.com'}}
         <strong>Phone:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['phone_no']:'01740390336'}} <br>
         <strong>Address:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['address']:'Talaimari Rajshahi'}}
     </span>
       </div>


<br>
    <div style="margin-left: 35px">
        <div class="col-md-6">
        <table class="bg3">
            <CAPTION class="blue">INCOMES</CAPTION>
            <tr class="thead">
                <th>Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>


            </tr>

            @foreach($incomes as $income)
                <tr>
                    <td>{{$income->name}}</td>
                    <td>{{$income->amount}}</td>
                    <td>{{$income->description}}</td>
                    <td>{{$income->date}}</td>
                </tr>



            @endforeach
            <td class="text-right"><strong>Total:</strong></td><td>{{$incomes->sum('amount')}} tk.</td><td></td><td></td>
     
        </table>
    </div>
        <div class="col-md-6">
            <table class="bg3">
                <CAPTION class="blue">EXPENCES</CAPTION>
                <tr class="thead">
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>


                </tr>

                @foreach($expenses as $expence)
                    <tr>
                        <td>{{$expence->name}}</td>
                        <td>{{$expence->amount}}</td>
                        <td>{{$expence->description}}</td>
                        <td>{{$expence->date}}</td>
                    </tr>



                @endforeach
                <td class="text-right"><strong>Total:</strong></td><td>{{$expenses->sum('amount')}} tk.</td><td></td><td></td>

            </table>
        </div>
        </div>
<br>
<table>
 <tr>  <td><strong>Total Bill Amount:</strong></td><td>{{$incomes->sum('amount')-$expenses->sum('amount')}}</td><td>&nbsp;&nbsp;</td> <tr>
</table>


<br>
<center>-----0-----</center>
<div id="footer">
  <p>Print Date: {{date('d/m/Y')}}</p>
</div>
</body>
</html>
