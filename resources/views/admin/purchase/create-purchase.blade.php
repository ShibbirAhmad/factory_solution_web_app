@extends('admin.layouts.admin')
@section('title', 'Add Purchase')
@section('content')

    <div id="purchaseApp" class="row layout-top-spacing">
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
                                        <tr v-for="(item,item_index) in purchase_items" :key="item_index">
                                            <td>@{{ item_index + 1 }}</td>
                                            <td>@{{ itemProduct(item . product_id) }}</td>
                                            <td>@{{ itemUnit(item . unit_id) }}</td>
                                            <td>@{{ item . price }} * @{{ item . qty }}</td>
                                            <td>@{{ item . amount }} </td>
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
                                        <h4>Product Buy Info</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Supplier</label>
                                    <div class="col-sm-10">
                                        <select name="supplier"  v-model="supplier_id"
                                            class="form-control purchase_suppliers">
                                            <option value="" disabled selected>Select Supplier</option>
                                            @forelse ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @empty
                                                Suppliers Not Found
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="supplier_invoice_no" class="col-sm-2 col-form-label">Invoice No</label>
                                    <div class="col-sm-10">
                                           <input type="text"  v-model="supplier_invoice_no" class="form-control"
                                             placeholder="supplier invoice number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Products</label>
                                    <div class="col-sm-10">
                                        <select name="product_id"  v-model="product_id"
                                            class="form-control purchase_products">
                                            <option value="" disabled selected>Select Product</option>
                                            @forelse ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @empty
                                                Products Not Found
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <select  name="unit_id" v-model="unit_id" class="form-control">
                                            <option value="" disabled>Select Product Unit</option>
                                            @forelse ($units as $unit)
                                                <option value="{{ $product->id }}">{{ $unit->name }}</option>
                                            @empty
                                                Products Units Not Found
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="number"  name="price" v-model="price" class="form-control"
                                            placeholder="00">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Qty</label>
                                    <div class="col-sm-10">
                                        <input type="number"  name="qty" v-model="qty" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" readonly :value="itemAmount" class="form-control"
                                            placeholder="00">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button v-on:click="addPurchaseItem" class="btn btn-success btn-block">Add Purchase
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
                                <h4>Manage purchase</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="form-group mb-2">
                            <button v-on:click="submitPurchase" type="submit" class="btn btn-primary btn-block">Save
                                Purchase</button>
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

                        <div class="form-group mb-2">
                            <button v-on:click="submitPurchase" type="submit" class="btn btn-primary btn-block">Save
                                Purchase</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>


<script>
        window.units = {!! json_encode(
    \App\Models\Unit::query()->orderBy('name')->get()->toArray(),
    JSON_HEX_TAG,
) !!};
        window.products = {!! json_encode(
    \App\Models\Product::query()->where('user_id', auth()->id())->orderBy('name')->get()->toArray(),
    JSON_HEX_TAG,
) !!};
</script>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#purchaseApp',
            data() {
                return {
                    purchase_items: [],
                    supplier_id:'',
                    supplier_invoice_no:null,
                    product_id: '',
                    unit_id: '',
                    price: null,
                    discount: null,
                    qty: 1,
                    payable_date: null,
                    note: null,
                    total_amount: 0,
                    due: 0,
                    paid: 0,
                    payment_method:'',
                    transaction_id: null,
                    attachments: '',
                    units: window.units,
                    products: window.products,
                    validation_check:true,
                    submit_validation:true,
                }
            },
            methods: {

                async submitPurchase() {
                    this.purchaseSubmitValidation();
                    if (this.purchase_items.length < 1) {
                        this.flashSwal('please,add purchase is item');
                        return;
                    }
                    if(this.submit_validation==false) {

                        const data = {
                            purchase_items: this.purchase_items,
                            supplier_id: this.supplier_id,
                            supplier_invoice_no: this.supplier_invoice_no,
                            paid: this.paid,
                            payment_method: this.payment_method,
                            transaction_id: this.transaction_id,
                            discount: this.discount,
                            total_amount: this.total_amount,
                            payable_date: this.payable_date,
                            note: this.note,
                            attachments: this.attachments,
                        }

                        await axios.post('/admin/purchase', data)
                            .then((response) =>{
                                console.log(response);
                                if (response.data.status == 1) {
                                this.purchase_items='' ;
                                this.supplier_id='' ;
                                this.supplier_invoice_no='' ;
                                this.unit_id='' ;
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

                addPurchaseItem() {
                    this.validation();
                    if (this.validation_check==false) {
                        let item = {
                        price: this.price,
                        qty: this.qty,
                        product_id: this.product_id,
                        unit_id: this.unit_id,
                        amount: (parseFloat(this.price) * parseFloat(this.qty))
                    }
                    this.purchase_items.push(item);
                    this.price = null;
                    this.qty = 1;
                    this.product_id = '';
                    this.unit_id = '';
                    this.validation_check = true ;
                    this.totalAmount();
                    }
                },
                totalAmount() {
                    if (this.purchase_items.length > 0) {
                        let t_amount = 0;
                        this.purchase_items.forEach((item) => {
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
                //remove method of purchase item
                removeItem(item_index) {
                    console.log(item_index);
                    this.purchase_items.splice(item_index, 1);
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
                //parsing unit name
                itemUnit(item_id) {
                    let unit_name = '';
                    this.units.forEach(unit => {
                        if (unit.id == item_id) {
                            unit_name = unit.name;
                        }
                    });
                    return unit_name;
                },

                uploadAttachment(e) {
                    const file = e.target.files
                    this.attachments = file
                },

                validation(){
                    //checking supplier field
                    if (this.supplier_id == '') {
                        this.flashSwal('please, add supplier');
                        return;
                    }
                    //checking price field
                    else if (this.price == null || this.price.length <= 0) {
                        this.flashSwal('please, add purchase price of item');
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
                    }
                    //checking unit field
                   else  if (this.unit_id == '') {
                        this.flashSwal('please, select product unit field');
                        return;
                    }
                   else{
                        this.validation_check = false ;
                    }
                },

                purchaseSubmitValidation(){
                 //checking payment method field
                   if (parseInt(this.paid) > 0) {
                        if (this.payment_method=='') {
                           this.flashSwal('please, select payment method of purchase amount');
                           return;
                        }
                        //checking payment date
                        else if (this.payable_date == null) {
                            this.flashSwal('please, select payment date');
                            return;
                        }else{
                            this.submit_validation=false ;
                        }
                    }else{
                        this.submit_validation=false ;
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
