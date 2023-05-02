<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
trait ValidationTrait {
    public function signup($request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:20|min:2',
            'last_name' => 'required|string|max:20|min:2',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:10',
            'gender'=>['required',  Rule::in(['male', 'female']),],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['Message' => 'ERORR'],status:Response::HTTP_BAD_REQUEST);
        }
    }
}

















