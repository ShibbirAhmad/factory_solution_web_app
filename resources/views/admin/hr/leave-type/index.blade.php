@extends('admin.layouts.admin')
@section('title', 'Manage Leave Type')
@section('content')
    <div id="dueReceiveApp" class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Leave Type</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{route('leaveType.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="control-label">Name</label>
                                <input type="text" name="name"  class="form-control" placeholder="sick">
                            </div>
                            <button v-on:click="submitPayment" type="submit" class="btn btn-primary ml-3 mt-3">Save Leave Type</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow  p-4">
                    <div class="widget-header">
                        <div  v-if="purchase" class="row">
                            <div class="col-lg-12">
                                <div v-if="purchase" class="info">
                                    <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leaveTypes as $key=>$leaveType)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$leaveType->name}}</td>
                                                     <td>
                                                        <a href="{{ route('leaveType.edit',$leaveType->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                                        <a href="{{ route('leaveType.destroy',$leaveType->id) }}" class="btn btn-danger erase" > <i class="fa fa-trash-alt fa-1x"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

