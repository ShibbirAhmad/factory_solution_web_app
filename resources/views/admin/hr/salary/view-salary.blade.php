@extends('admin.layouts.admin')
@section('title','Manage Salary')
@section('content')
    <div id="flActionButtons" class="col-lg-12">
        <div class="statbox widget box box-shadow  p-4">
            <div class="widget-header">
                <a href="{{route('salary.add')}}" class="btn btn-info"> <i class="fa fa-left-arrow"></i> Back </a>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="">
                            <img class="rounded-circle" src="" height="80" width="80" />
                            <p>Name: {{$view_profile->expert->name}} </p>
                            <p>Designation: {{$view_profile->expert->designation->name}} </p>
                            <p>Phone: {{$view_profile->expert->phone}}</p>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="custom-box p-3 mb-2" style="background: #F2F2F5;">
                            <strong>Total Taken Amount: {{$total_amount}}</strong>
                        </div>
                        <div class="custom box p-2 mb-2" style="background: #F2F2F5;">
                            <strong>Total Paid Amount: {{$bonus}} </strong>       
                        </div>
                        <div class="custom box p-2" style="background: #F2F2F5;">
                            <strong>Fine: {{$fine}}</strong>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expert_salary as $key=>$salary)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ $salary->created_at}}</td>
                                            <td>{{$salary->amount}}</td>
                                            <td>{{$salary->comment}}</td>
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

@endsection


