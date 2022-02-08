@extends('admin.layouts.admin')
@section('title', 'Manage Tasks')
@section('content')


    <div class="row layout-top-spacing">
        <div id="flActionButtons" class="col-lg-12">
            <div class="statbox widget box box-shadow  p-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <p><b> {{ $tasks[0]->order->title }} </b></p>
                        </div>
                        <div class="col-lg-2">
                            <p> Order No: <b> {{ $tasks[0]->order->invoice_no }} </b></p>
                        </div>
                        <div class="col-lg-3">
                            <p class="text-info"> Design Code: <b> {{ $tasks[0]->order->prototype->code }} </b></p>
                        </div>
                        <div class="col-lg-3">
                            <p class="linkDesign text-danger"> Product Code: <b>{{ $tasks[0]->order->product->code }} </b></p>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Department </th>
                                            <th>Expert/Master</th>
                                            <th>Unit</th>
                                            <th>Task Assigned & Received</th>
                                            <th>Created By</th>
                                            <th>Verified By</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tasks as $key=>$task)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $task->department->name }}</td>
                                                <td>{{ $task->expert->name }}</td>
                                                <td>{{ $task->unit ? $task->unit->name : '' }} ({{ $task->unit_qty }})</td>
                                                <td>
                                                    <div class="task_report_container">
                                                        <ul>
                                                            @forelse ($task->reports as $report)
                                                                <li> {{ $report->variant->name }} assigned = <strong>
                                                                        {{ $report->task_qty }} </strong> Received =
                                                                    <strong>{{ $report->handover_qty }}</strong> </li>
                                                            @empty
                                                                No Data Found
                                                            @endforelse

                                                        </ul>
                                                    </div>
                                                </td>

                                                <td>{{ $task->createdBy->name }}</td>
                                                <td>{{ $task->reports[0]->verifiedBy ? $task->reports[0]->verifiedBy->name : 'Not yet verified' }}
                                                </td>
                                                <td>
                                                    @if ($task->order->is_closed != 1)
                                                    <a href="{{ route('taskReport.receive', $task->id) }}"
                                                        class="btn btn-success">Task Receive</a>
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

    </div>

@endsection

@section('css')
    <style>
        .linkDesign {
            display: block;
            font-weight: bold;
            line-height: 25px;
        }

        .linkDesign:first-child {
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);

        }

    </style>
@endsection
