@extends('admin.layouts.admin')
@section('title', 'Task Receive')
@section('content')

    <div class="row layout-top-spacing">
        <div id="flActionButtons" class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Receive Task From {{ $tasks[0]->expert->name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">

                        <div class="col-lg-12">
                            {{ Form::open(['route'=>['taskReport.store',$tasks[0]['order_progress_id']],'method'=>'post']) }}
                                <div class="row">
                                    @include('admin.order.task-receive.form-task-receive',['button'=>'Save Task Receive Report'])
                                </div>
                            {{ Form::close() }}
                        </div>

                        <div class="col-lg-8">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
   <script>

        $(document).on('keyup', '.order_task_receive_variant_values', function() {

            var order_qty=[] ;
            var variant_and_qty=[];
            $("input[name='order_task_receive_variant']").each(function() {
                    let variant_of_id = $(this).attr('variant_task_receive_of_id')

                        let variant_quantity = $(this).val() ;
                        let item = {
                            variant_id: variant_of_id ,
                            handover_qty : variant_quantity.length <= 0 ? 0 : variant_quantity ,
                        }
                        order_qty.push(variant_quantity.length <= 0 ? 0 : variant_quantity)  ;
                        variant_and_qty.push(item)  ;

            });

            let total_expected_qty = 0;
            for (let index = 0; index < order_qty.length; index++) {
                 total_expected_qty  +=  parseInt(order_qty[index]) ;
            }

            document.getElementById('total_task_receive_qty').innerHTML  = total_expected_qty;
            document.getElementById('order_task_receive_variant_and_qty').value  =  JSON.stringify(variant_and_qty) ;

        });



 </script>
@endsection