@extends('admin.layouts.admin')
@section('title', 'Manage credit')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center ">
                                <h4>Cash Book Incomes/Credits </h4>
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
                                            <th width="10%">Sale Invoice </th>
                                            <th width="10%">Client </th>
                                            <th width="10%">Amount</th>
                                            <th width="10%">Credit In</th>
                                            <th width="10%">Reference</th>
                                            <th width="10%">Note/Comment</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        @forelse($credits as $key=>$credit)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> {{ $credit->created_at }} </td>
                                                <td> {{ $credit->invoice_no }} </td>
                                                <td> {{ $credit->sale? $credit->sale->invoice_no : '' }} </td>
                                                <td> {{ $credit->client ? $credit->client->company_name : "" }} </td>
                                                <td> {{ number_format($credit->amount,2)  }} </td>
                                                <td> {{ $credit->balance ? $credit->balance->name : '' }} </td>
                                                <td> {{ $credit->reference }} </td>
                                                <td> {{ $credit->note }} </td>

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
