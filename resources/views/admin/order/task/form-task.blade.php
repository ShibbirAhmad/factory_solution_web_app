<div class="col-lg-4">
    <div class="form-group mb-4">
        <h4 style="font-size: 14px;">Production ID : <strong>{{ $order->invoice_no }}</strong> </h4>
    </div>

    <div class="form-group mb-1">
        <label class="control-label">Select Department</label>
        <select name="department_id"  class="form-control department">
            <option value disabled selected> Select Department</option>
            @forelse($departments as $key=>$department)
                <option value="{{ $department->id }}" data-departments="{{ $department->departments }}">{{ $department->name }}</option>
            @empty
            @endforelse
        </select>
        @error('department_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
        @enderror
        <br>
        <div class="subDepartments">

        </div>
    </div>

     <div class="form-group mb-4">
        <label class="control-label">Select Expert</label>
        <select name="expert_id"  class="form-control experts select2">
            <option value disabled selected> Select Expert</option>
        </select>
        @error('expert_id')
             <strong class="bg-danger text-white error">{{ $message }}</strong>
        @enderror
    </div>

</div>


<div class="col-lg-3">
    <div class="form-group mb-4">
        <div class="orderInfo">
            <h4>Production Product Code: #{{ $order->product->code }}</h4>
            <div class="orderImage">
                <img src="{{ \App\Helper\dynamicFileLink('product').$order->product->image }}" alt="">
            </div>
        </div>

    </div>
</div>


<div class="col-lg-3">
    <div class="form-group mb-4">
        <div class="orderInfo">
            <h4>Design Code: #{{ $order->prototype->code }}</h4>
            <div class="orderImage">
                <img src="{{ !empty($order->prototype->ref_attachment) ? \App\Helper\dynamicFileLink('prototype').$order->prototype->ref_attachment : \App\Helper\noImage() }}" alt="">
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="form-group mt-2 mb-4">
        <label class="control-label">Select Unit</label>
        {{ Form::select('unit_id',$units,false,['class'=>'form-control  select2','placeholder'=>'select unit']) }}
        @error('unit_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
        @enderror
    </div>
</div>

<div class="col-lg-4">
    <div class="form-group mt-2 mb-4">
        <div class="form-group mb-4">
            <label class="control-label">Unit Quantity QTY</label>
            {{ Form::number('unit_qty',0,[ 'class'=>'form-control product_qty_filed','placeholder'=>'Ex. Product Qty']) }}
        </div>
    </div>
</div>


<div class="col-lg-4">
        <div class="form-group mb-2">
                <label class="control-label">Handover Date</label>
                {{ Form::date('handover_date',null,['class'=>'form-control','required']) }}
                @error('handover_date')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
</div>

      <div class="col-lg-6">
            <div class="form-group variant_container mb-4">
                <label class="control-label">Task Target </label>
                 <input type="hidden" id="order_task_assign_variant_and_qty" value="" name="order_variant_and_qty">
                  <ul>
                      @forelse ($order->variants as $item)
                        <li>

                            <div style="width: 100%" class="n-chk">

                            <div class="row">
                                <div class="col-lg-3">
                                <label  style="margin-right: 100px;" class="new-control new-checkbox checkbox-primary">
                                <input name="order_variants[]" disabled value="{{ $item->variant->id }}"  checked type="checkbox" class="order_create_variants new-control-input" >
                                <span class="new-control-indicator"></span>{{ $item->variant->name }} <sup style="color:blue">target({{ $item->except_qty }})</sup>
                                </label>
                            </div>
                             <div class="col-lg-6">
                                 <div class="variant_value_container">
                                  <input  placeholder="0" min="1" type="number" value="" variant_task_assign_of_id="{{ $item->variant->id }}" id="order_task_assign_variant_input_{{ $item->variant->id }}"  name="order_task_assign_variant"  class="order_task_assign_variant_values form-control">
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

        <div class="col-lg-6 ">
            <h4 style="margin-top:80px;"> Total Expected Quantity
                <strong id="total_task_assign_qty"> {{ $order->expected_qty }}  </strong> </h4>
        </div>


<div class="col-lg-4">
    {{ Form::submit($button,['class'=>'btn btn-info']) }}
</div>

