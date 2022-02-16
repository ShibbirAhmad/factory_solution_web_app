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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Job Type</th>
                                        <th>Phone</th>
                                        <th>Join Date</th>
                                        <th>Salary</th>
                                        <th>Address</th>
                                        <th>Transaction <br> ( - = Advanced, <br> += Payable) </th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($employees as $key=>$employee_info)
                                    @php
                                        $image = !empty($employee_info->avatar) ? \App\Helper\dynamicFileLink('employee').$employee_info->avatar : asset('project_files/404.jpg')
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img height="80" width="80" src="{{ $image }}" alt="{{ $employee_info->image }}">
                                        </td>
                                        <td>{{ $employee_info->name }}</td>
                                        <td>{{ $employee_info->department ? $employee_info->department->name  : null}}</td>
                                        <td>{{ $employee_info->position ? $employee_info->position->name : null }}</td>
                                        <td>
                                            @if ($employee_info->job_type == 1)
                                                Fulltime
                                            @elseif($employee_info->job_type == 2)
                                                Part Time
                                            @elseif($employee_info->job_type == 3)
                                                Contractual
                                            @endif
                                        </td>
                                        <td>{{ $employee_info->phone }}</td>
                                        <td>{{ $employee_info->join_date }}</td>
                                        <td>
                                            @if ($employee_info->job_type == 1)
                                                {{ $employee_info->current_salary }}
                                            @elseif($employee_info->job_type == 2)
                                                {{ $employee_info->per_hour_salary }}
                                            @elseif($employee_info->job_type == 3)
                                                Company Policy
                                            @endif
                                            {{-- {{ $employee_info->current_salary }} --}}
                                        </td>
                                        <td>{{ $employee_info->address }}</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ route('employee.edit',$employee_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-danger erase" data-url="{{ route('employee.destroy') }}" data-id="{{ $employee_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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
