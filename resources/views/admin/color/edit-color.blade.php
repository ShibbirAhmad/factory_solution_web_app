@extends('admin.layouts.admin')
@section('title','Manage Color')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Color</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::model($color,['route'=>['color.update',$color->id],'method'=>'post','class'=>'form-vertical']) }}
                            @include('admin.color.form-color',['button'=>'Update Color'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.color.colors')
        </div>
    </div>
@endsection

