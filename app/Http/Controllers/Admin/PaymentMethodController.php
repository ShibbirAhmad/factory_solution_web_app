<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentStoreRequest;
use App\Http\Requests\Department\DepartmentUpdateRequest;
use App\Http\Requests\PaymentMethod\PaymentMethodStoreRequest;
use App\Http\Requests\PaymentMethod\UpdateRequest;
use App\Models\Department;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index(){
        $data['payment_methods'] = PaymentMethod::query()->orderBy('name')->get();
        return view('admin.payment-method.index')->with($data);
    }

    public function store(PaymentMethodStoreRequest $request){
        PaymentMethod::query()->create($request->validated());
        session()->flash('success','Successfully Department Created');
        return redirect()->back();
    }

    public function edit($id){
        $data['payment_method'] = PaymentMethod::query()->findOrFail($id);
        $data['payment_methods'] = PaymentMethod::query()->orderBy('name')->get();
        return view('admin.payment-method.edit-payment-method')->with($data);
    }

    public function update(UpdateRequest $request,$id){
        $payment_method = PaymentMethod::query()->findOrFail($id);
        $payment_method->update($request->validated());
        session()->flash('success','Successfully Department Updated.');
        return redirect()->route('paymentMethod.add');
    }

    public function destroy(Request $request){
        $payment_method = PaymentMethod::query()->findOrFail($request->id);
        if($payment_method->transactions->count()<=0) {
            $payment_method->delete();
            return response()->json(['success' => 'Data Deleted', 'code' => 200]);
        }
    }
}
