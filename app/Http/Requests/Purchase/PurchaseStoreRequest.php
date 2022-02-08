<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseStoreRequest extends FormRequest
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
            'purchase_items'=>'required',
            'supplier_id'=>'required',
            'supplier_invoice_no'=>'required',
            'paid'=>'required',
            'total_amount'=>'required',
            'payment_method'=>'nullable',
            'payable_date'=>'nullable',
            'note'=>'nullable',
            'attachments'=>'nullable',
        ];
    }
}
