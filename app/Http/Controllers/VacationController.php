<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacationController extends Controller
{
    //
    public function index(){
        return view('vacations.index');
    }
}