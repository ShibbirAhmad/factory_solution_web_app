<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
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
            'sale_items'=>'required',
            'warehouse_id'=>'required',
            'client_id'=>'required',
            'total'=>'required',
            'paid'=>'required',
            'discount'=>'nullable',
            'payment_method'=>'nullable',
            'transaction_id'=>'nullable',
            'note'=>'nullable',
        ];
    }
}
