<?php

namespace App\Http\Controllers\Admin\Prototype;

use App\Models\Expert;
use App\Models\Category;
use App\Models\Prototype;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
use App\Http\Controllers\Controller;
use App\Services\Prototype\PrototypeService;
use App\Http\Requests\Prototype\PrototypeStoreRequest;
use App\Http\Requests\Prototype\PrototypeUpdateRequest;

class ProtoTypeController extends Controller
{
    use StoreImageTrait;
    public $uploadFolder = 'prototype';
    public function index(Request $request){

        if($request->ajax()){
            $prototype = Prototype::query()->findOrFail($request->id);
            $prototype->update([
                'status'=>($prototype->status == 0 ? 1 : 0 ),
                'verification_note'=>$request->message,
                'approved_by'=>auth()->id(),
                'proto_type_verified_at'=>now()
            ]);
            return response()->json(['prototype'=>$prototype,'message'=>'Prototype status changed.']);
        }
        $data['categories'] = Category::query()->orderBy('name')->pluck('name','id');
        $data['prototypes'] = Prototype::query()->orderBy('code')->get();
        $data['employees'] = Expert::query()->where('designation_id',2)->orderBy('name')->get(['id','name','phone']) ?? null;
        return view('admin.prototype.index')->with($data);
    }

    public function store(PrototypeStoreRequest $request){
        $savePrototype = (new PrototypeService())->savePrototype($request->validated(),$this->uploadFolder);
        session()->flash('success','Successfully Prototype/Design Created');
        return redirect()->route('prototype.add');
    }

    public function edit($id){
        $data['prototype'] = Prototype::query()->findOrFail($id);
        $data['categories'] = Category::query()->orderBy('name')->pluck('name','id');

         $data['prototypes'] = Prototype::query()->orderBy('code')->get();
        $data['employees'] = Expert::query()->where('department_id',3)->orderBy('name')->get(['id','name','phone']) ?? null;
        return view('admin.prototype.edit-prototype')->with($data);
    }


    public function update(PrototypeUpdateRequest $request,$id){
        $prototype = Prototype::query()->findOrFail($id);
        $data = $request->validated();
        $data['image'] = $this->imageProcess($request->file('image'));
        /* New Image Found start  */
        if($request->hasFile('image')){
            /* Check Image column null or not.  If not null unlink it, otherwise store a new image  */
            if(!empty($prototype->image)){
                $path = public_path("project_files/user".$prototype->user_id."/prototype/".$prototype->image);
                $this->UnlinkImage($path);
            }
        }
        /* New Image Found End */
        $prototype->update($data);
        session()->flash('success','Successfully Prototype Updated.');
        return redirect()->route('prototype.add');
    }


    public function imageProcess($file){
        return ($file ? $this->ImageStore($file,$this->uploadFolder,600,600) : null);
    }

    public function destroy(Request $request){
        $prototype = prototype::query()->findOrFail($request->id);
        // Checking any purchase record found or not. If Any Purchase record found prototype will not be deleted.
        if($prototype->purchases && $prototype->purchases->count()>0){
            session()->flash('error','prototype Can\t be delete.');
            return response()->json(['success'=>'Data not deleted','code'=>300]);
        }else{
            $prototype->delete();
            return response()->json(['success'=>'Data Deleted','code'=>200]);
        }
    }
}
