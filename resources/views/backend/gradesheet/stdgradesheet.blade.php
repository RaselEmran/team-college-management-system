<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GradeSheet</title>
    <link rel="stylesheet" href="{{asset('css/result.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
   

    <section class="content">
            <div class="box col-md-12">
        <div class="box-inner">
            <div id="printableArea">
  <div class="wraperResult">
          <div style="text-align: center;" >
       <img  src="@if(isset($appSettings['institute_settings']['logo'])) {{asset('storage/logo/'.$appSettings['institute_settings']['logo'])}} @else {{ asset('images/logo-md.png') }} @endif" alt="logo-md" class="img-responsive center-block">
     <b> <p style="text-align: center;">{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['name']:'Satt School'}}</p></b>
     <span>
         <strong>Establish:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['establish']:'2018'}}
         <strong>Web:</strong> <a href="{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['website_link']:'https://sattit.com'}}" target="_blank">{{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['website_link']:'htpps://sattit.com'}}</a> <br>
         <strong>Email:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['email']:'satt@satt@sattit.com'}}
         <strong>Phone:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['phone_no']:'01740390336'}} <br>
         <strong>Address:</strong> {{isset($appSettings['institute_settings'])?$appSettings['institute_settings']['address']:'Talaimari Rajshshi'}} <br>
           <span>Class {{$student->class->name}} {{$examname->name}} EXAMINATION</span> <br>
                <strong>  Equivalent Result Publication  </strong>
     </span>
       </div>

    <div class="resContainer">
          <div class="resTophdr">
            <div class="restopleft">
                <div><b>{{$student->student->name}} </b></div>
                <div><span>FATHER'S NAME</span><i>: </i><em>{{$student->student->father_name}}</em></div>
                <div><span>MOTHER'S NAME</span><i>: </i><em>{{$student->student->mother_name}}</em></div>
                <div><span>STUDENT ID</span><i>: </i><em>{{$student->regi_no}}</em></div>
                <div><span>DATE OF BIRTH</span><i>: </i><em>{{$student->student->dob}}</em></div>
                <!--<div><span>NEW CLASS ROLL :  </span><em>02</em></div>-->
                <div><span>SHIFT</span><i>: </i><em>{{$student->shift}}</em></div>
            </div><!-- end of restopleft -->

            <div class="restopleft rgttopleft">
                <div><span>CLASS</span><i>: </i><em>{{$student->class->name}}</em></div>
              
                <div><span>SECTION</span><i>: </i><em>{{$student->section->name}}</em></div>
                <div><span>ROLL NO</span><i>: </i><em>{{$student->roll_no}}</em></div>

                <div><span>GPA</span><i>: </i><em>{{$result->point}}</em></div>

                <div><span>GRADE</span><i>: </i><em>{{$result->grade}}</em></div>
                <!--<div><span>PROMOTED CLASS : </span><em>9 (B)</em></div>-->
            </div><!-- end of restopleft -->
        </div><!-- end of resTophdr -->
        <div class="resmidcontainer">
            <h2 class="markTitle">Subject-Wise Grade &amp; Mark Sheet</h2>
               <table class="pagetble_middle">
                <tbody><tr>
                    <th class="res1" rowspan="2">CODE</th>
                    <th class="res2 cTitle" rowspan="2">SUBJECT</th>

                    <th class="res8 examtitle" colspan="12">EXAMINATION MARKS</th>
                    <!--<th class="res3 examtitle" colspan="6">Final EXAMINATION MARKS</th>-->
                </tr>
                        <tr>
                    <!--<td class="res1">&nbsp;</td>
                    <td class="res2">&nbsp;</td>
                    <td class="res1">Total</td>
                    <td class="res1">GP</td>
                    <td class="res3">Highest</td>-->
                    <td class="res7" colspan="1">Written</td>
                    <td class="res7" colspan="1">MCQ</td>
                    <td class="res7" colspan="1">SBA</td>
                    <td class="res7" colspan="1">Practical</td>
                    <td class="res5">Total</td>
                    <td class="res4">GP</td>
                    <td class="res3">Grade</td>
                    <!--<td class="res3">Written</td>
                    <td class="res4">MCQ</td>
                    <td class="res5">SBA</td>
                    <td class="res3">Total</td>
                    <td class="res3">GP</td>
                    <td class="res6">Grade</td>-->
                </tr>
                @foreach ($mark as $element)
                 <tr>
                    <td >{{$element->subject->code}}</td>
                    <td class="cTitle">{{$element->subject->name}}</td>
                    <td> 
                     @if (isset(json_decode($element->marks, true)[1]))
                                       
                    {{json_decode($element->marks, true)[1]}}
                    @else
                     0
                    @endif
                    </td>
                    <td>    
                     @if (isset(json_decode($element->marks, true)[2]))              
                    {{json_decode($element->marks, true)[2]}}
                     @else
                     0  
                    @endif
                    </td>
                    <td>  
                    @if (isset(json_decode($element->marks, true)[3]))
                                    
                    {{json_decode($element->marks, true)[3]}}
                    @else
                     0
                    @endif
                   </td>
                    <td> 
                     @if (isset(json_decode($element->marks, true)[7]))
                                      
                    {{json_decode($element->marks, true)[7]}}
                    @else
                     0
                 
                    @endif
                      </td>
                    <td>
                      {{$element->total_marks}}
                    </td>

                     <td>
                      {{$element->grade}}
                    </td>
                      <td>
                      {{$element->point}}
                    </td>

                 </tr>  
                @endforeach
                <tr class="lastitem">
                    <td>&nbsp;</td>
                    <td class="markTotal" colspan="5">Total Marks &amp; GPA = </td>
                    <td><b>{{$result->total_marks}}</b></td>
                    <td><b>{{$result->point}}</b></td>
                    <td><b>{{$result->grade}}</b></td>
                    <!--<td class="res3 markTotal2" colspan="3">Total marks &amp; GPA</td>
                    <td class="res3"><b>&nbsp;</b></td>
                    <td class="res3"><b>&nbsp;</b></td>
                    <td class="res6"><b>&nbsp;</b></td>-->
                </tr>
            </tbody>
        </table>
        </div>
         <div class="btmcontainer">
                   <div class="overalreport overalreportAll">
                <h2 class="markTitle">Overall Report</h2>
                <table class="pagetble" style="height:113px">
                    <tbody><tr>
                        <th class="column1" style="width:110px; padding:3px 0 2px">Subject Code</th>
                        <th class="column2" style="width:130px">Total Marks</th>
                        <th class="column3">Gp</th>
                    </tr>
                    @foreach ($mark as $overall)
                     <tr>


                        <td class="column1" style="width:110px; text-align:center">{{$overall->subject->code}}</td>
                        <td class="column2" style="width:130px">{{$overall->total_marks}}</td>
                        <td class="column3"><b>{{$result->point}}</b></td>
                    </tr>
                    @endforeach
   
                    <tr>
                        <td class="column1" style="width:110px;height:23px;text-align:center">Overall</td>
                        <td class="column2" style="width:130px;height:23px">{{$result->total_marks}}</td>
                        <td class="column3" style="height:23px"><b>{{$result->point}}</b></td>
                    </tr>
                    </tbody></table>
            </div><!-- end of overalreport -->

             <div class="overalreport gpagrading">
                <h2 class="markTitle">GPA Grading</h2>
                   <table class="pagetble" style="height:181px">
                    <tbody><tr>
                        <th class="column1">Range of Marks(%)</th>
                        <th class="column2">Grade</th>
                        <th class="column3">Point</th>
                    </tr>
                    <tr>
                        <td class="column1">80 or Above </td>
                        <td class="column2"> A+</td>
                        <td class="column3">5.00</td>
                    </tr>
                    <tr>
                        <td class="column1">70 to 79</td>
                        <td class="column2">A</td>
                        <td class="column3">4.00</td>
                    </tr>
                    <tr>
                        <td class="column1">60 to 69</td>
                        <td class="column2">A-</td>
                        <td class="column3">3.50</td>
                    </tr>
                    <tr>
                        <td class="column1">50 to 59</td>
                        <td class="column2">B</td>
                        <td class="column3">3.00</td>
                    </tr>

                    <tr>
                        <td class="column1">40 to 49</td>
                        <td class="column2">C</td>
                        <td class="column3">2.00</td>
                    </tr>

                    <tr>
                        <td class="column1">33 to 39</td>
                        <td class="column2">D</td>
                        <td class="column3">1.00</td>
                    </tr>
                    <tr class="lastitem">
                        <td class="column1">Below 33</td>
                        <td class="column2">F</td>
                        <td class="column3">0.00</td>
                    </tr>
                    </tbody></table>

                  <h2 class="markTitle">Achievement</h2>
                <table class="pagetble" style="height:106px"><tbody>
                    <tr><th align="center" valign="middle">Final Exam</th><th align="center" valign="middle">
                      @if($result->grade!="F")
                        @if($result->point>=5.00)
                        Excellent
                        @elseif($result->point>=4.00)
                        Good
                        @elseif($result->point>="3.00")
                        Average
                        @elseif($result->point>="2.00")
                        Poor
                        @else
                        Fail
                        @endif
                      @else
                        Fail
                      @endif

                    </th></tr>                    </tbody></table>
             </div>   
         </div>
             <div class="signatureWraper" >
              <div class="signatureCont">
            <div class="sign-grdn"><b>Signature (Guardian)</b></div>
            <div class="sign-clsT"><b>Signature (Class Teacher)</b></div>
            <div class="sign-head">
            <b>Signature (Head Master)</b>
            </div>
        </div></div>
    </section> 
</body>
</html>


