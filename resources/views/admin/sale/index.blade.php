@extends('admin.layouts.admin')
@section('title', 'Manage sale')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-5 col-5 ">
                                <a class="btn btn-success mt-2" href="{{ route('sale.create') }}"> Add New sale </a>
                            </div>
                            <div class="col-xl-7 col-md-7 col-sm-7 col-7 ">
                                <h4>Manage sales</h4>
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
                                            <th width="10%">Client Name</th>
                                            <th width="10%">Total</th>
                                            <th width="10%">Discount</th>
                                            <th width="10%">Paid</th>
                                            <th width="5%">Due</th>
                                            <th width="10%">Action</th>

                                        </tr>
                                    </thead>
                                     <tbody>
                                        @forelse($sales as $key=>$sale)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> {{ $sale->invoice_no }} </td>
                                                <td> {{ $sale->client ? $sale->client->name : "" }} </td>
                                                <td> {{ number_format($sale->total,2)  }} </td>
                                                <td> {{ $sale->discount }} </td>
                                                <td> {{ number_format($sale->paid,2)  }} </td>
                                                <td> {{  intval($sale->total) - ( intval($sale->paid) + intval($sale->discount) ) }} </td>

                                                <td>
                                                    <a href="{{route('sale.show', $sale->id)}}" class="btn btn-xs btn-success" > <i class="fa fa-eye fa-1x"></i> </a>
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
