<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;

class AuditController extends Controller
{
    

    function auditPage(){
        return view('audit');
    }

    function audit(){
        $audit = Audit::all()->transform(function ($events) {
                    return (object) $events->toArray();
                })->all();

           

                return ['data' => $audit];
    }




}
