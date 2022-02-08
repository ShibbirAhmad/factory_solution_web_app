<div class="form-group mb-4">
    <label class="control-label">Admin:</label>
    {{ Form::text('name', null,['class'=>'form-control']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Email:</label>
    {{ Form::email('email', null,['class'=>'form-control']) }}
    @error('email')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Password:</label>
    {{ Form::text('password', null,['class'=>'form-control']) }}
    @error('password')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Image</label>
    {{ Form::file('image', null,['class'=>'form-control','accept'=>'images/*']) }}
    @error('image')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">phone:</label>
    {{ Form::number('phone', null,['class'=>'form-control']) }}
    @error('phone')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
