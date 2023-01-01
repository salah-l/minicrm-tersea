<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController; 
use \App\Http\Controllers\CompanyController; 
use \App\Http\Controllers\EmployeeController; 
use \App\Http\Controllers\InvitationController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin
Route::get('/', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'createUser']);//Done
Route::get('/users', [UserController::class, 'getAllUsers']);//Done

Route::get('/companies/{id}', [CompanyController::class, 'getCompany']); //Done 
Route::get('/companies', [CompanyController::class, 'getAllCompanies']); //Done
Route::post('/company', [CompanyController::class, 'createCompany']);//Done
Route::put('/company', [CompanyController::class, 'updateCompany']);//Done
Route::delete('/company/{id}', [CompanyController::class, 'deleteCompany']);//Done

Route::get('/employees/{id}', [EmployeeController::class, 'getEmployee']);//Done
Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);//Done

Route::get('/invitations', [InvitationController::class, 'getAllInvitations']);//Done
Route::put('/invitation/{id}', [InvitationController::class, 'cancelInvitation']);//Done
Route::post('/invitation', [InvitationController::class, 'sendInvitation']);//Done



//Employee
Route::get('/employee/registration/{id}/{token}', [EmployeeController::class, 'updatePasswordPage']);//Done
Route::put('/employee', [EmployeeController::class, 'updateEmployeePassword']);//Done
Route::put('/employees/registration/details', [EmployeeController::class, 'setEmployeeDetails']);//Done

// Route::get('/employees/{id}', [EmployeeController::class, 'viewEmployee']);
// Route::put('/employees/{id}', [EmployeeController::class, 'updateEmployee']);

// Route::get('/company/{id}', [CompanyController::class, 'viewCompany']); 
Route::get('/company/employees/{id}', [CompanyController::class, 'viewEmployeeCompany']);//Done