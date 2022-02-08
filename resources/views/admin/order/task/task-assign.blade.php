@extends('admin.layouts.admin')
@section('title', 'Order Task')
@section('content')

    <div class="row layout-top-spacing">
        <div id="flActionButtons" class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Manage {{ $order->title }} Order </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    {{ Form::open(['route'=>['task.store',$order->id],'method'=>'post','class'=>'form-vertical','files'=>true]) }}
                    <div class="row">
                        @include('admin.order.task.form-task',['button'=>'Save Task Assign'])
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function (){
            $(".select2").select2();
        })

        $(document).on('change','.department',function (){
           let department = $('.department option:selected')

            $.ajax({
                method:"post",
                url:"{{ route('task.changeDepartment') }}",
                data:{department_id:department.val(),_token:'{{ csrf_token() }}'},
                dataType:'json',
                success:function (response){
                    if(response.experts.length>0){
                        for(var i=0;i<response.experts.length;i++){
                            var myOption = '<option value="'+response.experts[i].id+'">'+response.experts[i].name+" | "+response.experts[i].phone+'</option>';
                            $('.experts').append(myOption);
                        }
                    }
                    if(response.sub_departments.length>0){

                        $('.subDepartments').html(response.sub_departments);
                    }
                }
            })

        });





        $(document).on('keyup', '.order_task_assign_variant_values', function() {

            var order_qty=[] ;
            var variant_and_qty=[];
            $("input[name='order_task_assign_variant']").each(function() {
                    let variant_of_id = $(this).attr('variant_task_assign_of_id')

                        let variant_quantity = $(this).val() ;
                        let item = {
                            variant_id: variant_of_id ,
                            task_qty: variant_quantity.length <= 0 ? 0 : variant_quantity ,
                        }
                        order_qty.push(variant_quantity.length <= 0 ? 0 : variant_quantity)  ;
                        variant_and_qty.push(item)  ;

            });

            let total_expected_qty = 0;
            for (let index = 0; index < order_qty.length; index++) {
                 total_expected_qty  +=  parseInt(order_qty[index]) ;
            }

            document.getElementById('total_task_assign_qty').innerHTML  = total_expected_qty;
            document.getElementById('order_task_assign_variant_and_qty').value  =  JSON.stringify(variant_and_qty) ;

        });




    </script>
@endsection

@section('css')
    <style>
        .orderInfo{

            overflow: hidden;
            text-align: center;
            margin: auto;

        ;
        }
        .orderInfo h4{
            font-size: 14px;
        }
        .orderInfo div{
            border: 1px solid rgba(0,0,0,0.25);
            height: 200px;
            width: 200px;
            margin: auto;
        }
        .orderInfo div img{
            margin: auto;
            height: 100%;
            width: 100%;
        }

        .product_qty_filed{
            height: 30px;
        }


    </style>
@endsection
