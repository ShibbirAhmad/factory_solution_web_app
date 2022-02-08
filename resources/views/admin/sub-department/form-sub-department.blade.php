<div class="form-group mb-4">
    <label class="control-label">Select Department :</label>
    {{ Form::select('parent_department_id',$departments,isset($sub_department) ? $sub_department->parent_department_id :false,['class'=>'form-control','placeholder'=>'Please Select Department','required']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Sub Department *</label>
    {{ Form::text('name', null,['class'=>'form-control','required']) }}
    @error('name')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
