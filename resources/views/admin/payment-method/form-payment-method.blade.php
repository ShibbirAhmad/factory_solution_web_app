<div class="form-group mb-4">
    <label class="control-label">Select Banking Types</label>
    {{ Form::select('isBank',['3'=>'Cash','2'=>'Mobile Banking','1'=>'Banking'], null,['class'=>'form-control']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Name:</label>
    {{ Form::text('name', null,['class'=>'form-control','placeholder'=>'Ex. bKash/ AB Bank etc.']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Account No:</label>
    {{ Form::text('account_no', null,['class'=>'form-control','placeholder'=>'Ex. bKash No/ Bank Account Number']) }}
    @error('account_no')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
