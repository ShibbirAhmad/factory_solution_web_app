@extends('admin.layouts.admin')
@section('title','Manage Salary')
@section('content')
    <div id="flActionButtons" class="col-lg-12">
        <div class="statbox widget box box-shadow  p-4">
            <div class="widget-header">
                <a href="{{route('salary.add')}}" class="btn btn-info"> <i class="fa fa-left-arrow"></i> Back </a>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="boxs blue">
                            <img class="d_img_icon" src="" height="80" width="80" />
                            <p>Name: {{$view_profile->expert->name}} </p>
                            <p>Designation: {{$view_profile->expert->designation->name}} </p>
                            <p>Phone: {{$view_profile->expert->phone}}</p>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="boxs blue">
                            <p>Total Taken Amount: {{$total_amount}} </p>
                            <p>Total Paid Amount: {{$bonus}} </p>
                            <p>Fine: {{$fine}}</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Comment</th>
                                        <th>Amount</th>
                                        <th>Job Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

