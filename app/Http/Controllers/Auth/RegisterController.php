<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Database\QueryException;
class RegisterController extends Controller
{
    use ResponseTrait;

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:25','min:2'],
            'last_name' => ['required', 'string', 'max:25','min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['string', 'min:10'],
            'gender'=>['required',  Rule::in(['M', 'F']),],
        ]);
    }

    protected function create(Request $request)
    {
        $validator = $this->validator($request);
        if($validator->errors()->all()){
            return $validator->errors()->all();
        }
        
        try{
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'phone' => $request['email'],
                'gender' => $request['gender'],
            ]);
            $token = $user->createToken('myapptoken')->plainTextToken;
            }catch(QueryException $e){
                return $this->returnError("Server Error",500);
            }catch(Exception $e){
                return $this->returnError("Server Error",500);
            }

            return $this->returnData("user",[
                'name' => $user['first_name'].' '.$user['last_name'],
                'email' => $user['email'],
                'token' => $token,
            ],"Account successfully created");
    }
}
