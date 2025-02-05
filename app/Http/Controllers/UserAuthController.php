<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class UserAuthController extends Controller
{
    //
    function login(Request $request){   
        return "Login API Function";
    }

    function signup(Request $request){
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $succes['token'] = $user->createToken('MyApp')->plainTextToken;
        $succes['name'] = $user->name;
        return ['result' => $succes, 'msg' => "user Register Succesfully"];
    }
}
