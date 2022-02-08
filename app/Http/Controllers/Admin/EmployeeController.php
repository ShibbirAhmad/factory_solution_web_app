<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Expert;
use App\Services\ProductionSoftwareService;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
class EmployeeController extends Controller
{
    use StoreImageTrait;
    public $uploadFolder = "employee";

    public function index(){
        $data['departments'] = Department::query()->whereNull('parent_department_id')->orderBy('name')->pluck('name','id');
        $data['designations'] = Designation::query()->orderBy('name')->pluck('name','id');
        $data['employees'] = Expert::query()
                                ->with(['user','position','department'])
                                ->orderBy('name')
                                ->get();
        return view('admin.hr.employee.index')->with($data);
    }

    public function store(EmployeeStoreRequest $request){
        $data= $request->validated();
        $data['user_id'] = auth()->id();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        $data['avatar'] = $this->imageProcess($request->file('avatar'));
        Expert::query()->create($data);
        session()->flash('success','Successfully Employee Created');
        return redirect()->back();
    }

    public function imageProcess($file){
        return ($file ? $this->ImageStore($file,$this->uploadFolder,600,600) : null);
    }

    public function edit($id){
        $data['employee'] = Expert::query()->findOrFail($id);
        $data['departments'] = Department::query()->whereNull('parent_department_id')->orderBy('name')->pluck('name','id');
        $data['designations'] = Designation::query()->orderBy('name')->pluck('name','id');
        $data['employees'] = Expert::query()->with(['user','position','department'])->orderBy('name')->get();
        return view('admin.hr.employee.edit-employee')->with($data);
    }

    public function update(EmployeeUpdateRequest $request,$id){
        $employee = Expert::query()->findOrFail($id);
        $data = $request->validated();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        $data['avatar'] = $this->imageProcess($request->file('avatar'));
        if($request->hasFile('avatar')){
            /* Check Image column null or not.  If not null unlink it, otherwise store a new image  */
            if(!empty($employee->avatar)){
                $path = public_path("project_files/user".$employee->user_id."/employee/".$employee->avatar);
                $this->UnlinkImage($path);
            }
        }

        $employee->update($data);
        session()->flash('success','Successfully Employee Updated.');
        return redirect()->route('employee.add');
    }

    public function destroy(Request $request){
        $employee = Expert::query()->findOrFail($request->id);

        if($employee->subDepartments->count()<=0) {
            $employee->delete();
            return response()->json(['success' => 'Data Deleted', 'code' => 200]);
        }
    }
}
