<div class="form-group mb-4">
    <label class="control-label">Designation:</label>
    {{ Form::text('name', null,['class'=>'form-control']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
