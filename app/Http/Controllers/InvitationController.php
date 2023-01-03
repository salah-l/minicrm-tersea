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

        $invitations = Invitation::join('employees', 'employees.id', '=', 'invitations.employee_id')
                                 ->join('companies', 'companies.id', '=', 'invitations.company_id')
                                 ->join('users', 'users.id', '=', 'invitations.user_id')
                                 ->select('employees.name as employee_name',
                                        'users.name as user_name',
                                        'companies.name as company_name',
                                        'invitations.*' 
                                    )
                                 ->get()
                                 ->transform(function ($invitation) {
                                      return (object) $invitation->toArray();
                                  })->all();                         
        return ['data' => $invitations];
    }

    function viewAllInvitations(){
        return view('invitations');
    }

    function cancelInvitation($id){

        //Needs Data Validation
        $message = 'Invitations annulée avec succès!';
        $alert = "success";
        try{
            $invitation = Invitation::find($id);
            if($invitation){
                if($invitation->status == 'Envoyée'){
                    $invitation->status = 'Annulée';
                    $invitation->save();
                    $invitation->employee()->update(['token' => null]) ;

                    $admin_name = \Session::get('user')['user_name'];
                    $employee_name = Employee::find($invitation->employee_id)->name;
                    $company_name = Company::find($invitation->company_id)->name;
                    Audit::create([
                        'event' => "Admin \"$admin_name\" a annulé l'invitation de l'employé \"$employee_name\" pour joindre la société \"$company_name\"",
                    ]);

                }
            }
        }catch(\Exception $e){
            $message = $e->getMessage();
            $alert = "danger";
        }

        return view('alert', ['message' => $message, 'alert' => $alert]);

    }

    function viewInvitationPage(){

        return view('inviteEmployee', [ 'companies' => Company::all()]);
    }

    function sendInvitation(Request $request){

        // request()->validate([
        //     'name' => ['required'],
        //     'email' => ['required'],
        //     'company' => ['required']
        // ]);


        $message = "L'Invitation est envoyée avec succès!";
        $alert = 'success';

        try{

        $company = Company::find($request->company_id);   
        if(!$company){
            $message = "La Société n'existe pas!";
        }else{
            
            $admin_name = User::find(\Session::get('user')['user_id'])->name;
            $token = \Str::random(16);    

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
                        $company->name,
                        $registration_link
                    )
                    
            );

            //Create Invitation record
            Invitation::create([
                
                'user_id' => \Session::get('user')['user_id'],
                'employee_id' => $invited_employee->id,
                'company_id' => $request->company_id
                
            ]);

            Audit::create([
                'event' => "Admin \"$admin_name\" a invite l'employé \"$request->name\" à joindre la société \"$company->name\"",
            ]);
        
        }
    }catch(\Exception $e){
        $errorCode = $e->errorInfo[1];
        $message = $e->getMessage();
        $alert = 'danger';
        if($errorCode == 19){
            $message = 'Cet Employé a été déja invité!';
         }
    }
        


        return view('alert', [  'message' => $message, 'alert' => $alert]);
        
    }

}