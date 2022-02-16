    @extends('admin.layouts.admin')
    @section('title', 'Add Salary')
    @section('content')
        <div id="salaryAPP" class="row layout-top-spacing">
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
                                <select class="form-control" v-model="expert_id" v-on:change="selectEmployee">
                                    <option value="" disabled selected>Select Employee</option>
                                    @foreach ($experts as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }} |
                                            {{ $employee->phone }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Bonus</label>
                                <input type="number" class="form-control" v-model="bonus" id="bonus" placeholder="0">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Fine</label>
                                <input type="number" class="form-control" v-model="fine_salary" id="fine_salary"
                                    placeholder="0">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Total</label>
                                <input type="number" class="form-control" v-model="total_salary" id="total_salary"
                                    placeholder="0">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Account Debit From  </label>
                                <select class="form-control" v-model="payment_method" name="payment_method" required>
                                    <option value="" disabled selected>Select Payment Method</option>
                                    @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button v-on:click="salaryPayment" type="submit" class="btn btn-primary ml-3 mt-3">Save Payment
                                Info</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="flActionButtons" class="col-lg-12">
                    <div class="statbox widget box box-shadow  p-4">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div v-if="employee" class="info">
                                        <h4 style="background: #0e1726; color: white; margin-bottom: 10px"> Activity
                                            Summary
                                        </h4>
                                        <p class="due-info">Name: <strong class="name">
                                                @{{ employee.name }}</strong></p>
                                        <p class="due-info">Phone: <strong class="phone">
                                                @{{ employee.phone }}</strong></p>
                                        <p>Current Salary: <strong class="total">@{{ employee.current_salary }}</strong>
                                        </p>
                                        <p>Paid: <strong class="paid"> @{{ employee.total_paid }}</strong></p>
                                        <p>Advance: <strong class="balance"> @{{ parseInt(employee.current_salary) - parseInt(employee.total_paid) }}</strong> </p>
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
                el: '#salaryAPP',
                data() {
                    return {
                        expert_id: '',
                        bonus: 0,
                        fine_salary: 0,
                        total_salary: 0,
                        payment_method: '',
                        validation_check: true,
                        employee: ''
                    }
                },


                methods: {

                    async salaryPayment() {
                        this.validation();
                        const data = {
                            expert_id: this.expert_id,
                            bonus: this.bonus,
                            advanced_salary: this.advanced_salary,
                            fine_salary: this.fine_salary,
                            total_salary: this.total_salary,
                            payment_method: this.payment_method,
                        }
                        if (this.validation_check == false) {
                            await axios.post('/admin/salary/api/store/salary', data)
                                .then((response) => {
                                    this.expert_id = '',
                                        this.bonus = '',
                                        this.fine_salary = '',
                                        this.total_salary = '',
                                        this.payment_method = ''
                                    this.flashSwal(response.data.message);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                })
                                .catch(function(error) {
                                    onsole.log(error.response.data);
                                    Swal.fire({
                                        icon: 'error',
                                        title: error.response.data.message,
                                        text: error.response.data.errors,
                                    })
                                });
                        }
                    },

                    async selectEmployee() {

                        await axios.get('/admin/salary/api/search/expert/' + this.expert_id)

                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 1) {
                                    this.employee = response.data.employee;
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
                    },

                    validation() {
                        if (!this.expert_id) {
                            this.flashSwal('please, select employee');
                            return;
                        }
                        if (!this.total_salary) {
                            this.flashSwal('please, add total salary');
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


                }
            })
        </script>



    @endsection
