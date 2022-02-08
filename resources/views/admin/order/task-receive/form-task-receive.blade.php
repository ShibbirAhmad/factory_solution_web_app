<div class="col-lg-7">
    <div class="form-group variant_container mb-4">
        <label class="control-label">Task Receive  </label>
        <input type="hidden" id="order_task_receive_variant_and_qty" value="" name="order_variant_and_qty">
        <ul>
            @forelse ($tasks as $item)
                <li>

                    <div style="width: 100%" class="n-chk">

                        <div class="row">
                            <div class="col-lg-1">
                                <label style="margin-right:10px;" class="new-control new-checkbox checkbox-primary">
                                    <input name="order_variants[]" disabled value="{{ $item->variant->id }}" checked
                                        type="checkbox" class="order_create_variants new-control-input">
                                    <span class="new-control-indicator"></span>{{ $item->variant->name }}
                                </label>
                            </div>
                            <div class="col-lg-4">
                                <p
                                  style="color:blue;margin-left:50px;margin-top:5px;"> assigned qty = {{ $item->task_qty }}  </p>
                            </div>
                            <div class="col-lg-4">
                                <div class="variant_value_container">
                                    <input placeholder="0" min="1" type="number" value=""
                                        variant_task_receive_of_id="{{ $item->variant->id }}"
                                        id="order_task_receive_variant_input_{{ $item->variant->id }}"
                                        name="order_task_receive_variant"
                                        class="order_task_receive_variant_values form-control">
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

<div class="col-lg-5 ">
    <h4 style="margin-top:80px;"> Total Assigned Quantity
        <strong > {{ $total_task_qty }}   </strong>
    </h4>
     <h4> Total Receiving Quantity
        <strong id="total_task_receive_qty"> 0   </strong>
    </h4>
</div>

<div class="col-lg-6">
    <div class="form-group mb-4">
        <label class="control-label">Receive Note</label>
        {{ Form::textarea('note', null, ['class' => 'form-control','placeholder' => 'Ex.Task Reporting Note...','rows' => 3]) }}
        @error('note')
            <strong class="bg-danger text-white error">{{ $message }}</strong>
        @enderror
    </div>
</div>
<div class="col-lg-2"> </div>
<div class="col-lg-3">
    <br>
    <br>
    {{ Form::submit($button, ['class' => 'btn btn-info btn-block p-2']) }}
</div>
