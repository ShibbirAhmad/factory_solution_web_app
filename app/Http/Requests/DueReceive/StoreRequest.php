<?php

namespace App\Http\Requests\DueReceive;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'invoice_no'=>'required',
            'paid_date'=>'required',
            'payment_method'=>'required',
            'due_type'=>'required',
            'is_discount_payment'=>'required',
            'note'=>'nullable',
            'transaction_id'=>'nullable',
            'amount'=>'required',
        ];
    }
}
