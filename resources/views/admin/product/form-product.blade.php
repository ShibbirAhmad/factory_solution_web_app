<div class="form-group mb-4">
    <label class="control-label">Select Category</label>
    {{ Form::select('category_id', $categories, isset($product) ? $product->category_id:false,['class'=>'form-control','placeholder'=>'Please Select Category']) }}
    @error('category_id')
        <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Code</label>
    {{ Form::text('code', null,['class'=>'form-control','placeholder'=>'Ex. FEB001']) }}
    @error('code')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mb-4">
    <label class="control-label">Title</label>
    {{ Form::text('name', null,['class'=>'form-control','placeholder'=>'Ex. Cotton Fabric']) }}
    @error('name')
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
    <label class="control-label">Description</label>
    {{ Form::textarea('details', null,['class'=>'form-control','placeholder'=>'Ex. Product Details.......']) }}
    @error('name')
    <strong class="bg-danger text-white error">{{ $message }}</strong>
    @enderror
</div>



{{ Form::button($button,['type'=>'submit','class'=>'btn btn-primary ml-3 mt-3']) }}
