@extends('admin.layouts.admin')
@section('title','Manage Employee')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Manage Employee</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::open(['route'=>'employee.store','method'=>'post','class'=>'form-vertical','files'=>true]) }}
                            @include('admin.employee.form-employee',['button'=>'Save Employee'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.employee.employees')
        </div>
    </div>
@endsection

