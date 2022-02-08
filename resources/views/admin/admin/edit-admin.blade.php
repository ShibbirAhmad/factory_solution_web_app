@extends('admin.layouts.admin')
@section('title','Manage Admin')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Admin</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::model($admin,['route'=>['admin.update',$admin->id],'method'=>'put','class'=>'form-vertical']) }}
                            @include('admin.admin.form-admin',['button'=>'Update Admin'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.admin.admin')
        </div>
    </div>
@endsection

