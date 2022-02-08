<div class="form-group mb-4">
    <label class="control-label">Expert/Employee:</label>
    {{ Form::select('isOut',['1'=>'Office In Date & Time','Office Out Date & Time'],false,['class'=>'form-control','required']) }}
</div>

<div class="form-group mb-4">
    <label class="control-label">Expert/Employee:</label>
    <select name="user_expert_id" class="form-control" required>
        <option disabled selected>Please Select a Employee</option>
        @forelse($employees as $key=>$employee)
            <option value="{{ $employee->id }}" {{ isset($attendance) && $attendance->user_expert_id == $employee->id ? 'selected' : false }} > {{ $employee->name }} | {{ $employee->phone }}</option>
        @empty
        @endforelse
    </select>
    @error('user_expert_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Pick a Date & Time:</label>
    <input type="datetime-local" name="in_datetime" class="form-control" placeholder="YYYY/dd/MM">
    @error('in_datetime')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
