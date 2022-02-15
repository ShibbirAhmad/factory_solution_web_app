@extends('admin.layouts.admin')
@section('title', 'Manage Leave')
@section('content')
    <div id="dueReceiveApp" class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Leave</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{route('leave.update', $leave->id)}}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="control-label">Select Employee </label>
                                <select class="form-control" name="expert_id">
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label"> Start Date & Time:</label>
                                <input type="datetime-local" name="start_datetime" class="form-control" placeholder="YYYY/dd/MM">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label"> End Date & Time:</label>
                                <input type="datetime-local" name="end_datetime" class="form-control" placeholder="YYYY/dd/MM">
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label">Days</label>
                                <input type="number" name="days"  class="form-control" placeholder="days">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Leave Types</label>
                                <select class="form-control" name="leave_type">
                                    @foreach ($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Paid</option>
                                    <option value="2">Unpaid</option>
                                </select>
                            </div>

                            <button v-on:click="submitPayment" type="submit" class="btn btn-primary ml-3 mt-3">Save Leave</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow  p-4">
                    <div class="widget-header">
                        <div  v-if="purchase" class="row">
                            <div class="col-lg-12">
                                <div v-if="purchase" class="info">
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Days</th>
                                                <th>Leave Type</th>
                                                <th>Approved By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expert_leaves as $key=>$leave)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$leave->start_datetime}}</td>
                                                    <td>{{$leave->end_datetime}}</td>
                                                    <td>{{$leave->days}}</td>
                                                    <td>{{$leave->leave_type}}</td>
                                                    <td>{{$leave->approved_by}}</td>
                                                    <td>{{$leave->status}}</td>
                                                     <td>
                                                        <a href="{{ route('leave.edit',$leave->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                                        <a href="{{ route('leave.destroy',$leave->id) }}" class="btn btn-danger erase" > <i class="fa fa-trash-alt fa-1x"></i> </a>
                                                    </td>
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
            </div>
        </div>
    </div>
@endsection

