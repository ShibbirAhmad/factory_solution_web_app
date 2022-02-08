@extends('admin.layouts.admin')
@section('title', 'Warehouse Products ')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">

                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                <h4>Warehouse Products</h4>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content widget-content-area">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product</th>
                                            <th>Code</th>
                                            <th>Variant</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $key=>$item)
                                            @php
                                                $image = !empty($item->product->image) ? asset(\App\Helper\dynamicFileLink('product') . $item->product->image) : \App\Helper\noImage();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div>
                                                        <img height="80" width="80" src="{{ $image }}">
                                                        <p>{{ $item->product->name }}</p>
                                                    </div>

                                                </td>
                                                <td> {{ $item->product->code }} </td>
                                                <td> {{ $item->variant->name }} </td>
                                                <td> {{ $item->stock }} </td>

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
