@extends('admin.layouts.admin')
@section('title','Manage Client')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Client</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::model($client,['route'=>['client.update',$client->id],'method'=>'put','class'=>'form-vertical']) }}
                            @include('admin.client.form-client',['button'=>'Update Client'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.client.clients')
        </div>
    </div>
@endsection

