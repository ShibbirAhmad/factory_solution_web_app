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
                    @include('admin.hr.leave.leave-form')
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
                                                <th>Employee Name</th>
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
                                                    <td>{{$leave->expert->name}}</td>
                                                    <td>{{$leave->start_datetime}}</td>
                                                    <td>{{$leave->end_datetime}}</td>
                                                    {{-- <td>{{$leave->days}}</td> --}}
                                                    <td>

                                                        {{$leave->days}}
                                                    </td>
                                                    <td>{{$leave->leaveType->name}}</td>

                                                    <td>{{$leave->user->name}}</td>
                                                     @if ($leave->status == 1)
                                                        <td>Paid Leave</td>
                                                    @else
                                                        <td>Unpaid Leave</td>
                                                    @endif
                                                     <td>
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

@section('js')
    <script>
        $(document).ready(function() {
            $("body").on('click',function() {

                var start_datetime = $('#start_datetime').val();
                var end_datetime = $('#end_datetime').val();
                var start = new Date(start_datetime);
                var end = new Date(end_datetime);
                var diffDate = (end - start) / (1000 * 60 * 60 * 24);
                var days = Math.round(diffDate);
                document.getElementById('days').value = days ;
            }) ;
        });

    </script>
@endsection


