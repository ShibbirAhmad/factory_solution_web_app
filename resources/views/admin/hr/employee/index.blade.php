@extends('admin.layouts.admin')
@section('title','Manage Employee')
@section('content')
    <div class="row layout-top-spacing">

        @if(isset($_GET['new']))
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
                                @include('admin.hr.employee.form-employee',['button'=>'Save Employee'])
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-{{ isset($_GET['new']) ? '8' : '12' }}">
            @if(isset($_GET['new']))
                <a href="{{ route('employee.add') }}" class="btn btn-danger  ml-3 mt-3"> <i class="fa fa-times-circle"></i> Cancel </a>
            @else
                <a href="?new" class="btn btn-info"> <i class="fa fa-plus"></i> New Employee </a>
            @endif
            @include('admin.hr.employee.employees')
        </div>
    </div>
@endsection

