<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invitation;
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Audit;
use App\Mail\InvitationMail;

class InvitationController extends Controller
{
    

    function getAllInvitations(){
        return Invitation::all();
    }

    function cancelInvitation($id){

        //Needs Data Validation
        $message = 'No Such invitation';
        $invitation = Invitation::find($id);
        if($invitation){
            if($invitation->status == 'Pending'){
                $invitation->update(['status' => 'Canceled']);
            }
        }

        return ['message' => $message];

    }

    function sendInvitation(Request $request){

        // request()->validate([
        //     'name' => ['required'],
        //     'email' => ['required'],
        //     'company' => ['required']
        // ]);

        $message = 'Invitation sent Successfully';

        
        if(!(Company::find($request->company_id))){
            $message = "Company doesn't exists";
        }else{
            
            $admin_name = User::find($request->user_id)->name;
            $token = \Str::random(32);    

            //Create Employee 
            $invited_employee = Employee::create([

                'name' => $request->name,
                'email' => $request->email,
                'company_id' => $request->company_id,
                'token' => $token
                
            ]);
            $registration_link = "http://localhost:8000/employee/registration/".$invited_employee->id."/".$token;
            
            
            \Mail::to($request->email)->send(

                    new InvitationMail(
                        $admin_name,
                        $request->name,
                        $request->company,
                        $registration_link
                    )
                    
            );

            //Need a way to check email successful delivery before creating employee

            
            //Create Invitation record
            Invitation::create([
                
                'user_id' => $request->user_id,
                'employee_id' => $invited_employee->id,
                'company_id' => $request->company_id
                
            ]);
        
        }
        
        return ['message' => $message];
        
    }

}