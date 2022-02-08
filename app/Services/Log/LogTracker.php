<?php

namespace App\Services\Log;
use Illuminate\Support\Facades\Log;
class LogTracker
{
    public static function successLog($data,$user = null){
        $data['data'] = $data;
        $data['url'] = url()->full();
        $data['ip'] = request()->ip();
        $data['user'] = $user;
        Log::channel('CoderSyntaxError')->info(json_encode($data));
    }

    public static function failLog($e,$user = null){
        $data['error'] = $e->getMessage();
        $data['code'] = $e->getCode();
        $data['url'] = url()->full();
        $data['ip'] = request()->ip();
        $data['user'] = $user;
        Log::channel('CoderSyntaxError')->info(json_encode($data));
    }
}
