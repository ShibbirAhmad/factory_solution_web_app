    <div id="flActionButtons" class="col-lg-12">
        <div class="statbox widget box box-shadow  p-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Office Duty Start Date Time</th>
                                    <th>Office Duty Stop Date Time</th>
                                    <th>Name</th>
                                    <th>Total Hour </th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($attendances as $key=>$attendance_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance_info->in_datetime }}</td>
                                        <td>{{ $attendance_info->out_datetime }}</td>
                                        <td>{{ $attendance_info->employee ? $attendance_info->employee->name: null }}</td>
                                        <td>
                                            @php
                                                $start = !empty($attendance_info->in_datetime) ? \Carbon\Carbon::parse($attendance_info->in_datetime) : null ;
                                                $end = !empty($attendance_info->out_datetime) ? \Carbon\Carbon::parse($attendance_info->out_datetime) : null ;
                                                $difference = $start->diff($end)->format('%H:%I:%S');
                                            @endphp
                                            {{ $difference }}
                                        </td>
                                        <td>
                                            @if(isset($attendance) && $attendance->id == $attendance_info->id)
                                                <p class="badge badge-success p-4">Updating...</p>
                                            @else
                                                <a href="{{ route('attendance.edit',$attendance_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                                <button class="btn btn-danger erase" data-url="{{ route('attendance.destroy') }}" data-id="{{ $attendance_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
                                            @endif


                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
