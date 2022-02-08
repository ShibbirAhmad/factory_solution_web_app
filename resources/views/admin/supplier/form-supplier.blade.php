


<div class="form-group mb-2">
    <label class="control-label">Name <b class="text-danger">*</b> </label>
    {{ Form::text('name', null,['class'=>'form-control','placeholder'=>'Ex. Mohammad']) }}
    @error('name')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-2">
    <label class="control-label">Phone <b class="text-danger">*</b> </label>
    {{ Form::text('phone', null,['class'=>'form-control','placeholder'=>'01xxxxxxxxx']) }}
    @error('phone')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-2">
    <label class="control-label">Email</label>
    {{ Form::text('email', null,['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
    @error('email')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">NID</label>
    {{ Form::text('nid', null,['class'=>'form-control','placeholder'=>'National ID NO']) }}
    @error('nid')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-2">
    <label class="control-label">Image</label>
    {{ Form::file('avatar', null,['class'=>'form-control','accept'=>'images/*']) }}
    @error('avatar')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-2">
    <label class="control-label">Address</label>
    {{ Form::textarea('address', null,['class'=>'form-control','placeholder'=>'Ex. address details.......']) }}
    @error('name')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group text-center">
   {{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary  mt-3']) }}
</div>
