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
Route::post('/users', [UserController::class, 'createUser']);

Route::get('/companies/{id}', [CompanyController::class, 'getCompany']);
Route::get('/companies', [CompanyController::class, 'getAllCompanies']);
Route::post('/companies', [CompanyController::class, 'createCompany']);
Route::put('/companies/{id}', [CompanyController::class, 'updateCompany']);
Route::delete('/companies/{id}', [CompanyController::class, 'deleteCompany']);

Route::post('/employees', [EmployeeController::class, 'inviteEmployee']);
Route::get('/employees/{id}', [EmployeeController::class, 'getEmployee']);
Route::get('/employees', [EmployeeController::class, 'getEmployees']);

Route::get('/invitations', [InvitationController::class, 'getInvitations']);
Route::put('/invitations/{id}', [InvitationController::class, 'updateInvitationStatus']);
Route::post('/invitations', [InvitationController::class, 'sendInvitation']);


//Employee
Route::put('/employees/registration/{token}', [EmployeeController::class, 'setEmployeePassword']);
Route::put('/employees/registration/details/{token}', [EmployeeController::class, 'setEmployeeDetails']);

Route::get('/employees/{id}', [EmployeeController::class, 'viewEmployee']);
Route::put('/employees/{id}', [EmployeeController::class, 'updateEmployee']);

Route::get('/company/{id}', [CompanyController::class, 'viewCompany']);
Route::get('/company/{id}/employees', [CompanyController::class, 'viewCompany']);