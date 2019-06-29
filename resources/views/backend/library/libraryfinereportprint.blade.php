
<!DOCTYPE html>
<html lang="en">
<head>
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
</style>
</head>

<body >
<div id="admit">
  <div style="max-width: 30%;margin: auto;">
     <img  src="@if(isset($appSettings['institute_settings']['logo'])) {{asset('storage/logo/'.$appSettings['institute_settings']['logo'])}} @else {{ asset('images/logo-md.png') }} @endif" alt="logo-md">
  </div>
  <table class="bg">
    <tr>
    <td class="lefthead">

  
    </td>

   <td class="righthead">
<h3>{{$appSettings['institute_settings']['name']}}</h3><pre>
<p><strong>Establish:</strong> {{$appSettings['institute_settings']['establish']}}</p>
<p><strong>Web:</strong> {{$appSettings['institute_settings']['website_link']}}</p>
<p><strong>Email:</strong> {{$appSettings['institute_settings']['email']}}</p>
<p><strong>Phone:</strong> {{$appSettings['institute_settings']['phone_no']}}</p>
<p><strong>Address:</strong> {{$appSettings['institute_settings']['address']}}</p>
     </pre>
   </td>
   </tr>

 </table>
  <table class="bg2">
   <tr><td>
    Library Report
  </td>
  <td><strong>{{$rdata['name']}}</strong></td>
  <td >
    Month : <strong>{{$rdata['month']}}</strong>
  </td>
</tr>
</table>
<br>
<center>
<h1>
 <strong>Total Fine: {{$rdata['total']}} tk.</strong></h1>

</center>
<div id="footer">
  <p>Print Date: {{date('d/m/Y')}}</p>
</div>
</body>
</html>
