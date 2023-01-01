<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    

    function createUser(Request $request){

        //data validation
        $messsage = 'User Created';
        Company::create([
                'name' => $request->name,
                'email'=> $request->description,
                'password' => $request->password,
                'role' => $request->role
            ]);

        return ['message' => $messsage];

    }

    function getAllUsers(){
        return User::all();
    }


}