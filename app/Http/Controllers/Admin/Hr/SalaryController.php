<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Expert;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{



    public function index()
    {
        $experts = Expert::where('user_id',auth()->id())->where('status',1)->get();
        return view('admin.hr.salary.index', compact('experts'));
    }




    public function add()
    {
        $experts = Expert::where('user_id',auth()->id())->where('status',1)->get();
        $payment_methods = PaymentMethod::all();
        return view('admin.hr.salary.add', compact('experts', 'payment_methods'));
    }




    public function paymentSalary(Request $request)
    {
        $employee = Expert::where('id', $request->employee_id)->first();
        // $employee->bonus = $request->bonus;
        $employee->total_fine = $request->fine_salary;
        $employee->total_salary = $request->total_salary;
        $employee->save();
    }




    public function expertSalaryReportPreview($id)
    {
        $employee = Expert::where('id', $id)->first();
        
        return response()->json([
            'status' => 1, //purchase status
            'employee' => $employee,
        ]);
    }





}
