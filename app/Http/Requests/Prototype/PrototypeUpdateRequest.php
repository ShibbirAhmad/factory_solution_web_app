<?php

namespace App\Http\Requests\Prototype;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrototypeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'code'=> ['required',Rule::unique('prototypes')->ignore($this->id)],
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
