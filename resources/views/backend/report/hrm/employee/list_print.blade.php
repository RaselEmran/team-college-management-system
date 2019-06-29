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
        <div class="report-filter">
            <span class="filter-text">Filters:</span> <span class="filters">{{implode(' || ',$filters)}}</span>
        </div>
        <div class="report-data">
            <div class="row">
                <div class="col-xs-12">
                    <table class="main-data">
                        <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="20%">Name</th>
                            <th width="15%">Id</th>

                            <th width="12%">Designation</th>
                            <th width="12%">Qualification</th>
                            <th width="12%">Joining Date</th>
                            <th width="12%">Contact</th>
                            <th width="12%">Address</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->id_card}}</td>
                                    <td>{{$employee->designation}}</td>
                                    <td>{{$employee->qualification}}</td>
                                    <td>{{$employee->joining_date}}</td>
                                    <td>{{$employee->email}} {{$employee->phone_no}}</td>
                                    <td>{{$employee->address}}</td>
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
                </div>
                <div class="col-xs-4">
                </div>
            </div>
        </div>
    </div>
@endsection