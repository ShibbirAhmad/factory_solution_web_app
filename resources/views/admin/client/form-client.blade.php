<div class="form-group mb-4">
    <label class="control-label">Client:</label>
    {{ Form::text('name', null,['class'=>'form-control', 'placeholder'=>'ex. xyz']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Company Name:</label>
    {{ Form::text('company_name', null,['class'=>'form-control', 'placeholder'=>'ex. xyz']) }}
    @error('company_name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Phone:</label>
    {{ Form::number('phone', null,['class'=>'form-control', 'placeholder'=>'ex. 015**_******']) }}
    @error('phone')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Address:</label>
    {{ Form::textarea('address', null,['class'=>'form-control', 'rows'=>'3', 'placeholder'=>'Ex. address details.......']) }}
    @error('address')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
