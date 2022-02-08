<?php

namespace App\Http\Requests\Warehouse;

use App\Services\ProductionSoftwareService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WarehouseStoreRequest extends FormRequest
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
            'name' => ['required',Rule::unique('warehouses')->where('user_id',ProductionSoftwareService::merchantUserId())],
            'phone' => 'nullable|digits:11',
            'address' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please, Give a name for warehouse save',
            'name.unique' => 'Warehouse Name already exists. Please, Type a New Name',
        ];
    }
}
