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

Route::get('/', [UserController::class, 'index']);//index page for users
Route::get('/home', [UserController::class, 'home']);//contains only the content-section of index page to be loaded with Ajax calls
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::put('/user', [UserController::class, 'updateUser']);
Route::get('/user', [UserController::class, 'viewCreateUserPage']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::post('/user', [UserController::class, 'createUser']);



Route::get('/companies', [CompanyController::class, 'getAllCompanies']); 
Route::get('/companies/{id}', [CompanyController::class, 'getCompany']); 
Route::get('/companiesList', [CompanyController::class, 'viewAllCompanies']); 
Route::get('/company', [CompanyController::class, 'viewCreateCompanyPage']);
Route::post('/company', [CompanyController::class, 'createCompany']);
Route::put('/company', [CompanyController::class, 'updateCompany']);
Route::delete('/company/{id}', [CompanyController::class, 'deleteCompany']);


Route::get('/employees/{id}', [EmployeeController::class, 'getEmployee']);
Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
Route::get('/employeesList', [EmployeeController::class, 'viewAllEmployees']);
Route::put('/employees', [EmployeeController::class, 'updateEmployee']);
Route::delete('/employee/{id}', [EmployeeController::class, 'deleteEmployee']);


Route::get('/invitations', [InvitationController::class, 'getAllInvitations']);
Route::get('/invitationsList', [InvitationController::class, 'viewAllInvitations']);
Route::put('/invitation/{id}', [InvitationController::class, 'cancelInvitation']);
Route::get('/invitation', [InvitationController::class, 'viewInvitationPage']);
Route::post('/invitation', [InvitationController::class, 'sendInvitation']);


Route::get('/audit', [AuditController::class, 'auditPage']);
Route::post('/audit', [AuditController::class, 'audit']);

 
});





    
// });


//Employee

Route::get('/employee/registration/{id}/{token}', [EmployeeController::class, 'confirmInvitationPage']);
Route::put('/invitation/employee/{id}', [EmployeeController::class, 'updateInvitationStatus']);
Route::get('/employee/password/{id}', [EmployeeController::class, 'updatePasswordPage']);
Route::put('/employee/password', [EmployeeController::class, 'updateEmployeePassword']);
Route::get('/employees/registration/details', [EmployeeController::class, 'setEmployeeDetailsPage']);
Route::put('/employees/registration/details', [EmployeeController::class, 'setEmployeeDetails']);


Route::group(['middleware' => 'employee.auth'], function () {


Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employeeHome', [EmployeeController::class, 'home']);
Route::get('/employee/{id}', [EmployeeController::class, 'getEmployeeAccount']);
Route::put('/employee', [EmployeeController::class, 'updateEmployee']);
Route::get('/company/employee/{id}', [EmployeeController::class, 'viewEmployeeCompany']);
Route::get('/collegues/employee', [EmployeeController::class, 'getEmployeeColleguesView']);
Route::get('/collegues/list/employee', [EmployeeController::class, 'getEmployeeCollegues']);


});

//logout
Route::post('/logout', function () { 
    \Auth::guard('user')->logout(); 
    \Auth::guard('employee')->logout();
    return ['newLocation', '/login'];
});



