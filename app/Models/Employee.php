<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $guard = 'employee';

    protected $fillable= [
        'name',
        'email',
        'password',
        'company_id',
        'address',
        'phone',
        'birthdate',
        'token',
        'is_verified'
    ]; 
    protected $hidden = [
        'password',
        'token',
        'token_expiry_date',
        'is_verified'
    ];

    public function invitation()
    {
        return $this->hasOne(Invitation::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}