<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //



    function signup(Request $req){

        $rules  = [
        'name' => 'required | min:6 | max:30',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
        ];
    

        $validation = Validator::make($req->all(), $rules);

        if($validation->fails()){
            return $validation->errors();
        } else {
            $input = $req->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $token['user'] = $user->name; 
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $user['name'] = $user->name;
            return ['success' => true, "result" => $success];
            // return $input;
        }
    }

    function login(Request $req){
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }else{
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['user'] = $user->name;
            return ['success' => true, "result" => $success];
        }
    }
}