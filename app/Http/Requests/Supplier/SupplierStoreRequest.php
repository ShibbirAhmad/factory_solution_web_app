<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'phone' => 'required|digits:11|unique:suppliers',
            'email' => 'nullable|email|unique:suppliers',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'nid' => 'nullable|unique:suppliers',
            'address' => 'nullable',
        ];
    }
}
