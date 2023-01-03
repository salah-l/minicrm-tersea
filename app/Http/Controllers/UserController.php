<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{



    
    function index(){
        return view('userHome');
    }

    function home(){
        return view('home');
    }



    function getUser($id){

        $section_title = "Compte d'utilisateur Minicrm";
        if($id == "me" or $id == \Session::get('user')['user_id']){
            $id = \Session::get('user')['user_id'];
            $section_title = "Mon Compte Minicrm";
        }
        return view('account', [
            'user' => User::find($id), 
            'sectionTitle' => $section_title,
        ]);
    }

    function viewCreateUserPage(){
        return view('createUser');
    }

    function createUser(Request $request){

        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'role' => 'required'
        ]);


        $message = "L'utilisatuer a été créé avec succès!";
        $alert = 'success';

        try{

            User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => \Hash::make($request->password),
                'role' => $request->role
            ]);

        }catch(\Exception $e){
            $errorCode = $e->errorInfo[1];
            $message = $e->getMessage();
            $alert = 'danger';
            if($errorCode == 19){
                $message = 'Ce email existe déja!';
             }
        }


        return view('alert', ['message' => $message, 'alert' => $alert]);  

    }

    function getAllUsers(){
        return User::all();
    }

    function updateUser(Request $request){


        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $message = "Votre compte a été modifié avec succès!";
        $alert = 'success';
        try{

            $id =\Session::get('user')['user_id']; 
             
            User::find($id)->update([
                'name' => $request->name,
                'email'=> $request->email,
                'role' => $request->role
            ]);


        }catch(\Exception $e){
            $errorCode = $e->errorInfo[1];
            $message = $e->getMessage();
            $alert = 'danger';
            if($errorCode == 19){
                $message = 'Ce email existe déja!';
             }
        }


        return view('alert', [
            'message' => $message, 
            'alert' => $alert
        ]);  


    }


}