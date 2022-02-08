@extends('admin.layouts.admin')
@section('title', 'Manage Supplier')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-5 col-5 ">
                                <a class="btn btn-success mt-2" href="{{ route('supplier.create') }}"> Add New Supplier </a>
                            </div>
                            <div class="col-xl-7 col-md-7 col-sm-7 col-7 ">
                                <h4>Manage Suppliers</h4>
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
                                            <th width="20%">Supplier Info.</th>
                                            <th width="10%">Email </th>
                                            <th width="15%">Address </th>
                                            <th width="10%">Total Amount</th>
                                            <th width="10%">Total Paid</th>
                                            <th width="10%">Due Amount</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($suppliers as $key=>$supplier)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                     @php
                                                         $image = !empty($supplier->avatar) ? \App\Helper\dynamicFileLink('supplier').$supplier->avatar : asset('project_files/404.jpg')
                                                     @endphp
                                                     <img  class="profile_img" src="{{  $image }}">
                                                    <p> Name: <b>  {{ $supplier->name }}</b> </p>
                                                    <p> Phone: <b> {{ $supplier->phone }} </b> </p>
                                                </td>
                                                <td> {{ $supplier->email ? $supplier->email : '' }} </td>
                                                <td> {{ $supplier->address }} </td>
                                                <td> {{ $supplier->total_amount }}</td>
                                                <td> {{ $supplier->total_paid  }} </td>
                                                <td> {{ intval($supplier->total_amount) - (intval($supplier->total_paid ) + intval($supplier->total_discount ))  }} </td>

                                                <td>
                                                    @if ($supplier->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-warning">De-Active</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ route('supplier.edit',$supplier->id) }}" class="btn btn-sm btn-success" > <i class="fa fa-edit fa-1x"></i> </a>

                                                    @if ($supplier->status==1)
                                                         <button class="mt-1 btn btn-sm erase btn-warning" data-url="{{ route('supplier.destroy',$supplier->id) }}" data-id="{{ $supplier->id }}"> <i class="fa fa-ban fa-1x"></i> </button>
                                                    @else
                                                    <button class="mt-1 btn btn-sm erase btn-success" data-url="{{ route('supplier.destroy',$supplier->id) }}" data-id="{{ $supplier->id }}"> <i class="fa fa-check fa-1x"></i> </button>
                                                    @endif
                                                    <a href="{{route('supplier.show', $supplier->id)}}" class="btn btn-sm btn-success mt-1"><i class="fa fa-eye fa-1x"></i></a>
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
