<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
            'daily_working_hour'=>'nullable',
            'name'=>'required',
            'phone'=>'required|min:11',
            'nid'=>['nullable',Rule::unique('experts')->ignore($this->id)],
            'avatar' => 'nullable',
            'avatar.*' => 'image|mimes:jpg,png',
            'current_salary'=>'nullable',
            'per_hour_salary'=> 'nullable',
            'join_date'=>'required',
            'address'=>'required',
        ];
    }
}
