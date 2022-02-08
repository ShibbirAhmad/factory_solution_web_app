<?php
namespace App\Helper;
use Illuminate\Support\Facades\Auth;

$_SESSION['pathName'] = '/storage/project_files/user';


function dynamicFileLink($folderName){
    return Auth::check() ? $_SESSION['pathName'].auth()->id()."/".$folderName."/" : null;
}

function noImage(){
    return asset('project_files/404.jpg');
}


