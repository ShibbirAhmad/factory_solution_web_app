<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
      //  Log::debug($this->request->all());
        return [
            'category_id'=>'required',
            'code'=>'required|unique:products',
            'name'=>'required',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,gif',
            'details'=>'nullable',
        ];
    }
}
