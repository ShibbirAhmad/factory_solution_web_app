<div class="form-group mb-4">
    <label class="control-label">Color:</label>
    {{ Form::text('name', null,['class'=>'form-control', 'placeholder'=>'ex. red']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
