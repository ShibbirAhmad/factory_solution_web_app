<?php

namespace App\Http\Requests\SubDepartment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubDepartmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_department_id'=>'required',
            'name'=>['required',Rule::unique('departments')->where('parent_department_id',$this->parent_department_id)]

        ];
    }
}
