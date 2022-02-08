<div class="form-group mb-4">
    <label class="control-label">Select Department :</label>
    {{ Form::select('department_id',$departments,isset($employee) ? $employee->parent_department_id :false,['class'=>'form-control','placeholder'=>'Please Select Department','required']) }}
    @error('department_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Select Designation :</label>
    {{ Form::select('designation_id',$designations,isset($employee) ? $employee->designation_id :false,['class'=>'form-control','placeholder'=>'Please Select Designation','required']) }}
    @error('designation_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Name:</label>
    {{ Form::text('name', null,['class'=>'form-control']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Phone:</label>
    {{ Form::text('phone', null,['class'=>'form-control','required','placeholder'=>'+8801***-** ** **','minlength'=>11]) }}
    @error('phone')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">NID:</label>
    {{ Form::number('nid', null,['class'=>'form-control','required','placeholder'=>'Ex. 123456789']) }}
    @error('nid')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Image:</label>
    {{ Form::file('avatar', ['class'=>'form-control',isset($employee) && !empty($employee->avatar)  ? '' : '' ,'accept'=>'images/*']) }}
    @error('avatar')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Salary</label>
    {{ Form::number('current_salary', null,['class'=>'form-control','required','placeholder'=>'Ex. 10000']) }}
    @error('current_salary')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Joining Date</label>
    {{ Form::date('join_date', null,['class'=>'form-control','required']) }}
    @error('join_date')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Address</label>
    {{ Form::textarea('address', null,['class'=>'form-control','required','rows'=>3,'placeholder'=>'Ex. Employee Address']) }}
    @error('address')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>



{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}

<a href="{{ route('employee.add') }}" class="btn btn-danger  ml-3 mt-3"> <i class="fa fa-times-circle"></i> Cancel </a>
