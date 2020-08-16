<?php


namespace App\Http\Helper;




use Laravel\Lumen\Http\Request;

class ResponserBuilder
{
    public static function result($status='', $info='', $data=''){
        return response()->json(['status'=>$status,'msg'=>$info,'data'=>$data],200);
    }
}
