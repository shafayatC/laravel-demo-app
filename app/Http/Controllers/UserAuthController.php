<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends Controller
{
    //

    function signup(Request $req){
        $input = $req->all(); 
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token['user'] = $user->name; 
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $user['name'] = $user->name;
        return ['success' => true, "result" => $success];
        // return $input;
    }

    function login(Request $req){
        return 'login';
    }
}