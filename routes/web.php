<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController; 
use \App\Http\Controllers\CompanyController; 
use \App\Http\Controllers\EmployeeController; 
use \App\Http\Controllers\InvitationController; 
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\AuditController;  

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
// Route::middleware('IsUser')->group(function () {


Route::group(['middleware' => 'guest'], function () {

Route::get('/login', [LoginController::class, 'loginPage']);
Route::post('/login', [LoginController::class, 'login']);

});


//Admin
Route::group(['middleware' => 'user.auth'], function () {

Route::get('/', [UserController::class, 'index']);
Route::get('/home', [UserController::class, 'home']);
Route::get('/user', [UserController::class, 'viewCreateUserPage']);//Done
Route::get('/users', [UserController::class, 'getAllUsers']);//Done
Route::get('/user/{id}', [UserController::class, 'getUser']);//Done
Route::post('/user', [UserController::class, 'createUser']);//Done
Route::put('/user', [UserController::class, 'updateUser']);//Done


Route::get('/companies/{id}', [CompanyController::class, 'getCompany']); //Done 
Route::get('/companies', [CompanyController::class, 'getAllCompanies']); //Done
Route::get('/companiesList', [CompanyController::class, 'viewAllCompanies']); //Done
Route::get('/company', [CompanyController::class, 'viewCreateCompanyPage']);//Done
Route::post('/company', [CompanyController::class, 'createCompany']);//Done
Route::put('/company', [CompanyController::class, 'updateCompany']);//Done
Route::delete('/company/{id}', [CompanyController::class, 'deleteCompany']);//Done

Route::get('/employees/{id}', [EmployeeController::class, 'getEmployee']);//Done
Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);//Done
Route::get('/employeesList', [EmployeeController::class, 'viewAllEmployees']);//Done
Route::put('/employees', [EmployeeController::class, 'updateEmployee']);//Done
Route::delete('/employee/{id}', [EmployeeController::class, 'deleteEmployee']);//Done


Route::get('/invitations', [InvitationController::class, 'getAllInvitations']);//Done
Route::get('/invitationsList', [InvitationController::class, 'viewAllInvitations']);//Done
Route::put('/invitation/{id}', [InvitationController::class, 'cancelInvitation']);//Done
Route::get('/invitation', [InvitationController::class, 'viewInvitationPage']);//Done
Route::post('/invitation', [InvitationController::class, 'sendInvitation']);//Done


Route::get('/audit', [AuditController::class, 'auditPage']);//Done
Route::post('/audit', [AuditController::class, 'audit']);//Done

 
});





    
// });


//Employee

Route::get('/employee/registration/{id}/{token}', [EmployeeController::class, 'confirmInvitationPage']);
Route::put('/invitation/employee/{id}', [EmployeeController::class, 'updateInvitationStatus']);
Route::get('/employee/password/{id}', [EmployeeController::class, 'updatePasswordPage']);//Done
Route::put('/employee/password', [EmployeeController::class, 'updateEmployeePassword']);//Done
Route::get('/employees/registration/details', [EmployeeController::class, 'setEmployeeDetailsPage']);//Done
Route::put('/employees/registration/details', [EmployeeController::class, 'setEmployeeDetails']);//Done

Route::group(['middleware' => 'employee.auth'], function () {


Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employeeHome', [EmployeeController::class, 'home']);
Route::get('/employee/{id}', [EmployeeController::class, 'getEmployeeAccount']);
Route::put('/employee', [EmployeeController::class, 'updateEmployee']);//Done
Route::get('/company/employee/{id}', [EmployeeController::class, 'viewEmployeeCompany']);//Done
Route::get('/collegues/employee', [EmployeeController::class, 'getEmployeeColleguesView']);
Route::get('/collegues/list/employee', [EmployeeController::class, 'getEmployeeCollegues']);

});

//logout
Route::post('/logout', function () { 
    \Auth::guard('user')->logout(); 
    \Auth::guard('employee')->logout();
    return ['newLocation', '/login'];
});



