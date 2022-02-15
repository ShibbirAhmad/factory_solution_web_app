@extends('admin.layouts.admin')
@section('title', 'Add Sale')
@section('content')

    <div id="saleApp" class="row layout-top-spacing">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div id="flActionButtons" class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                        <h4>Sales Product List</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th> Product </th>
                                            <th> Variants </th>
                                            <th> Price * Total Qty </th>
                                            <th> Amount </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="(item,item_index) in sale_items" :key="item_index">
                                            <td>@{{ item_index + 1 }}</td>
                                            <td>
                                                <div class="sale_product_item_preview">
                                                    <img :src="base_url +'/'+ item.product.image" width="80px" width="80px">
                                                    <p> @{{ item.product.name }} </p>
                                                    <p> code: @{{ item.product.code }} </p>
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="sale_variant_preview_list">
                                                    <li v-for="(variant,s_index) in item.variants" :key="s_index">
                                                        @{{ variant.name }} = @{{ variant.qty }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>@{{ item.price }} * @{{ item.total_qty }} </td>
                                            <td>@{{ item.amount }} </td>
                                            <td>

                                                <button v-on:click="removeItem(`@{{ item_index }}`)"
                                                    class="btn btn-danger btn-sm"> <i class="fa fa-trash-alt fa-1x"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 5px">
                    <div id="flActionButtons" class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <br>
                                        <h6>Client Product, and Variant Info</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Client</label>
                                    <div class="col-sm-10">
                                        <select name="client" v-model="client_id" class="form-control sale_clients">
                                            <option value="" disabled selected>Select Client</option>
                                            @forelse ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @empty
                                                clients Not Found
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Warehouse </label>
                                    <div class="col-sm-10">
                                        <select name="client" v-model="warehouse_id" class="form-control ">
                                            <option value="" disabled selected>Select Warehouse of Product </option>
                                            @forelse ($warehouses as $w)
                                                <option value="{{ $w->id }}">{{ $w->name }}</option>
                                            @empty
                                                Warehouse Not Found
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="product_code" class="col-sm-2 col-form-label">Product</label>
                                    <div class="col-sm-10">
                                        <input v-on:keyup="searchProduct" type="text" name="product_code" maxlength="6"
                                            v-model="product_code" class="form-control"
                                            placeholder="type product code and press enter ">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="price" class="col-sm-4 col-form-label">Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="price" v-model="price" class="form-control"
                                                    placeholder="00">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="qty" class="col-sm-5 col-form-label">Total Quantity</label>
                                            <div class="col-sm-7">
                                                <input type="number" readonly value="" id="variants_total_qty"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" readonly :value="itemAmount" class="form-control"
                                            placeholder="00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group variant_container mb-4">
                                        <label class="control-label"> Order Variants </label>
                                        <input type="hidden" id="sale_variant_and_qty" value="" name="variant_and_qty">
                                        <ul>

                                            <li v-if="product_variants" v-for="(v_item,v_index) in product_variants"
                                                :key="v_index">

                                                <div style="width: 100%" class="n-chk">

                                                    <div class="row">
                                                        <div class="col-lg-1">
                                                            <label style="margin-right:10px;"
                                                                class="new-control new-checkbox checkbox-primary">
                                                                <input name="sale_variants[]" :value="v_item.variant_id"
                                                                    :id="'sale_variant_check_'+v_item.variant_id"
                                                                    type="checkbox"
                                                                    class="sale_create_variants new-control-input">
                                                                <span class="new-control-indicator"></span>
                                                                @{{ v_item.variant.name }}
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p style="color:blue;margin-left:50px;margin-top:5px;">
                                                                current stock qty = @{{ v_item.stock }} </p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="variant_value_container">
                                                                <input placeholder="0" min="1" type="number"
                                                                    :max="v_item.stock"
                                                                    :id="'max_sale_qty_'+v_item.variant_id"
                                                                    :sale_variant_qty_id="v_item.variant_id"
                                                                    :sale_variant_qty_name="v_item.variant.name"
                                                                    name="sale_variant_qty_value"
                                                                    class="sale_variant_values form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button v-on:click="addsaleItem" class="btn btn-success p-2">Add Product In Sale
                                        list</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4> Sale Amount/Payment Section </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="form-group mb-2 text-center">
                            <button v-on:click="submitsale" type="submit" class="btn btn-primary btn-block p-2">Submit Sale
                            </button>
                        </div>


                        <div class="form-group mb-2">
                            <label class="control-label">Total</label>
                            <input type="number" v-model="total" readonly placeholder="00" name="total"
                                class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Discount</label>
                            <input type="number" min="0" v-on:keyup="dueAmountCaluculation" v-model="discount"
                                placeholder="00" name="discount" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Paid</label>
                            <input type="number" min="0" v-on:keyup="dueAmountCaluculation" v-model="paid" placeholder="00"
                                name="paid" class="form-control">
                        </div>


                        <div class="form-group mb-2">
                            <label class="control-label">Amount Due</label>
                            <input type="number" readonly v-model="due" placeholder="00" name="due" class="form-control">
                        </div>


                        <div class="form-group mb-2">
                            <label class="col-form-label">Select Cash Receive Method</label>
                            <select v-model="payment_method" class="form-control">
                                <option value="" disabled>Select One</option>
                                @foreach ($payment_methods as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="text" v-model="transaction_id" class="form-control" placeholder="transaction ID">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Note</label>
                            <textarea class="form-control" name="note" v-model="note" rows="2"></textarea>
                        </div>

                        <div class="form-group mb-2 text-center">
                            <button v-on:click="submitsale" type="submit" class="btn btn-primary p-2 ">Submit
                                Sale</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('script')
    <script>
        window.create_sale_img_base_url = {!! json_encode( \App\Helper\dynamicFileLink('product'),JSON_HEX_TAG)  !!}
        var app = new Vue({
            el: '#saleApp',
            data() {
                return {
                    sale_items: [],
                    client_id: '',
                    product_id: '',
                    price: null,
                    discount: 0,
                    qty: 0,
                    total_qty: 0,
                    note: null,
                    total: 0,
                    due: 0,
                    paid: 0,
                    payment_method: '',
                    transaction_id: null,
                    base_url: window.create_sale_img_base_url,
                    validation_check: true,
                    submit_validation: true,
                    warehouse_id: '',
                    product_code: null,
                    product: '',
                    product_variants: '',
                }
            },
            methods: {



                async searchProduct() {

                    if (this.product_code.length == 6) {

                        if (this.product_code.length < 1 || this.warehouse_id == '') {
                            this.flashSwal('product code and warehouse is empty');
                            return;
                        }

                        this.product = null,
                            this.product_variants = null,
                            await axios.get('/admin/product/search/by/code/' + this.warehouse_id + '/' + this
                                .product_code)
                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 1) {
                                    this.product_id = response.data.product.id
                                    this.product = response.data.product
                                    this.product_variants = response.data.variants
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: ' not found ',
                                    })
                                }
                            })
                            .catch(function(error) {
                                console.log(error.response.data);
                            });
                    }
                },



                async submitsale() {
                    this.saleSubmitValidation();
                    if (this.sale_items.length < 1) {
                        this.flashSwal('please,add sale is item');
                        return;
                    }
                    if (this.submit_validation == false) {

                        const data = {
                            sale_items: this.sale_items,
                            client_id: this.client_id,
                            warehouse_id: this.warehouse_id,
                            paid: this.paid,
                            payment_method: this.payment_method,
                            transaction_id: this.transaction_id,
                            discount: this.discount,
                            total: this.total,
                            note: this.note,
                        }

                        await axios.post('/admin/sale', data)
                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 1) {
                                    this.sale_items = '';
                                    this.client_id = '';
                                    this.warehouse_id = '';
                                    this.flashSwal(response.data.message);
                                    window.history.back();
                                }
                            })
                            .catch(function(error) {
                                console.log(error.response.data);
                                Swal.fire({
                                    icon: 'error',
                                    title: error.response.data.message,
                                    text: error.response.data.errors,
                                })
                            });
                    }
                },

                addsaleItem() {
                    this.validation();
                    if (this.validation_check == false) {
                        let item = {
                            price: this.price,
                            total_qty: parseInt(document.getElementById('variants_total_qty').value),
                            product_id: this.product_id,
                            product: this.product,
                            variants: JSON.parse(document.getElementById('sale_variant_and_qty').value),
                            amount: (parseFloat(this.price) * parseFloat(document.getElementById(
                                'variants_total_qty').value))
                        }
                        this.sale_items.push(item);
                        this.flashSwal('item added in sale list');
                        this.product = null;
                        this.product_code = null;
                        this.product_variants = '';
                        this.price = null;
                        this.total_qty = 0;
                        this.product_id = '';
                        this.product = null;
                        document.getElementById('sale_variant_and_qty').value = '';
                        document.getElementById('variants_total_qty').value = 0;
                        this.validation_check = true;
                        this.totalAmount();
                    }
                },
                totalAmount() {
                    if (this.sale_items.length > 0) {
                        let t_amount = 0;
                        this.sale_items.forEach((item) => {
                            t_amount += parseFloat(item.amount);
                        });
                        this.total = t_amount;
                        this.due = t_amount;
                        return;
                    }
                },
                dueAmountCaluculation() {
                    let t_amount = parseFloat(this.total);
                    this.discount = this.discount.length <= 0 && this.discount <= 0 ? 0 : parseFloat(this.discount);
                    this.paid = this.paid.length <= 0 && this.paid <= 0 ? 0 : parseFloat(this.paid);

                    let discount = this.discount
                    let paid = this.paid
                    let due = Number(t_amount - (discount + paid));
                    this.due = Number(due);
                },
                //remove method of sale item
                removeItem(item_index) {
                    console.log(item_index);
                    this.sale_items.splice(item_index, 1);
                    this.totalAmount();
                    this.dueAmountCaluculation();
                },



                validation() {
                    //checking client field
                    if (this.client_id == '') {
                        this.flashSwal('please, select client');
                        return;
                    }
                    //checking warehouse field
                    if (this.warehouse_id == '') {
                        this.flashSwal('please, select warehouse');
                        return;
                    }
                    //checking price field
                    else if (this.price == null || this.price.length <= 0 ) {
                        this.flashSwal('please, add sale price of product');
                        return;
                    }
                    //checking quantity field
                    else if (parseInt(document.getElementById('variants_total_qty').value) < 1) {
                        this.flashSwal('please, add variant quantity');
                        return;
                    }
                    //checking product field
                    else if (this.product_id == '') {
                        this.flashSwal('please, select product');
                        return;
                    } else {
                        this.validation_check = false;
                    }
                },

                saleSubmitValidation() {
                    //checking payment method field
                    if (parseInt(this.paid) > 0) {
                        if (this.payment_method == '') {
                            this.flashSwal('please, select payment method of sale amount');
                            return;
                        }
                        else {
                            this.submit_validation = false;
                        }
                    } else {
                        this.submit_validation = false;
                    }

                },

                flashSwal(message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                    })
                },
            },
            computed: {
                itemAmount: function() {
                    return parseInt(document.getElementById('variants_total_qty').value) * (this.price == null ?
                        0 : parseInt(this.price))
                },

            }
        })


        // vue scripts end










        // jqury scripts start

        $(document).on('keyup', '.sale_variant_values', function() {

            var sale_qty = [];
            var variant_and_qty = [];
            $("input[name='sale_variant_qty_value']").each(function() {

                let variant_of_id = $(this).attr('sale_variant_qty_id')
                let name_of_variant = $(this).attr('sale_variant_qty_name')
                if (document.getElementById('sale_variant_check_' + variant_of_id).checked) {
                    let variant_quantity = $(this).val();
                    //check if the input quantity is greater
                    let max_qty = $('#max_sale_qty_'+variant_of_id).attr('max');
                    console.log(max_qty);
                    if (parseInt(variant_quantity) > parseInt(max_qty) ) {
                        Swal.fire({
                            title: 'Oops...',
                            text: 'error! quantity is greater than stock ',
                        })
                        return;
                    }

                    sale_qty.push(variant_quantity.length <= 0 ? 0 : variant_quantity);
                    //create an object by selected items
                    let item = {
                        id: variant_of_id,
                        name: name_of_variant,
                        qty: variant_quantity.length <= 0 ? 0 : variant_quantity,
                    }
                    variant_and_qty.push(item);
                }

            });

            let qty = 0;
            for (let index = 0; index < sale_qty.length; index++) {
                qty += parseInt(sale_qty[index]);
            }

            document.getElementById('variants_total_qty').value = qty;
            document.getElementById('sale_variant_and_qty').value = JSON.stringify(variant_and_qty);

        });
    </script>




@endsection
