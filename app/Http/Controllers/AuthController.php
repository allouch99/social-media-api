<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ValidationTrait;
use App\Models\User;
class AuthController extends Controller
{
    use ValidationTrait;
    public function signup(Request $request)
    {
        $user= User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
            'phone' =>$request->phone,
            'gender'=>$request->gender,
            //'role'=>'admin',
        ]);

        
        
    }
}
