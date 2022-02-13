@extends('admin.layouts.admin')
@section('title', 'Show sale')
@section('content')
    <div id="dueReceiveApp" class="row layout-top-spacing">
        <div class="col-lg-12">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow  p-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <div v-if="sale" class="info">
                                    <div class="supplier_info">
                                        <p class="">sale Invoice: <strong class="invoice">
                                                {{ $sale->invoice_no }}</strong>
                                        </p>
                                        <p class="">Company Name: <strong class="">
                                                {{ $sale->client->company_name }}</strong>
                                        </p>

                                        <p class="">client Name: <strong class="">
                                                {{ $sale->client->name }}</strong>
                                        </p>

                                        <p class="">client Phone: <strong class="phone">
                                                {{ $sale->client->phone }}</strong>
                                        </p>

                                    </div>
                                    <div class="amount_info">

                                        <p class="">Total Amount: <strong class="total_amount">
                                                {{ $sale->total }}</strong>
                                        </p>
                                        <p class="">Paid Amount: <strong class="paid">
                                                {{ $sale->paid }}</strong></p>
                                        <p class="">Discount Amount: <strong class="paid">
                                                {{ $sale->discount }}</strong></p>
                                        <p class="">Due Amount: <strong class="paid">
                                                {{ $due = $sale->total - $sale->discount - $sale->paid }}</strong></p>
                                    </div>
                                    <div class="note-info">

                                        <p class="">Note/Comments: <strong class="note">
                                                {{ $sale->note }}</strong>
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
                                                <th>Variant</th>
                                                <th>Qty</th>
                                                <th>Price </th>
                                                <th>Amount </th>
                                            </tr>
                                        </thead>
                                             <tbody>
                                        @forelse($sale_items as $key=>$item)
                                            @php
                                                $product = \App\Models\Product::findOrFail($item->product_id);
                                                $image = !empty($product->image) ? asset(\App\Helper\dynamicFileLink('product') . $product->image) : \App\Helper\noImage();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div>
                                                        <img height="200" width="200" src="{{ $image }}">
                                                        <p> Name: {{ $product->name }}</p>
                                                        <p> Code: {{ $product->code }}</p>
                                                    </div>

                                                </td>

                                                <td colspan="4">
                                                    <ul class="final_order_complition_list">
                                                        @forelse ($item->variants as $v)
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        {{ $v->variant->name }}
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        {{ $v->qty }}
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        {{ $v->price }}
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        {{ $v->qty * $v->price }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @empty
                                                        @endforelse

                                                    </ul>

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
    </div>
@endsection
