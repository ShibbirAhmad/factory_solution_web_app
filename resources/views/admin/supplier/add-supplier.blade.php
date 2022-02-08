@extends('admin.layouts.admin')
@section('title','Create Supplier')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-2 col-xl-2 col-xs-0 "> </div>
        <div class="col-lg-8 col-xl-8 col-md-8 col-sm-8 col-xs-8 ">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                <h4>Create/Add New Supplier</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @if($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        {{ Form::open(['route'=>'supplier.store','method'=>'post','class'=>'form-vertical','files'=>true]) }}

                           @include('admin.supplier.form-supplier',['button'=>'Save supplier'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

