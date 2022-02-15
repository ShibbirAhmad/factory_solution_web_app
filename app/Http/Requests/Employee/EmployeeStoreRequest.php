<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'department_id'=>'required',
            'designation_id'=>'required',
            'job_type'=>'required',
            'name'=>'required',
            'phone'=>'required|min:11',
            'nid'=>'nullable|unique:experts',
            'avatar'=>'nullable|image|mimes:jpg,jpeg,png,gif',
            'current_salary'=>'required',
            'join_date'=>'required',
            'address'=>'required',
        ];
    }
}
