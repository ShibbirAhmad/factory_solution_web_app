<div class="col-lg-8">
    <div class="row">

        <div class="col-lg-12">
            <div class="form-group mb-4">
                <label class="control-label">Production Title</label>
                {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'Production Order Title...','required']) }}
                @error('title')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="control-label">Select Product</label>
                <select name="product_id"  class="form-control select2" required>
                    @forelse($products as $key=>$product)
                        <option value="{{ $product->id }}">{{ $product->name }} | {{ $product->code }}</option>
                    @empty
                    @endforelse
                </select>
                @error('product_id')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="control-label">Select Unit</label>
                {{ Form::select('unit_id', $units, false,['class'=>'form-control select2','placeholder'=>'Please Select Category','required']) }}
                @error('unit_id')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>


        {{-- <div class="col-lg-4">
            <div class="form-group mb-4">
                <label class="control-label">Qty (Product Cost.)</label>
                {{ Form::number('qty',1,['class'=>'form-control','min'=>1,'required']) }}
                @error('qty')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div> --}}


        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="control-label">Production Start Date</label>
                {{ Form::date('start_datetime',null,['class'=>'form-control','required']) }}
                @error('start_datetime')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="control-label">Production End Date</label>
                {{ Form::date('end_datetime',null,['class'=>'form-control','required']) }}
                {{--        <input type="datetime-local" class="form-control" name="start_datetime" />--}}
                @error('end_datetime')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="control-label">Production Attribute(Size | Color)</label>
                <select required name="attribute_id" class="form-control" >
                    {{-- @forelse ($attributes as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @empty
                          <option disabled >record is empty </option>
                    @endforelse --}}
                    <option selected value="1">Size</option>
                </select>
                @error('arrtibute_id')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <label class="control-label">Produce Expected Qty</label>
                {{ Form::number('expected_qty',1,['class'=>'form-control','id'=>'order_expected_qty','min'=>1,'required','readonly']) }}
                @error('expected_qty')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>



        <div class="col-lg-8">
            <div class="form-group variant_container mb-4">
                <label class="control-label">Order Variants </label>
                 <input type="hidden" id="order_variant_and_qty" value="" name="order_variant_and_qty">
                  <ul>
                      @forelse ($variants as $variant)
                        <li>

                            <div style="width: 100%" class="n-chk">

                            <div class="row">
                                <div class="col-lg-1">
                                <label  class="new-control new-checkbox checkbox-primary">
                                <input name="order_variants[]" value="{{ $variant->id }}" id="order_variant_{{ $variant->id  }}" type="checkbox" class="order_create_variants new-control-input" >
                                <span class="new-control-indicator"></span>{{ $variant->name }}
                                </label>
                            </div>
                             <div class="col-lg-10">
                                 <div class="variant_value_container">
                                  <input  placeholder="0" min="1" type="number" variant_of_id={{ $variant->id }} id="order_variant_input_{{ $variant->id }}"  name="order_variant"  class="order_variant_values form-control">
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
            <h5 style="margin-top:20px;"> Total Expected Quantity <strong id="total_expected_qty">  </strong> </h5>
        </div>

        <div class="col-lg-12">
            <div class="form-group mb-4">
                <label class="control-label">Production Details/Agreement</label>
                {{ Form::textarea('order_agreements',null,['class'=>'form-control','placeholder'=>'Ex. Production Details/Agreement','rows'=>3]) }}
                @error('order_agreements')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
                @enderror
            </div>
        </div>

    </div>
</div>

<div class="col-lg-4">
    <div class="form-group mb-4 text-center m-auto">
        <div class="designedImage">
            <img src="{{ \App\Helper\noImage() }}" alt="" class="designImg">
        </div>
        <label class="control-label designCode">#0000</label>
    </div>

    <div class="col-lg-12" style="overflow: hidden">
        <div class="form-group mb-4">
            <label class="control-label">Select Design/Prototype</label>
            <select name="prototype_id"  class="form-control prototype select2" required>
                <option value disabled selected>Select Design/Prototype</option>
                @forelse($prototypes as $key=>$prototype)
                    <option data-code="{{ $prototype->code }}" data-file="{{ $prototype->ref_attachment }}" value="{{ $prototype->id }}">{{ $prototype->title }} | {{ $prototype->code }}</option>
                @empty
                @endforelse
            </select>
            @error('prototype_id')
                <strong class="bg-danger text-white error">{{ $message }}</strong>
            @enderror
        </div>
    </div>
</div>

<div class="col-lg-4">
    {{ Form::submit($button,['class'=>'btn btn-info']) }}
</div>
