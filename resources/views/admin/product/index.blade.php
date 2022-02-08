@extends('admin.layouts.admin')
@section('title','Manage Product')
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Manage Product</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {{ Form::open(['route'=>'product.store','method'=>'post','class'=>'form-vertical','files'=>true]) }}
                            @include('admin.product.form-product',['button'=>'Save Product'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @include('admin.product.products')
        </div>

    </div>



@endsection


@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.1.6/vue.min.js">  </script>

    <script>
        new Vue({
            el: "#testing-app",
            data() {
                return {
                    name: "Hello World!",
                    product:null
                }
            },
            methods:{
                productChange(e){
                    $(".select2").select2();
                    let value = $( ".select2 option:selected" ).val();
                    this.product = value
                    //this.product = e.target.value
                    console.log("Data : ",e.target.value)
                },
            }
        });
    </script>
@endsection
