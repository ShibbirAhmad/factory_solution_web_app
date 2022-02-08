<?php

namespace App\Http\Requests\Prototype;

use Illuminate\Foundation\Http\FormRequest;

class PrototypeStoreRequest extends FormRequest
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
            'code'=>'required|unique:prototypes',
            'title'=>'required',
            'type'=>'required',
            'user_id'=>'required',
            'ref_attachment'=>'nullable',
            'ref_attachment.*'=>'image|mimes:jpeg,png,svg',
            'ref_link'=>'nullable',
            'note'=>'nullable',
            'category_id'=>'required',
        ];
    }
}
