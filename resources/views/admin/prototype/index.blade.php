@extends('admin.layouts.admin')
@section('title','Manage Prototype/Design')
@section('content')
    <div class="row layout-top-spacing">
        @if(isset($_GET['new']))
            <div class="col-lg-4">
                <div id="flActionButtons" class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Manage Prototype/Design</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            {{ Form::open(['route'=>'prototype.store','method'=>'post','class'=>'form-vertical','files'=>true]) }}
                                @include('admin.prototype.form-prototype',['button'=>'Save Prototype/Design'])
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-{{ isset($_GET['new']) ? '8' : '12' }}">
            @if(isset($_GET['new']))
                <a href="{{ route('prototype.add') }}" class="btn btn-danger  ml-3 mt-3"> <i class="fa fa-times-circle"></i> Cancel </a>
            @else
                <a href="?new" class="btn btn-info"> <i class="fa fa-plus"></i> New Prototype </a>
            @endif

            @include('admin.prototype.prototypes')
        </div>
    </div>
@endsection


@section('css')
    <link href="https://designreset.com/cork/ltr/demo4/assets/css/forms/switches.css" rel="stylesheet">
@endsection
@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function (){
           $(".select2").select2();
        });

        $(document).on('change','.changeStatus',function(){
           let status = $(this);
           let messages = prompt("Status Change Note.","");
           if(messages == null)
           {
               let is1  = (status.attr('data-status') == 1 ? true : false);
               status.attr('data-status',status.data('status'))
               status.prop('checked',is1)
           }else
           {
               $.ajax({
                   method:"get",
                   url:'{{ route("prototype.add") }}',
                   data:{status:status.attr('data-status'),id:status.attr('data-id')},
                   dataType:'json',
                   success:function (response) {
                       status.attr('data-status',response.prototype.status)
                       console.log("Response : ",response)
                   },
                   error:function (error) {
                       console.log("Error :",error)
                   }
               })
           }

           console.log("Status : ",status.attr('data-status'))
        });

    </script>
@endsection
