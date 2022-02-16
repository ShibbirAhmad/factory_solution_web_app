<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Expert;
use App\Models\ExpertLeave;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{



    public function index()
    {
       return $experts = Expert::where('user_id',auth()->id())->where('status',1)->select('id','job_type','name','phone','avatar','current_salary','per_hour_salary')->get()->each(function($value){
                                $attendances= Attendance::where('user_expert_id',$value->id)->whereMonth('created_at', Carbon::now()->month)->get();
                                $value->{'total_present'} = $attendances->count();
                                $value->{'total_paid_leave'} = ExpertLeave::where('expert_id',$value->id)->whereMonth('created_at', Carbon::now()->month)->where('status',1)->sum('days');
                                $value->{'total_absent'} = ExpertLeave::where('expert_id',$value->id)->whereMonth('created_at', Carbon::now()->month)->where('status',2)->sum('days');
                                $value->{'total_hour'} = self::hourCalculator($attendances);
                        });
        return view('admin.hr.salary.index', compact('experts'));
    }




    public static  function  hourCalculator($attendances){
            $hours= 0 ;
            $minutes= 0 ;
            foreach ($attendances as  $value) {
                $start = !empty($value->in_datetime) ? Carbon::parse($value->in_datetime) : 0 ;
                $end = !empty($value->out_datetime) ? Carbon::parse($value->out_datetime) : 0 ;
                $difference_hour = $start->diff($end)->format('%H');
                $difference_minute = $start->diff($end)->format('%I');
                $hours += $difference_hour ;
                $minutes += $difference_minute ;
            }
            $total_hour = intval($hours) + intval($minutes/60) ;
            return $total_hour ;
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
