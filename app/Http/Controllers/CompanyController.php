<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{


    function getCompany($id){

        if(Company::whereId($id)->exists()){
            $company = Company::whereId($id)->first();
            return [
                'company_name' => $company->name,
                'company_description' => $company->description,
            ];
        }

        return ['message' => 'No Such Company'];
        
    }

    function getAllCompanies(){
        return Company::all();
    }

    function viewEmployeeCompany($id){
        

        $company = Company::join('employees', 'companies.id', '=', 'employees.company_id')
                        ->where('employees.id', '=', $id)
                        ->select('companies.*')
                        ->first();

        return [
            'company_name' => $company->name,
            'description' => $company->description
        ];
    }


    function createCompany(Request $request){

        //Needs Data Validation
        $messsage = 'Company Created';
        Company::create([
                'name' => $request->name,
                'description'=> $request->description
            ]);

        return ['message' => $messsage];

    }


    function updateCompany(Request $request){
        
        //Needs Data Validation
        $messsage = 'Something went wrong';
        $company = Company::find($request->id);
        if($company){
            $company->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            
            $updated_company = Company::find($request->id)->fresh();
            $messsage = [
                'updatedCompany' => $updated_company,
            ];
        }

        return ['message' => $messsage];

    }


    function deleteCompany($id){

        $messsage = '404 Error';
        try{

            $company = Company::find($id);
            if($company){
                $company->delete();
                $message = 'Company Deleted!';
            }


        }catch(\Exception $e){

            if($e->getCode() == 23000){
                $message = "Can't delete company with employees in it!";
            }
            $message = $e->getMessage();

        }

        return ['message' => $messsage];
        
    }


}