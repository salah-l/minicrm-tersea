<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Audit;

class EmployeeController extends Controller
{
    


    function index(){
        return view('employeeHome');
    }

    function home(){
        return view('employeeHomePage');
    }

    function getEmployeeAccount($id){

        if($id == "me"){
            $id = \Session::get('employee')['id'];
        }

        $employee = Employee::find($id);
        $company = Company::whereId($employee->company_id)->first();

        return view('employeeAccount', [
            'employee' => $employee,
            'company' => ['name' => $company->value('name'), 'id' => $employee->company_id]
        ]);


    }


    function getEmployee($id){



        if(Employee::where('id', $id)->exists()){

            if(Employee::where('id', $id)->where('is_verified', '=', 1)->exists()){
                    $employee = Employee::join('companies', 'companies.id', '=', 'employees.company_id')
                                    ->where('employees.id', '=', $id)
                                    ->select('employees.*', 'companies.name as company_name')
                                    ->get()
                                    ->transform(function ($employee) {
                                        return (object) $employee->toArray();
                                    })[0];
                
                $companies = Company::all();                   

                return view('employee', [
                    'message' => null,
                    'employee' => $employee, 
                    'companies' => $companies,
                    'sectionTitle' => "Modifier Détails d'Employé"
                ]);
            }

            return view('employee', [
                'message' => "L'Employé n'a toujours pas valider son profile!",
                'sectionTitle' => "Modifier Détails d'Employé"
            ]);
            
        }

        return view('employee', [
            'message' => "L'Employé n'existe pas!",
            'sectionTitle' => "Modifier Détails d'Employé"
        ]);


    }

    function getAllEmployees(){


        $employees = Employee::join('companies', 'companies.id', '=', 'employees.company_id')
                       ->where('is_verified', '=', 1)
                       ->select('employees.*', 'companies.name as company_name')
                       ->get()
                       ->transform(function ($employee) {
                            return (object) $employee->toArray();
                        })->all();

        return ['data' => $employees];
        

    }

    function viewAllEmployees(){
        return view('employees');
    }

    function confirmInvitationPage($id, $token){
        
        //To review how access will work here
        $employee = Employee::find($id);
        if($employee){
            if($token == $employee->token){

                $session = \Session::put('employee', [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'company_id' => $employee->company_id,
                ]);

                $comapny_name = Company::find($employee->company_id)->name;
                return view('employeeInvitation', ['company' => $comapny_name]);
            }

        
        }

        return view('brokenUrl');
    }

    function updatePasswordPage($id){
            return view('employeeUpdatePassword', ['id' => $id]);
    }

    function setEmployeeDetailsPage(){
        return view('employeeDetails');
    }

    function updateEmployeePassword(Request $request){
        
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        $employee = Employee::find($request->id);

        if($employee){

            $hashedPassword = \Hash::make($request->password);
            $updated_employee = $employee->update([
                'password' => $hashedPassword,
                'token' => null
            ]);

            return ['newLocation', 
            '/employees/registration/details' ,
            'name' => $employee->name,
            'message' => 'Password saved!'];

        }

        return ['message' => 'Something went wrong!'];


    }


    function setEmployeeDetails(Request $request){


        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'birthdate' => 'required|date|before:-18 years',
        ]);

        
        $message = 'Details saved!';
    
        $updated_employee_details = Employee::find($request->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'is_verified' => true
        ]);

        Audit::create([
            'event' => "\"$request->name\" à confirmer son profile",
        ]);


        //This will redirect to the employee profile.
        return ['newLocation','/employee','message' => $message];

    }



    function updateEmployee(Request $request){


        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|max:1000',
            'birthdate' => 'required|date|before:-18 years',
        ]);

        $message = "L'Employé a été modifié avec succès!";
        $alert = 'success';
        try{

            Employee::find($request->id)->update([
                'name' => $request->name,
                'email'=> $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'birthdate' => $request->birthdate
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


    function deleteEmployee($id){

        $message = "L'Employé a été supprimé avec succès!";
        $alert = 'success';
        try{

            $employee = Employee::find($id);
            if($employee){
                // dd($employee->invitations());
                $employee->invitation()->delete();
                $employee->delete();

            }


        }catch(\Exception $e){

            $message = $e->getMessage();
            $alert = 'danger';

        }

        return view('alert', ['message' => $message, 'alert' => $alert]);
    }



    function viewEmployeeCompany($id){
        return view('employeeCompany', ['company' => Company::find($id)]);
    }


    function getEmployeeColleguesView(){

        return view('employeeCollegues');
    }

    function getEmployeeCollegues(){

        $employees = Employee::join('companies', 'companies.id', '=', 'employees.company_id')
                       ->where('is_verified', '=', 1)
                       ->where('companies.id', '=',\Session::get('employee')['company_id'] )
                       ->select('employees.*', 'companies.name as company_name')
                       ->get()
                       ->transform(function ($employee) {
                            return (object) $employee->toArray();
                        })->all();

        return ['data' => $employees];

    }

    function updateInvitationStatus($id, Request $request){


        if($request->has('answer')){

            if($request->answer == "1"){

                $employee = Employee::find($id);
                $invitation = $employee->invitation;
                $invitation->status = 'Acceptée';
                $invitation->save();

                Audit::create([
                    'event' => "\"$employee->name\" à validé l'invitation",
                ]);
    
                return ['newLocation', "/employee/password/$id"];
            }
        }

            return ['newLocation', "/employee/invitation/canceled"];

    }

}