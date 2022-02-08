<?php

namespace App\Http\Controllers\Admin\Order\Task;

use App\Models\Unit;
use App\Models\Order;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\OrderProgress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrderProgressReport;
use App\Services\Log\LogTracker;
use Throwable;

class TaskController extends Controller
{


    public function orderProgressList($order_id){


        $data['tasks'] = OrderProgress::query()->where('order_id',$order_id)
                                        ->with(['reports','department:id,name','unit:id,name','expert:id,name','createdBy:id,name'])
                                        ->get();
        return view('admin.order.task.tasks')->with($data);

    }



    public function orderTask($order_id){

        $data['departments'] = Department::with('departments')->whereNull('parent_department_id')->orderBy('name')->get();
        $data['units'] = Unit::query()->orderBy('name')->pluck('name','id');
        $data['order'] = Order::query()->with(['product:id,code,name,image','unit','prototype:id,code,title,ref_attachment','variants'])->findOrFail($order_id);
        return view('admin.order.task.task-assign')->with($data);

    }

    public function changeDepartment(Request $request){

        $department= Department::query()->with('departments')->findOrFail($request->department_id);

        $depts = [];
        $options = '<div class="form-group">';
        foreach ($department->departments as $key=>$info){
            array_push($depts,$info->id);
            $options.='<label for="">'.$info->name.'</label><input type="number" class="form-control" name="department_qty[]" placeholder="Ex. 10" value="0">';
        }
        $options.=" <input type='hidden' name='sub_departments' value='".json_encode($depts)."'>
                </div>";
        return response()->json(['experts'=>$department->experts,'sub_departments'=>$options]);
    }

    public function store(Request $request,$order_id){

        $data=$request->validate([
             'department_id' => 'required',
             'expert_id' => 'required',
             'handover_date' => 'nullable',
             'progress_note' => 'nullable',
             'unit_id' => 'nullable',
             'unit_qty' => 'nullable',
        ]);
        DB::beginTransaction();
        try{
            $order = Order::query()->findOrFail($order_id);
            $data["order_id"] = $order->id;
            $data['created_by'] = auth()->id();
            $order_progress = OrderProgress::query()->create($data);
            //save order report
            $variant_data =json_decode($request->order_variant_and_qty, true);
            for($v=0; $v < count((array)$variant_data) ; $v++) {
                $order_variant = new OrderProgressReport() ;
                $order_variant->order_id =  $order->id ;
                $order_variant->order_progress_id =  $order_progress->id ;
                $order_variant->department_id =  $order_progress->department_id ;
                $order_variant->expert_id =  $order_progress->expert_id ;
                $order_variant->variant_id =  $variant_data[$v]['variant_id'] ;
                $order_variant->task_qty =  $variant_data[$v]['task_qty'] ;
                $order_variant->save();
            }
            DB::commit();
            session()->flash('success','Order  Task Assigned Complete.');
            return redirect()->route('order.list');

        }catch(Throwable $e){
          DB::rollBack();
          LogTracker::failLog($e,auth()->id()) ;
          session()->flash('error','Order  Task assigned failed.');
          return redirect()->back();

        }


    }










}
