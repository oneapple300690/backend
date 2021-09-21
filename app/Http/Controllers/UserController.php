<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req){
        $user = new User();
        $user->first_name = $req->input('first_name');
        $user->middle_name = $req->input('middle_name');
        $user->last_name = $req->input('last_name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->save();
        return $user;
    }

    function login(Request $req) {
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return ['error' => 'Email or Password is incorrect!'];
        }
        return $user;
    }
}
