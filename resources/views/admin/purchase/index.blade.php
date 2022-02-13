@extends('admin.layouts.admin')
@section('title', 'Manage Purchase')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-5 col-5 ">
                                <a class="btn btn-success mt-2" href="{{ route('purchase.create') }}"> Add New Purchase </a>
                            </div>
                            <div class="col-xl-7 col-md-7 col-sm-7 col-7 ">
                                <h4>Manage Purchases</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div id="flActionButtons" class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover  text-center " id="dataTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="10%">Invoice No.</th>
                                            <th width="10%">Supplier Name</th>
                                            <th width="10%">Qty.</th>
                                            <th width="10%">Total</th>
                                            <th width="10%">Discount</th>
                                            <th width="10%">Paid</th>
                                            <th width="5%">Due</th>
                                            <th width="10%">Payable Date</th>
                                            <th width="10%">Action</th>

                                        </tr>
                                    </thead>
                                     <tbody>
                                        @forelse($purchases as $key=>$purchase)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> {{ $purchase->invoice_no }} </td>
                                                <td> {{ $purchase->supplier ? $purchase->supplier->name : "" }} </td>
                                                <td> {{ $purchase->qty }} </td>
                                                <td> {{ number_format($purchase->total,2)  }} </td>
                                                <td> {{ $purchase->discount }} </td>
                                                <td> {{ number_format($purchase->paid,2)  }} </td>
                                                <td> {{ intval($purchase->total) - ( intval($purchase->paid) + intval($purchase->discount) ) }} </td>
                                                <td> {{ date('d-m-Y', strtotime($purchase->payable_date)); }} </td>
                                                <td>
                                                    <a href="{{route('purchase.show', $purchase->id)}}" class="btn btn-xs btn-success" > <i class="fa fa-eye fa-1x"></i> </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <h4> No Data Found </h4>
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
