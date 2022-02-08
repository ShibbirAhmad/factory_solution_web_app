@extends('admin.layouts.admin')
@section('title', 'Show Supplier')
@section('content')
    <div id="dueReceiveApp" class="row layout-top-spacing">
        <div class="col-lg-12">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow  p-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-lg-12">
                                {{-- <div class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="text-center">Supplier: {{$supplier->name}}</h2>
                                </div> --}}
                                <h4 class="text-center">Supplier: {{$supplier->name}}</h4>
                                <div class="supplier">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="supplier_amount">
                                                 <h4 class="text-center mb-4"><strong>Total Purchase Amount</strong></h4> 
                                                <div class="border"></div>
                                                <h3 class="mt-4 text-center">{{$purchase_amount}}</h3>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-3">
                                            <div class="supplier_amount">
                                                 <h4 class="text-center mb-4"><strong>Discount Amount</strong></h4> 
                                                <div class="border"></div>
                                                <h3 class="mt-4 text-center">{{$discount_amount}}</h3>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-4">
                                            <div class="supplier_amount">
                                                 <strong><h4 class="text-center mb-4">Total Paid Amount</h4></strong> 
                                                 <div class="border"></div>
                                                 <h3 class="mt-4 text-center">{{$paid_amount}}</h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="supplier_amount">
                                                 <strong> <h4 class="text-center mb-4">Total Due Amount</h4></strong> 
                                                 <div class="border"></div>
                                                <h3 class="mt-4 text-center">{{$due_amount = $purchase_amount - $paid_amount}}</h3> 
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pdf mt-2 d-flex justify-content-between align-items-center">
                                            <button type="button" id="" class="btn btn-primary p-2">Payment History</button>
                                            <button type="button" onclick="purchase()" class="btn btn-primary p-2">Purchase History</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive pt-2" id="purchase_history_data">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <h4>Purchase History</h4>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Invoice No</th>
                                                <th>Comment </th>
                                                <th>Product Quantity</th>
                                                <th>Amount</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchases as $key=>$purchase)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{ date('d-m-Y', strtotime($purchase->payable_date)); }}</td>
                                                    <td>{{$purchase->invoice_no}}</td>
                                                    <td>{{$purchase->note}}</td>
                                                    <td>{{$purchase->qty}}</td>
                                                    <td>{{$purchase->total}}</td>
                                                    <td>{{$purchase->paid}}</td>
                                                    <td>{{$due = $purchase->total - $purchase->paid}}</td>
                                                    <td>
                                                        <button class="btn btn-info">Details</button>
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
@endsection
