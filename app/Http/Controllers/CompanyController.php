<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{


    function getCompany($id){




        if(Company::whereId($id)->exists()){
            $section_title = "Détails de la Sociéte";
            return view('company', ['company' => Company::find($id), 'sectionTitle' => $section_title]);
        }

        return ['message' => 'No Such Company'];
        
    }


    function getAllCompanies(){
        return ['data' => Company::all()];
    }

    function viewCreateCompanyPage(){

        return view('createCompany');
    }

    function viewAllCompanies(){
        return view('companies', ['message' => null, 'alert' => null]);
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

        
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:1000',
        ]);


        $message = 'La Société a été créé avec succès!';
        $alert = 'success';

        try{
            $company = Company::where('name', '=', $request->name)->exists();
            if($company){
                $message = 'La Société est déja créé!';
                $alert = 'danger';
            }else{
                Company::create([
                    'name' => $request->name,
                    'description'=> $request->description
                ]);
            }


        }catch(\Exception $e){
            $message = $e->getMessage();
            $alert = 'danger';
        }


        return view('alert', ['message' => $message, 'alert' => $alert]);    


    }


    function updateCompany(Request $request){
        
        
        $request->validate([
            'description' => 'max:1000',
        ]);

        $message = 'La Société a été modifié avec succès!';
        $alert = 'success';

        try{
            $company = Company::find($request->id);

            if($company){
                    $company->update([
                        'description' => $request->description
                    ]);

                
            }

        }catch(\Exception $e){
            
            $message = $e->getMessage();
            $alert = 'danger';
        }


        return view('alert', ['message' => $message, 'alert' => $alert]);

    }


    function deleteCompany($id){

        $message = 'La Société a été supprimé avec succès!';
        $alert = 'success';
        try{

            $company = Company::find($id);
            if($company){
                $company->delete();
            }


        }catch(\Exception $e){

            $message = $e->getMessage();
            if($e->getCode() == 23000){
                $message = "La Société n'a pas été supprimé car il y'en a des Employés!";
                $alert = 'danger';
            }
        }

        return view('alert', ['message' => $message, 'alert' => $alert]);

        
    }


}