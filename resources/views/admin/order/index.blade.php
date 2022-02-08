@extends('admin.layouts.admin')
@section('title', 'Add Order')
@section('content')

    <div class="row layout-top-spacing">
        <div id="flActionButtons" class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Create Order</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    {{ Form::open(['route' => 'order.store', 'method' => 'post', 'class' => 'form-vertical', 'files' => true]) }}
                    <div class="row">
                        @include('admin.order.form-order',['button'=>'Save Order'])
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>

@endsection


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>

        .designedImage {
            border: 1px solid rgba(0, 0, 0, 0.12);
            height: 300px;
            width: 300px;
            overflow: hidden;
            text-align: center;
            margin: auto;
            padding: 10px;
            border-radius: 5px;
        }

        .designedImage img {
            height: -webkit-fill-available;
            width: 100%;
            border-radius: 9px;
        }

        .designCode {
            font-weight: bold;
            font-size: 1.5rem !important;
            margin: 15px 0;
            border-bottom: 1px solid;
            border-top: 1px solid;
        }

    </style>
@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2();
        })

        $(document).on('change', '.prototype', function() {
            var prototype = $(".prototype option:selected");
            var imgSrc = "{{ asset(\App\Helper\dynamicFileLink('prototype')) }}" + "/" + prototype.data("file");
            $(".designImg").attr('src', imgSrc)
            $(".designCode").text("#" + prototype.data('code'))
        });




        $(document).on('keyup', '.order_variant_values', function() {

            var order_qty=[] ;
            var variant_and_qty=[];
            $("input[name='order_variant']").each(function() {
                    let variant_of_id = $(this).attr('variant_of_id')
                    let order_variant_id = $('#order_variant_'+variant_of_id).val()   ;
                    if ( document.getElementById('order_variant_'+variant_of_id).checked ) {
                        let variant_quantity = $(this).val() ;
                        let item = {
                            variant_id: variant_of_id ,
                            except_qty: variant_quantity.length <= 0 ? 0 : variant_quantity ,
                        }
                        order_qty.push(variant_quantity.length <= 0 ? 0 : variant_quantity)  ;
                        variant_and_qty.push(item)  ;
                    }
            });

            console.log(variant_and_qty);
            let total_expected_qty = 0;
            for (let index = 0; index < order_qty.length; index++) {
                 total_expected_qty  +=  parseInt(order_qty[index]) ;
            }
            document.getElementById('order_expected_qty').value = total_expected_qty;
            document.getElementById('total_expected_qty').innerHTML  = total_expected_qty;
            document.getElementById('order_variant_and_qty').value  =  JSON.stringify(variant_and_qty) ;

        });
    </script>
@endsection
