<?php
namespace App\Http\Traits;

trait ResponseTrait {
    public function returnSuccess($message=null,$status_number=200)
    {
        return response()->json([
                'message'=>$message,
            ],$status_number);
    }
    public function returnError($message=null,$status_number=400)
    {
        return response()->json([
                'message'=>$message,
            ],$status_number);
    }
    public function returnData($key,$value,$message=null,$status_number=200)
    {
        return response()->json([
                'message'=>$message,
                $key=>$value,
            ],$status_number);
    }
}


