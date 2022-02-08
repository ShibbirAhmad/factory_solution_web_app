<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use StoreImageTrait;
    public $uploadFolder = 'user';

    public function index()
    {
        $users = User::all();
        return view('admin.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->imageProcess($request->file('image'));
        User::query()->create($data);
        session()->flash('success', 'Successfully user Created');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
        } else {
            $user->status = 1;
            $user->save();
        }

        return redirect()->route('admin.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        $data['users'] = User::query()->orderBy('name')->get();
        return view('admin.admin.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $data = $request->validated();
        $data['image'] = $this->imageProcess($request->file('image'));
        /* New Image Found start  */
        if ($request->hasFile('image')) {
            /* Check Image column null or not.  If not null unlink it, otherwise store a new image  */
            if (!empty($user->image)) {
                $path = public_path("storage/project_files/user" . $user->user_id . "/user/" . $user->image);
                $this->UnlinkImage($path);
            }
        }
        /* New Image Found End */
        $user->update($data);
        session()->flash('success', 'Successfully user Updated.');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imageProcess($file)
    {
        return ($file ? $this->ImageStore($file, $this->uploadFolder, 250, 250) : null);
    }

    public function profile($id)
    {
        return view('admin.admin.profile');
        // $user = User::findOrFail($id);
        // return $user;
    }
}
