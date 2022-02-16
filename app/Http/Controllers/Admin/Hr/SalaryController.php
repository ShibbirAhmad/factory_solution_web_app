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
        $present_employees = Attendance::select('*')->whereMonth('created_at', Carbon::now()->month)
                                                ->select('user_expert_id', DB::raw('count(*) as total'))
                                                ->groupBy('user_expert_id')
                                                ->get();
        return view('admin.hr.salary.index', compact('present_employees'));
    }




    public function add()
    {
        $present_employees = Attendance::select('*')->whereMonth('created_at', Carbon::now()->month)
                                                ->select('user_expert_id', DB::raw('count(*) as total'))
                                                ->groupBy('user_expert_id')
                                                ->get();
        $payment_methods = PaymentMethod::all();
        return view('admin.hr.salary.add', compact('present_employees', 'payment_methods'));
    }




    public function paymentSalary(Request $request)
    {
        $employee = Expert::where('id', $request->employee_id)->first();
        // $employee->bonus = $request->bonus;
        $employee->total_fine = $request->fine_salary;
        $employee->total_salary = $request->total_salary;
        $employee->save();
    }




    public function searchEmployee(Request $request)
    {
        $search_employee = Expert::where('id', $request->employee_id)->first();
        return response()->json([
            'status' => 'search', //purchase status
            'search_employee' => $search_employee,
        ]);
    }





}
