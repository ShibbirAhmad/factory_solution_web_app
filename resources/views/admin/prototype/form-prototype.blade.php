<div class="form-group mb-4">
    <label class="control-label">Select Expert/Designer </label>
    <select class="form-control select2" name="user_id">
        <option disabled>Please select a Employee</option>
        @forelse($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }} | {{ $employee->phone }}</option>
        @empty
        @endforelse
    </select>
    @error('category_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Select Category</label>
    {{ Form::select('category_id', $categories, isset($prototype) ? $prototype->category_id:false,['class'=>'form-control','placeholder'=>'Please Select Category']) }}
    @error('category_id')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Select Design Type </label>
    @php
        $types = [1=>"Full Product",2=>"Collar",3=>"Front Part",4=>"Back Part",5=>"Cuff"];
    @endphp
    {{Form::select('type',$types,false,['class'=>'form-control'])}}
    @error('type')
         <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Code</label>
    {{ Form::text('code', null,['class'=>'form-control','placeholder'=>'Ex. DESIGN-001']) }}
    @error('code')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Title</label>
    {{ Form::text('title', null,['class'=>'form-control','placeholder'=>'Ex.  Cuff Design']) }}
    @error('title')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Design Ref. Attachment File</label>
    {{ Form::file('ref_attachment',['class'=>'form-control','accept'=>'images/*']) }}
    @error('ref_attachment')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>


<div class="form-group mb-4">
    <label class="control-label">Design Ref. Link</label>
    {{ Form::text('ref_link',null,['class'=>'form-control','placeholder'=>'https://google.com/refLink']) }}
    @error('ref_link')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Description</label>
    {{ Form::textarea('note', null,['class'=>'form-control','placeholder'=>'Ex. Prototype/Design Details.......','rows'=>3]) }}
    @error('note')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>



{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
