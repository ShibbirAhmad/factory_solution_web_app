<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        Log::debug($this->request->all());
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'phone' => 'nullable|min: 11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please, Give a admin name',
            'email.unique' => 'Opps! The name already taken.',
            'password.unique' => 'Please, Give a strong password! not 12345678.',
        ];
    }
}
