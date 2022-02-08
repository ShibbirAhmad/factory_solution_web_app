@extends('admin.layouts.admin')
@section('title','Manage Attribute')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Attribute</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::model($attribute,['route'=>['attribute.update',$attribute->id],'method'=>'post','class'=>'form-vertical']) }}
                            @include('admin.attribute.form-attribute',['button'=>'Update Attribute'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.attribute.attribute')
        </div>
    </div>
@endsection

