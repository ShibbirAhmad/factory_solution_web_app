<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'title'=>'required',
            'product_id'=>'required',
            'attribute_id'=>'required',
            'unit_id'=>'required',
            'expected_qty'=>'required',
            'start_datetime'=>'required',
            'end_datetime'=>'required',
            'prototype_id'=>'required',
            'order_agreements'=>'nullable',
        ];
    }
}
