@extends('admin.layouts.admin')
@section('title','Manage Product')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Product</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        @if($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif


                        {{ Form::model($product,['route'=>['product.update',$product->id],'method'=>'post','class'=>'form-vertical','files'=>true]) }}
                            @include('admin.product.form-product',['button'=>'Update Product'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.product.products')
        </div>
    </div>
@endsection

