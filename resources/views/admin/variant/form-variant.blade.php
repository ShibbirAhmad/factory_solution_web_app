{{-- <div class="form-group mb-4">
    <label class="control-label">Select Attribute</label>
    {{ Form::select('attribute_id',['3'=>'Color','2'=>'Size','1'=>'Weight'], null,['class'=>'form-control']) }}
    @error('attribute_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
    @foreach ($attributes as $attribute)
        <p>{{$attribute->name}}</p>
    @endforeach
</div> --}}

<div class="form-group">
    <label for="exampleSelect">Select Attribute</label>
    <select class="form-control" name="attribute_id" id="exampleSelect">
        <option selected disabled>Select Attribute</option>
        @foreach ($attributes as $attribute)
           <option value="{{$attribute->id}}">{{$attribute->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-4">
    <label class="control-label">Attribute Name:</label>
    {{ Form::text('name', null,['class'=>'form-control']) }}
    @error('name')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
