@extends('admin.layouts.admin')
@section('title','Manage Sub Department')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Update Sub Department</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::model($sub_department,['route'=>['subDepartment.update',$sub_department->id],'method'=>'post','class'=>'form-vertical']) }}
                            @include('admin.sub-department.form-sub-department',['button'=>'UpdateSub Department'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.sub-department.sub-departments')
        </div>
    </div>
@endsection

