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
                                        <h4>Purchasing Product List</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th> Product </th>
                                            <th> Unit </th>
                                            <th> Price * Qty </th>
                                            <th> Amount </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,item_index) in sale_items" :key="item_index">
                                            <td>@{{ item_index + 1 }}</td>
                                            <td>@{{ itemProduct(item.product_id) }}</td>
                                            <td>@{{ item.price }} * @{{ item.qty }}</td>
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
                                    <label for="product_code" class="col-sm-2 col-form-label">Product</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="product_id" v-model="product_id" class="form-control"
                                            placeholder="product code ">
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
                                                <input type="number" readonly name="qty" v-model="qty"
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
                                        <input type="hidden" id="sale_variant_and_qty" value="" name="sale_variant_and_qty">
                                        <ul>
                                            @forelse ($tasks as $item)
                                                <li>

                                                    <div style="width: 100%" class="n-chk">

                                                        <div class="row">
                                                            <div class="col-lg-1">
                                                                <label style="margin-right:10px;"
                                                                    class="new-control new-checkbox checkbox-primary">
                                                                    <input name="sale_variants[]"
                                                                        value="{{ $item->variant->id }}"
                                                                        type="checkbox"
                                                                        class="sale_create_variants new-control-input">
                                                                    <span
                                                                        class="new-control-indicator"></span>{{ $item->variant->name }}
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <p style="color:blue;margin-left:50px;margin-top:5px;">
                                                                    current stock qty = {{ $item->except_qty }} </p>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="variant_value_container">
                                                                    <input placeholder="0" min="1" type="number" value=""
                                                                        variant_task_receive_of_id="{{ $item->variant->id }}"
                                                                        id="sale_variant_input_{{ $item->variant->id }}"
                                                                        name="sale_variant"
                                                                        class="sale_variant_values form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </li>
                                            @empty
                                                <li> No Data Found </li>
                                            @endforelse


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
                                <h4>Manage Sale</h4>
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
                            <input type="number" v-model="total_amount" readonly placeholder="00" name="total_amount"
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
                            <label class="control-label">Date</label>
                            <input type="date" class="form-control" name="date" v-model="payable_date">
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

                        <div class="form-group mb-2">
                            <label class="control-label">Invoice Memo</label>
                            <input v-on:change="uploadAttachment" type="file" multiple name="attachments">
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



    <script>
        window.products = {!! json_encode(
    \App\Models\Product::query()->where('user_id', auth()->id())->orderBy('name')->get()->toArray(),
    JSON_HEX_TAG,
) !!};
    </script>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#saleApp',
            data() {
                return {
                    sale_items: [],
                    client_id: '',
                    product_id: '',
                    price: null,
                    discount: null,
                    qty: 0,
                    payable_date: null,
                    note: null,
                    total_amount: 0,
                    due: 0,
                    paid: 0,
                    payment_method: '',
                    transaction_id: null,
                    attachments: '',
                    products: window.products,
                    validation_check: true,
                    submit_validation: true,
                }
            },
            methods: {

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
                            paid: this.paid,
                            payment_method: this.payment_method,
                            transaction_id: this.transaction_id,
                            discount: this.discount,
                            total_amount: this.total_amount,
                            payable_date: this.payable_date,
                            note: this.note,
                            attachments: this.attachments,
                        }

                        await axios.post('/admin/sale', data)
                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 1) {
                                    this.sale_items = '';
                                    this.client_id = '';

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
                            qty: this.qty,
                            product_id: this.product_id,
                            amount: (parseFloat(this.price) * parseFloat(this.qty))
                        }
                        this.sale_items.push(item);
                        this.price = null;
                        this.qty = 1;
                        this.product_id = '';
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
                        this.total_amount = t_amount;
                        this.due = t_amount;
                        return;
                    }
                },
                dueAmountCaluculation() {
                    let t_amount = parseFloat(this.total_amount);
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
                //parsing product name
                itemProduct(item_id) {
                    let product_name = '';
                    this.products.forEach(product => {
                        if (product.id == item_id) {
                            product_name = product.name;
                        }
                    });
                    return product_name;
                },


                uploadAttachment(e) {
                    const file = e.target.files
                    this.attachments = file
                },

                validation() {
                    //checking client field
                    if (this.client_id == '') {
                        this.flashSwal('please, add client');
                        return;
                    }
                    //checking price field
                    else if (this.price == null) {
                        this.flashSwal('please, add sale price of item');
                        return;
                    }
                    //checking quantity field
                    else if (this.qty < 1) {
                        this.flashSwal('please, add quantity');
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
                        //checking payment date
                        else if (this.payable_date == null) {
                            this.flashSwal('please, select payment date');
                            return;
                        } else {
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
                    return parseInt(this.qty) * (this.price == null ? 0 : parseInt(this.price))
                },

            }
        })
    </script>



@endsection