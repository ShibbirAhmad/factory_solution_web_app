<?php

namespace App\Http\Controllers\Admin\Order\Task;

use Illuminate\Http\Request;
use App\Models\OrderProgress;
use Illuminate\Support\Facades\DB;
use App\Models\OrderProgressReport;
use App\Http\Controllers\Controller;
use App\Services\Log\LogTracker;
use Throwable;

class TaskReportController extends Controller
{
    public function index(){
        return view('admin.order.task-receive.index');
    }

    public function receive($progress_id){

        $data['tasks'] = OrderProgressReport::query()->where('order_progress_id',$progress_id)->with('variant')->get();
        $data['total_task_qty'] = $data['tasks']->sum('task_qty');
        return view('admin.order.task-receive.index')->with($data);

    }

    public function taskReceive(Request $request,$progress_id){

        DB::beginTransaction();
        try{
            $progress = OrderProgress::query()->findOrFail($progress_id);
            //save order report
            $variant_data =json_decode($request->order_variant_and_qty, true);
            for($v=0; $v < count((array)$variant_data) ; $v++) {
                $order_variant = OrderProgressReport::where('order_progress_id',$progress->id)->where('variant_id', $variant_data[$v]['variant_id'])->first() ;
                $order_variant->verified_by = auth()->id();
                $order_variant->handover_qty =  $variant_data[$v]['handover_qty'] ;
                $order_variant->note =  $request->note ?? null ;
                $order_variant->save();
            }

            DB::commit();
            session()->flash('success','Task Received successfully.');
            return redirect()->route('task.progress',$progress->order_id);

        }catch(Throwable $e){

            DB::rollBack();
            LogTracker::failLog($e,auth()->id()) ;
            return redirect()->back();
            session()->flash('error','Task Receiving failed .');

        }
    }

}
