<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;


class LoginController extends Controller
{
    
    function loginPage(){
        return view('loginPage');
    }


    function login(Request $request){

        $request->validate([
            'email' => "required|email",
            'password' => "required|min:8",
        ]);


        if($request->guard === 'user'){

            if(\Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])){
                $user = \Auth::guard('user')->user();
                \Auth::login($user);
                \Session::put('user', [
                    'user_name' => $user->name,
                    'user_id' => $user->id,
                    'user_role' => $user->role,
                ]);
                
                return ['newLocation', '/'];
            }
        }else{

            if(\Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])){

                $employee = \Auth::guard('employee')->user();
                \Auth::login($employee);
                
                \Session::put('employee', [
                    'name' => $employee->name,
                    'id' => $employee->id,
                    'company_id' => $employee->company_id,
                ]);

                return ['newLocation', '/employee'];
                
            }
        }

    }

}
