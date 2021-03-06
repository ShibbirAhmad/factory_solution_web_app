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
                                <input type="number" class="form-control" v-on:keyup="calculateTotalAmount" v-model="bonus"  placeholder="0">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Fine</label>
                                <input type="number" class="form-control"  v-on:keyup="calculateTotalAmount"   v-model="fine" 
                                    placeholder="0">
                            </div>



                            <div class="form-group mb-2">
                                <label class="control-label">Amount</label>
                                <input type="number" class="form-control" v-model="amount" 
                                    placeholder="0">
                            </div>         

                            <div class="form-group mb-2">
                                <label class="control-label">Total</label>
                                <input type="number" readonly class="form-control" v-model="total" 
                                    placeholder="0">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Account Debit From  </label>
                                <select class="form-control" v-model="payment_method">
                                    <option value="" disabled selected>Select Payment Method</option>
                                    @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Comment</label>
                                <input type="text" class="form-control" v-model="comment" 
                                    placeholder="comment">
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
                                        <p class="due-info">Name: <strong class="name">  @{{ employee.name }}</strong></p>
                                        <p class="due-info">Phone: <strong class="phone"> @{{ employee.phone }}</strong></p>
                                        <p class="due-info">Paid Leave: <strong class="paid"> @{{ employee.total_paid_leave }}</strong></p>
                                        <p class="due-info">Absent: <strong class="paid"> @{{ employee.total_absent }}</strong></p>
                                        <p class="due-info">Overtime: <strong class="paid"> @{{ employee.total_overtime }}</strong></p>
                                        <p v-if="employee.job_type==1">Current Salary: <strong class="total">  @{{ employee.current_salary }}</strong> </p>
                                        <p v-if="employee.job_type==2">Per Hour Value: <strong class="total">  @{{ employee.per_hour_salary }}</strong> </p>
                                        
                                        <p>Present: <strong class="paid"> @{{ employee.total_present }}</strong></p>
                                        <p>Daily Working Hour: <strong class="paid"> @{{ employee.daily_working_hour }}</strong></p>
                                        <p>Working Hour: <strong class="paid"> @{{ employee.total_hour }}</strong></p>
                                        <p>Job Type: <strong class="paid"> @{{ employee.job_type == 1 ? 'Monthly' : employee.job_type == 2 ? 'Hourly' : 'Contactual' }}</strong></p>
                                        {{-- <p>Total Working Hour: <strong class="balance"> @{{ parseInt(employee.current_salary) - parseInt(employee.total_paid) }}</strong> </p> --}}
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
                        fine: 0,
                        amount: 0,
                        total: 0,
                        payment_method: '',
                        validation_check: true,
                        employee: '',
                        current_salary: 0,
                        per_hour_salary: 0,
                        comment: '',
                    }
                },


                methods: {


                    async salaryPayment() {
                        this.validation();
                        const data = {
                            expert_id: this.expert_id,
                            bonus: this.bonus,
                            fine: this.fine,
                            amount: this.amount,
                            payment_method: this.payment_method,
                            comment: this.comment
                        }
                        if (this.validation_check == false) {
                            await axios.post('/admin/salary/api/store/salary', data)
                                .then((response) => {
                                    console.log(response);
                                    if (response.data.status == 1) {
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



                    calculateTotalAmount(){

                        let f= this.fine.length  <=  0 ? 0 :  parseInt(this.fine);
                        let b = this.bonus.length  <=  0 ? 0 :  parseInt(this.bonus);
                        let pay = this.amount.length  <= 0 ?  0 : parseInt(this.amount);
                        return this.total = (b + pay ) - f ;
                        
                         
                    },

                    async selectEmployee() {

                        await axios.get('/admin/salary/api/search/expert/' + this.expert_id)

                            .then((response) => {
                                console.log(response);
                                if (response.data.status == 1) {
                                    this.employee = response.data.employee;
                                    if (response.data.employee.job_type != 3) {
                                          this.amount= response.data.employee.current_salary > 0 ? response.data.employee.current_salary : response.data.employee.per_hour_salary 
                                    }else{
                                           this.amount=0 ;
                                    }
                                    this.calculateTotalAmount();
                                  
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
                        if (!this.total) {
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
