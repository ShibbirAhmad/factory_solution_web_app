@extends('admin.layouts.admin')
@section('title', 'Analysis report and complete the order ')
@section('content')


    <div class="row layout-top-spacing">
        <div id="flActionButtons" class="col-lg-12">
            <div class="statbox widget box box-shadow  p-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h4> {{ $order->title }} and final group report and order completion </h4>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <br>
                                    <p>Order Invoice No : <b> {{ $order->invoice_no }} </b> </p>
                                    <p>Order Total Expected Quantity :<b> {{ $order->expected_qty }} </b></p>
                                </div>

                                <div class="col-lg-3">
                                    <br>
                                    <br>
                                    <p>Order Start Date: <b> {!! date('d-M-Y', strtotime($order->start_datetime)) !!} </b> </p>
                                    <p>Order Start Date: <b> {!! date('d-M-Y', strtotime($order->end_datetime)) !!} </b> </p>

                                </div>

                                <div class="col-lg-3">
                                    <img src="{{ !empty($order->product->image)? \App\Helper\dynamicFileLink('product') . $order->product->image: \App\Helper\noImage() }}"
                                        height="100" width="100">
                                    <p>Product code: {{ $order->product->code }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <img src="{{ !empty($order->prototype->ref_attachment)? \App\Helper\dynamicFileLink('prototype') . $order->prototype->ref_attachment: \App\Helper\noImage() }}"
                                        height="100" width="100">
                                    <p>{{ $order->prototype->code }}</p>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover   table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Department </th>
                                            <th>Order Variant </th>
                                            <th>Task Assigned </th>
                                            <th>Task Received</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order_reports as $report)
                                            <tr>
                                                <td>
                                                    @php
                                                        $department = \App\Models\Department::where('id', $report->department_id)->first();
                                                    @endphp
                                                    {{ $department->name }}
                                                </td>

                                                <td colspan="3">
                                                    <div class="group_report_list_container">
                                                        <ul>
                                                            @forelse ($report->tasks as $item)
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            @php
                                                                                $variant = \App\Models\Variant::where('id', $item->variant_id)->first();
                                                                            @endphp
                                                                            {{ $variant->name }}
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <strong>
                                                                                {{ $item->total_task_assigned_qty }}</strong>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <strong>{{ $item->total_received_qty }}
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @empty
                                                                <p> Sorry! No Data Found</p>
                                                            @endforelse

                                                        </ul>

                                                    </div>
                                                </td>

                                            </tr>

                                        @empty
                                            <h4>Sorry! No Data Found </h4>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        @if ($order->is_closed != 1)
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <h4> Task Completion and Stock In Product </h4>
                                </div>
                                <div class="col-lg-12">
                                    {{ Form::open(['route' => ['order.complete', $order->id], 'method' => 'post']) }}
                                    @include('admin.order.completion.form-completion')
                                    {{ Form::close() }}
                                </div>
                            </div>
                        @else

                            <div class="col-lg-12 text-center">
                                <h4> Task Final Completion Report </h4>
                            </div>
                            <div class="col-lg-12 text-center">
                                <ul class="final_order_complition_list">
                                    @forelse ($order->variants as $item)
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <b> {{ $item->variant->name }}</b>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p>Assigned</p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b> {{ $item->except_qty }}</b>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p>Hand-Over</p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b> {{ $item->handover_qty }}</b>
                                                </div>
                                                <div class="col-lg-2">
                                                    Missing = {{ $item->except_qty - $item->handover_qty }}
                                                </div>
                                            </div>
                                        </li>

                                    @empty
                                        No data found
                                    @endforelse
                                    <li>
                                        <div class="row">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-3">
                                                <p>Total Assigned Quantity =</p>
                                            </div>
                                            <div class="col-lg-2">
                                                <b> {{ $order->expected_qty }}</b>
                                            </div>
                                            <div class="col-lg-2">
                                                <p>Total Hand-Over =</p>
                                            </div>
                                            <div class="col-lg-2">
                                                <b> {{ $total_handover_qty }}</b>
                                            </div>
                                            <div class="col-lg-2">
                                                Total Missing = {{ $order->expected_qty - $total_handover_qty }}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        @endif

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


@section('js')
    <script>
        $(document).on('keyup', '.order_completion_variant_values', function() {

            var order_qty = [];
            var variant_and_qty = [];
            $("input[name='order_completion_variant']").each(function() {
                let variant_of_id = $(this).attr('completion_of_id')

                let variant_quantity = $(this).val();
                let item = {
                    variant_id: variant_of_id,
                    handover_qty: variant_quantity.length <= 0 ? 0 : variant_quantity,
                }
                order_qty.push(variant_quantity.length <= 0 ? 0 : variant_quantity);
                variant_and_qty.push(item);

            });

            let total_expected_qty = 0;
            for (let index = 0; index < order_qty.length; index++) {
                total_expected_qty += parseInt(order_qty[index]);
            }

            document.getElementById('total_order_completion_qty').innerHTML = total_expected_qty;
            document.getElementById('order_completion_variant_and_qty').value = JSON.stringify(variant_and_qty);

        });
    </script>
@endsection
