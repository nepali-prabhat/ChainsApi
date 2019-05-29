<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    public function login(Request $request){

        $user = null;
        if($request->has('username')){
            $user = User::where('username',$request->input('username'))->get();
        }else
            {
                if($request->has('email')){
                $user = User::where('email',$request->input('email'))->get();
            }
        }
        if($user){
            if(Hash::check($request->input('password'), $user[0]->password)){
                $payload= [
                    "id" => $user[0]->id,
                    "iat"=> time()
                ];
                $token = JWT::encode($payload,env("APP_KEY") );
                return response()->json([
                    "success"=>true,
                    "user"=>$user[0],
                    "token"=>$token
                ],200);
            };
        }
        return response()->json([
            "success"=>false,
        ],404);
    }
    public function signup(Request $request){
        $this->validate($request,[
            'username'=>'required|unique:users|min:7',
            'f_name'=>'required',
            'l_name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);
        $inputs = $request->all();

        $inputs['password'] = Hash::make($inputs['password']);

        $user = User::create($inputs);
        return $user;
    }

    public function userDetails($id, Request $request){
        print_r($request->auth);
        $user = User::findOrFail($id);
        return $user;
    }
}
