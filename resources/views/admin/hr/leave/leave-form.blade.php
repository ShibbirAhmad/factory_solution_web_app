 <div class="widget-content widget-content-area">
                        <form action="{{route('leave.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="control-label">Select Employee </label>
                                <select class="form-control" name="expert_id">
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label"> Start Date & Time:</label>
                                <input type="datetime-local" id="start_datetime" name="start_datetime" class="form-control" placeholder="YYYY/dd/MM">
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label"> End Date & Time:</label>
                                <input type="datetime-local" id="end_datetime" name="end_datetime" class="form-control" placeholder="YYYY/dd/MM">
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label">Days</label>
                                <input type="number" name="days" id="days" class="form-control" placeholder="days" readonly>
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Leave Types</label>
                                <select class="form-control" name="leave_type">
                                    @foreach ($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Paid</option>
                                    <option value="2">Unpaid</option>
                                </select>
                            </div>

                            <button v-on:click="submitPayment" type="submit" class="btn btn-primary ml-3 mt-3">Save Leave</button>
                        </form>

                    </div>