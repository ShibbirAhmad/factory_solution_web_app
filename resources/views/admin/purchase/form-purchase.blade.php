<div class="form-group mb-2">
    {{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary btn-block']) }}
</div>


<div class="form-group mb-2">
    <label class="control-label">Total</label>
    {{ Form::text('code', null,['class'=>'form-control','placeholder'=>'00']) }}
    @error('code')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-2">
    <label class="control-label">Discount</label>
    {{ Form::text('discount', null,['class'=>'form-control','placeholder'=>'00']) }}
    @error('discount')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-2">
    <label class="control-label">Paid</label>
    {{ Form::text('paid', null,['class'=>'form-control','placeholder'=>'00']) }}
    @error('paid')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-2">
    <label class="control-label">Amount Due</label>
    {{ Form::text('due', null,['class'=>'form-control','placeholder'=>'00']) }}
    @error('due')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-2">
    <label class="control-label">Date</label>
    {{ Form::date('date', null,['class'=>'form-control','placeholder'=>'0000']) }}
    @error('date')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-2">
    <label class="control-label">Note</label>
    {{ Form::textarea('details', null,['class'=>'form-control', 'placeholder'=>'Ex. Product Details.......']) }}
    @error('details')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>
<div class="form-group mb-2">
    {{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary btn-block']) }}
</div>


