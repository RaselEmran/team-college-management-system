@extends('backend.report.layouts.master', ['headerData' => $headerData,'printIt' => 1])
@section('extraStyle')
    <style>
        @page {
            size:  A4 landscape;
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
                            <th width="3%" rowspan="2">SL</th>
                            <th width="8%" rowspan="4">Name</th>
                            <th width="10%" rowspan="2">Id</th>
                            <th width="55%" colspan="{{count($monthDates)}}">Day of Month</th>
                            <th width="5%" rowspan="2">P</th>
                            <th width="5%" rowspan="2">A</th>
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
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->id_card}}</td>
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
                                                        if($attendanceData[$employee->id][$date]['inLate'] == 1){
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
                                    <td>
                                        {{($tPresent)}}
                                    </td>
                                    <td>
                                        {{$tabsent}}
                                    </td>
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