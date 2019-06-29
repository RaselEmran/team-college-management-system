@extends('backend.report.layouts.master', ['headerData' => $headerData,'printIt' => 1])
@section('extraStyle')
    <style>
        @page {
            size: A4 ;
            size: landscape ;
        }
    </style>
@endsection
@section('reportBody')
    <div class="report-body">
        <div class="report-data">
            <div class="row">
                <div class="col-xs-12">
                    <table class="classic">
                        <thead>
                        <tr>
                            <th width="3%" rowspan="2">Sl</th>
                            <th width="8%" rowspan="2">Name</th>
                            <th width="10%" rowspan="2">Id</th>
                            <th width="4%" rowspan="2">Status</th>
                            <th width="81%" colspan="{{count($monthDates)}}">Day of Month</th>
                            <th width="2%" rowspan="2">P</th>
                            <th width="2%" rowspan="2">A</th>
                        </tr>
                        <tr>
                            @foreach($monthDates as $date => $value)
                            <th @if($value['weekend']) class="weekend" @endif>{{$value['day']}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td rowspan="4">{{$loop->iteration}}</td>
                                    <td rowspan="4">{{$employee->name}}</td>
                                    <td rowspan="4">{{$employee->id_card}}</td>
                                    <td>Status</td>
                                    @php
                                        $tPresent = 0;
                                        $tabsent = 0;

                                    @endphp
                                    @foreach($monthDates as $date => $value)
                                        @php
                                            $status = '';
                                            $color = '';


                                                if(isset($attendanceData[$employee->id][$date])) {
                                                    if($attendanceData[$employee->id][$date]['present']  == 1){
                                                        $status = 'P';
                                                        $color = 'green';
                                                        $tPresent++;
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
                                        {{($tPresent)}}
                                    </td>
                                    <td rowspan="4">
                                        {{$tabsent}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>In Time</td>
                                    @foreach($monthDates as $date => $value)
                                        @php
                                            $status = '';
                                            $color = '';
                                                if(isset($attendanceData[$employee->id][$date])) {
                                                    if($attendanceData[$employee->id][$date]['present']  == 1){
                                                        $status = $attendanceData[$employee->id][$date]['in_time'];
                                                        $color = 'green';
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
                                                if(isset($attendanceData[$employee->id][$date])) {
                                                    if($attendanceData[$employee->id][$date]['present']  == 1){
                                                        $status = $attendanceData[$employee->id][$date]['out_time'];
                                                        $color = 'green';
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
                                                if(isset($attendanceData[$employee->id][$date])) {
                                                    if($attendanceData[$employee->id][$date]['present']  == 1){
                                                        $status = \AppHelper::get_time($attendanceData[$employee->id][$date]['staying_hour']);
                                                        $color = 'green';
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
                <div class="col-xs-6">
                    <h5>Printed By: {{auth()->user()->name}}</h5>
                </div>
                <div class="col-xs-6">
                    <h5>Principal</h5>
                </div>
            </div>
        </div>
    </div>
@endsection