<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    

    function getEmployee($id){

        if(Employee::where('id', $id)->exists()){
            $employee = Employee::find($id, ['name', 'email', 'address', 'phone', 'birthdate']);
            $company = Company::find(Employee::find($id)->company_id, ['name']);
            return ['employee' => $employee, 'company' => $company];
        }

        return ['message' => 'No Such Employee'];

    }

    function getAllEmployees(){

        return Employee::all();

    }

    function updatePasswordPage($id, $token){
        

        $message = '404 NOT FOUND';
        $employee = Employee::where("token", "=", $token);
        if($employee->exists()){
            $message = 'view.setPasswordPage';
            if($employee->first()->token_expiry_date < Carbon::now()){
                $message = 'view.Link_expired';
            }else if(!$employee->first()->token){
                $message = 'view.setDetailsPage';
            }
        }

        
        return ['message' => $message];
        //this will return a view to update password that send a post request to call updateEmployeePassword()
    }

    function updateEmployeePassword(Request $request){
        
        //Data validation
        $message = 'Password saved!';
        $hashedPassword = \Hash::make($request->password);

        $updated_employee = Employee::whereId($request->id)->update([
            'password' => $hashedPassword,
            'token' => null
        ]);


        //This will redirect to the update info page.
        return ['message' => $message];

    }

    function setEmployeeDetails(Request $request){
        
        //Data validation required
        
        $message = 'Details saved!';
        
        $updated_employee_details = Employee::whereId($request->id)->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate
        ]);


        //This will redirect to the employee profile.
        return ['message' => $message];

    }

}