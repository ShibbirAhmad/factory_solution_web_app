@extends('admin.layouts.admin')
@section('title', 'Manage Due Receive')
@section('content')
    <div id="dueReceiveApp" class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Type or Scan Invoice No.</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="form-group mb-2">
                            <label class="control-label">Select Type </label>
                            <select class="form-control" v-model="due_type">
                                <option value="" disabled>Select Due receive or Paid</option>
                                <option value="purchase">purchase amount paid</option>
                                <option value="sale">sale amount receive</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="control-label">Invoice</label>
                            <input type="text" maxlength="20" v-on:keyup="searchInvoice" v-model="invoice_no"
                                class="form-control" placeholder="Ex.123456">
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
                            <label class="control-label">Paid</label>
                            <input type="number" v-on:keyup="checkPaidAmount"   min="1" v-model="paid" class="form-control" placeholder="Ex.1000000">
                        </div>
                        <div class="form-group mb-2">
                            <label class="col-form-label">Is Discount Payment</label>
                            <select v-model="is_discount_payment" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            <br>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Date</label>
                            <input type="date" class="form-control" name="date" v-model="paid_date">
                        </div>

                        <button v-on:click="submitPayment" type="submit" class="btn btn-primary ml-3 mt-3">Save Due Receive</button>


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
                                    <h4 style="background: #0e1726; color: white; margin-bottom: 10px"> Profile and Summary
                                    </h4>
                                    <p class="due-info">Name: <strong class="name">
                                            @{{ purchase . supplier . name }}</strong></p>
                                    <p>Total: <strong class="total">@{{ purchase . total }}</strong></p>
                                    <p class="due-info">Phone: <strong class="phone">
                                            @{{ purchase . supplier . phone }}</strong></p>
                                    <p>Paid: <strong class="paid"> @{{ purchase . paid }}</strong></p>
                                    <p class="due-info">Email: <strong class="email">
                                            @{{ purchase . supplier . email ? purchase . supplier . name : '' }}</strong>
                                    </p>
                                    <p>Due: <strong class="balance">
                                            @{{ parseInt(purchase . total) - (parseInt(purchase . paid) + parseInt(purchase . discount)) }}</strong>
                                    </p>
                                    <p class="due-info">Note: <strong class="email">
                                            @{{ purchase . note ? purchase . note : '' }}</strong> </p>
                                    <p>Discount: <strong class="balance">
                                            @{{ purchase . discount }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table  class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>price </th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="purchase" v-for="(item,item_index) in purchase.purchase_items"
                                                :key="item_index">
                                                <td>@{{ item_index + 1 }}</td>
                                                <td>@{{ item . product . name }}</td>
                                                <td>@{{ item . qty }}</td>
                                                <td>@{{ item . price }}</td>
                                                <td>@{{ parseInt(item . qty) * parseInt(item . price) }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div  v-if="sale" class="row">
                            <div class="col-lg-12">
                                <div v-if="sale" class="info">
                                    <h4 style="background: #0e1726; color: white; margin-bottom: 10px"> Profile and Summary
                                    </h4>
                                    <p class="due-info">Name: <strong class="name">
                                            @{{ sale . client . name }}</strong></p>
                                    <p>Total: <strong class="total">@{{ sale . total }}</strong></p>
                                    <p class="due-info">Phone: <strong class="phone">
                                            @{{ sale . client . phone }}</strong></p>
                                    <p>Paid: <strong class="paid"> @{{ sale . paid }}</strong></p>
                                    <p class="due-info">Company: <strong class="email">
                                            @{{ sale . client ? sale . client . company_name : '' }}</strong>
                                    </p>
                                    <p>Due: <strong class="balance">
                                            @{{ parseInt(sale . total) - (parseInt(sale . paid) + parseInt(sale . discount)) }}</strong>
                                    </p>
                                    <p class="due-info">Note: <strong class="email">
                                            @{{ sale . note ? sale . note : '' }}</strong> </p>
                                    <p>Discount: <strong class="balance">
                                            @{{ sale . discount }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table  class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Variants</th>
                                                <th>Qty</th>
                                                <th>price </th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="sale_items" v-for="(item,item_index) in sale_items"
                                                :key="item_index">
                                                <td>@{{ item_index + 1 }}</td>

                                                <td>
                                                    <div>
                                                        <img height="200" width="200" :src="img_base_url+'/'+item.product.image">
                                                        <p> Name: @{{ item.product . name }} </p>
                                                        <p> Code: @{{ item.product . code }} </p>
                                                    </div>

                                                </td>

                                                <td colspan="4">
                                                    <ul class="final_order_complition_list">

                                                            <li v-for="(variant,v_index) in item.variants ">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        @{{ variant.variant.name }}
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                       @{{ variant . qty }}
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        @{{ variant . price }}
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        @{{ parseInt(variant.qty) * parseInt(variant.price) }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                    </ul>

                                                </td>
                                            </tr>
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
@endsection



@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('script')
    <script>

       window.due_receive_sale_img_base_url = {!! json_encode( \App\Helper\dynamicFileLink('product'),JSON_HEX_TAG)  !!}

        var app = new Vue({
            el: '#dueReceiveApp',
            data() {
                return {
                    due_type: '',
                    payment_method: '',
                    invoice_no: null,
                    is_discount_payment:0,
                    purchase: '',
                    is_purchase_due: true,
                    sale: '',
                    sale_items: '',
                    transaction_id: null,
                    note: null,
                    paid_date: 0,
                    paid: 0,
                    total_payable_amount: 0,
                    attachments: '',
                    validation_check: true,
                    img_base_url:window.due_receive_sale_img_base_url,
                }
            },
            methods: {

                async submitPayment() {
                    this.validation();
                    const data = {
                        invoice_no: this.invoice_no,
                        payment_method: this.payment_method,
                        due_type: this.due_type,
                        is_discount_payment: this.is_discount_payment,
                        amount: this.paid,
                        transaction_id: this.transaction_id,
                        paid_date: this.paid_date,
                    }
                    if (this.validation_check == false) {

                        await axios.post('/admin/due-receive/api/store/due/payment', data)
                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 1) {
                                    this.total_payable_amount = 0;
                                    this.payment_method = '';
                                    this.paid = '';
                                    this.transaction_id = '';
                                    this.due_type = '';
                                    this.is_discount_payment = 0;
                                    this.flashSwal(response.data.message);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
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
                //searching due invoice
                async searchInvoice() {
                    if (!this.invoice_no) {
                        this.purchase = '';
                        this.total_payable_amount= 0;
                    }
                    if (!this.due_type) {
                        return this.flashSwal('Please, select sales due receive or purchase due paid type');
                    }

                    if (this.invoice_no.length > 3) {
                        await axios.post('/admin/due-receive/api/search/due/invoice', {
                                invoice_no: this.invoice_no,
                                due_type: this.due_type,
                            })
                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 'purchase') {
                                    this.purchase = response.data.purchase;
                                    this.total_payable_amount = parseInt(response.data.purchase.total) - (parseInt(response.data.purchase.paid) + parseInt(response.data.purchase.discount)) ;
                                }
                                if (response.data.status == 'sale') {
                                    this.sale = response.data.sale ;
                                    this.total_payable_amount = parseInt(response.data.sale.total) - (parseInt(response.data.sale.paid) + parseInt(response.data.sale.discount)) ;
                                    this.sale_items = response.data.sale_items ;
                                    this.is_purchase_due = false;
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


                checkPaidAmount(){

                     let total = parseInt(this.total_payable_amount);
                     let paid = parseInt(this.paid);
                     if (paid > total) {
                         this.flashSwal('paid amount is greater than total payable amount ');
                         return this.paid = 0 ;
                     }
                },



                validation() {
                    //invoice_no fields
                    if (!this.invoice_no) {
                        this.flashSwal('please, add the  invoice number');
                        return;
                    }
                    //checking paid fields
                    if (this.paid < 1 || this.paid==0 || this.paid==null) {
                        this.flashSwal('please, add paid amount');
                        return;
                    }
                    if (this.paid > (parseInt(this.purchase.total) - ( parseInt(this.purchase.paid) + parseInt(this.purchase.discount)))  ) {
                        this.flashSwal('Error,your paid amount is greater than due amount of this invoice ');
                        this.paid=0 ;
                        return;
                    }
                    //checking field
                    if (!this.payment_method) {
                        this.flashSwal('please, add payment a method');
                        return;
                    }
                    //checking paid date
                    if (!this.paid_date) {
                        this.flashSwal('please, payment date');
                        return;
                    }
                    this.validation_check = false;
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
