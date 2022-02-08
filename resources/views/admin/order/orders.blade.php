@extends('admin.layouts.admin')
@section('title', 'Manage Orders')
@section('content')


    <div class="row layout-top-spacing">
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
                                        <th>Order No.</th>
                                        <th>Prototype Design</th>
                                        <th>Product Code</th>
                                        <th>Unit</th>
                                        <th>Title</th>
                                        <th>Qty</th>
                                        <th>Expected Production QTY</th>
                                        <th>Total Productioned QTY</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Created By</th>
                                        <th>Manage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $key=>$order)
                                            @php
                                                $product = $order->product;
                                                $prototype = $order->prototype;
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td width="8%"> <a href="{{ route('task.progress',$order->id) }}"> {{ $order->invoice_no }}  </a> </td>
                                                <td width="11.8%">
                                                    <a class="refCode" href="{{ route('prototype.add') }}" target="_blank">
                                                        <strong >{{ $prototype->code }}</strong>
                                                        <img src="{{ !empty($prototype->ref_attachment) ? \App\Helper\dynamicFileLink('prototype').$prototype->ref_attachment : \App\Helper\noImage() }}" height="80" width="80" alt="">
                                                    </a>
                                                </td>
                                                <td  width="10%">
                                                    <a href="#" class="refCode" target="_blank">
                                                        <strong  >{{ $product->code }}</strong>
                                                        <img src="{{  !empty($product->image) ? \App\Helper\dynamicFileLink('product').$product->image : \App\Helper\noImage() }}" height="80" width="80" alt="">
                                                    </a>
                                                </td>
                                                <td>   {{ $order->unit->name }} </td>
                                                <td width="20%">   {{ $order->title }} </td>
                                                <td>   {{ $order->qty }} </td>
                                                <td>   {{ $order->expected_qty }} </td>
                                                <td>   {{ $order->produced_qty ?? 0 }} </td>
                                                <td width="11%"> {{ \Carbon\Carbon::parse($order->start_datetime)->format('d-M-Y') }}</td>
                                                <td width="10%"> {{ \Carbon\Carbon::parse($order->end_datetime)->format('d-M-Y') }}</td>
                                                <td> <strong class="badge badge-primary">{{ $order->createBy->name ?? '' }} </strong> </td>
                                                <td >

                                                    <a title="order informatin edit " href="#" class="btn btn-info  m-1"> <i class="fa fa-edit"></i> </a>
                                                    <a title="order progress tracking " href="{{ route('task.progress',$order->id) }}" class="btn btn-dark  m-1"> <i class="fa fa-eye"></i> </a>
                                                    @if ($order->is_closed != 1)
                                                     <a title="order task assign " href="{{ route('task.order',$order->id) }}" class="btn btn-danger m-1"> <i class="fa fa-plus"></i> </a>
                                                    @endif
                                                    <a title="final order group wise report and completion " href="{{ route('order.department_report',$order->id) }}" class="btn btn-success  m-1"> <i class="fa fa-check"></i> </a>
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
    .refCode{
        display: block;
        text-align: center;

    }

    .refCode strong{
        display: block;
    }

    .refCode img{
        border-radius: 5px;
    }
</style>
@endsection
