@extends('admin.layouts.admin')
@section('title', 'Show Purchase')
@section('content')
    <div id="dueReceiveApp" class="row layout-top-spacing">
        <div class="col-lg-12">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow  p-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <div v-if="purchase" class="info">
                                    <div class="supplier_info">
                                        <p class="">Purchase Invoice: <strong class="invoice">
                                            {{ $purchase->invoice_no }}</strong>
                                        </p>
                                        <p class="">Supplier Name: <strong class="">
                                            {{$purchase->supplier->name}}</strong>
                                        </p>
                                        <p class="">Supplier Phone: <strong class="phone">
                                            {{$purchase->supplier->phone}}</strong>
                                        </p>
                                        <p class="">Supplier Email: <strong class="email">
                                            {{$purchase->supplier->email}}</strong>
                                        </p>
                                    </div>
                                    <div class="amount_info">
                                        
                                        <p class="">Total Amount: <strong class="total_amount">
                                            {{ $purchase->total }}</strong>
                                        </p>
                                        <p class="">Paid Amount: <strong class="paid"> {{ $purchase->paid }}</strong></p>
                                        <p class="">Discount Amount: <strong class="paid"> {{ $purchase->discount }}</strong></p>
                                        <p class="">Due Amount: <strong class="paid"> {{ $due = ($purchase->total - $purchase->discount) - $purchase->paid }}</strong></p>
                                    </div>
                                    <div class="note-info">
                                        <p class="">Total Quantity: <strong class="total">{{ $purchase->qty }}</strong></p>
                                        <p class="">Payable Date: <strong class="note">
                                            {{ date('d-m-Y', strtotime($purchase->payable_date)); }}
                                            </strong>
                                        </p>
                                        <p class="">Note: <strong class="note">
                                            {{$purchase->note}}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price </th>
                                                <th>Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchase->purchaseItems as $key=>$item)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $price = $item->qty * $item->price }}</td>
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
