<div class="form-group mb-4">
    <label class="control-label">Warehouse:</label>
    {{ Form::text('name', null,['class'=>'form-control', 'placeholder'=>'ex. mirpur']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Phone:</label>
    {{ Form::number('phone', null,['class'=>'form-control', 'placeholder'=>'ex. +88015**_******']) }}
    @error('phone')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Address:</label>
    {{ Form::textarea('address', null,['class'=>'form-control', 'rows'=>'3', 'placeholder'=>'ex.address']) }}
    @error('address')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>



{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
