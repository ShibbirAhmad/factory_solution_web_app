<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Expert;
use App\Models\ExpertLeave;
use App\Models\ExpertSalary;
use App\Models\PaymentMethod;
use App\Services\Cashbook\CashBookService;
use App\Services\Log\LogTracker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{



    public function index()
    {
        $experts = Expert::where('user_id',auth()->id())->where('status',1)->select('id','job_type','name','phone','avatar','current_salary','daily_working_hour','per_hour_salary')->get()->each(function($value){
                                $attendances= Attendance::where('user_expert_id',$value->id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
                                $value->{'total_present'} = $attendances->count();
                                $value->{'total_paid_leave'} = ExpertLeave::where('expert_id',$value->id)->whereMonth('created_at', Carbon::now()->month)->where('status',1)->sum('days');
                                $value->{'total_absent'} = ExpertLeave::where('expert_id',$value->id)->whereMonth('created_at', Carbon::now()->month)->where('status',2)->sum('days');
                                $value->{'total_hour'} = self::hourCalculator($attendances);
                                $value->{'total_overtime'} = intval($value->{'total_hour'})  - ( (intval( $value->{'total_present'}) - intval($value->{'total_paid_leave'}))  * intval($value->daily_working_hour))  ;
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
        $data=[$request->validate(),
            'amount' => 'required|min:1',
            'payment_method' => 'required',
            'expert_id' => 'required',
        ];
       
        try {

            DB::beginTransaction();
            $invoice_no = '';
            $expert = Expert::findOrFail($request->expert_id);
            $expert->total_bonus = intval($expert->total_bonus) + intval($request->bonus) ;
            $expert->total_fine = intval($expert->total_fine) + intval($request->fine);
            $expert->total_salary = intval($expert->total_salary) + intval($request->amount);
            $expert->save();
            //
            $expert_salary = new ExpertSalary();
            $expert_salary->expert_id = $expert->id;
            $expert_salary->bonus = $request->bonus;
            $expert_salary->fine = $request->fine;
            $expert_salary->amount = $request->amount;
            $expert_salary->payment_method_id = $request->payment_method;
            $expert_salary->save();
            
            //storing in cashbook
            $data['amount'] = $data['amount'] ;
            $data['due_type'] = 'purchase';
            $data['is_discount_payment'] = 0 ;
            CashBookService::paymentStore($data, $invoice_no,3);
            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'salary paid successful'
            ]);
           
        } catch (\Throwable $e) {
            DB::rollBack();
            LogTracker::failLog($e,auth()->id);
            return response()->json([
                'status' => 0,
                'message' => 'salary paid failed'
            ]);
        }
       

        
    }




    public function expertSalaryReportPreview($id)
    {
        $expert = Expert::select('id','job_type','name','phone','avatar','current_salary','daily_working_hour','per_hour_salary')->findOrFail($id);
        $attendances= Attendance::where('user_expert_id',$expert->id)->whereMonth('created_at', Carbon::now()->month)->get();
        $expert->{'total_present'} = $attendances->count();
        $expert->{'total_paid_leave'} = ExpertLeave::where('expert_id',$expert->id)->whereMonth('created_at', Carbon::now()->month)->where('status',1)->sum('days');
        $expert->{'total_absent'} = ExpertLeave::where('expert_id',$expert->id)->whereMonth('created_at', Carbon::now()->month)->where('status',2)->sum('days');
        $expert->{'total_hour'} = self::hourCalculator($attendances);
        $expert->{'total_overtime'} = intval($expert->{'total_hour'})  - ( (intval($expert->{'total_present'}) - intval($expert->{'total_paid_leave'}) ) * intval($expert->daily_working_hour))   ;

        return response()->json([
            'status' => 1,
            'employee' => $expert,
        ]);
    }

    public function viewSalary($id)
    {
        $expert = Expert::findOrFail($id);
        $view_profile = ExpertSalary::where('expert_id', $expert->id)->first();
        $total_amount = ExpertSalary::where('expert_id', $expert->id)->sum('amount');
        $bonus = ExpertSalary::where('expert_id', $expert->id)->sum('bonus');
        $fine = ExpertSalary::where('expert_id', $expert->id)->sum('fine');
        $expert_salary = ExpertSalary::all();
        return view('admin.hr.salary.view-salary', compact('view_profile', 'total_amount', 'bonus', 'fine', 'expert_salary'));
    }





}
