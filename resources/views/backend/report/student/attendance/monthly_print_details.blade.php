@extends('backend.report.layouts.master', ['headerData' => $headerData,'printIt' => 1])
@section('extraStyle')
    <style>
        @page {
            size: 8.5in 14.5in ;
            size: landscape ;
        }
    </style>
@endsection
@section('reportBody')
    <div class="report-body">
        <div class="report-filter">
            <span class="filter-text">Filters:</span> <span class="filters">{{implode(' || ',$filters)}}</span>
        </div>
        <div class="report-data">
            <div class="row">
                <div class="col-xs-12">
                    <table class="classic">
                        <thead>
                        <tr>
                            <th width="3%" rowspan="2">Roll</th>
                            <th width="4%" rowspan="2">Regi No.</th>
                            <th width="4%" rowspan="2">Status</th>
                            <th width="81%" colspan="{{count($monthDates)}}">Day of Month</th>
                            <th width="2%" rowspan="2">P</th>
                            <th width="2%" rowspan="2">L.P</th>
                            <th width="2%" rowspan="2">A</th>
                            <th width="2%" rowspan="2">T.P</th>
                        </tr>
                        <tr>
                            @foreach($monthDates as $date => $value)
                            <th @if($value['weekend']) class="weekend" @endif>{{$value['day']}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td rowspan="4">{{$student->roll_no}}</td>
                                    <td rowspan="4">{{$student->regi_no}}</td>
                                    <td>Status</td>
                                    @php
                                        $tPresent = 0;
                                        $tlPresent = 0;
                                        $tabsent = 0;

                                    @endphp
                                    @foreach($monthDates as $date => $value)
                                        @php
                                            $status = '';
                                            $color = '';


                                                if(isset($attendanceData[$student->id][$date])) {
                                                    if($attendanceData[$student->id][$date]['present']  == 1){
                                                        $status = 'P';
                                                        $color = 'green';
                                                        $tPresent++;
                                                        if($attendanceData[$student->id][$date]['inLate'] == 1){
                                                            $tlPresent++;
                                                        }

                                                    }
                                                    else{
                                                        $status = 'A';
                                                        $tabsent++;
                                                        $color = 'red';
                                                    }
                                                }


                                                 if(isset($calendarData[$date])) {
                                                    //if student has present in exam
                                                    if($calendarData[$date] == 'E' && ($status == 'P' || $status == 'A')){
                                                        if($status == 'P'){
                                                            $status .= $calendarData[$date];
                                                        }

                                                        if($status == 'A'){
                                                            $tabsent--;
                                                            $status = $calendarData[$date];
                                                            $color = 'holiday';
                                                        }

                                                    }
                                                    else{
                                                        $status = $calendarData[$date];
                                                        $color = 'holiday';
                                                    }

                                                 }




                                            if($value['weekend']){
                                                    $status .= 'W';
                                                    $color = 'weekend';
                                            }
                                        @endphp
                                        <td class="{{$color}}">{{$status}}</td>
                                    @endforeach
                                    <td rowspan="4">
                                        {{($tPresent-$tlPresent)}}
                                    </td>
                                    <td rowspan="4">
                                       {{$tlPresent}}
                                    </td>
                                    <td rowspan="4">
                                        {{$tabsent}}
                                    </td>
                                    <td rowspan="4">
                                        {{$tPresent}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>In Time</td>
                                    @foreach($monthDates as $date => $value)
                                        @php
                                            $status = '';
                                            $color = '';
                                                if(isset($attendanceData[$student->id][$date])) {
                                                    if($attendanceData[$student->id][$date]['present']  == 1){
                                                        $status = $attendanceData[$student->id][$date]['in_time'];
                                                        $color = 'green';
                                                        $tPresent++;
                                                        if($attendanceData[$student->id][$date]['inLate'] == 1){
                                                            $tlPresent++;
                                                        }
                                                    }
                                                    else{
                                                        $status = 'A';
                                                        $tabsent++;
                                                        $color = 'red';
                                                    }
                                                }


                                                 if(isset($calendarData[$date])) {
                                                    //if student has present in exam
                                                    if($calendarData[$date] == 'E' && ($status == 'P' || $status == 'A')){
                                                        if($status == 'P'){
                                                            $status .= $calendarData[$date];
                                                        }

                                                        if($status == 'A'){
                                                            $tabsent--;
                                                            $status = $calendarData[$date];
                                                            $color = 'holiday';
                                                        }

                                                    }
                                                    else{
                                                        $status = $calendarData[$date];
                                                        $color = 'holiday';
                                                    }

                                                 }




                                            if($value['weekend']){
                                                    $status .= 'W';
                                                    $color = 'weekend';
                                            }
                                        @endphp
                                        <td class="{{$color}}">{{$status}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>Out</td>
                                    @foreach($monthDates as $date => $value)
                                        @php
                                            $status = '';
                                            $color = '';
                                                if(isset($attendanceData[$student->id][$date])) {
                                                    if($attendanceData[$student->id][$date]['present']  == 1){
                                                        $status = $attendanceData[$student->id][$date]['out_time'];
                                                        $color = 'green';
                                                        $tPresent++;
                                                        if($attendanceData[$student->id][$date]['inLate'] == 1){
                                                            $tlPresent++;
                                                        }
                                                    }
                                                    else{
                                                        $status = 'A';
                                                        $tabsent++;
                                                        $color = 'red';
                                                    }
                                                }


                                                 if(isset($calendarData[$date])) {
                                                    //if student has present in exam
                                                    if($calendarData[$date] == 'E' && ($status == 'P' || $status == 'A')){
                                                        if($status == 'P'){
                                                            $status .= $calendarData[$date];
                                                        }

                                                        if($status == 'A'){
                                                            $tabsent--;
                                                            $status = $calendarData[$date];
                                                            $color = 'holiday';
                                                        }

                                                    }
                                                    else{
                                                        $status = $calendarData[$date];
                                                        $color = 'holiday';
                                                    }

                                                 }

                                            if($value['weekend']){
                                                    $status .= 'W';
                                                    $color = 'weekend';
                                            }
                                        @endphp
                                        <td class="{{$color}}">{{$status}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>Stay</td>
                                    @foreach($monthDates as $date => $value)
                                        @php
                                            $status = '';
                                            $color = '';
                                                if(isset($attendanceData[$student->id][$date])) {
                                                    if($attendanceData[$student->id][$date]['present']  == 1){
                                                        $status = \AppHelper::get_time($attendanceData[$student->id][$date]['staying_hour']);
                                                        $color = 'green';
                                                        $tPresent++;
                                                        if($attendanceData[$student->id][$date]['inLate'] == 1){
                                                            $tlPresent++;
                                                        }
                                                    }
                                                    else{
                                                        $status = 'A';
                                                        $tabsent++;
                                                        $color = 'red';
                                                    }
                                                }


                                                 if(isset($calendarData[$date])) {
                                                    //if student has present in exam
                                                    if($calendarData[$date] == 'E' && ($status == 'P' || $status == 'A')){
                                                        if($status == 'P'){
                                                            $status .= $calendarData[$date];
                                                        }

                                                        if($status == 'A'){
                                                            $tabsent--;
                                                            $status = $calendarData[$date];
                                                            $color = 'holiday';
                                                        }

                                                    }
                                                    else{
                                                        $status = $calendarData[$date];
                                                        $color = 'holiday';
                                                    }

                                                 }

                                            if($value['weekend']){
                                                    $status .= 'W';
                                                    $color = 'weekend';
                                            }
                                        @endphp
                                        <td class="{{$color}}">{{$status}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="report-authority">
            <div class="row">
                <div class="col-xs-4">
                    <h5>Printed By: {{auth()->user()->name}}</h5>
                </div>
                <div class="col-xs-4">
                    <h5>Class Teacher</h5>
                </div>
                <div class="col-xs-4">
                    <h5>Principal</h5>
                </div>
            </div>
        </div>
    </div>
@endsection