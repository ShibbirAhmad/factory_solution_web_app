    @extends('admin.layouts.admin')
    @section('title','Add Salary')
    @section('content')
    <div id="salary" class="row layout-top-spacing">
        <div class="col-lg-4">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Add Salary</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="form-group mb-2">
                            <label class="control-label">Select Employee </label>
                            <select class="form-control" v-model="client_id" required>
                                @foreach ($employees as $employee)
                                    <option value="">{{$employee->employee->name}} | {{$employee->employee->phone}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Phone</label>
                            <input type="number" v-on:keyup="searchPhone" v-model="phone"
                                class="form-control" placeholder="015********">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Bonus</label>
                            <input type="number"
                                class="form-control" v-model="bonus" id="bonus" placeholder="0">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Advanced Salary</label>
                            <input type="number"
                                class="form-control" v-model="advanced_salary" id="advanced_salary" placeholder="0">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Fine Salary</label>
                            <input type="number"
                                class="form-control" v-model="fine_salary" id="fine_salary" placeholder="0">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Total Salary</label>
                            <input type="number"
                                class="form-control" v-model="total_salary" id="total_salary" placeholder="0">
                        </div>

                        <div class="form-group mb-2">
                            <label class="control-label">Payment Type </label>
                            <select class="form-control" v-model="payment_method" name="payment_method" required>
                                <option value="">Cash</option>
                                <option value="">Bkash</option>
                                <option value="">Bank</option>
                            </select>
                        </div>
                        <button v-on:click="salaryPayment" type="submit" class="btn btn-primary ml-3 mt-3">Save Payment Info</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow  p-4">
                    <div class="widget-header">
                        <div class="row">
                            {{-- <div class="col-lg-12">
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
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
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
                                            {{-- <tr v-if="purchase" v-for="(item,item_index) in purchase.purchase_items"
                                                :key="item_index">
                                                <td>@{{ item_index + 1 }}</td>
                                                <td>@{{ item . product . name }}</td>
                                                <td>@{{ item . qty }}</td>
                                                <td>@{{ item . price }}</td>
                                                <td>@{{ parseInt(item . qty) * parseInt(item . price) }} </td>
                                            </tr> --}}
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
        var app = new Vue({
            el: '#salary',
            data() {
                return {
                    client_id: '',
                    bonus: '',
                    advanced_salary: '',
                    fine_salary: '',
                    total_salary: 0,
                    payment_method: '',
                    phone: '',
                    employee: '',
                }
            },


            methods: {

                async salaryPayment() {

                    console.log('Hello World');
                },

                async searchPhone() {
                    
                
                },

                validation() {
                  
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
                

            }
        })
    </script>



@endsection
