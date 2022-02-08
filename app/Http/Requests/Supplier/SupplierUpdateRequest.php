<?php

namespace App\Http\Requests\supplier;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends FormRequest
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
            'phone' => 'required|digits:11',Rule::unique('suppliers')->ignore($this->id),
            'email' => 'nullable|email',Rule::unique('suppliers')->ignore($this->id),
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'nid' => 'nullable',Rule::unique('suppliers')->ignore($this->id),
            'address' => 'nullable',
        ];
    }
}
