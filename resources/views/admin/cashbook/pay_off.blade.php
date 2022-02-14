@extends('admin.layouts.admin')
@section('title', 'Manage debit')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center ">
                                <h4>Cash Book Pay Off/Debits </h4>
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
                                            <th width="10%">Date</th>
                                            <th width="10%">Invoice No.</th>
                                            <th width="10%">Purchase Invoice </th>
                                            <th width="10%">Supplier </th>
                                            <th width="10%">Employee </th>
                                            <th width="10%">Amount</th>
                                            <th width="10%">Debit From</th>
                                            <th width="10%">Reference</th>
                                            <th width="10%">Note/Comment</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        @forelse($debits as $key=>$debit)
                                            <tr>
                                                <td> {{  $loop->iteration }}</td>
                                                <td> {{ $debit->created_at }} </td>
                                                <td> {{ $debit->invoice_no }} </td>
                                                <td> {{ $debit->purchase? $debit->purchase->invoice_no : '' }} </td>
                                                <td> {{ $debit->supplier ? $debit->supplier->name : "" }} </td>
                                                <td> {{ $debit->expert ? $debit->expert->name : "" }} </td>
                                                <td> {{ number_format($debit->amount,2)  }} </td>
                                                <td> {{ $debit->balance ? $debit->balance->name : '' }} </td>
                                                <td> {{ $debit->reference }} </td>
                                                <td> {{ $debit->note }} </td>

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
