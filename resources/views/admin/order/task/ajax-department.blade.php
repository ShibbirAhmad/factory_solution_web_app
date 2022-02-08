@php
    $sub_department_ids =[];
@endphp

@forelse($department->departments as $info)
    <div class="form-group">

        <input type="hidden" name="sub_department_id[]">
        <input type="number" class="form-control" placeholder="Ex. 10">
    </div>
@empty

@endforelse

