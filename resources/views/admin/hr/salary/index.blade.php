@extends('admin.layouts.admin')
@section('title','Manage Salary')
@section('content')
    <div id="flActionButtons" class="col-lg-12">
        <div class="statbox widget box box-shadow  p-4">
            <div class="widget-header">
                <a href="{{route('salary.add')}}" class="btn btn-info"> <i class="fa fa-plus"></i> Salary </a>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable">
                                <thead>
                                    <tr>

                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Job Type</th>
                                        <th>Phone</th>
                                        <th>Total Working Day</th>
                                        <th>Total Working Hour</th>
                                        <th>Over Time</th>
                                        <th>Total Salary</th>
                                        <th>Advance/Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($experts as $key=>$employee)
                                        @php
                                            $total_working_day = App\Models\Attendance::whereMonth('in_datetime', \Carbon\Carbon::now()->month)->where('user_expert_id',$employee->user_expert_id)->count();
                                            $image = !empty($employee->avatar) ? \App\Helper\dynamicFileLink('employee').$employee->avatar : asset('project_files/404.jpg')
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td><img src="{{ $image }}" width="80" height="80" alt=""></td>
                                            <td> {{$employee->name}}</td>
                                            @if ($employee->job_type ==1)
                                                <td>Fulltime</td>
                                            @elseif($employee->job_type ==2)
                                                <td>Parttime</td>
                                            @else
                                                <td>Contractual</td>
                                            @endif
                                            
                                            <td>{{$employee->phone}}</td>
                                            <td>{{$employee->total_present}}</td>
                                            <td>{{$employee->total_hour}}</td>
                                            <td>{{$employee->total_overtime}}</td>
                                            <td>{{$employee->total_salary}}</td>
                                            <td>{{$due = $employee->total_salary - $employee->total_paid}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

