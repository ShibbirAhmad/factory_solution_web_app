<?php

namespace App\Http\Requests\Variant;

use Illuminate\Foundation\Http\FormRequest;

class VariantStoreRequest extends FormRequest
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
            'attribute_id' => 'required',
            'name' => 'required',
        ];
    }
}
