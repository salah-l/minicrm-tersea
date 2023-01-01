<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'email',
        'password',
        'company_id',
        'address',
        'phone',
        'birthdate',
        'token'
    ]; 
    protected $hidden = [
        'password',
        'token',
        'token_expiry_date',
        'is_verified'
    ];
}