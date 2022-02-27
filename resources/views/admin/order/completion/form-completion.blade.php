                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group mb-4">
                                            <label for="warehouse">Selcet Stock In Warehouse </label>
                                            <select class="form-control" name="warehouse_id">
                                                @forelse ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}
                                                    </option>
                                                @empty
                                                    <option disabled> No data found</option>
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group variant_container mb-4">
                                            <input type="hidden" id="order_completion_variant_and_qty" value=""
                                                name="order_variant_and_qty">
                                            <ul>
                                                @forelse ($order_variants as $item)
                                                    <li>

                                                        <div style="width: 100%" class="n-chk">

                                                            <div class="row">
                                                                <div class="col-lg-1">
                                                                    <label style="margin-right:10px;"
                                                                        class="new-control new-checkbox checkbox-primary">
                                                                        <input name="order_variants[]" disabled
                                                                            value="{{ $item->variant->id }}" checked
                                                                            type="checkbox"
                                                                            class="order_create_variants new-control-input">
                                                                        <span
                                                                            class="new-control-indicator"></span>{{ $item->variant->name }}
                                                                    </label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <p
                                                                        style="color:blue;margin-left:50px;margin-top:5px;">
                                                                        assigned qty
                                                                        =
                                                                        {{ $item->except_qty }} </p>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="variant_value_container">
                                                                        <input placeholder="0" min="1" type="number"
                                                                            required
                                                                            completion_of_id="{{ $item->variant->id }}"
                                                                            id="order_completion_variant_input_{{ $item->variant->id }}"
                                                                            name="order_completion_variant"
                                                                            class="order_completion_variant_values form-control">
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
                                    <div class="col-lg-4 ">
                                        <h4 style="margin-top:40px;"> Total Assigned Quantity
                                            <strong> {{ $total_task_assigned_qty }} </strong>
                                        </h4>
                                        <h4> Final Stock Quantity
                                            <strong id="total_order_completion_qty"> {{ $total_handover_qty }} </strong>
                                        </h4>
                                    </div>


                                    <div class="col-lg-7">
                                        <div class="form-group mb-4">
                                            <label class="control-label"> Note</label>
                                            {{ Form::textarea('note', null, ['class' => 'form-control','placeholder' => 'Ex.Task Reporting Note...','rows' => 3]) }}
                                            @error('note')
                                                <strong class="bg-danger text-white error">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($order->is_closed != 1)
                                        <div class="col-lg-3">
                                            <br>
                                            <br>
                                            <br>
                                            {{ Form::submit('submit completion', ['class' => 'btn btn-block p-2 btn-success']) }}

                                        </div>
                                    @endif
                                </div>
