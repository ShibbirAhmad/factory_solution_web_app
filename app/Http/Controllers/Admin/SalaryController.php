<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index()
    {
        $total_employees = Attendance::select('*')->whereMonth('created_at', Carbon::now()->month)
                                                ->select('user_expert_id', DB::raw('count(*) as total'))
                                                ->groupBy('user_expert_id')
                                                ->get();
        return view('admin.hr.salary.index', compact('total_employees'));
    }

    public function add()
    {
        $employees = Attendance::select('*')->whereMonth('created_at', Carbon::now()->month)
                                                ->select('user_expert_id', DB::raw('count(*) as total'))
                                                ->groupBy('user_expert_id')
                                                ->get();
        return view('admin.hr.salary.add', compact('employees'));
    }
}
