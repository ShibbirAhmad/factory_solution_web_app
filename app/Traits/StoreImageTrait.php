<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Boolean;


trait StoreImageTrait{

    public function fileRename(): string
    {
        return "user_id_".auth()->id()."_R_Solution_PS_";
    }

    public function ImageStore($file,$path,$height=null,$width=null) : string
    {
        // Dynamically User wise Folder Creation so that we can filter easily client wise files
        $dynamicPath = public_path('storage/project_files/user'.auth()->id().'/'.$path);

        if (!file_exists($dynamicPath)) {
            mkdir($dynamicPath, 666, true);
        }

        $fileName = $this->fileRename().substr(md5(time()),0,5)  .'.'.$file->getClientOriginalExtension();
        $img = Image::make($file->path());
        $img->resize($width,$height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($dynamicPath.'/'.$fileName);

       return $fileName;
    }

    public function UnlinkImage($path)
    {
        return unlink($path);
    }




}
